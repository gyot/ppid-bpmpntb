<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pejabat;
use Illuminate\Http\Request;

class PejabatController extends Controller
{
    public function index()
    {
        $pejabats = Pejabat::orderBy('sort_order')->paginate(20);
        return view('admin.pejabat.index', compact('pejabats'));
    }

    public function create()
    {
        return view('admin.pejabat.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $validated['foto'] = $file->storeAs('uploads/pejabat', $fileName, 'public');
        }

        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        Pejabat::create($validated);

        return redirect()->route('admin.pejabat.index')->with('success', 'Data pejabat berhasil ditambahkan.');
    }

    public function edit(Pejabat $pejabat)
    {
        return view('admin.pejabat.edit', compact('pejabat'));
    }

    public function update(Request $request, Pejabat $pejabat)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('foto')) {
            if ($pejabat->foto && \Storage::disk('public')->exists($pejabat->foto)) {
                \Storage::disk('public')->delete($pejabat->foto);
            }
            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $validated['foto'] = $file->storeAs('uploads/pejabat', $fileName, 'public');
        }

        $pejabat->update($validated);

        return redirect()->route('admin.pejabat.index')->with('success', 'Data pejabat berhasil diperbarui.');
    }

    public function destroy(Pejabat $pejabat)
    {
        if ($pejabat->foto && \Storage::disk('public')->exists($pejabat->foto)) {
            \Storage::disk('public')->delete($pejabat->foto);
        }
        $pejabat->delete();
        return redirect()->route('admin.pejabat.index')->with('success', 'Data pejabat berhasil dihapus.');
    }

    public function toggleActive(Pejabat $pejabat)
    {
        $pejabat->update(['is_active' => !$pejabat->is_active]);
        $status = $pejabat->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return back()->with('success', "Pejabat berhasil {$status}.");
    }
}
