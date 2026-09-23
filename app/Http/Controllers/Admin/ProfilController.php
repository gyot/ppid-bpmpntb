<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProfilController extends Controller
{
    public function index()
    {
        $settings = Setting::whereIn('group', [
            'profil_tentang', 'profil_visi', 'profil_misi', 'profil_tugas', 'profil_dasar_hukum', 'profil_maklumat', 'profil_standar', 'profil_struktur', 'profil_sk',
        ])->get()->keyBy('key');

        $strukturUrl = null;
        $strukturPath = Setting::get('profil_struktur_gambar');
        if ($strukturPath && File::exists(public_path($strukturPath))) {
            $strukturUrl = '/' . $strukturPath;
        }

        $skFileName = Setting::get('profil_sk_nama');
        $skUploaded = $skFileName ? true : false;

        return view('admin.profil.index', compact('settings', 'strukturUrl', 'skFileName', 'skUploaded'));
    }

    public function update(Request $request)
    {
        $fields = [
            'profil_tentang_teks' => 'profil_tentang',
            'profil_visi_teks' => 'profil_visi',
            'profil_misi_teks' => 'profil_misi',
            'profil_tugas_teks' => 'profil_tugas',
            'profil_dasar_hukum_teks' => 'profil_dasar_hukum',
            'profil_maklumat_teks' => 'profil_maklumat',
            'profil_standar_teks' => 'profil_standar',
        ];

        foreach ($fields as $key => $group) {
            Setting::set($key, $request->input($key, ''), $group);
        }

        if ($request->hasFile('profil_struktur_gambar')) {
            $request->validate([
                'profil_struktur_gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:5120',
            ]);

            $oldPath = Setting::get('profil_struktur_gambar');
            if ($oldPath && File::exists(public_path($oldPath))) {
                File::delete(public_path($oldPath));
            }

            $file = $request->file('profil_struktur_gambar');
            $fileName = 'struktur_org_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/profil'), $fileName);
            $path = 'uploads/profil/' . $fileName;
            Setting::set('profil_struktur_gambar', $path, 'profil_struktur');
        }

        if ($request->hasFile('profil_sk_file')) {
            $request->validate([
                'profil_sk_file' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
            ]);

            $oldPath = Setting::get('profil_sk_file');
            if ($oldPath && File::exists(public_path($oldPath))) {
                File::delete(public_path($oldPath));
            }

            $file = $request->file('profil_sk_file');
            $originalName = $file->getClientOriginalName();
            $fileName = 'sk_ppid_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/profil'), $fileName);
            $path = 'uploads/profil/' . $fileName;
            Setting::set('profil_sk_file', $path, 'profil_sk');
            Setting::set('profil_sk_nama', $originalName, 'profil_sk');
        }

        return back()->with('success', 'Profil PPID berhasil diperbarui.');
    }

    public function downloadSk()
    {
        $path = Setting::get('profil_sk_file');
        if (!$path || !File::exists(public_path($path))) {
            abort(404, 'File SK PPID tidak ditemukan.');
        }

        $name = Setting::get('profil_sk_nama', 'SK_PPID.pdf');
        return response()->download(public_path($path), $name);
    }
}
