<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sop;
use Illuminate\Http\Request;
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
            'konten' => 'required|string',
            'icon' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        try {
            Sop::create([
                'title' => $validated['title'],
                'slug' => Str::slug($validated['title']) . '-' . Str::random(5),
                'deskripsi' => $validated['deskripsi'],
                'konten' => $validated['konten'],
                'icon' => $validated['icon'] ?? null,
                'sort_order' => $validated['sort_order'] ?? 0,
                'is_active' => $request->boolean('is_active', true),
                'created_by' => auth()->id(),
            ]);

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
            'konten' => 'required|string',
            'icon' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        try {
            $sop->update([
                'title' => $validated['title'],
                'deskripsi' => $validated['deskripsi'],
                'konten' => $validated['konten'],
                'icon' => $validated['icon'] ?? null,
                'sort_order' => $validated['sort_order'] ?? 0,
                'is_active' => $request->boolean('is_active', true),
            ]);

            return redirect()->route('admin.sop.index')
                ->with('success', 'SOP berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal memperbarui SOP: ' . $e->getMessage());
        }
    }

    public function destroy(Sop $sop)
    {
        try {
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
}
