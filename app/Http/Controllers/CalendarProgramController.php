<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCalendarProgramRequest;
use App\Http\Requests\UpdateCalendarProgramRequest;
use App\Models\CalendarProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CalendarProgramImport;
use App\Exports\CalendarProgramExport;

class CalendarProgramController extends Controller
{
    public function index(Request $request)
    {
        $query = CalendarProgram::with('months', 'createdBy', 'updatedBy')->ordered();

        if ($request->filled('tahun')) {
            $query->byTahun($request->tahun);
        }

        if ($request->filled('penanggung_jawab')) {
            $query->byPenanggungJawab($request->penanggung_jawab);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('uraian_kegiatan', 'like', "%{$search}%")
                    ->orWhere('penanggung_jawab', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        $programs = $query->paginate(15)->withQueryString();

        $tahunList = CalendarProgram::distinct()->pluck('tahun')->sort()->values();
        $pjList = CalendarProgram::distinct()->pluck('penanggung_jawab')->filter()->sort()->values();

        return view('admin.calendar-programs.index', compact('programs', 'tahunList', 'pjList'));
    }

    public function create()
    {
        return view('admin.calendar-programs.create');
    }

    public function store(StoreCalendarProgramRequest $request)
    {
        $validated = $request->validated();

        try {
            DB::transaction(function () use ($validated) {
                $program = CalendarProgram::create([
                    'tahun' => $validated['tahun'],
                    'penanggung_jawab' => $validated['penanggung_jawab'],
                    'uraian_kegiatan' => $validated['uraian_kegiatan'],
                    'deskripsi' => $validated['deskripsi'] ?? null,
                    'anggaran' => $validated['anggaran'] ?? null,
                    'urutan' => $validated['urutan'] ?? 0,
                    'status' => $validated['status'],
                    'created_by' => auth()->id(),
                    'updated_by' => auth()->id(),
                ]);

                foreach ($validated['bulan'] as $bulan) {
                    $program->months()->create(['bulan' => $bulan]);
                }
            });

            return redirect()->route('admin.calendar-programs.index')
                ->with('success', 'Program kalender berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal menambahkan program: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $program = CalendarProgram::with(['months', 'createdBy', 'updatedBy'])->findOrFail($id);

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $program->id,
                    'tahun' => $program->tahun,
                    'penanggung_jawab' => $program->penanggung_jawab,
                    'uraian_kegiatan' => $program->uraian_kegiatan,
                    'deskripsi' => $program->deskripsi,
                    'anggaran' => $program->anggaran,
                    'formatted_anggaran' => $program->formatted_anggaran,
                    'urutan' => $program->urutan,
                    'status' => $program->status,
                    'bulan' => $program->bulan_array,
                    'created_by' => $program->createdBy?->name,
                    'updated_by' => $program->updatedBy?->name,
                    'created_at' => $program->created_at->format('d/m/Y H:i'),
                    'updated_at' => $program->updated_at->format('d/m/Y H:i'),
                ],
            ]);
        }

        return view('admin.calendar-programs.show', compact('program'));
    }

    public function edit($id)
    {
        $program = CalendarProgram::with('months')->findOrFail($id);

        return view('admin.calendar-programs.edit', compact('program'));
    }

    public function update(UpdateCalendarProgramRequest $request, $id)
    {
        $program = CalendarProgram::findOrFail($id);
        $validated = $request->validated();

        try {
            DB::transaction(function () use ($validated, $program) {
                $program->update([
                    ...collect($validated)->except('bulan')->toArray(),
                    'updated_by' => auth()->id(),
                ]);

                $program->months()->delete();
                foreach ($validated['bulan'] as $bulan) {
                    $program->months()->create(['bulan' => $bulan]);
                }
            });

            return redirect()->route('admin.calendar-programs.index')
                ->with('success', 'Program kalender berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal memperbarui program: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $program = CalendarProgram::findOrFail($id);
            $program->delete();

            return redirect()->route('admin.calendar-programs.index')
                ->with('success', 'Program kalender berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus program: ' . $e->getMessage());
        }
    }

    public function duplicate(Request $request, $id)
    {
        $request->validate(['tahun' => 'required|integer|min:2000|max:2100']);

        $original = CalendarProgram::findOrFail($id);

        try {
            $new = DB::transaction(function () use ($original, $request) {
                $new = CalendarProgram::create([
                    'tahun' => $request->tahun,
                    'penanggung_jawab' => $original->penanggung_jawab,
                    'uraian_kegiatan' => $original->uraian_kegiatan,
                    'deskripsi' => $original->deskripsi,
                    'anggaran' => $original->anggaran,
                    'urutan' => $original->urutan,
                    'status' => $original->status,
                    'created_by' => auth()->id(),
                    'updated_by' => auth()->id(),
                ]);

                foreach ($original->bulan_array as $bulan) {
                    $new->months()->create(['bulan' => $bulan]);
                }

                return $new;
            });

            return redirect()->route('admin.calendar-programs.index')
                ->with('success', 'Program berhasil diduplikasi.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menduplikasi program: ' . $e->getMessage());
        }
    }

    public function timeline(Request $request)
    {
        $query = CalendarProgram::with('months')->active()->ordered();

        if ($request->filled('tahun')) {
            $query->byTahun($request->tahun);
        }

        if ($request->filled('penanggung_jawab')) {
            $query->byPenanggungJawab($request->penanggung_jawab);
        }

        $programs = $query->get();

        $tahunList = CalendarProgram::distinct()->pluck('tahun')->sort()->values();
        $pjList = CalendarProgram::distinct()->pluck('penanggung_jawab')->filter()->sort()->values();

        return view('admin.calendar-programs.timeline', compact('programs', 'tahunList', 'pjList'));
    }

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
            $import = new CalendarProgramImport();
            Excel::import($import, $request->file('file'));

            $rowsCreated = $import->getRowsCreated();
            $errors = $import->getErrors();

            $message = "Import berhasil. {$rowsCreated} data ditambahkan.";
            if (!empty($errors)) {
                $message .= ' ' . count($errors) . ' baris bermasalah: ' . implode(', ', $errors);
            }

            return redirect()->route('admin.calendar-programs.index')
                ->with('success', $message);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal import: ' . $e->getMessage());
        }
    }

    public function export(Request $request)
    {
        $tahun = $request->input('tahun', date('Y'));

        return Excel::download(new CalendarProgramExport($tahun), "calendar-programs-{$tahun}.xlsx");
    }
}
