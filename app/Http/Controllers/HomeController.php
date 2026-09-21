<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\InformationPublik;
use App\Models\News;
use App\Models\PermohonanInformasi;
use App\Models\Keberatan;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $latestNews = News::where('status', 'published')
            ->latest('published_at')
            ->limit(6)
            ->get();

        $stats = Cache::remember('home_statistics', 3600, function () {
            return [
                'total_informasi' => InformationPublik::where('status', 'published')->count(),
                'total_dokumen' => Document::where('status', 'published')->count(),
                'total_permohonan' => PermohonanInformasi::count(),
                'permohonan_selesai' => PermohonanInformasi::where('status', 'completed')->count(),
                'avg_waktu_layanan' => 10,
                'total_keberatan' => Keberatan::count(),
            ];
        });

        return view('pages.home', compact('latestNews', 'stats'));
    }
}
