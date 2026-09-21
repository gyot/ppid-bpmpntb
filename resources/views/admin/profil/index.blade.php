@extends('admin.layouts.app')
@section('title', 'Profil PPID')

@section('content')
<h1 class="text-2xl font-bold text-gray-900 mb-6">Kelola Profil PPID</h1>

@if(session('success'))
<div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg text-green-700 text-sm">{{ session('success') }}</div>
@endif

<form method="POST" action="{{ route('admin.profil.update') }}" enctype="multipart/form-data" class="space-y-6">
    @csrf

    @php
    $sections = [
        'profil_tentang_teks' => ['label' => 'Tentang PPID', 'rows' => 6],
        'profil_visi_teks' => ['label' => 'Visi PPID', 'rows' => 3],
        'profil_misi_teks' => ['label' => 'Misi PPID', 'rows' => 8],
        'profil_tugas_teks' => ['label' => 'Tugas dan Fungsi', 'rows' => 12],
        'profil_dasar_hukum_teks' => ['label' => 'Dasar Hukum', 'rows' => 6],
        'profil_maklumat_teks' => ['label' => 'Maklumat Pelayanan', 'rows' => 6],
        'profil_standar_teks' => ['label' => 'Standar Pelayanan', 'rows' => 8],
    ];
    @endphp

    @foreach($sections as $key => $config)
    <div class="bg-white rounded-lg shadow p-6">
        <x-quill-editor
            name="{{ $key }}"
            :value="old($key, $settings[$key]->value ?? '')"
            :label="$config['label']"
            height="150px"
        />
    </div>
    @endforeach

    <div class="bg-white rounded-lg shadow p-6">
        <label class="input-label mb-3">Gambar Struktur Organisasi</label>
        <x-image-upload name="profil_struktur_gambar" :current="$strukturUrl ? true : false" :currentUrl="$strukturUrl" />
        <p class="text-xs text-gray-500 mt-2">Upload gambar struktur organisasi PPID. Format: JPG, PNG, WEBP, SVG. Maks: 5MB</p>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <label class="input-label mb-3">SK PPID (Surat Keputusan Penetapan PPID)</label>
        @if($skUploaded)
            <div class="flex items-center gap-3 p-3 bg-green-50 border border-green-200 rounded-lg mb-3">
                <svg class="w-5 h-5 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span class="text-sm text-green-700 flex-1">File terupload: <strong>{{ $skFileName }}</strong></span>
                <a href="{{ route('admin.profil.download-sk') }}" class="text-sm text-primary hover:underline font-medium">Download</a>
            </div>
        @endif
        <input type="file" name="profil_sk_file" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" class="input-field w-full">
        <p class="text-xs text-gray-500 mt-1">Format: PDF, DOC, DOCX, JPG, PNG. Maks: 10MB. Kosongkan jika tidak ingin mengubah.</p>
    </div>

    <div class="flex gap-3">
        <button type="submit" class="btn-primary">Simpan Semua Perubahan</button>
    </div>
</form>
@endsection
