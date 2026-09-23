<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Regulasi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\IOFactory;

class RegulasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Regulasi::with('user')->latest();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', "%{$request->search}%")
                  ->orWhere('kategori', 'like', "%{$request->search}%");
            });
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('status_berlaku')) {
            $query->where('status_berlaku', $request->status_berlaku);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $regulasis = $query->paginate(15)->withQueryString();

        return view('admin.regulasi.index', compact('regulasis'));
    }

    public function create()
    {
        return view('admin.regulasi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'status_berlaku' => 'required|in:berlaku,tidak_berlaku',
            'file' => 'nullable|file|max:10240|mimes:pdf,doc,docx',
            'link_eksternal' => 'nullable|string|max:500',
            'status' => 'required|in:draft,published',
        ]);

        try {
            $data = [
                'title' => $validated['title'],
                'slug' => Str::slug($validated['title']) . '-' . Str::random(5),
                'kategori' => $validated['kategori'],
                'status_berlaku' => $validated['status_berlaku'],
                'link_eksternal' => $validated['link_eksternal'] ?? null,
                'status' => $validated['status'],
                'published_at' => $validated['status'] === 'published' ? now() : null,
                'created_by' => auth()->id(),
            ];

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                $data['file_path'] = $file->storeAs('uploads/regulasi', $fileName, 'public');
                $data['file_name'] = $file->getClientOriginalName();
            }

            Regulasi::create($data);

            return redirect()->route('admin.regulasi.index')
                ->with('success', 'Regulasi berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal menambahkan regulasi: ' . $e->getMessage());
        }
    }

    public function edit(Regulasi $regulasi)
    {
        $item = $regulasi;
        return view('admin.regulasi.edit', compact('item'));
    }

    public function update(Request $request, Regulasi $regulasi)
    {
        $validated = $request->validate([
            'kategori' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'status_berlaku' => 'required|in:berlaku,tidak_berlaku',
            'file' => 'nullable|file|max:10240|mimes:pdf,doc,docx',
            'link_eksternal' => 'nullable|string|max:500',
            'status' => 'required|in:draft,published',
        ]);

        try {
            $data = [
                'title' => $validated['title'],
                'kategori' => $validated['kategori'],
                'status_berlaku' => $validated['status_berlaku'],
                'link_eksternal' => $validated['link_eksternal'] ?? null,
                'status' => $validated['status'],
            ];

            if ($validated['status'] === 'published' && $regulasi->status !== 'published') {
                $data['published_at'] = now();
            }

            if ($request->hasFile('file')) {
                if ($regulasi->file_path && \Storage::disk('public')->exists($regulasi->file_path)) {
                    \Storage::disk('public')->delete($regulasi->file_path);
                }

                $file = $request->file('file');
                $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                $data['file_path'] = $file->storeAs('uploads/regulasi', $fileName, 'public');
                $data['file_name'] = $file->getClientOriginalName();
            }

            $regulasi->update($data);

            return redirect()->route('admin.regulasi.index')
                ->with('success', 'Regulasi berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal memperbarui regulasi: ' . $e->getMessage());
        }
    }

    public function destroy(Regulasi $regulasi)
    {
        try {
            if ($regulasi->file_path && \Storage::disk('public')->exists($regulasi->file_path)) {
                \Storage::disk('public')->delete($regulasi->file_path);
            }

            $regulasi->delete();

            return redirect()->route('admin.regulasi.index')
                ->with('success', 'Regulasi berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus regulasi: ' . $e->getMessage());
        }
    }

    public function toggleStatus(Regulasi $regulasi)
    {
        try {
            $newStatus = $regulasi->status === 'published' ? 'draft' : 'published';
            $regulasi->update([
                'status' => $newStatus,
                'published_at' => $newStatus === 'published' ? now() : null,
            ]);

            return back()->with('success', "Status regulasi berhasil diubah menjadi {$newStatus}.");
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengubah status: ' . $e->getMessage());
        }
    }

    public function importForm()
    {
        return view('admin.regulasi.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv|max:10240',
        ]);

        try {
            $file = $request->file('file');
            $spreadsheet = IOFactory::load($file->getRealPath());
            $worksheet = $spreadsheet->getActiveSheet();
            $rows = $worksheet->toArray();

            if (count($rows) < 2) {
                return back()->with('error', 'File Excel kosong atau tidak memiliki data.');
            }

            $header = array_map('strtolower', array_map('trim', $rows[0]));

            $colJenis = null; $colNama = null; $colStatusBerlaku = null; $colLink = null; $colPublikasi = null;
            foreach ($header as $i => $h) {
                if (str_contains($h, 'jenis regulasi')) $colJenis = $i;
                if (str_contains($h, 'nama peraturan')) $colNama = $i;
                if (str_contains($h, 'status berlaku') && !str_contains($h, 'publikasi')) $colStatusBerlaku = $i;
                if (str_contains($h, 'link eksternal') || str_contains($h, 'link')) $colLink = $i;
                if (str_contains($h, 'status publikasi') || str_contains($h, 'publikasi')) $colPublikasi = $i;
            }

            if ($colJenis === null || $colNama === null) {
                return back()->with('error', 'Header Excel tidak sesuai. Pastikan ada kolom "Jenis Regulasi" dan "Nama Peraturan".');
            }

            $created = 0;
            $errors = [];

            for ($i = 1; $i < count($rows); $i++) {
                $row = $rows[$i];

                if (empty($row[$colNama])) continue;

                try {
                    $title = trim($row[$colNama]);
                    $kategori = trim($row[$colJenis] ?? '');
                    $statusBerlaku = ($colStatusBerlaku !== null && !empty($row[$colStatusBerlaku])) ? (str_contains(strtolower($row[$colStatusBerlaku]), 'tidak') ? 'tidak_berlaku' : 'berlaku') : 'berlaku';
                    $linkEksternal = ($colLink !== null && !empty($row[$colLink])) ? trim($row[$colLink]) : null;
                    $status = 'draft';
                    if ($colPublikasi !== null && !empty($row[$colPublikasi])) {
                        $status = str_contains(strtolower($row[$colPublikasi]), 'publish') ? 'published' : 'draft';
                    }

                    Regulasi::create([
                        'title' => $title,
                        'slug' => Str::slug($title) . '-' . Str::random(5),
                        'kategori' => $kategori ?: 'lainnya',
                        'status_berlaku' => $statusBerlaku,
                        'link_eksternal' => $linkEksternal,
                        'status' => $status,
                        'published_at' => $status === 'published' ? now() : null,
                        'created_by' => auth()->id(),
                    ]);

                    $created++;
                } catch (\Exception $e) {
                    $errors[] = 'Baris ' . ($i + 1) . ' (' . $title . '): ' . $e->getMessage();
                }
            }

            $message = "{$created} regulasi berhasil diimport.";
            if (!empty($errors)) {
                $message .= ' ' . count($errors) . ' baris gagal: ' . implode(' | ', array_slice($errors, 0, 5));
            }

            return redirect()->route('admin.regulasi.index')->with('success', $message);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal membaca file: ' . $e->getMessage());
        }
    }
}
