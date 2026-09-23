<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DaftarInformasiPublik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class DipController extends Controller
{
    public function index(Request $request)
    {
        $query = DaftarInformasiPublik::with('user')->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('jenis_informasi', 'like', "%{$search}%")
                  ->orWhere('uraian_informasi', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $dip = $query->paginate(15)->withQueryString();

        return view('admin.dip.index', compact('dip'));
    }

    public function create()
    {
        return view('admin.dip.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:berkala,setiap_saat,serta_merta,dikecualikan',
            'jenis_informasi' => 'required|string|max:255',
            'uraian_informasi' => 'nullable|string',
            'sumber_informasi' => 'nullable|string|max:255',
            'media_informasi' => 'nullable|string|max:255',
            'jkd' => 'nullable|string|max:255',
            'file' => 'nullable|file|max:10240|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx',
            'status' => 'required|in:draft,published',
        ]);

        try {
            $data = [
                'title' => $validated['title'],
                'slug' => Str::slug($validated['title']) . '-' . Str::random(5),
                'category' => $validated['category'],
                'jenis_informasi' => $validated['jenis_informasi'],
                'uraian_informasi' => $validated['uraian_informasi'] ?? null,
                'sumber_informasi' => $validated['sumber_informasi'] ?? null,
                'media_informasi' => $validated['media_informasi'] ?? null,
                'jkd' => $validated['jkd'] ?? null,
                'status' => $validated['status'],
                'created_by' => auth()->id(),
            ];

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/dip'), $fileName);
                $data['file_path'] = 'uploads/dip/' . $fileName;
                $data['file_name'] = $file->getClientOriginalName();
            }

            DaftarInformasiPublik::create($data);

            return redirect()->route('admin.dip.index')
                ->with('success', 'DIP berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal menambahkan DIP: ' . $e->getMessage());
        }
    }

    public function edit(DaftarInformasiPublik $dip)
    {
        $item = $dip;
        return view('admin.dip.edit', compact('item'));
    }

    public function update(Request $request, DaftarInformasiPublik $dip)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:berkala,setiap_saat,serta_merta,dikecualikan',
            'jenis_informasi' => 'required|string|max:255',
            'uraian_informasi' => 'nullable|string',
            'sumber_informasi' => 'nullable|string|max:255',
            'media_informasi' => 'nullable|string|max:255',
            'jkd' => 'nullable|string|max:255',
            'file' => 'nullable|file|max:10240|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx',
            'status' => 'required|in:draft,published',
        ]);

        try {
            $data = [
                'title' => $validated['title'],
                'category' => $validated['category'],
                'jenis_informasi' => $validated['jenis_informasi'],
                'uraian_informasi' => $validated['uraian_informasi'] ?? null,
                'sumber_informasi' => $validated['sumber_informasi'] ?? null,
                'media_informasi' => $validated['media_informasi'] ?? null,
                'jkd' => $validated['jkd'] ?? null,
                'status' => $validated['status'],
            ];

            if ($request->hasFile('file')) {
                if ($dip->file_path && File::exists(public_path($dip->file_path))) {
                    File::delete(public_path($dip->file_path));
                }

                $file = $request->file('file');
                $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/dip'), $fileName);
                $data['file_path'] = 'uploads/dip/' . $fileName;
                $data['file_name'] = $file->getClientOriginalName();
            }

            $dip->update($data);

            return redirect()->route('admin.dip.index')
                ->with('success', 'DIP berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal memperbarui DIP: ' . $e->getMessage());
        }
    }

    public function destroy(DaftarInformasiPublik $dip)
    {
        try {
            if ($dip->file_path && File::exists(public_path($dip->file_path))) {
                File::delete(public_path($dip->file_path));
            }

            $dip->delete();

            return redirect()->route('admin.dip.index')
                ->with('success', 'DIP berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus DIP: ' . $e->getMessage());
        }
    }

    public function toggleStatus(DaftarInformasiPublik $dip)
    {
        try {
            $newStatus = $dip->status === 'published' ? 'draft' : 'published';
            $dip->update(['status' => $newStatus]);

            return back()->with('success', "Status DIP berhasil diubah menjadi {$newStatus}.");
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengubah status: ' . $e->getMessage());
        }
    }
}
