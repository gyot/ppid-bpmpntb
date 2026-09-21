@extends('layouts.app')

@section('title', 'Profil Badan Publik - PPID BPMP NTB')
@section('meta_description', 'Profil Badan Publik BPMP Provinsi Nusa Tenggara Barat')

@section('content')
<div class="page-header">
    <div class="container-custom py-8">
        <h1 class="text-3xl font-bold text-white mb-4">Profil Badan Publik</h1>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}" class="text-secondary hover:text-white">Beranda</a>
            <span class="mx-2 text-gray-400">/</span>
            <a href="{{ route('berkala.index') }}" class="text-secondary hover:text-white">Informasi Wajib Berkala</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-white">Profil Badan Publik</span>
        </nav>
    </div>
</div>

<section class="py-12 bg-gray-50">
    <div class="container-custom max-w-5xl">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-10 mb-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center">
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-navy">BPMP Provinsi Nusa Tenggara Barat</h2>
            </div>
            <div class="prose prose-lg max-w-none text-charcoal leading-relaxed">
                <p>Balai Penjaminan Mutu Pendidikan Provinsi Nusa Tenggara Barat (BPMP NTB) adalah Unit Pelaksana Teknis di lingkungan Kementerian Pendidikan Dasar dan Menengah yang bertanggung jawab dalam peningkatan mutu pendidikan di Provinsi Nusa Tenggara Barat.</p>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-8 mb-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-10 h-10 rounded-lg bg-accent/10 flex items-center justify-center">
                        <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-navy">Alamat</h3>
                </div>
                <p class="text-charcoal leading-relaxed">Jl. Panji Tilarnegara, No. 08 Mataram - NTB</p>
                <p class="text-charcoal leading-relaxed mt-2">Provinsi: Nusa Tenggara Barat</p>
                <p class="text-charcoal leading-relaxed mt-2">Kode Pos: 83121</p>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-10 h-10 rounded-lg bg-secondary/20 flex items-center justify-center">
                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-navy">Ruang Lingkup</h3>
                </div>
                <p class="text-charcoal leading-relaxed">Penjaminan mutu pendidikan di Provinsi Nusa Tenggara Barat meliputi:</p>
                <ul class="mt-3 space-y-2 text-charcoal">
                    <li class="flex items-start gap-2">
                        <span class="w-5 h-5 rounded-full bg-primary/10 text-primary text-xs font-bold flex items-center justify-center flex-shrink-0 mt-0.5">1</span>
                        <span>Peningkatan mutu pendidikan</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="w-5 h-5 rounded-full bg-primary/10 text-primary text-xs font-bold flex items-center justify-center flex-shrink-0 mt-0.5">2</span>
                        <span>Supervisi akademik dan manajerial</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="w-5 h-5 rounded-full bg-primary/10 text-primary text-xs font-bold flex items-center justify-center flex-shrink-0 mt-0.5">3</span>
                        <span>Bimbingan teknis dan supervisi</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-10 mb-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center">
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-navy">Tugas dan Fungsi</h2>
            </div>
            <div class="prose prose-lg max-w-none text-charcoal leading-relaxed">
                <p>BPMP NTB memiliki tugas melaksanakan penjaminan mutu pendidikan dasar dan menengah di Provinsi Nusa Tenggara Barat. Fungsi utama meliputi penyusunan rencana program penjaminan mutu, pelaksanaan supervisi akademik dan manajerial, serta pelaksanaan bimbingan teknis peningkatan mutu pendidikan.</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-10 mb-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-12 h-12 rounded-xl bg-accent/10 flex items-center justify-center">
                    <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-navy">Struktur Organisasi</h2>
            </div>
            <p class="text-charcoal leading-relaxed mb-4">Struktur organisasi BPMP NTB terdiri dari:</p>
            <div class="space-y-3">
                <div class="flex items-start gap-3 p-4 bg-gray-50 rounded-xl">
                    <span class="badge-primary">1</span>
                    <span class="text-charcoal text-sm">Kepala BPMP NTB</span>
                </div>
                <div class="flex items-start gap-3 p-4 bg-gray-50 rounded-xl">
                    <span class="badge-primary">2</span>
                    <span class="text-charcoal text-sm">Sub Bagian Tata Usaha</span>
                </div>
                <div class="flex items-start gap-3 p-4 bg-gray-50 rounded-xl">
                    <span class="badge-primary">3</span>
                    <span class="text-charcoal text-sm">[Bidang-bidang akan diisi sesuai struktur terbaru]</span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-10">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center">
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-navy">Profil Pimpinan</h2>
            </div>
            <div class="grid md:grid-cols-2 gap-6">
                <div class="p-4 bg-gray-50 rounded-xl">
                    <p class="text-sm text-gray-500 mb-1">Kepala BPMP NTB</p>
                    <p class="font-semibold text-navy">[Nama Kepala BPMP NTB]</p>
                    <p class="text-sm text-charcoal mt-1">SK Penunjukan: [Nomor SK]</p>
                </div>
                <div class="p-4 bg-gray-50 rounded-xl">
                    <p class="text-sm text-gray-500 mb-1">PPID BPMP NTB</p>
                    <p class="font-semibold text-navy">[Nama PPID BPMP NTB]</p>
                    <p class="text-sm text-charcoal mt-1">SK Penunjukan: [Nomor SK]</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
