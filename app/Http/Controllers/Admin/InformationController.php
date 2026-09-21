<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InformationPublik;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InformationController extends Controller
{
    public function index(Request $request)
    {
        $query = InformationPublik::with('user')->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $informasi = $query->paginate(15)->withQueryString();

        return view('admin.informasi.index', compact('informasi'));
    }

    public function create()
    {
        return view('admin.informasi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'year' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'description' => 'nullable|string',
            'file' => 'required|file|max:10240|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx',
            'unit_pengelola' => 'nullable|string|max:255',
            'status' => 'required|in:draft,published',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        try {
            $file = $request->file('file');
            $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('uploads/informasi', $fileName, 'public');

            InformationPublik::create([
                'title' => $validated['title'],
                'slug' => Str::slug($validated['title']) . '-' . Str::random(5),
                'category' => $validated['category'],
                'year' => $validated['year'],
                'description' => $validated['description'] ?? null,
                'file_path' => $filePath,
                'file_name' => $file->getClientOriginalName(),
                'file_size' => $file->getSize(),
                'mime_type' => $file->getMimeType(),
                'unit_pengelola' => $validated['unit_pengelola'] ?? null,
                'status' => $validated['status'],
                'published_at' => $validated['status'] === 'published' ? now() : null,
                'created_by' => auth()->id(),
                'meta_title' => $validated['meta_title'] ?? null,
                'meta_description' => $validated['meta_description'] ?? null,
            ]);

            return redirect()->route('admin.informasi.index')
                ->with('success', 'Informasi publik berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal menambahkan informasi: ' . $e->getMessage());
        }
    }

    public function show(InformationPublik $informasi)
    {
        $item = $informasi;
        return view('admin.informasi.show', compact('item'));
    }

    public function edit(InformationPublik $informasi)
    {
        $item = $informasi;
        return view('admin.informasi.edit', compact('item'));
    }

    public function update(Request $request, InformationPublik $informasi)
    {

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'year' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'description' => 'nullable|string',
            'file' => 'nullable|file|max:10240|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx',
            'unit_pengelola' => 'nullable|string|max:255',
            'status' => 'required|in:draft,published',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        try {
            $data = [
                'title' => $validated['title'],
                'category' => $validated['category'],
                'year' => $validated['year'],
                'description' => $validated['description'] ?? null,
                'unit_pengelola' => $validated['unit_pengelola'] ?? null,
                'status' => $validated['status'],
                'meta_title' => $validated['meta_title'] ?? null,
                'meta_description' => $validated['meta_description'] ?? null,
            ];

            if ($validated['status'] === 'published' && $informasi->status !== 'published') {
                $data['published_at'] = now();
            }

            if ($request->hasFile('file')) {
                if ($informasi->file_path && \Storage::disk('public')->exists($informasi->file_path)) {
                    \Storage::disk('public')->delete($informasi->file_path);
                }

                $file = $request->file('file');
                $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                $data['file_path'] = $file->storeAs('uploads/informasi', $fileName, 'public');
                $data['file_name'] = $file->getClientOriginalName();
                $data['file_size'] = $file->getSize();
                $data['mime_type'] = $file->getMimeType();
            }

            $informasi->update($data);

            return redirect()->route('admin.informasi.index')
                ->with('success', 'Informasi publik berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal memperbarui informasi: ' . $e->getMessage());
        }
    }

    public function destroy(InformationPublik $informasi)
    {
        try {
            if ($informasi->file_path && \Storage::disk('public')->exists($informasi->file_path)) {
                \Storage::disk('public')->delete($informasi->file_path);
            }

            $informasi->delete();

            return redirect()->route('admin.informasi.index')
                ->with('success', 'Informasi publik berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus informasi: ' . $e->getMessage());
        }
    }

    public function toggleStatus(InformationPublik $informasi)
    {
        try {
            $newStatus = $informasi->status === 'published' ? 'draft' : 'published';

            $informasi->update([
                'status' => $newStatus,
                'published_at' => $newStatus === 'published' ? now() : null,
            ]);

            return back()->with('success', "Status informasi berhasil diubah menjadi {$newStatus}.");
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengubah status: ' . $e->getMessage());
        }
    }
}
