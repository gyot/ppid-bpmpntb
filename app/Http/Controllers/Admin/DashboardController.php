<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\InformationPublik;
use App\Models\Keberatan;
use App\Models\News;
use App\Models\PermohonanInformasi;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $currentYear = date('Y');

        $monthlyData = PermohonanInformasi::whereYear('created_at', $currentYear)
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
        $monthlyCounts = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyCounts[] = $monthlyData[$i] ?? 0;
        }

        $statusLabels = ['Diajukan', 'Diverifikasi', 'Diproses', 'Selesai', 'Ditolak'];
        $statusCounts = [
            PermohonanInformasi::where('status', 'submitted')->count(),
            PermohonanInformasi::where('status', 'verified')->count(),
            PermohonanInformasi::where('status', 'processing')->count(),
            PermohonanInformasi::where('status', 'completed')->count(),
            PermohonanInformasi::where('status', 'rejected')->count(),
        ];

        $stats = [
            'total_informasi' => InformationPublik::count(),
            'total_dokumen' => Document::count(),
            'total_berita' => News::count(),
            'permohonan_submitted' => $statusCounts[0],
            'permohonan_verified' => $statusCounts[1],
            'permohonan_processing' => $statusCounts[2],
            'permohonan_completed' => $statusCounts[3],
            'permohonan_rejected' => $statusCounts[4],
            'permohonan_total' => array_sum($statusCounts),
            'keberatan_submitted' => Keberatan::where('status', 'submitted')->count(),
            'keberatan_reviewing' => Keberatan::where('status', 'reviewing')->count(),
            'keberatan_responded' => Keberatan::where('status', 'responded')->count(),
            'keberatan_resolved' => Keberatan::where('status', 'resolved')->count(),
            'keberatan_total' => Keberatan::count(),
            'permohonan_months' => $months,
            'permohonan_monthly' => $monthlyCounts,
            'status_labels' => $statusLabels,
            'status_counts' => $statusCounts,
        ];

        $recentPermohonan = PermohonanInformasi::with('processedBy')
            ->latest()
            ->limit(10)
            ->get();

        $recentNews = News::with('author')
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentPermohonan', 'recentNews'));
    }
}
