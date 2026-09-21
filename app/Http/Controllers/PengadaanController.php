<?php

namespace App\Http\Controllers;

use App\Models\Pengadaan;

class PengadaanController extends Controller
{
    public function index()
    {
        return view('pages.pengadaan.index');
    }

    public function rencana()
    {
        $pengadaans = Pengadaan::where('status', 'published')
            ->where('tahap', 'rencana')
            ->where('tahun', date('Y'))
            ->get();
        return view('pages.pengadaan.rencana', compact('pengadaans'));
    }

    public function pemilihan()
    {
        $pengadaans = Pengadaan::where('status', 'published')
            ->where('tahap', 'pemilihan')
            ->where('tahun', date('Y'))
            ->get();
        return view('pages.pengadaan.pemilihan', compact('pengadaans'));
    }

    public function pelaksanaan()
    {
        $pengadaans = Pengadaan::where('status', 'published')
            ->where('tahap', 'pelaksanaan')
            ->where('tahun', date('Y'))
            ->get();
        return view('pages.pengadaan.pelaksanaan', compact('pengadaans'));
    }
}
