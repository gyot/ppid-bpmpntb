<?php

namespace App\Http\Controllers;

use App\Models\CalendarProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class CalendarProgramImportController extends Controller
{
    public function importForm()
    {
        return view('admin.calendar-programs.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls|max:10240',
        ]);

        try {
            $file = $request->file('file');
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file->getPathname());
            $worksheet = $spreadsheet->getActiveSheet();
            $rows = $worksheet->toArray();

            if (count($rows) < 2) {
                return back()->with('error', 'File Excel kosong atau tidak memiliki data.');
            }

            $header = array_map('trim', $rows[0]);
            $expectedHeaders = [
                'No', 'Tahun', 'Penanggung Jawab', 'Uraian Kegiatan', 'Deskripsi',
                'Anggaran', 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
                'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des', 'Urutan', 'Status',
            ];

            if (count($header) < 18) {
                return back()->with('error', 'Format kolom tidak sesuai. Minimal 18 kolom diperlukan.');
            }

            $errors = [];
            $rowsCreated = 0;
            $dataRows = array_slice($rows, 1);

            DB::transaction(function () use ($dataRows, &$rowsCreated, &$errors) {
                foreach ($dataRows as $index => $row) {
                    $rowNumber = $index + 2;

                    if (empty($row[1]) && empty($row[2]) && empty($row[3])) {
                        continue;
                    }

                    $tahun = is_numeric($row[1]) ? (int) $row[1] : null;
                    $penanggungJawab = trim($row[2] ?? '');
                    $uraianKegiatan = trim($row[3] ?? '');
                    $deskripsi = trim($row[4] ?? '');
                    $anggaran = is_numeric($row[5]) ? (float) $row[5] : null;

                    $bulan = [];
                    for ($i = 6; $i <= 17; $i++) {
                        if (!empty($row[$i]) && (strtolower(trim($row[$i])) === 'x' || strtolower(trim($row[$i])) === 'v' || (int) $row[$i] === 1)) {
                            $bulan[] = $i - 5;
                        }
                    }

                    $urutan = is_numeric($row[18] ?? null) ? (int) $row[18] : 0;
                    $status = in_array(strtolower(trim($row[19] ?? '')), ['aktif', 'nonaktif'])
                        ? strtolower(trim($row[19]))
                        : 'aktif';

                    if (empty($tahun) || $tahun < 2000 || $tahun > 2100) {
                        $errors[] = "Baris {$rowNumber}: Tahun tidak valid.";
                        continue;
                    }

                    if (empty($penanggungJawab)) {
                        $errors[] = "Baris {$rowNumber}: Penanggung jawab wajib diisi.";
                        continue;
                    }

                    if (empty($uraianKegiatan)) {
                        $errors[] = "Baris {$rowNumber}: Uraian kegiatan wajib diisi.";
                        continue;
                    }

                    if (empty($bulan)) {
                        $errors[] = "Baris {$rowNumber}: Minimal satu bulan harus dipilih.";
                        continue;
                    }

                    $program = CalendarProgram::create([
                        'tahun' => $tahun,
                        'penanggung_jawab' => $penanggungJawab,
                        'uraian_kegiatan' => $uraianKegiatan,
                        'deskripsi' => $deskripsi ?: null,
                        'anggaran' => $anggaran,
                        'urutan' => $urutan,
                        'status' => $status,
                        'created_by' => auth()->id(),
                        'updated_by' => auth()->id(),
                    ]);

                    foreach ($bulan as $b) {
                        $program->months()->create(['bulan' => $b]);
                    }

                    $rowsCreated++;
                }
            });

            $message = "Import berhasil. {$rowsCreated} data ditambahkan.";
            if (!empty($errors)) {
                $message .= ' ' . count($errors) . ' baris bermasalah: ' . implode(', ', array_slice($errors, 0, 5));
                if (count($errors) > 5) {
                    $message .= ' ... dan ' . (count($errors) - 5) . ' lainnya.';
                }
            }

            return redirect()->route('admin.calendar-programs.index')->with('success', $message);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal import: ' . $e->getMessage());
        }
    }

    public function template()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $headers = [
            'No', 'Tahun', 'Penanggung Jawab', 'Uraian Kegiatan', 'Deskripsi',
            'Anggaran', 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
            'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des', 'Urutan', 'Status',
        ];

        foreach ($headers as $col => $header) {
            $sheet->setCellValueByColumnAndRow($col + 1, 1, $header);
        }

        $sheet->getStyle('1:1')->getFont()->setBold(true);

        $sampleRow = [
            1, 2026, 'Bidang PPID', 'Sosialisasi Keterbukaan Informasi Publik',
            'Deskripsi kegiatan', 5000000,
            'x', '', 'x', '', '', 'x',
            '', '', 'x', '', '', 'x',
            1, 'aktif',
        ];

        foreach ($sampleRow as $col => $value) {
            $sheet->setCellValueByColumnAndRow($col + 1, 2, $value);
        }

        $sheet->setTitle('Template Import');

        foreach (range('A', 'T') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $writer = new Xlsx($spreadsheet);

        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, 'template-import-calendar-programs.xlsx', [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }
}
