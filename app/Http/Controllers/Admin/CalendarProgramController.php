<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CalendarProgram;
use App\Models\CalendarProgramMonth;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class CalendarProgramController extends Controller
{
    public function index(Request $request)
    {
        $query = CalendarProgram::with('months')->ordered();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('uraian_kegiatan', 'like', "%{$request->search}%")
                  ->orWhere('penanggung_jawab', 'like', "%{$request->search}%");
            });
        }

        if ($request->filled('tahun')) {
            $query->byTahun($request->tahun);
        }

        if ($request->filled('penanggung_jawab')) {
            $query->byPenanggungJawab($request->penanggung_jawab);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $programs = $query->paginate(15)->withQueryString();
        $penanggungJawabs = CalendarProgram::distinct()->pluck('penanggung_jawab')->filter()->sort()->values();

        return view('admin.calendar.index', compact('programs', 'penanggungJawabs'));
    }

    public function create()
    {
        return view('admin.calendar.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tahun' => 'required|integer|min:2020|max:2099',
            'penanggung_jawab' => 'required|string|max:255',
            'uraian_kegiatan' => 'required|string|max:500',
            'deskripsi' => 'nullable|string',
            'bulan' => 'required|array|min:1',
            'bulan.*' => 'integer|min:1|max:12',
            'anggaran' => 'nullable|numeric|min:0',
            'urutan' => 'nullable|integer|min:0',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        try {
            $program = CalendarProgram::create([
                'tahun' => $validated['tahun'],
                'penanggung_jawab' => $validated['penanggung_jawab'],
                'uraian_kegiatan' => $validated['uraian_kegiatan'],
                'deskripsi' => $validated['deskripsi'] ?? null,
                'anggaran' => $validated['anggaran'] ?? 0,
                'urutan' => $validated['urutan'] ?? 0,
                'status' => $validated['status'],
                'created_by' => auth()->id(),
                'updated_by' => auth()->id(),
            ]);

            foreach ($validated['bulan'] as $bulan) {
                CalendarProgramMonth::create([
                    'calendar_program_id' => $program->id,
                    'bulan' => $bulan,
                ]);
            }

            return redirect()->route('admin.calendar-programs.index')
                ->with('success', 'Program kalender berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal menambahkan program: ' . $e->getMessage());
        }
    }

    public function show(CalendarProgram $calendar_program)
    {
        $calendar_program->load('months');
        $program = $calendar_program;

        return view('admin.calendar.show', compact('program'));
    }

    public function edit(CalendarProgram $calendar_program)
    {
        $calendar_program->load('months');
        $program = $calendar_program;

        return view('admin.calendar.edit', compact('program'));
    }

    public function update(Request $request, CalendarProgram $calendar_program)
    {
        $validated = $request->validate([
            'tahun' => 'required|integer|min:2020|max:2099',
            'penanggung_jawab' => 'required|string|max:255',
            'uraian_kegiatan' => 'required|string|max:500',
            'deskripsi' => 'nullable|string',
            'bulan' => 'required|array|min:1',
            'bulan.*' => 'integer|min:1|max:12',
            'anggaran' => 'nullable|numeric|min:0',
            'urutan' => 'nullable|integer|min:0',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        try {
            $calendar_program->update([
                'tahun' => $validated['tahun'],
                'penanggung_jawab' => $validated['penanggung_jawab'],
                'uraian_kegiatan' => $validated['uraian_kegiatan'],
                'deskripsi' => $validated['deskripsi'] ?? null,
                'anggaran' => $validated['anggaran'] ?? 0,
                'urutan' => $validated['urutan'] ?? 0,
                'status' => $validated['status'],
                'updated_by' => auth()->id(),
            ]);

            $calendar_program->months()->delete();
            foreach ($validated['bulan'] as $bulan) {
                CalendarProgramMonth::create([
                    'calendar_program_id' => $calendar_program->id,
                    'bulan' => $bulan,
                ]);
            }

            return redirect()->route('admin.calendar-programs.index')
                ->with('success', 'Program kalender berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal memperbarui program: ' . $e->getMessage());
        }
    }

    public function destroy(CalendarProgram $calendar_program)
    {
        try {
            $calendar_program->months()->delete();
            $calendar_program->delete();

            return redirect()->route('admin.calendar-programs.index')
                ->with('success', 'Program kalender berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus program: ' . $e->getMessage());
        }
    }

    public function duplicate($id)
    {
        try {
            $original = CalendarProgram::with('months')->findOrFail($id);

            $duplicate = CalendarProgram::create([
                'tahun' => $original->tahun,
                'penanggung_jawab' => $original->penanggung_jawab,
                'uraian_kegiatan' => $original->uraian_kegiatan . ' (Duplikat)',
                'deskripsi' => $original->deskripsi,
                'anggaran' => $original->anggaran,
                'urutan' => $original->urutan,
                'status' => $original->status,
                'created_by' => auth()->id(),
                'updated_by' => auth()->id(),
            ]);

            foreach ($original->months as $month) {
                CalendarProgramMonth::create([
                    'calendar_program_id' => $duplicate->id,
                    'bulan' => $month->bulan,
                ]);
            }

            return redirect()->route('admin.calendar-programs.index')
                ->with('success', 'Program kalender berhasil diduplikat.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menduplikat program: ' . $e->getMessage());
        }
    }

    public function timeline(Request $request)
    {
        $query = CalendarProgram::with('months')->ordered();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('uraian_kegiatan', 'like', "%{$request->search}%")
                  ->orWhere('penanggung_jawab', 'like', "%{$request->search}%");
            });
        }

        if ($request->filled('tahun')) {
            $query->byTahun($request->tahun);
        }

        if ($request->filled('penanggung_jawab')) {
            $query->byPenanggungJawab($request->penanggung_jawab);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $programs = $query->paginate(50)->withQueryString();
        $penanggungJawabs = CalendarProgram::distinct()->pluck('penanggung_jawab')->filter()->sort()->values();

        return view('admin.calendar.timeline', compact('programs', 'penanggungJawabs'));
    }

    public function importForm()
    {
        return view('admin.calendar.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'tahun' => 'required|integer|min:2020|max:2099',
            'file' => 'required|file|mimes:xlsx,xls|max:10240',
        ]);

        try {
            $file = $request->file('file');
            $spreadsheet = IOFactory::load($file->getRealPath());
            $worksheet = $spreadsheet->getActiveSheet();
            $rows = $worksheet->toArray();

            if (count($rows) < 2) {
                return back()->with('error', 'File Excel kosong atau tidak memiliki data.');
            }

            $header = array_map('strtolower', array_map('trim', $rows[0]));

            $colPj = $colUraian = $colDeskripsi = $colAnggaran = $colUrutan = $colStatus = null;
            $monthCols = [];

            foreach ($header as $i => $h) {
                if (str_contains($h, 'penanggung jawab') || str_contains($h, 'pj')) $colPj = $i;
                if (str_contains($h, 'uraian') || str_contains($h, 'kegiatan')) $colUraian = $i;
                if (str_contains($h, 'deskripsi')) $colDeskripsi = $i;
                if (str_contains($h, 'anggaran')) $colAnggaran = $i;
                if (str_contains($h, 'urutan')) $colUrutan = $i;
                if (str_contains($h, 'status') && !str_contains($h, 'bulan')) $colStatus = $i;

                $monthNames = ['jan','feb','mar','apr','mei','jun','jul','agu','sep','okt','nov','des'];
                foreach ($monthNames as $mi => $mn) {
                    if (str_contains($h, $mn)) $monthCols[$mi + 1] = $i;
                }
            }

            if ($colPj === null || $colUraian === null) {
                return back()->with('error', 'Header Excel tidak sesuai. Pastikan ada kolom "Penanggung Jawab" dan "Uraian Kegiatan".');
            }

            $created = 0;
            $errors = [];
            $tahun = $request->tahun;

            for ($i = 1; $i < count($rows); $i++) {
                $row = $rows[$i];

                if (empty($row[$colUraian])) continue;

                try {
                    $program = CalendarProgram::create([
                        'tahun' => $tahun,
                        'penanggung_jawab' => trim($row[$colPj] ?? ''),
                        'uraian_kegiatan' => trim($row[$colUraian]),
                        'deskripsi' => ($colDeskripsi !== null) ? trim($row[$colDeskripsi] ?? '') : null,
                        'anggaran' => ($colAnggaran !== null && is_numeric($row[$colAnggaran] ?? null)) ? (float) $row[$colAnggaran] : 0,
                        'urutan' => ($colUrutan !== null && is_numeric($row[$colUrutan] ?? null)) ? (int) $row[$colUrutan] : 0,
                        'status' => ($colStatus !== null && str_contains(strtolower($row[$colStatus] ?? ''), 'non')) ? 'nonaktif' : 'aktif',
                        'created_by' => auth()->id(),
                        'updated_by' => auth()->id(),
                    ]);

                    foreach ($monthCols as $bulan => $colIdx) {
                        if (isset($row[$colIdx]) && (int) $row[$colIdx] === 1) {
                            CalendarProgramMonth::create([
                                'calendar_program_id' => $program->id,
                                'bulan' => $bulan,
                            ]);
                        }
                    }

                    $created++;
                } catch (\Exception $e) {
                    $errors[] = 'Baris ' . ($i + 1) . ': ' . $e->getMessage();
                }
            }

            $message = "{$created} program berhasil diimport.";
            if (!empty($errors)) {
                $message .= ' ' . count($errors) . ' baris gagal: ' . implode(' | ', array_slice($errors, 0, 5));
            }

            return redirect()->route('admin.calendar-programs.index')->with('success', $message);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal membaca file: ' . $e->getMessage());
        }
    }

    public function export(Request $request)
    {
        $query = CalendarProgram::with('months')->ordered();

        if ($request->filled('tahun')) {
            $query->byTahun($request->tahun);
        }

        $programs = $query->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $headers = ['No', 'Penanggung Jawab', 'Uraian Kegiatan', 'Deskripsi', 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des', 'Anggaran', 'Urutan', 'Status'];
        $sheet->fromArray($headers, null, 'A1');

        foreach ($programs as $i => $program) {
            $row = $i + 2;
            $bulanArray = $program->bulan_array;

            $sheet->setCellValue("A{$row}", $i + 1);
            $sheet->setCellValue("B{$row}", $program->penanggung_jawab);
            $sheet->setCellValue("C{$row}", $program->uraian_kegiatan);
            $sheet->setCellValue("D{$row}", $program->deskripsi);

            for ($m = 1; $m <= 12; $m++) {
                $col = chr(68 + $m);
                $sheet->setCellValue("{$col}{$row}", in_array($m, $bulanArray) ? 1 : 0);
            }

            $sheet->setCellValue("Q{$row}", $program->anggaran);
            $sheet->setCellValue("R{$row}", $program->urutan);
            $sheet->setCellValue("S{$row}", $program->status);
        }

        $filename = 'kalender-program-' . ($request->tahun ?? date('Y')) . '.xlsx';
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=\"{$filename}\"");
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

    public function template()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $headers = ['Penanggung Jawab', 'Uraian Kegiatan', 'Deskripsi', 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des', 'Anggaran', 'Urutan', 'Status'];
        $sheet->fromArray($headers, null, 'A1');

        $sheet->setCellValue('A2', 'PAUD');
        $sheet->setCellValue('B2', 'Contoh Kegiatan');
        $sheet->setCellValue('D2', 1);
        $sheet->setCellValue('F2', 1);
        $sheet->setCellValue('Q2', 50000000);
        $sheet->setCellValue('R2', 1);
        $sheet->setCellValue('S2', 'aktif');

        $filename = 'template-kalender-program.xlsx';
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=\"{$filename}\"");
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

    public function publicTimeline(Request $request)
    {
        $tahun = $request->input('tahun', date('Y'));

        $query = CalendarProgram::with('months')->active()->ordered()->byTahun($tahun);

        if ($request->filled('penanggung_jawab')) {
            $query->byPenanggungJawab($request->penanggung_jawab);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('uraian_kegiatan', 'like', "%{$request->search}%")
                  ->orWhere('penanggung_jawab', 'like', "%{$request->search}%");
            });
        }

        $programs = $query->paginate(50)->withQueryString();
        $penanggungJawabs = CalendarProgram::active()->distinct()->pluck('penanggung_jawab')->filter()->sort()->values();

        return view('pages.kalender.index', compact('programs', 'penanggungJawabs', 'tahun'));
    }
}
