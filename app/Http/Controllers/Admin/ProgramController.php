<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index(Request $request)
    {
        $query = Program::with('user')->latest();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_program', 'like', "%{$request->search}%")
                  ->orWhere('penanggung_jawab', 'like', "%{$request->search}%");
            });
        }

        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }

        if ($request->filled('tahun')) {
            $query->where('tahun', $request->tahun);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $programs = $query->paginate(15)->withQueryString();

        return view('admin.program.index', compact('programs'));
    }

    public function create()
    {
        return view('admin.program.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_program' => 'required|string|max:255',
            'penanggung_jawab' => 'nullable|string|max:255',
            'target' => 'nullable|string|max:255',
            'jadwal' => 'nullable|string|max:255',
            'sumber_anggaran' => 'nullable|string|max:255',
            'besaran_anggaran' => 'nullable|numeric|min:0',
            'tahun' => 'required|integer|min:2000|max:' . (date('Y') + 2),
            'jenis' => 'required|in:program,kegiatan,strategis',
            'deskripsi' => 'nullable|string',
            'status' => 'required|in:draft,published',
        ]);

        try {
            Program::create([
                ...$validated,
                'published_at' => $validated['status'] === 'published' ? now() : null,
                'created_by' => auth()->id(),
            ]);

            return redirect()->route('admin.program.index')
                ->with('success', 'Program berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal menambahkan program: ' . $e->getMessage());
        }
    }

    public function edit(Program $program)
    {
        $item = $program;
        return view('admin.program.edit', compact('item'));
    }

    public function update(Request $request, Program $program)
    {
        $validated = $request->validate([
            'nama_program' => 'required|string|max:255',
            'penanggung_jawab' => 'nullable|string|max:255',
            'target' => 'nullable|string|max:255',
            'jadwal' => 'nullable|string|max:255',
            'sumber_anggaran' => 'nullable|string|max:255',
            'besaran_anggaran' => 'nullable|numeric|min:0',
            'tahun' => 'required|integer|min:2000|max:' . (date('Y') + 2),
            'jenis' => 'required|in:program,kegiatan,strategis',
            'deskripsi' => 'nullable|string',
            'status' => 'required|in:draft,published',
        ]);

        try {
            $data = $validated;

            if ($validated['status'] === 'published' && $program->status !== 'published') {
                $data['published_at'] = now();
            }

            $program->update($data);

            return redirect()->route('admin.program.index')
                ->with('success', 'Program berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal memperbarui program: ' . $e->getMessage());
        }
    }

    public function destroy(Program $program)
    {
        try {
            $program->delete();

            return redirect()->route('admin.program.index')
                ->with('success', 'Program berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus program: ' . $e->getMessage());
        }
    }

    public function toggleStatus(Program $program)
    {
        try {
            $newStatus = $program->status === 'published' ? 'draft' : 'published';
            $program->update([
                'status' => $newStatus,
                'published_at' => $newStatus === 'published' ? now() : null,
            ]);

            return back()->with('success', "Status program berhasil diubah menjadi {$newStatus}.");
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengubah status: ' . $e->getMessage());
        }
    }
}
