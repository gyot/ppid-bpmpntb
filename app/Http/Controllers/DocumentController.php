<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $query = Document::where('status', 'published');

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
            $query->whereYear('published_at', $request->year);
        }

        $dokumen = $query->latest('published_at')
            ->paginate(15)
            ->appends($request->query());

        $years = Document::where('status', 'published')
            ->selectRaw('YEAR(published_at) as year')
            ->distinct()
            ->orderByDesc('year')
            ->pluck('year');

        $categories = ['regulasi' => 'Regulasi', 'sk' => 'Surat Keputusan', 'sop' => 'SOP', 'laporan' => 'Laporan', 'dip' => 'Daftar Informasi Publik', 'statistik' => 'Statistik', 'formulir' => 'Formulir', 'dokumen_ppid' => 'Dokumen PPID'];

        return view('pages.dokumen.index', compact('dokumen', 'years', 'categories'));
    }

    public function show($slug)
    {
        $document = Document::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        $related = Document::where('category', $document->category)
            ->where('status', 'published')
            ->where('id', '!=', $document->id)
            ->latest('published_at')
            ->limit(4)
            ->get();

        return view('pages.dokumen.show', compact('document', 'related'));
    }

    public function download($id)
    {
        $document = Document::where('id', $id)
            ->where('status', 'published')
            ->firstOrFail();

        $document->increment('download_count');

        return response()->download(
            public_path($document->file_path),
            $document->title . '.' . pathinfo($document->file_path, PATHINFO_EXTENSION)
        );
    }
}
