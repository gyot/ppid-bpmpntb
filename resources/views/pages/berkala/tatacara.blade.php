@extends('layouts.app')

@section('title', 'Tata Cara Memperoleh Informasi - PPID BPMP NTB')
@section('meta_description', 'Tata cara memperoleh informasi publik dari BPMP Provinsi Nusa Tenggara Barat')

@section('content')
<div class="page-header">
    <div class="container-custom py-8">
        <h1 class="text-3xl font-bold text-white mb-4">Tata Cara Memperoleh Informasi</h1>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}" class="text-secondary hover:text-white">Beranda</a>
            <span class="mx-2 text-gray-400">/</span>
            <a href="{{ route('berkala.index') }}" class="text-secondary hover:text-white">Informasi Wajib Berkala</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-white">Tata Cara Memperoleh Informasi</span>
        </nav>
    </div>
</div>

<section class="py-12 bg-gray-50">
    <div class="container-custom max-w-5xl">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-10 mb-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center">
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-navy">Alur Permohonan Informasi</h2>
            </div>

            <div class="flex flex-col md:flex-row items-center gap-4 mb-8">
                <div class="flex-1 text-center p-4 bg-primary/5 rounded-xl border border-primary/10">
                    <div class="w-10 h-10 bg-primary text-white rounded-full flex items-center justify-center mx-auto mb-2 text-sm font-bold">1</div>
                    <p class="text-sm font-semibold text-navy">Isi Formulir</p>
                    <p class="text-xs text-gray-500 mt-1">Pemohon mengisi formulir permohonan informasi</p>
                </div>
                <svg class="w-6 h-6 text-primary hidden md:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <div class="flex-1 text-center p-4 bg-accent/5 rounded-xl border border-accent/10">
                    <div class="w-10 h-10 bg-accent text-navy rounded-full flex items-center justify-center mx-auto mb-2 text-sm font-bold">2</div>
                    <p class="text-sm font-semibold text-navy">Verifikasi</p>
                    <p class="text-xs text-gray-500 mt-1">PPID memverifikasi kelengkapan permohonan</p>
                </div>
                <svg class="w-6 h-6 text-primary hidden md:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <div class="flex-1 text-center p-4 bg-primary/5 rounded-xl border border-primary/10">
                    <div class="w-10 h-10 bg-primary text-white rounded-full flex items-center justify-center mx-auto mb-2 text-sm font-bold">3</div>
                    <p class="text-sm font-semibold text-navy">Proses</p>
                    <p class="text-xs text-gray-500 mt-1">Informasi dicari dan disiapkan</p>
                </div>
                <svg class="w-6 h-6 text-primary hidden md:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <div class="flex-1 text-center p-4 bg-accent/5 rounded-xl border border-accent/10">
                    <div class="w-10 h-10 bg-accent text-navy rounded-full flex items-center justify-center mx-auto mb-2 text-sm font-bold">4</div>
                    <p class="text-sm font-semibold text-navy">Siap</p>
                    <p class="text-xs text-gray-500 mt-1">Informasi siap diberikan</p>
                </div>
                <svg class="w-6 h-6 text-primary hidden md:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <div class="flex-1 text-center p-4 bg-emerald-50 rounded-xl border border-emerald-100">
                    <div class="w-10 h-10 bg-emerald-600 text-white rounded-full flex items-center justify-center mx-auto mb-2 text-sm font-bold">5</div>
                    <p class="text-sm font-semibold text-navy">Diterima</p>
                    <p class="text-xs text-gray-500 mt-1">Pemohon menerima informasi</p>
                </div>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-8 mb-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                <h3 class="text-xl font-bold text-navy mb-4">Waktu Pelayanan</h3>
                <ul class="space-y-3 text-charcoal">
                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>Proses permohonan: <strong>10 hari kerja</strong> sejak permohonan diterima lengkap</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-amber-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>Perpanjangan: <strong>+7 hari kerja</strong> (jika diperlukan)</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-emerald-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>Pelayanan: Senin - Kamis (08:00 - 16:00 WITA), Jumat (08:00 - 16:30 WITA)</span>
                    </li>
                </ul>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                <h3 class="text-xl font-bold text-navy mb-4">Syarat Permohonan</h3>
                <ul class="space-y-3 text-charcoal">
                    <li class="flex items-start gap-2">
                        <span class="w-5 h-5 rounded-full bg-primary/10 text-primary text-xs font-bold flex items-center justify-center flex-shrink-0 mt-0.5">1</span>
                        <span>Nama lengkap dan alamat pemohon</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="w-5 h-5 rounded-full bg-primary/10 text-primary text-xs font-bold flex items-center justify-center flex-shrink-0 mt-0.5">2</span>
                        <span>Informasi yang dibutuhkan secara jelas</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="w-5 h-5 rounded-full bg-primary/10 text-primary text-xs font-bold flex items-center justify-center flex-shrink-0 mt-0.5">3</span>
                        <span>Cara memperoleh informasi (melihat, mendengar, salinan)</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="w-5 h-5 rounded-full bg-primary/10 text-primary text-xs font-bold flex items-center justify-center flex-shrink-0 mt-0.5">4</span>
                        <span>Surat kuasa (jika dikuasakan)</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="text-center">
            <a href="{{ route('layanan.permohonan.create') }}" class="btn-primary btn-lg">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Ajukan Permohonan Informasi
            </a>
        </div>
    </div>
</section>
@endsection
