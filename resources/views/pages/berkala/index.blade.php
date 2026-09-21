@extends('layouts.app')

@section('title', 'Informasi Wajib Berkala - PPID BPMP NTB')
@section('meta_description', 'Informasi yang wajib disediakan dan diumumkan secara berkala oleh BPMP Provinsi Nusa Tenggara Barat')

@section('content')
<div class="page-header">
    <div class="container-custom py-8">
        <h1 class="text-3xl font-bold text-white mb-4">Informasi Wajib Berkala</h1>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}" class="text-secondary hover:text-white">Beranda</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-white">Informasi Wajib Berkala</span>
        </nav>
    </div>
</div>

<section class="py-12 bg-gray-50">
    <div class="container-custom">
        <div class="text-center mb-12">
            <h2 class="section-title">Kategori Informasi Wajib Berkala</h2>
            <p class="section-subtitle mx-auto">Informasi yang wajib disediakan dan diumumkan secara berkala oleh Badan Publik sesuai Undang-Undang Keterbukaan Informasi Publik</p>
        </div>

        @php
        $items = [
            [
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>',
                'title' => 'Profil Badan Publik',
                'desc' => 'Profil BPMP NTB meliputi alamat, ruang lingkup tugas, struktur organisasi, dan profil pimpinan.',
                'route' => 'berkala.profil',
                'color' => 'primary',
            ],
            [
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>',
                'title' => 'LHKPN Pejabat',
                'desc' => 'Laporan Harta Kekayaan Penyelenggara Negara di lingkungan BPMP NTB.',
                'route' => 'berkala.lhkpn',
                'color' => 'sky',
            ],
            [
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>',
                'title' => 'Program dan Kegiatan',
                'desc' => 'Program dan kegiatan BPMP NTB beserta anggaran dan jadwal pelaksanaan.',
                'route' => 'berkala.program',
                'color' => 'emerald',
            ],
            [
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                'title' => 'Informasi Keuangan',
                'desc' => 'Laporan keuangan audited, RKA, DIPA, dan realisasi keuangan BPMP NTB.',
                'route' => 'berkala.keuangan',
                'color' => 'amber',
            ],
            [
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>',
                'title' => 'Ringkasan Akses Informasi',
                'desc' => 'Statistik permohonan informasi publik yang diterima oleh BPMP NTB.',
                'route' => 'berkala.akses-informasi',
                'color' => 'violet',
            ],
            [
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>',
                'title' => 'Regulasi & Kebijakan',
                'desc' => 'Peraturan perundang-undangan terkait Keterbukaan Informasi Publik.',
                'route' => 'berkala.regulasi',
                'color' => 'rose',
            ],
            [
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                'title' => 'Tata Cara Memperoleh Informasi',
                'desc' => 'Prosedur dan tata cara untuk memperoleh informasi publik dari BPMP NTB.',
                'route' => 'berkala.tatacara',
                'color' => 'teal',
            ],
            [
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>',
                'title' => 'Tata Cara Pengaduan',
                'desc' => 'Mekanisme pengaduan terkait penyalahgunaan wewenang di BPMP NTB.',
                'route' => 'berkala.pengaduan',
                'color' => 'orange',
            ],
        ];
        @endphp

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($items as $item)
            <a href="{{ route($item['route']) }}" class="group block bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-lg hover:border-{{ $item['color'] }}/20 hover:-translate-y-1 transition-all duration-300">
                <div class="w-14 h-14 rounded-xl bg-{{ $item['color'] }}/10 flex items-center justify-center mb-5 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-7 h-7 text-{{ $item['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        {!! $item['icon'] !!}
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-navy mb-2 group-hover:text-primary transition-colors">{{ $item['title'] }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed mb-4">{{ $item['desc'] }}</p>
                <span class="inline-flex items-center gap-1 text-primary font-semibold text-sm group-hover:gap-2 transition-all">
                    Lihat
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </span>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endsection
