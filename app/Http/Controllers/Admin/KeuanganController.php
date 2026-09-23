<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Keuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class KeuanganController extends Controller
{
    public function index(Request $request)
    {
        $query = Keuangan::with('user')->latest();

        if ($request->filled('search')) {
            $query->where('title', 'like', "%{$request->search}%");
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('tahun')) {
            $query->where('tahun', $request->tahun);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $keuangans = $query->paginate(15)->withQueryString();

        return view('admin.keuangan.index', compact('keuangans'));
    }

    public function create()
    {
        return view('admin.keuangan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:laporan_keuangan,rka,dipa,realisasi,calk,neraca,arus_kas',
            'tahun' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'deskripsi' => 'nullable|string',
            'file' => 'required|file|max:20480|mimes:pdf,doc,docx,xls,xlsx',
            'status' => 'required|in:draft,published',
        ]);

        try {
            $file = $request->file('file');
            $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $fileSize = $file->getSize();
            $originalName = $file->getClientOriginalName();
            $file->move(public_path('uploads/keuangan'), $fileName);
            $filePath = 'uploads/keuangan/' . $fileName;

            Keuangan::create([
                'title' => $validated['title'],
                'slug' => Str::slug($validated['title']) . '-' . Str::random(5),
                'category' => $validated['category'],
                'tahun' => $validated['tahun'],
                'deskripsi' => $validated['deskripsi'] ?? null,
                'file_path' => $filePath,
                'file_name' => $originalName,
                'file_size' => $fileSize,
                'status' => $validated['status'],
                'published_at' => $validated['status'] === 'published' ? now() : null,
                'created_by' => auth()->id(),
            ]);

            return redirect()->route('admin.keuangan.index')
                ->with('success', 'Dokumen keuangan berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal menambahkan dokumen: ' . $e->getMessage());
        }
    }

    public function edit(Keuangan $keuangan)
    {
        $item = $keuangan;
        return view('admin.keuangan.edit', compact('item'));
    }

    public function update(Request $request, Keuangan $keuangan)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:laporan_keuangan,rka,dipa,realisasi,calk,neraca,arus_kas',
            'tahun' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'deskripsi' => 'nullable|string',
            'file' => 'nullable|file|max:20480|mimes:pdf,doc,docx,xls,xlsx',
            'status' => 'required|in:draft,published',
        ]);

        try {
            $data = [
                'title' => $validated['title'],
                'category' => $validated['category'],
                'tahun' => $validated['tahun'],
                'deskripsi' => $validated['deskripsi'] ?? null,
                'status' => $validated['status'],
            ];

            if ($validated['status'] === 'published' && $keuangan->status !== 'published') {
                $data['published_at'] = now();
            }

            if ($request->hasFile('file')) {
                if ($keuangan->file_path && File::exists(public_path($keuangan->file_path))) {
                    File::delete(public_path($keuangan->file_path));
                }

                $file = $request->file('file');
                $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                $fileSize = $file->getSize();
                $originalName = $file->getClientOriginalName();
                $file->move(public_path('uploads/keuangan'), $fileName);
                $data['file_path'] = 'uploads/keuangan/' . $fileName;
                $data['file_name'] = $originalName;
                $data['file_size'] = $fileSize;
            }

            $keuangan->update($data);

            return redirect()->route('admin.keuangan.index')
                ->with('success', 'Dokumen keuangan berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal memperbarui dokumen: ' . $e->getMessage());
        }
    }

    public function destroy(Keuangan $keuangan)
    {
        try {
            if ($keuangan->file_path && File::exists(public_path($keuangan->file_path))) {
                File::delete(public_path($keuangan->file_path));
            }

            $keuangan->delete();

            return redirect()->route('admin.keuangan.index')
                ->with('success', 'Dokumen keuangan berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus dokumen: ' . $e->getMessage());
        }
    }

    public function toggleStatus(Keuangan $keuangan)
    {
        try {
            $newStatus = $keuangan->status === 'published' ? 'draft' : 'published';
            $keuangan->update([
                'status' => $newStatus,
                'published_at' => $newStatus === 'published' ? now() : null,
            ]);

            return back()->with('success', "Status dokumen berhasil diubah menjadi {$newStatus}.");
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengubah status: ' . $e->getMessage());
        }
    }

    public function download(Keuangan $keuangan)
    {
        try {
            $keuangan->increment('download_count');

            if ($keuangan->file_path && File::exists(public_path($keuangan->file_path))) {
                return response()->download(public_path($keuangan->file_path), $keuangan->file_name);
            }

            return back()->with('error', 'File tidak ditemukan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengunduh file: ' . $e->getMessage());
        }
    }
}
