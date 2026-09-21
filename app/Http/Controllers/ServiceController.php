<?php

namespace App\Http\Controllers;

use App\Models\Keberatan;
use App\Models\PermohonanHistory;
use App\Models\PermohonanInformasi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function permohonanForm()
    {
        return view('pages.layanan.permohonan');
    }

    public function permohonanStore(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:16',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'alamat' => 'required|string|max:500',
            'informasi_diminta' => 'required|string|max:1000',
            'tujuan_permohonan' => 'required|string|max:500',
            'cara_memperoleh' => 'required|in:email,pos,langsung',
            'cara_mendapatkan' => 'required|in:elektronik,non_elektronik',
            'identity_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $data = collect($validated)->except('identity_file')->toArray();

        if ($request->hasFile('identity_file')) {
            $file = $request->file('identity_file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $data['identity_file_path'] = $file->storeAs('uploads/identitas', $fileName, 'public');
            $data['identity_file_name'] = $file->getClientOriginalName();
        }

        $permohonan = PermohonanInformasi::create([
            ...$data,
            'status' => 'submitted',
        ]);

        PermohonanHistory::create([
            'permohonan_id' => $permohonan->id,
            'status' => 'submitted',
            'notes' => 'Permohonan informasi telah diterima dan sedang menunggu proses verifikasi.',
        ]);

        return redirect()
            ->route('layanan.permohonan.success', $permohonan->registration_number)
            ->with('success', 'Permohonan informasi berhasil diajukan.');
    }

    public function permohonanSuccess($registrationNumber)
    {
        $permohonan = PermohonanInformasi::where('registration_number', $registrationNumber)->firstOrFail();
        return view('pages.layanan.success', compact('permohonan'));
    }

    public function cekStatus()
    {
        return view('pages.layanan.cek-status');
    }

    public function cekStatusResult(Request $request)
    {
        $request->validate([
            'registration_number' => 'required|string',
        ]);

        $regNumber = trim($request->registration_number);
        $permohonan = null;
        $keberatan = null;

        if (str_starts_with(strtoupper($regNumber), 'KBR')) {
            $keberatan = Keberatan::where('registration_number', $regNumber)->first();
        } elseif (str_starts_with(strtoupper($regNumber), 'PPID')) {
            $permohonan = PermohonanInformasi::where('registration_number', $regNumber)
                ->with('histories')
                ->first();
        } else {
            $permohonan = PermohonanInformasi::where('registration_number', $regNumber)
                ->with('histories')
                ->first();
            if (!$permohonan) {
                $keberatan = Keberatan::where('registration_number', $regNumber)->first();
            }
        }

        $searched = true;

        return view('pages.layanan.cek-status', compact('permohonan', 'keberatan', 'searched'));
    }

    public function keberatanForm()
    {
        return view('pages.layanan.keberatan');
    }

    public function keberatanStore(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:16',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'alamat' => 'required|string|max:500',
            'alasan_keberatan' => 'required|string|max:2000',
            'informasi_terkait' => 'required|string|max:1000',
        ]);

        $keberatan = Keberatan::create([
            ...$validated,
            'status' => 'submitted',
        ]);

        return redirect()
            ->route('layanan.keberatan.success', $keberatan->registration_number)
            ->with('success', 'Keberatan berhasil diajukan.');
    }

    public function keberatanSuccess($registration_number)
    {
        $keberatan = Keberatan::where('registration_number', $registration_number)->firstOrFail();
        return view('pages.layanan.keberatan-success', compact('keberatan'));
    }

    public function alur()
    {
        return view('pages.layanan.alur');
    }
}
