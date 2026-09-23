<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = News::with('author')->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $berita = $query->paginate(15)->withQueryString();

        return view('admin.berita.index', compact('berita'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string|max:500',
            'body' => 'required|string',
            'image' => 'nullable|image|max:5120|mimes:jpg,jpeg,png,webp',
            'category' => 'nullable|string|max:100',
            'status' => 'required|in:draft,published',
            'is_featured' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        try {
            $data = [
                'title' => $validated['title'],
                'slug' => Str::slug($validated['title']) . '-' . Str::random(5),
                'excerpt' => $validated['excerpt'],
                'body' => $validated['body'],
                'category' => $validated['category'] ?? null,
                'status' => $validated['status'],
                'is_featured' => $request->boolean('is_featured'),
                'published_at' => $validated['status'] === 'published' ? now() : null,
                'author_id' => auth()->id(),
                'meta_title' => $validated['meta_title'] ?? null,
                'meta_description' => $validated['meta_description'] ?? null,
            ];

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                $data['image'] = $file->storeAs('uploads/news', $fileName, 'public');
            }

            News::create($data);

            return redirect()->route('admin.berita.index')
                ->with('success', 'Berita berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal menambahkan berita: ' . $e->getMessage());
        }
    }

    public function show(News $beritum)
    {
        $item = $beritum->load('author');
        return view('admin.berita.show', compact('item'));
    }

    public function edit(News $beritum)
    {
        return view('admin.berita.edit', compact('beritum'));
    }

    public function update(Request $request, News $beritum)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string|max:500',
            'body' => 'required|string',
            'image' => 'nullable|image|max:5120|mimes:jpg,jpeg,png,webp',
            'category' => 'nullable|string|max:100',
            'status' => 'required|in:draft,published',
            'is_featured' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        try {
            $data = [
                'title' => $validated['title'],
                'excerpt' => $validated['excerpt'],
                'body' => $validated['body'],
                'category' => $validated['category'] ?? null,
                'status' => $validated['status'],
                'is_featured' => $request->boolean('is_featured'),
                'meta_title' => $validated['meta_title'] ?? null,
                'meta_description' => $validated['meta_description'] ?? null,
            ];

            if ($validated['status'] === 'published' && $beritum->status !== 'published') {
                $data['published_at'] = now();
            }

            if ($request->hasFile('image')) {
                if ($beritum->image && \Storage::disk('public')->exists($beritum->image)) {
                    \Storage::disk('public')->delete($beritum->image);
                }

                $file = $request->file('image');
                $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                $data['image'] = $file->storeAs('uploads/news', $fileName, 'public');
            }

            $beritum->update($data);

            return redirect()->route('admin.berita.index')
                ->with('success', 'Berita berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal memperbarui berita: ' . $e->getMessage());
        }
    }

    public function destroy(News $beritum)
    {
        try {
            if ($beritum->image && \Storage::disk('public')->exists($beritum->image)) {
                \Storage::disk('public')->delete($beritum->image);
            }

            $beritum->delete();

            return redirect()->route('admin.berita.index')
                ->with('success', 'Berita berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus berita: ' . $e->getMessage());
        }
    }

    public function toggleFeatured(News $beritum)
    {
        try {
            $beritum->update(['is_featured' => !$beritum->is_featured]);

            $status = $beritum->is_featured ? 'diunggulkan' : 'dibatalkan unggulannya';
            return back()->with('success', "Berita berhasil {$status}.");
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengubah status unggulan: ' . $e->getMessage());
        }
    }

    public function toggleStatus(News $beritum)
    {
        try {
            $newStatus = $beritum->status === 'published' ? 'draft' : 'published';

            $beritum->update([
                'status' => $newStatus,
                'published_at' => $newStatus === 'published' ? now() : null,
            ]);

            return back()->with('success', "Status berita berhasil diubah menjadi {$newStatus}.");
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengubah status: ' . $e->getMessage());
        }
    }
}
