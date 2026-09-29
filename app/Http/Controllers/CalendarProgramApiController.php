<?php

namespace App\Http\Controllers;

use App\Models\CalendarProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalendarProgramApiController extends Controller
{
    public function index(Request $request)
    {
        $query = CalendarProgram::with('months')->ordered();

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

        $programs = $query->get()->map(function ($program) {
            return [
                'id' => $program->id,
                'tahun' => $program->tahun,
                'penanggung_jawab' => $program->penanggung_jawab,
                'uraian_kegiatan' => $program->uraian_kegiatan,
                'deskripsi' => $program->deskripsi,
                'anggaran' => $program->anggaran,
                'urutan' => $program->urutan,
                'status' => $program->status,
                'bulan' => $program->bulan_array,
                'created_at' => $program->created_at->format('Y-m-d H:i:s'),
                'updated_at' => $program->updated_at->format('Y-m-d H:i:s'),
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $programs,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tahun' => 'required|integer|min:2000|max:2100',
            'penanggung_jawab' => 'required|string|max:100',
            'uraian_kegiatan' => 'required|string',
            'deskripsi' => 'nullable|string',
            'anggaran' => 'nullable|numeric|min:0',
            'bulan' => 'required|array|min:1',
            'bulan.*' => 'integer|min:1|max:12',
            'urutan' => 'nullable|integer|min:0',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        try {
            $program = DB::transaction(function () use ($validated) {
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

                return $program;
            });

            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $program->id,
                    'tahun' => $program->tahun,
                    'penanggung_jawab' => $program->penanggung_jawab,
                    'uraian_kegiatan' => $program->uraian_kegiatan,
                    'deskripsi' => $program->deskripsi,
                    'anggaran' => $program->anggaran,
                    'urutan' => $program->urutan,
                    'status' => $program->status,
                    'bulan' => $program->bulan_array,
                ],
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat program: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        $program = CalendarProgram::with('months')->find($id);

        if (!$program) {
            return response()->json([
                'success' => false,
                'message' => 'Program tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $program->id,
                'tahun' => $program->tahun,
                'penanggung_jawab' => $program->penanggung_jawab,
                'uraian_kegiatan' => $program->uraian_kegiatan,
                'deskripsi' => $program->deskripsi,
                'anggaran' => $program->anggaran,
                'urutan' => $program->urutan,
                'status' => $program->status,
                'bulan' => $program->bulan_array,
                'created_at' => $program->created_at->format('Y-m-d H:i:s'),
                'updated_at' => $program->updated_at->format('Y-m-d H:i:s'),
            ],
        ]);
    }

    public function update(Request $request, $id)
    {
        $program = CalendarProgram::find($id);

        if (!$program) {
            return response()->json([
                'success' => false,
                'message' => 'Program tidak ditemukan.',
            ], 404);
        }

        $validated = $request->validate([
            'tahun' => 'required|integer|min:2000|max:2100',
            'penanggung_jawab' => 'required|string|max:100',
            'uraian_kegiatan' => 'required|string',
            'deskripsi' => 'nullable|string',
            'anggaran' => 'nullable|numeric|min:0',
            'bulan' => 'required|array|min:1',
            'bulan.*' => 'integer|min:1|max:12',
            'urutan' => 'nullable|integer|min:0',
            'status' => 'required|in:aktif,nonaktif',
        ]);

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

            $program->refresh();

            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $program->id,
                    'tahun' => $program->tahun,
                    'penanggung_jawab' => $program->penanggung_jawab,
                    'uraian_kegiatan' => $program->uraian_kegiatan,
                    'deskripsi' => $program->deskripsi,
                    'anggaran' => $program->anggaran,
                    'urutan' => $program->urutan,
                    'status' => $program->status,
                    'bulan' => $program->bulan_array,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui program: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        $program = CalendarProgram::find($id);

        if (!$program) {
            return response()->json([
                'success' => false,
                'message' => 'Program tidak ditemukan.',
            ], 404);
        }

        try {
            $program->delete();

            return response()->json([
                'success' => true,
                'message' => 'Program berhasil dihapus.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus program: ' . $e->getMessage(),
            ], 500);
        }
    }
}
