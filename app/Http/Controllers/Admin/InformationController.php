<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InformationPublik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class InformationController extends Controller
{
    private function mapCategory(string $category): string
    {
        return match ($category) {
            'informasi berkala' => 'berkala',
            'informasi serta merta' => 'serta_merta',
            'informasi setiap saat' => 'setiap_saat',
            'informasi dikecualikan' => 'dikecualikan',
            default => $category,
        };
    }

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
            $query->where('category', $this->mapCategory($request->category));
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
            $fileSize = $file->getSize();
            $mimeType = $file->getMimeType();
            $file->move(public_path('uploads/informasi'), $fileName);
            $filePath = 'uploads/informasi/' . $fileName;

            InformationPublik::create([
                'title' => $validated['title'],
                'slug' => Str::slug($validated['title']) . '-' . Str::random(5),
                'category' => $this->mapCategory($validated['category']),
                'year' => $validated['year'],
                'description' => $validated['description'] ?? null,
                'file_path' => $filePath,
                'file_name' => $file->getClientOriginalName(),
                'file_size' => $fileSize,
                'mime_type' => $mimeType,
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
                'category' => $this->mapCategory($validated['category']),
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
                if ($informasi->file_path && File::exists(public_path($informasi->file_path))) {
                    File::delete(public_path($informasi->file_path));
                }

                $file = $request->file('file');
                $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                $fileSize = $file->getSize();
                $mimeType = $file->getMimeType();
                $originalName = $file->getClientOriginalName();
                $file->move(public_path('uploads/informasi'), $fileName);
                $data['file_path'] = 'uploads/informasi/' . $fileName;
                $data['file_name'] = $originalName;
                $data['file_size'] = $fileSize;
                $data['mime_type'] = $mimeType;
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
            if ($informasi->file_path && File::exists(public_path($informasi->file_path))) {
                File::delete(public_path($informasi->file_path));
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

    public function bulkCreate()
    {
        return view('admin.informasi.bulk');
    }

    public function bulkStore(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:100',
            'year' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'status' => 'required|in:draft,published',
            'unit_pengelola' => 'nullable|string|max:255',
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
                $fileSize = $file->getSize();
                $mimeType = $file->getMimeType();
                $file->move(public_path('uploads/informasi'), $fileName);
                $filePath = 'uploads/informasi/' . $fileName;

                InformationPublik::create([
                    'title' => $title,
                    'slug' => Str::slug($title) . '-' . Str::random(5),
                    'category' => $this->mapCategory($validated['category']),
                    'year' => $validated['year'],
                    'description' => $title,
                    'file_path' => $filePath,
                    'file_name' => $file->getClientOriginalName(),
                    'file_size' => $fileSize,
                    'mime_type' => $mimeType,
                    'unit_pengelola' => $validated['unit_pengelola'] ?? null,
                    'status' => $validated['status'],
                    'published_at' => $validated['status'] === 'published' ? now() : null,
                    'created_by' => auth()->id(),
                ]);

                $created++;
            } catch (\Exception $e) {
                $errors[] = $file->getClientOriginalName() . ': ' . $e->getMessage();
            }
        }

        $message = "{$created} informasi publik berhasil ditambahkan.";
        if (!empty($errors)) {
            $message .= ' ' . count($errors) . ' file gagal: ' . implode(', ', $errors);
        }

        return redirect()->route('admin.informasi.index')->with('success', $message);
    }
}
