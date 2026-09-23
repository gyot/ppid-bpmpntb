<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class SopController extends Controller
{
    public function index(Request $request)
    {
        $query = Sop::with('user')->orderBy('sort_order');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', "%{$request->search}%")
                  ->orWhere('deskripsi', 'like', "%{$request->search}%");
            });
        }

        $sops = $query->paginate(15)->withQueryString();

        return view('admin.sop.index', compact('sops'));
    }

    public function create()
    {
        return view('admin.sop.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'konten' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'file' => 'nullable|file|max:10240|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        try {
            $data = [
                'title' => $validated['title'],
                'slug' => Str::slug($validated['title']) . '-' . Str::random(5),
                'deskripsi' => $validated['deskripsi'],
                'konten' => $validated['konten'] ?? '',
                'icon' => $validated['icon'] ?? null,
                'sort_order' => $validated['sort_order'] ?? 0,
                'is_active' => $request->boolean('is_active', true),
                'created_by' => auth()->id(),
            ];

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('uploads/sop', $fileName, 'public');
                $data['file_path'] = 'uploads/sop/' . $fileName;
                $data['file_name'] = $file->getClientOriginalName();
                $data['file_size'] = $file->getSize();
                $data['mime_type'] = $file->getMimeType();
            }

            Sop::create($data);

            return redirect()->route('admin.sop.index')
                ->with('success', 'SOP berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal menambahkan SOP: ' . $e->getMessage());
        }
    }

    public function edit(Sop $sop)
    {
        $item = $sop;
        return view('admin.sop.edit', compact('item'));
    }

    public function update(Request $request, Sop $sop)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'konten' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'file' => 'nullable|file|max:10240|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        try {
            $data = [
                'title' => $validated['title'],
                'deskripsi' => $validated['deskripsi'],
                'konten' => $validated['konten'] ?? '',
                'icon' => $validated['icon'] ?? null,
                'sort_order' => $validated['sort_order'] ?? 0,
                'is_active' => $request->boolean('is_active', true),
            ];

            if ($request->hasFile('file')) {
                if ($sop->file_path && \Storage::disk('public')->exists($sop->file_path)) {
                    \Storage::disk('public')->delete($sop->file_path);
                }

                $file = $request->file('file');
                $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('uploads/sop', $fileName, 'public');
                $data['file_path'] = 'uploads/sop/' . $fileName;
                $data['file_name'] = $file->getClientOriginalName();
                $data['file_size'] = $file->getSize();
                $data['mime_type'] = $file->getMimeType();
            }

            $sop->update($data);

            return redirect()->route('admin.sop.index')
                ->with('success', 'SOP berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal memperbarui SOP: ' . $e->getMessage());
        }
    }

    public function destroy(Sop $sop)
    {
        try {
            if ($sop->file_path && \Storage::disk('public')->exists($sop->file_path)) {
                \Storage::disk('public')->delete($sop->file_path);
            }

            $sop->delete();

            return redirect()->route('admin.sop.index')
                ->with('success', 'SOP berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus SOP: ' . $e->getMessage());
        }
    }

    public function toggleActive(Sop $sop)
    {
        try {
            $sop->update(['is_active' => !$sop->is_active]);
            $status = $sop->is_active ? 'diaktifkan' : 'dinonaktifkan';

            return back()->with('success', "SOP berhasil {$status}.");
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengubah status: ' . $e->getMessage());
        }
    }

    public function reorder(Request $request)
    {
        try {
            $order = $request->input('order', []);

            foreach ($order as $index => $id) {
                Sop::where('id', $id)->update(['sort_order' => $index]);
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function bulkCreate()
    {
        return view('admin.sop.bulk');
    }

    public function bulkStore(Request $request)
    {
        $validated = $request->validate([
            'deskripsi' => 'nullable|string',
            'files' => 'required|array|min:1',
            'files.*' => 'required|file|max:10240|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx',
        ]);

        $created = 0;
        $errors = [];
        $maxOrder = Sop::max('sort_order') ?? 0;

        foreach ($request->file('files') as $index => $file) {
            try {
                $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $title = str_replace(['_', '-'], ' ', $originalName);
                $title = ucwords($title);

                $fileName = time() . '_' . $index . '_' . Str::slug($originalName) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('uploads/sop', $fileName, 'public');

                Sop::create([
                    'title' => $title,
                    'slug' => Str::slug($title) . '-' . Str::random(5),
                    'deskripsi' => $validated['deskripsi'] ?? $title,
                    'konten' => '',
                    'file_path' => 'uploads/sop/' . $fileName,
                    'file_name' => $file->getClientOriginalName(),
                    'file_size' => $file->getSize(),
                    'mime_type' => $file->getMimeType(),
                    'sort_order' => $maxOrder + $index + 1,
                    'is_active' => true,
                    'created_by' => auth()->id(),
                ]);

                $created++;
            } catch (\Exception $e) {
                $errors[] = $file->getClientOriginalName() . ': ' . $e->getMessage();
            }
        }

        $message = "{$created} SOP berhasil ditambahkan.";
        if (!empty($errors)) {
            $message .= ' ' . count($errors) . ' file gagal: ' . implode(', ', $errors);
        }

        return redirect()->route('admin.sop.index')->with('success', $message);
    }
}
