<?php

namespace App\Http\Controllers;

use App\Models\Lhkpn;
use App\Models\Program;
use App\Models\Keuangan;
use App\Models\Regulasi;

class BerkalaController extends Controller
{
    public function index()
    {
        return view('pages.berkala.index');
    }

    public function profil()
    {
        return view('pages.berkala.profil');
    }

    public function lhkpn()
    {
        $lhkpn = Lhkpn::where('status', 'published')->orderByDesc('periode')->get();
        return view('pages.berkala.lhkpn', compact('lhkpn'));
    }

    public function program()
    {
        $programs = Program::where('status', 'published')->where('tahun', date('Y'))->orderBy('jenis')->get();
        return view('pages.berkala.program', compact('programs'));
    }

    public function keuangan()
    {
        $keuangans = Keuangan::where('status', 'published')->orderByDesc('tahun')->orderBy('category')->get()->groupBy('category');
        return view('pages.berkala.keuangan', compact('keuangans'));
    }

    public function aksesInformasi()
    {
        return view('pages.berkala.akses-informasi');
    }

    public function regulasi()
    {
        $regulasis = Regulasi::where('status', 'published')->orderBy('kategori')->orderByDesc('tanggal')->get();
        return view('pages.berkala.regulasi', compact('regulasis'));
    }

    public function tatacara()
    {
        return view('pages.berkala.tatacara');
    }

    public function pengaduan()
    {
        return view('pages.berkala.pengaduan');
    }
}
