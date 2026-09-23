<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Regulasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class RegulasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Regulasi::with('user')->latest();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', "%{$request->search}%")
                  ->orWhere('nomor', 'like', "%{$request->search}%")
                  ->orWhere('pembuat', 'like', "%{$request->search}%");
            });
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $regulasis = $query->paginate(15)->withQueryString();

        return view('admin.regulasi.index', compact('regulasis'));
    }

    public function create()
    {
        return view('admin.regulasi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'nomor' => 'nullable|string|max:100',
            'pembuat' => 'nullable|string|max:255',
            'kategori' => 'required|in:uu,pp,perma,perki,permendikbud,lainnya',
            'tanggal' => 'nullable|date',
            'deskripsi' => 'nullable|string',
            'file' => 'nullable|file|max:10240|mimes:pdf,doc,docx',
            'link_eksternal' => 'nullable|url|max:500',
            'status' => 'required|in:draft,published',
        ]);

        try {
            $data = [
                'title' => $validated['title'],
                'slug' => Str::slug($validated['title']) . '-' . Str::random(5),
                'nomor' => $validated['nomor'] ?? null,
                'pembuat' => $validated['pembuat'] ?? null,
                'kategori' => $validated['kategori'],
                'tanggal' => $validated['tanggal'] ?? null,
                'deskripsi' => $validated['deskripsi'] ?? null,
                'link_eksternal' => $validated['link_eksternal'] ?? null,
                'status' => $validated['status'],
                'published_at' => $validated['status'] === 'published' ? now() : null,
                'created_by' => auth()->id(),
            ];

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/regulasi'), $fileName);
                $data['file_path'] = 'uploads/regulasi/' . $fileName;
                $data['file_name'] = $file->getClientOriginalName();
            }

            Regulasi::create($data);

            return redirect()->route('admin.regulasi.index')
                ->with('success', 'Regulasi berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal menambahkan regulasi: ' . $e->getMessage());
        }
    }

    public function edit(Regulasi $regulasi)
    {
        $item = $regulasi;
        return view('admin.regulasi.edit', compact('item'));
    }

    public function update(Request $request, Regulasi $regulasi)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'nomor' => 'nullable|string|max:100',
            'pembuat' => 'nullable|string|max:255',
            'kategori' => 'required|in:uu,pp,perma,perki,permendikbud,lainnya',
            'tanggal' => 'nullable|date',
            'deskripsi' => 'nullable|string',
            'file' => 'nullable|file|max:10240|mimes:pdf,doc,docx',
            'link_eksternal' => 'nullable|url|max:500',
            'status' => 'required|in:draft,published',
        ]);

        try {
            $data = [
                'title' => $validated['title'],
                'nomor' => $validated['nomor'] ?? null,
                'pembuat' => $validated['pembuat'] ?? null,
                'kategori' => $validated['kategori'],
                'tanggal' => $validated['tanggal'] ?? null,
                'deskripsi' => $validated['deskripsi'] ?? null,
                'link_eksternal' => $validated['link_eksternal'] ?? null,
                'status' => $validated['status'],
            ];

            if ($validated['status'] === 'published' && $regulasi->status !== 'published') {
                $data['published_at'] = now();
            }

            if ($request->hasFile('file')) {
                if ($regulasi->file_path && File::exists(public_path($regulasi->file_path))) {
                    File::delete(public_path($regulasi->file_path));
                }

                $file = $request->file('file');
                $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/regulasi'), $fileName);
                $data['file_path'] = 'uploads/regulasi/' . $fileName;
                $data['file_name'] = $file->getClientOriginalName();
            }

            $regulasi->update($data);

            return redirect()->route('admin.regulasi.index')
                ->with('success', 'Regulasi berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal memperbarui regulasi: ' . $e->getMessage());
        }
    }

    public function destroy(Regulasi $regulasi)
    {
        try {
            if ($regulasi->file_path && File::exists(public_path($regulasi->file_path))) {
                File::delete(public_path($regulasi->file_path));
            }

            $regulasi->delete();

            return redirect()->route('admin.regulasi.index')
                ->with('success', 'Regulasi berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus regulasi: ' . $e->getMessage());
        }
    }

    public function toggleStatus(Regulasi $regulasi)
    {
        try {
            $newStatus = $regulasi->status === 'published' ? 'draft' : 'published';
            $regulasi->update([
                'status' => $newStatus,
                'published_at' => $newStatus === 'published' ? now() : null,
            ]);

            return back()->with('success', "Status regulasi berhasil diubah menjadi {$newStatus}.");
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengubah status: ' . $e->getMessage());
        }
    }
}
