<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index(Request $request)
    {
        $query = Page::latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $pages = $query->paginate(15)->withQueryString();

        return view('admin.halaman.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.halaman.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'is_active' => 'boolean',
        ]);

        try {
            Page::create([
                'title' => $validated['title'],
                'slug' => Str::slug($validated['title']),
                'content' => $validated['content'],
                'meta_title' => $validated['meta_title'] ?? null,
                'meta_description' => $validated['meta_description'] ?? null,
                'is_active' => $request->boolean('is_active', true),
            ]);

            return redirect()->route('admin.halaman.index')
                ->with('success', 'Halaman berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal menambahkan halaman: ' . $e->getMessage());
        }
    }

    public function show(Page $halaman)
    {
        return view('admin.halaman.show', compact('halaman'));
    }

    public function edit(Page $halaman)
    {
        return view('admin.halaman.edit', compact('halaman'));
    }

    public function update(Request $request, Page $halaman)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'is_active' => 'boolean',
        ]);

        try {
            $halaman->update([
                'title' => $validated['title'],
                'slug' => Str::slug($validated['title']),
                'content' => $validated['content'],
                'meta_title' => $validated['meta_title'] ?? null,
                'meta_description' => $validated['meta_description'] ?? null,
                'is_active' => $request->boolean('is_active', true),
            ]);

            return redirect()->route('admin.halaman.index')
                ->with('success', 'Halaman berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal memperbarui halaman: ' . $e->getMessage());
        }
    }

    public function destroy(Page $halaman)
    {
        try {
            $halaman->delete();

            return redirect()->route('admin.halaman.index')
                ->with('success', 'Halaman berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus halaman: ' . $e->getMessage());
        }
    }
}
