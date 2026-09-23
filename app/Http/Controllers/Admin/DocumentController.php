<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $query = Document::with('user')->latest();

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

        $dokumen = $query->paginate(15)->withQueryString();

        return view('admin.dokumen.index', compact('dokumen'));
    }

    public function create()
    {
        return view('admin.dokumen.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:regulasi,sk,sop,laporan,dip,statistik,formulir,dokumen_ppid',
            'year' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'description' => 'nullable|string',
            'file' => 'required|file|max:10240|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx',
            'status' => 'required|in:draft,published',
        ]);

        try {
            $file = $request->file('file');
            $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/documents'), $fileName);
            $filePath = 'uploads/documents/' . $fileName;

            Document::create([
                'title' => $validated['title'],
                'slug' => Str::slug($validated['title']) . '-' . Str::random(5),
                'category' => $validated['category'],
                'year' => $validated['year'],
                'description' => $validated['description'] ?? null,
                'file_path' => $filePath,
                'file_name' => $file->getClientOriginalName(),
                'file_size' => $file->getSize(),
                'mime_type' => $file->getMimeType(),
                'status' => $validated['status'],
                'published_at' => $validated['status'] === 'published' ? now() : null,
                'created_by' => auth()->id(),
            ]);

            return redirect()->route('admin.dokumen.index')
                ->with('success', 'Dokumen berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal menambahkan dokumen: ' . $e->getMessage());
        }
    }

    public function show(Document $dokuman)
    {
        $item = $dokuman->load('user');
        return view('admin.dokumen.show', compact('item'));
    }

    public function edit(Document $dokuman)
    {
        return view('admin.dokumen.edit', compact('dokuman'));
    }

    public function update(Request $request, Document $dokuman)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:regulasi,sk,sop,laporan,dip,statistik,formulir,dokumen_ppid',
            'year' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'description' => 'nullable|string',
            'file' => 'nullable|file|max:10240|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx',
            'status' => 'required|in:draft,published',
        ]);

        try {
            $data = [
                'title' => $validated['title'],
                'category' => $validated['category'],
                'year' => $validated['year'],
                'description' => $validated['description'] ?? null,
                'status' => $validated['status'],
            ];

            if ($validated['status'] === 'published' && $dokuman->status !== 'published') {
                $data['published_at'] = now();
            }

            if ($request->hasFile('file')) {
                if ($dokuman->file_path && File::exists(public_path($dokuman->file_path))) {
                    File::delete(public_path($dokuman->file_path));
                }

                $file = $request->file('file');
                $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/documents'), $fileName);
                $data['file_path'] = 'uploads/documents/' . $fileName;
                $data['file_name'] = $file->getClientOriginalName();
                $data['file_size'] = $file->getSize();
                $data['mime_type'] = $file->getMimeType();
            }

            $dokuman->update($data);

            return redirect()->route('admin.dokumen.index')
                ->with('success', 'Dokumen berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal memperbarui dokumen: ' . $e->getMessage());
        }
    }

    public function destroy(Document $dokuman)
    {
        try {
            if ($dokuman->file_path && File::exists(public_path($dokuman->file_path))) {
                File::delete(public_path($dokuman->file_path));
            }

            $dokuman->delete();

            return redirect()->route('admin.dokumen.index')
                ->with('success', 'Dokumen berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus dokumen: ' . $e->getMessage());
        }
    }

    public function toggleStatus(Document $dokuman)
    {
        try {
            $newStatus = $dokuman->status === 'published' ? 'draft' : 'published';

            $dokuman->update([
                'status' => $newStatus,
                'published_at' => $newStatus === 'published' ? now() : null,
            ]);

            return back()->with('success', "Status dokumen berhasil diubah menjadi {$newStatus}.");
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengubah status: ' . $e->getMessage());
        }
    }

    public function bulkCreate()
    {
        return view('admin.dokumen.bulk');
    }

    public function bulkStore(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|in:regulasi,sk,sop,laporan,dip,statistik,formulir,dokumen_ppid',
            'year' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'status' => 'required|in:draft,published',
            'files' => 'required|array|min:1',
            'files.*' => 'required|file|max:10240|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx',
        ]);

        $created = 0;
        $errors = [];

        foreach ($request->file('files') as $file) {
            try {
                $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $title = str_replace(['_', '-'], ' ', $originalName);
                $title = ucwords($title);

                $fileName = time() . '_' . Str::slug($originalName) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/documents'), $fileName);
                $filePath = 'uploads/documents/' . $fileName;

                Document::create([
                    'title' => $title,
                    'slug' => Str::slug($title) . '-' . Str::random(5),
                    'category' => $validated['category'],
                    'year' => $validated['year'],
                    'description' => $title,
                    'file_path' => $filePath,
                    'file_name' => $file->getClientOriginalName(),
                    'file_size' => $file->getSize(),
                    'mime_type' => $file->getMimeType(),
                    'status' => $validated['status'],
                    'published_at' => $validated['status'] === 'published' ? now() : null,
                    'created_by' => auth()->id(),
                ]);

                $created++;
            } catch (\Exception $e) {
                $errors[] = $file->getClientOriginalName() . ': ' . $e->getMessage();
            }
        }

        $message = "{$created} dokumen berhasil ditambahkan.";
        if (!empty($errors)) {
            $message .= ' ' . count($errors) . ' file gagal: ' . implode(', ', $errors);
        }

        return redirect()->route('admin.dokumen.index')->with('success', $message);
    }

    public function incrementDownload(Document $dokuman)
    {
        try {
            $dokuman->increment('download_count');

            return back()->with('success', 'Hitungan unduhan diperbarui.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui hitungan unduhan.');
        }
    }
}
