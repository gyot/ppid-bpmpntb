@extends('layouts.app')

@section('title', 'SOP Pengujian Konsekuensi - PPID BPMP NTB')
@section('meta_description', 'SOP Pengujian Konsekuensi PPID BPMP Provinsi Nusa Tenggara Barat')

@section('content')
<div class="page-header">
    <div class="container-custom py-8">
        <h1 class="text-3xl font-bold text-white mb-4">SOP Pengujian Konsekuensi</h1>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}" class="text-secondary hover:text-white">Beranda</a>
            <span class="mx-2 text-gray-400">/</span>
            <a href="{{ route('profile.index') }}" class="text-secondary hover:text-white">Profil</a>
            <span class="mx-2 text-gray-400">/</span>
            <a href="{{ route('profile.sop') }}" class="text-secondary hover:text-white">SOP</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-white">Pengujian Konsekuensi</span>
        </nav>
    </div>
</div>

<section class="py-12 bg-gray-50">
    <div class="container-custom max-w-4xl">

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-10">
            <h2 class="text-xl font-bold text-navy mb-4 text-center">SOP Pengujian Konsekuensi</h2>

            <div class="bg-blue-50 border-l-4 border-primary p-4 rounded-r-lg mb-8">
                <p class="text-charcoal text-sm leading-relaxed">
                    <strong>Uji konsekuensi</strong> adalah proses untuk menentukan apakah suatu informasi dapat dikecualikan dari keterbukaan. Pengujian ini dilakukan dengan membandingkan antara kepentingan publik untuk mendapatkan informasi dengan kerugian yang akan timbul jika informasi tersebut diungkapkan.
                </p>
            </div>

            <div class="relative">
                <div class="absolute left-6 top-0 bottom-0 w-0.5 bg-gray-200 hidden md:block"></div>

                <div class="space-y-6">
                    @php
                    $steps = [
                        ['num' => '1', 'title' => 'Identifikasi Informasi yang Akan Dikecualikan', 'desc' => 'PPID mengidentifikasi informasi yang dianggap perlu dikecualikan berdasarkan ketentuan perundang-undangan. Informasi tersebut dicatat dengan detail meliputi sifat, ruang lingkup, dan alasan pengkecualian.', 'color' => 'primary'],
                        ['num' => '2', 'title' => 'Klasifikasi Jenis Informasi', 'desc' => 'Informasi diklasifikasikan berdasarkan jenisnya sesuai dengan Pasal 17 Undang-Undang Keterbukaan Informasi Publik, termasuk informasi yang dapat menghambat proses penegakan hukum, informasi yang berkaitan dengan kepentingan perlindungan usaha, dan informasi strategis.', 'color' => 'secondary'],
                        ['num' => '3', 'title' => 'Lakukan Pengujian Konsekuensi', 'desc' => 'PPID melakukan pengujian konsekuensi dengan menganalisis dampak pengungkapan informasi terhadap kepentingan yang dilindungi. Pengujian meliputi uji kerugian (harm test) dan uji kepentingan publik (public interest test).', 'color' => 'accent'],
                        ['num' => '4', 'title' => 'Dokumentasikan Hasil Pengujian', 'desc' => 'Seluruh hasil pengujian konsekuensi didokumentasikan secara tertulis, termasuk pertimbangan, analisis, dan rekomendasi apakah informasi tersebut layak dikecualikan atau tidak.', 'color' => 'primary'],
                        ['num' => '5', 'title' => 'Tetapkan Status Informasi', 'desc' => 'Berdasarkan hasil pengujian, PPID menetapkan status informasi sebagai informasi yang dikecualikan atau informasi yang dapat diakses publik. Keputusan disertai dengan alasan yang jelas.', 'color' => 'secondary'],
                        ['num' => '6', 'title' => 'Review dan Approval oleh Atasan PPID', 'desc' => 'Hasil pengujian konsekuensi dan penetapan status informasi direview dan mendapat persetujuan dari Atasan PPID. Dokumen pengujian disimpan sebagai arsip untuk keperluan audit dan pelaporan.', 'color' => 'accent'],
                    ];
                    @endphp

                    @foreach($steps as $step)
                    <div class="flex items-start gap-5 relative">
                        <div class="w-12 h-12 rounded-full bg-{{ $step['color'] }} text-white font-bold flex items-center justify-center flex-shrink-0 shadow-md z-10">
                            {{ $step['num'] }}
                        </div>
                        <div class="flex-1 bg-gray-50 rounded-xl p-5 border border-gray-100">
                            <h3 class="font-bold text-navy mb-2">{{ $step['title'] }}</h3>
                            <p class="text-charcoal text-sm leading-relaxed">{{ $step['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="mt-10 bg-gray-50 rounded-xl p-6 border border-gray-100">
                <h3 class="font-bold text-navy mb-4 text-center">Alur Pengujian Konsekuensi</h3>
                <div class="flex flex-col items-center gap-3 text-sm">
                    <div class="bg-primary text-white px-6 py-3 rounded-lg text-center w-full max-w-md">Identifikasi Informasi</div>
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                    <div class="bg-secondary text-white px-6 py-3 rounded-lg text-center w-full max-w-md">Klasifikasi Jenis Informasi</div>
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                    <div class="bg-accent text-navy px-6 py-3 rounded-lg text-center w-full max-w-md font-semibold">Pengujian Konsekuensi</div>
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                    <div class="bg-primary text-white px-6 py-3 rounded-lg text-center w-full max-w-md">Dokumentasi Hasil</div>
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                    <div class="bg-secondary text-white px-6 py-3 rounded-lg text-center w-full max-w-md">Tetapkan Status</div>
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                    <div class="bg-accent text-navy px-6 py-3 rounded-lg text-center w-full max-w-md font-semibold">Review & Approval Atasan PPID</div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
