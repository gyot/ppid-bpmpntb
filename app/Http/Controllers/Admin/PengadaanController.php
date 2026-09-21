<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengadaan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PengadaanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengadaan::with('user')->latest();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_paket', 'like', "%{$request->search}%")
                  ->orWhere('penyedia', 'like', "%{$request->search}%");
            });
        }

        if ($request->filled('tahap')) {
            $query->where('tahap', $request->tahap);
        }

        if ($request->filled('tahun')) {
            $query->where('tahun', $request->tahun);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pengadaans = $query->paginate(15)->withQueryString();

        return view('admin.pengadaan.index', compact('pengadaans'));
    }

    public function create()
    {
        return view('admin.pengadaan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_paket' => 'required|string|max:255',
            'nilai_pagu' => 'nullable|numeric|min:0',
            'tahun' => 'required|integer|min:2000|max:' . (date('Y') + 2),
            'tahap' => 'required|in:rencana,pemilihan,pelaksanaan',
            'penyedia' => 'nullable|string|max:255',
            'no_kontrak' => 'nullable|string|max:255',
            'tanggal_kontrak' => 'nullable|date',
            'deskripsi' => 'nullable|string',
            'file' => 'nullable|file|max:10240|mimes:pdf,doc,docx,xls,xlsx',
            'status' => 'required|in:draft,published',
        ]);

        try {
            $data = [
                'nama_paket' => $validated['nama_paket'],
                'nilai_pagu' => $validated['nilai_pagu'] ?? null,
                'tahun' => $validated['tahun'],
                'tahap' => $validated['tahap'],
                'penyedia' => $validated['penyedia'] ?? null,
                'no_kontrak' => $validated['no_kontrak'] ?? null,
                'tanggal_kontrak' => $validated['tanggal_kontrak'] ?? null,
                'deskripsi' => $validated['deskripsi'] ?? null,
                'status' => $validated['status'],
                'published_at' => $validated['status'] === 'published' ? now() : null,
                'created_by' => auth()->id(),
            ];

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                $data['file_path'] = $file->storeAs('uploads/pengadaan', $fileName, 'public');
                $data['file_name'] = $file->getClientOriginalName();
            }

            Pengadaan::create($data);

            return redirect()->route('admin.pengadaan.index')
                ->with('success', 'Data pengadaan berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal menambahkan data: ' . $e->getMessage());
        }
    }

    public function edit(Pengadaan $pengadaan)
    {
        $item = $pengadaan;
        return view('admin.pengadaan.edit', compact('item'));
    }

    public function update(Request $request, Pengadaan $pengadaan)
    {
        $validated = $request->validate([
            'nama_paket' => 'required|string|max:255',
            'nilai_pagu' => 'nullable|numeric|min:0',
            'tahun' => 'required|integer|min:2000|max:' . (date('Y') + 2),
            'tahap' => 'required|in:rencana,pemilihan,pelaksanaan',
            'penyedia' => 'nullable|string|max:255',
            'no_kontrak' => 'nullable|string|max:255',
            'tanggal_kontrak' => 'nullable|date',
            'deskripsi' => 'nullable|string',
            'file' => 'nullable|file|max:10240|mimes:pdf,doc,docx,xls,xlsx',
            'status' => 'required|in:draft,published',
        ]);

        try {
            $data = [
                'nama_paket' => $validated['nama_paket'],
                'nilai_pagu' => $validated['nilai_pagu'] ?? null,
                'tahun' => $validated['tahun'],
                'tahap' => $validated['tahap'],
                'penyedia' => $validated['penyedia'] ?? null,
                'no_kontrak' => $validated['no_kontrak'] ?? null,
                'tanggal_kontrak' => $validated['tanggal_kontrak'] ?? null,
                'deskripsi' => $validated['deskripsi'] ?? null,
                'status' => $validated['status'],
            ];

            if ($validated['status'] === 'published' && $pengadaan->status !== 'published') {
                $data['published_at'] = now();
            }

            if ($request->hasFile('file')) {
                if ($pengadaan->file_path && \Storage::disk('public')->exists($pengadaan->file_path)) {
                    \Storage::disk('public')->delete($pengadaan->file_path);
                }

                $file = $request->file('file');
                $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                $data['file_path'] = $file->storeAs('uploads/pengadaan', $fileName, 'public');
                $data['file_name'] = $file->getClientOriginalName();
            }

            $pengadaan->update($data);

            return redirect()->route('admin.pengadaan.index')
                ->with('success', 'Data pengadaan berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function destroy(Pengadaan $pengadaan)
    {
        try {
            if ($pengadaan->file_path && \Storage::disk('public')->exists($pengadaan->file_path)) {
                \Storage::disk('public')->delete($pengadaan->file_path);
            }

            $pengadaan->delete();

            return redirect()->route('admin.pengadaan.index')
                ->with('success', 'Data pengadaan berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    public function toggleStatus(Pengadaan $pengadaan)
    {
        try {
            $newStatus = $pengadaan->status === 'published' ? 'draft' : 'published';
            $pengadaan->update([
                'status' => $newStatus,
                'published_at' => $newStatus === 'published' ? now() : null,
            ]);

            return back()->with('success', "Status pengadaan berhasil diubah menjadi {$newStatus}.");
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengubah status: ' . $e->getMessage());
        }
    }
}
