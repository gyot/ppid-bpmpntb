<?php

namespace App\Http\Controllers;

use App\Models\PermohonanInformasi;
use App\Models\Keberatan;

class LaporanController extends Controller
{
    public function ringkasanAkses()
    {
        $stats = [
            'total_permohonan' => PermohonanInformasi::whereYear('created_at', date('Y'))->count(),
            'permohonan_diterima' => PermohonanInformasi::whereYear('created_at', date('Y'))->whereIn('status', ['completed'])->count(),
            'permohonan_ditolak' => PermohonanInformasi::whereYear('created_at', date('Y'))->where('status', 'rejected')->count(),
            'rata_waktu' => '10 hari kerja',
            'total_keberatan' => Keberatan::whereYear('created_at', date('Y'))->count(),
            'permohonan_per_bulan' => PermohonanInformasi::whereYear('created_at', date('Y'))
                ->selectRaw('MONTH(created_at) as bulan, COUNT(*) as jumlah')
                ->groupBy('bulan')
                ->pluck('jumlah', 'bulan')
                ->toArray(),
        ];
        return view('pages.laporan.ringkasan-akses', compact('stats'));
    }

    public function laporanTahunan()
    {
        return view('pages.laporan.tahunan');
    }
}
