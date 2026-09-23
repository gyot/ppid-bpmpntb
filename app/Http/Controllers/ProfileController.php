<?php

namespace App\Http\Controllers;

use App\Models\Pejabat;
use App\Models\Setting;
use App\Models\Sop;

class ProfileController extends Controller
{
    public function index()
    {
        $tentang = Setting::get('profil_tentang_teks', '');
        $visi = Setting::get('profil_visi_teks', '');
        $misi = Setting::get('profil_misi_teks', '');
        $tugas = Setting::get('profil_tugas_teks', '');
        $dasarHukum = Setting::get('profil_dasar_hukum_teks', '');
        return view('pages.profile.index', compact('tentang', 'visi', 'misi', 'tugas', 'dasarHukum'));
    }

    public function visiMisi()
    {
        $visi = Setting::get('profil_visi_teks', '');
        $misi = Setting::get('profil_misi_teks', '');
        return view('pages.profile.visi-misi', compact('visi', 'misi'));
    }

    public function tugasFungsi()
    {
        $tugas = Setting::get('profil_tugas_teks', '');
        return view('pages.profile.tugas-fungsi', compact('tugas'));
    }

    public function strukturOrganisasi()
    {
        $strukturUrl = null;
        $strukturPath = Setting::get('profil_struktur_gambar');
        if ($strukturPath && \Storage::disk('public')->exists($strukturPath)) {
            $strukturUrl = \Storage::disk('public')->url($strukturPath);
        }
        return view('pages.profile.struktur-organisasi', compact('strukturUrl'));
    }

    public function pejabatPpid()
    {
        $pejabats = Pejabat::where('is_active', true)->orderBy('sort_order')->get();
        return view('pages.profile.pejabat', compact('pejabats'));
    }

    public function maklumatPelayanan()
    {
        $content = Setting::get('profil_maklumat_teks', '');
        return view('pages.profile.maklumat', compact('content'));
    }

    public function standarPelayanan()
    {
        $content = Setting::get('profil_standar_teks', '');
        return view('pages.profile.standar', compact('content'));
    }

    public function sop()
    {
        $sops = Sop::where('is_active', true)->orderBy('sort_order')->get();
        return view('pages.profile.sop', compact('sops'));
    }

    public function sopPengujianKonsekuensi()
    {
        return view('pages.profile.sop-pengujian-konsekuensi');
    }

    public function sopPenetapanDip()
    {
        return view('pages.profile.sop-penetapan-dip');
    }

    public function sopPendokumentasian()
    {
        return view('pages.profile.sop-pendokumentasian');
    }

    public function skPpid()
    {
        $skFileName = Setting::get('profil_sk_nama');
        $skUploaded = $skFileName ? true : false;
        return view('pages.profile.sk-ppid', compact('skFileName', 'skUploaded'));
    }

    public function downloadSk()
    {
        $path = Setting::get('profil_sk_file');
        if (!$path || !\Storage::disk('public')->exists($path)) {
            abort(404, 'File SK PPID tidak ditemukan.');
        }
        $name = Setting::get('profil_sk_nama', 'SK_PPID.pdf');
        return \Storage::disk('public')->download($path, $name);
    }

    public function sopDownload(Sop $sop)
    {
        if (!$sop->file_path || !\Storage::disk('public')->exists($sop->file_path)) {
            abort(404, 'File SOP tidak ditemukan.');
        }

        return \Storage::disk('public')->download($sop->file_path, $sop->file_name ?? basename($sop->file_path));
    }

    public function sopView(Sop $sop)
    {
        if (!$sop->file_path || !\Storage::disk('public')->exists($sop->file_path)) {
            abort(404, 'File SOP tidak ditemukan.');
        }

        $path = \Storage::disk('public')->path($sop->file_path);
        $mime = \Storage::disk('public')->mimeType($sop->file_path);

        return response()->file($path, [
            'Content-Type' => $mime,
            'Content-Disposition' => 'inline; filename="' . ($sop->file_name ?? basename($sop->file_path)) . '"',
        ]);
    }
}
