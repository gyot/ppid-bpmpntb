<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lhkpn;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LhkpnController extends Controller
{
    public function index(Request $request)
    {
        $query = Lhkpn::with('user')->latest();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_pejabat', 'like', "%{$request->search}%")
                  ->orWhere('jabatan', 'like', "%{$request->search}%");
            });
        }

        if ($request->filled('periode')) {
            $query->where('periode', $request->periode);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $lhkpn = $query->paginate(15)->withQueryString();

        return view('admin.lhkpn.index', compact('lhkpn'));
    }

    public function create()
    {
        return view('admin.lhkpn.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pejabat' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'nip' => 'nullable|string|max:30',
            'periode' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'file' => 'required|file|max:10240|mimes:pdf,doc,docx,xls,xlsx',
            'status' => 'required|in:draft,published',
        ]);

        try {
            $file = $request->file('file');
            $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('uploads/lhkpn', $fileName, 'public');

            Lhkpn::create([
                'nama_pejabat' => $validated['nama_pejabat'],
                'jabatan' => $validated['jabatan'],
                'nip' => $validated['nip'] ?? null,
                'periode' => $validated['periode'],
                'file_path' => $filePath,
                'file_name' => $file->getClientOriginalName(),
                'status' => $validated['status'],
                'published_at' => $validated['status'] === 'published' ? now() : null,
                'created_by' => auth()->id(),
            ]);

            return redirect()->route('admin.lhkpn.index')
                ->with('success', 'Data LHKPN berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal menambahkan data: ' . $e->getMessage());
        }
    }

    public function edit(Lhkpn $lhkpn)
    {
        $item = $lhkpn;
        return view('admin.lhkpn.edit', compact('item'));
    }

    public function update(Request $request, Lhkpn $lhkpn)
    {
        $validated = $request->validate([
            'nama_pejabat' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'nip' => 'nullable|string|max:30',
            'periode' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'file' => 'nullable|file|max:10240|mimes:pdf,doc,docx,xls,xlsx',
            'status' => 'required|in:draft,published',
        ]);

        try {
            $data = [
                'nama_pejabat' => $validated['nama_pejabat'],
                'jabatan' => $validated['jabatan'],
                'nip' => $validated['nip'] ?? null,
                'periode' => $validated['periode'],
                'status' => $validated['status'],
            ];

            if ($validated['status'] === 'published' && $lhkpn->status !== 'published') {
                $data['published_at'] = now();
            }

            if ($request->hasFile('file')) {
                if ($lhkpn->file_path && \Storage::disk('public')->exists($lhkpn->file_path)) {
                    \Storage::disk('public')->delete($lhkpn->file_path);
                }

                $file = $request->file('file');
                $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                $data['file_path'] = $file->storeAs('uploads/lhkpn', $fileName, 'public');
                $data['file_name'] = $file->getClientOriginalName();
            }

            $lhkpn->update($data);

            return redirect()->route('admin.lhkpn.index')
                ->with('success', 'Data LHKPN berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function destroy(Lhkpn $lhkpn)
    {
        try {
            if ($lhkpn->file_path && \Storage::disk('public')->exists($lhkpn->file_path)) {
                \Storage::disk('public')->delete($lhkpn->file_path);
            }

            $lhkpn->delete();

            return redirect()->route('admin.lhkpn.index')
                ->with('success', 'Data LHKPN berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    public function toggleStatus(Lhkpn $lhkpn)
    {
        try {
            $newStatus = $lhkpn->status === 'published' ? 'draft' : 'published';
            $lhkpn->update([
                'status' => $newStatus,
                'published_at' => $newStatus === 'published' ? now() : null,
            ]);

            return back()->with('success', "Status LHKPN berhasil diubah menjadi {$newStatus}.");
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengubah status: ' . $e->getMessage());
        }
    }
}
