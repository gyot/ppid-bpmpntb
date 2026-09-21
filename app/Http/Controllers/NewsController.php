<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = News::where('status', 'published');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%")
                    ->orWhere('body', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $featuredNews = null;
        if (!$request->filled('search') && !$request->filled('category') && $request->input('page', 1) == 1) {
            $featuredNews = News::where('status', 'published')
                ->where('is_featured', true)
                ->latest('published_at')
                ->first();
        }

        if ($featuredNews) {
            $query->where('id', '!=', $featuredNews->id);
        }

        $news = $query->latest('published_at')
            ->paginate(9)
            ->appends($request->query());

        $categories = News::where('status', 'published')
            ->distinct()
            ->pluck('category')
            ->filter()
            ->sort()
            ->values();

        return view('pages.berita.index', compact('news', 'featuredNews', 'categories'));
    }

    public function show($slug)
    {
        $berita = News::with('author')->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        $berita->increment('views_count');

        $relatedNews = News::where('category', $berita->category)
            ->where('status', 'published')
            ->where('id', '!=', $berita->id)
            ->latest('published_at')
            ->limit(3)
            ->get();

        return view('pages.berita.show', compact('berita', 'relatedNews'));
    }
}
