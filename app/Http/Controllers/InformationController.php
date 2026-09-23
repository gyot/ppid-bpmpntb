<?php

namespace App\Http\Controllers;

use App\Models\InformationPublik;
use App\Models\DaftarInformasiPublik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class InformationController extends Controller
{
    public function index()
    {
        $berkalaCount = InformationPublik::where('category', 'berkala')->where('status', 'published')->count();
        $setiapSaatCount = InformationPublik::where('category', 'setiap_saat')->where('status', 'published')->count();
        $sertaMertaCount = InformationPublik::where('category', 'serta_merta')->where('status', 'published')->count();
        $dikecualikanCount = InformationPublik::where('category', 'dikecualikan')->where('status', 'published')->count();

        return view('pages.informasi.index', compact('berkalaCount', 'setiapSaatCount', 'sertaMertaCount', 'dikecualikanCount'));
    }

    public function berkala(Request $request)
    {
        $query = InformationPublik::where('category', 'berkala')
            ->where('status', 'published');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $informasi = $query->latest('published_at')->paginate(12)->appends($request->query());

        $categoryName = 'Informasi Berkala';
        return view('pages.informasi.category', compact('informasi', 'categoryName'));
    }

    public function setiapSaat(Request $request)
    {
        $query = InformationPublik::where('category', 'setiap_saat')
            ->where('status', 'published');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $categoryName = 'Informasi Setiap Saat';

        $informasi = $query->latest('published_at')->paginate(12)->appends($request->query());

        return view('pages.informasi.category', compact('informasi', 'categoryName'));
    }

    public function sertaMerta(Request $request)
    {
        $query = InformationPublik::where('category', 'serta_merta')
            ->where('status', 'published');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $categoryName = 'Informasi Serta-Merta';

        $informasi = $query->latest('published_at')->paginate(12)->appends($request->query());

        return view('pages.informasi.category', compact('informasi', 'categoryName'));
    }

    public function dikecualikan(Request $request)
    {
        $query = InformationPublik::where('category', 'dikecualikan')
            ->where('status', 'published');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $categoryName = 'Informasi Dikecualikan';

        $informasi = $query->latest('published_at')->paginate(12)->appends($request->query());

        return view('pages.informasi.category', compact('informasi', 'categoryName'));
    }

    public function daftarInformasi(Request $request)
    {
        $query = InformationPublik::where('status', 'published');

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

        $sort = $request->get('sort', 'latest');
        if ($sort === 'oldest') {
            $query->oldest('published_at');
        } else {
            $query->latest('published_at');
        }

        $informasi = $query->paginate(15)->appends($request->query());

        $years = InformationPublik::where('status', 'published')
            ->selectRaw('YEAR(published_at) as year')
            ->distinct()
            ->orderByDesc('year')
            ->pluck('year');

        $categories = ['berkala' => 'Informasi Berkala', 'setiap_saat' => 'Informasi Setiap Saat', 'serta_merta' => 'Informasi Serta-Merta', 'dikecualikan' => 'Informasi Dikecualikan'];

        return view('pages.informasi.daftar', compact('informasi', 'years', 'categories'));
    }

    public function show($slug)
    {
        $informasi = InformationPublik::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        $related = InformationPublik::where('category', $informasi->category)
            ->where('status', 'published')
            ->where('id', '!=', $informasi->id)
            ->latest('published_at')
            ->limit(4)
            ->get();

        return view('pages.informasi.show', compact('informasi', 'related'));
    }

    public function dipOnline(Request $request)
    {
        $query = DaftarInformasiPublik::where('status', 'published');

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', "%{$request->search}%");
        }

        $dip = $query->orderBy('category')->orderBy('title')->paginate(20)->appends($request->query());

        return view('pages.informasi.dip-online', compact('dip'));
    }

    public function download($slug)
    {
        $informasi = InformationPublik::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        if (!$informasi->file_path || !File::exists(public_path($informasi->file_path))) {
            abort(404);
        }

        return response()->download(public_path($informasi->file_path), $informasi->file_name ?? basename($informasi->file_path));
    }

    public function viewFile($slug)
    {
        $informasi = InformationPublik::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        if (!$informasi->file_path || !File::exists(public_path($informasi->file_path))) {
            abort(404);
        }

        $path = public_path($informasi->file_path);
        $mime = mime_content_type(public_path($informasi->file_path));

        return response()->file($path, [
            'Content-Type' => $mime,
            'Content-Disposition' => 'inline; filename="' . ($informasi->file_name ?? basename($informasi->file_path)) . '"',
        ]);
    }
}
