@extends('layouts.app')

@section('title', 'PPID BPMP Provinsi Nusa Tenggara Barat - Keterbukaan Informasi Publik')
@section('meta_description', 'Portal resmi PPID BPMP Provinsi Nusa Tenggara Barat. Akses informasi publik secara mudah, transparan, cepat, dan akuntabel.')

@section('content')

<section class="relative bg-gradient-to-br from-primary via-primary to-primary-dark text-white overflow-hidden">
    <div class="absolute inset-0 opacity-[0.07]">
        <svg class="absolute top-0 left-0 w-full h-full" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="hero-grid" width="48" height="48" patternUnits="userSpaceOnUse">
                    <path d="M 48 0 L 0 0 0 48" fill="none" stroke="white" stroke-width="0.5"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#hero-grid)"/>
        </svg>
    </div>

    <div class="absolute top-10 right-0 w-[500px] h-[500px] bg-secondary/10 rounded-full blur-[120px]"></div>
    <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-accent/8 rounded-full blur-[100px]"></div>

    <svg class="absolute top-20 right-20 w-24 h-24 text-white/5" viewBox="0 0 100 100" fill="currentColor">
        <circle cx="50" cy="50" r="50"/>
    </svg>
    <svg class="absolute bottom-32 left-16 w-16 h-16 text-accent/10 rotate-45" viewBox="0 0 100 100" fill="currentColor">
        <rect width="100" height="100" rx="12"/>
    </svg>
    <svg class="absolute top-1/2 right-1/4 w-8 h-8 text-secondary/15" viewBox="0 0 100 100" fill="currentColor">
        <polygon points="50,0 100,100 0,100"/>
    </svg>

    <div class="container-custom relative py-20 md:py-32 lg:py-40">
        <div class="max-w-3xl">
            <span class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full text-sm font-medium mb-8 border border-white/20">
                <svg class="w-4 h-4 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Pejabat Pengelola Informasi dan Dokumentasi
            </span>

            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold leading-[1.1] mb-6 tracking-tight text-white">
                PPID BPMP
                <span class="block text-accent mt-1">Nusa Tenggara Barat</span>
            </h1>

            <p class="text-lg md:text-xl text-white/80 mb-10 max-w-2xl leading-relaxed">
                Akses informasi publik secara mudah, transparan, cepat, dan akuntabel.
            </p>

            <div class="flex flex-wrap gap-4">
                <a href="{{ route('layanan.permohonan.create') }}" class="btn-accent btn-lg group" style="color:#0A1628;">
                    <svg class="w-5 h-5 mr-2 group-hover:rotate-[-8deg] transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Ajukan Permohonan Informasi
                </a>
                <a href="{{ route('informasi.index') }}" class="btn-secondary btn-lg !border-white/30 !text-white hover:!bg-white hover:!text-primary group">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                    Lihat Informasi Publik
                </a>
            </div>
        </div>
    </div>

    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 100" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" class="w-full h-auto">
            <path d="M0 100L48 93.3C96 86.7 192 73.3 288 66.7C384 60 480 60 576 66.7C672 73.3 768 86.7 864 86.7C960 86.7 1056 73.3 1152 66.7C1248 60 1344 60 1392 60L1440 60V100H0Z" fill="white"/>
        </svg>
    </div>
</section>

<section class="py-16 md:py-24 bg-white">
    <div class="container-custom">
        <div class="text-center mb-14">
            <h2 class="section-title">Akses Cepat</h2>
            <p class="section-subtitle mx-auto">Jelajahi layanan informasi publik yang kami sediakan untuk Anda</p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @php
            $quickAccess = [
                [
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>',
                    'title' => 'Informasi Publik',
                    'desc' => 'Akses daftar informasi publik yang tersedia',
                    'route' => 'informasi.index',
                    'color' => 'primary',
                ],
                [
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>',
                    'title' => 'Permohonan Informasi',
                    'desc' => 'Ajukan permohonan informasi publik secara online',
                    'route' => 'layanan.permohonan.create',
                    'color' => 'secondary',
                ],
                [
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>',
                    'title' => 'Cek Status',
                    'desc' => 'Pantau status permohonan informasi Anda',
                    'route' => 'layanan.cek-status',
                    'color' => 'accent',
                ],
                [
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>',
                    'title' => 'Keberatan',
                    'desc' => 'Ajukan keberatan atas informasi yang tidak diberikan',
                    'route' => 'layanan.keberatan.create',
                    'color' => 'red',
                ],
                [
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"/>',
                    'title' => 'Dokumen',
                    'desc' => 'Unduh dokumen dan regulasi terkait',
                    'route' => 'dokumen.index',
                    'color' => 'sky',
                ],
                [
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                    'title' => 'FAQ',
                    'desc' => 'Pertanyaan yang sering diajukan',
                    'route' => 'faq',
                    'color' => 'amber',
                ],
                [
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>',
                    'title' => 'Pengadaan B&J',
                    'desc' => 'Informasi pengadaan barang dan jasa BPMP NTB',
                    'route' => 'pengadaan.index',
                    'color' => 'emerald',
                ],
            ];
            @endphp

            @foreach($quickAccess as $item)
            <a href="{{ route($item['route']) }}" class="group block bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-lg hover:border-{{ $item['color'] }}/20 hover:-translate-y-1 transition-all duration-300">
                <div class="w-14 h-14 rounded-xl bg-{{ $item['color'] }}/10 flex items-center justify-center mb-5 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-7 h-7 text-{{ $item['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        {!! $item['icon'] !!}
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-navy mb-2 group-hover:text-primary transition-colors">{{ $item['title'] }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed">{{ $item['desc'] }}</p>
            </a>
            @endforeach
        </div>
    </div>
</section>

<section class="py-16 md:py-24 bg-gray-50/80">
    <div class="container-custom">
        <div class="text-center mb-14">
            <h2 class="section-title">Statistik Layanan</h2>
            <p class="section-subtitle mx-auto">Data layanan informasi publik PPID BPMP NTB</p>
        </div>

        @php
        $statItems = [
            ['label' => 'Total Informasi Publik', 'value' => $stats['total_informasi'], 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>'],
            ['label' => 'Total Dokumen', 'value' => $stats['total_dokumen'], 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"/>'],
            ['label' => 'Total Permohonan', 'value' => $stats['total_permohonan'], 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>'],
            ['label' => 'Permohonan Selesai', 'value' => $stats['permohonan_selesai'], 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>'],
            ['label' => 'Rata-rata Waktu Layanan', 'value' => $stats['avg_waktu_layanan'], 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>', 'suffix' => ' hari'],
            ['label' => 'Total Keberatan', 'value' => $stats['total_keberatan'], 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>'],
        ];
        @endphp

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($statItems as $stat)
            <div class="bg-white rounded-2xl p-6 text-center border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300" style="border-top: 3px solid #F0A800;">
                <div class="w-14 h-14 rounded-full bg-accent/10 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        {!! $stat['icon'] !!}
                    </svg>
                </div>
                <div class="text-3xl md:text-4xl font-extrabold text-navy mb-1">
                    {{ is_numeric($stat['value']) ? number_format($stat['value']) : $stat['value'] }}{{ $stat['suffix'] ?? '' }}
                </div>
                <div class="text-sm text-gray-500 font-medium">{{ $stat['label'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="py-16 md:py-24 bg-white">
    <div class="container-custom">
        <div class="text-center mb-14">
            <h2 class="section-title">Kategori Informasi Publik</h2>
            <p class="section-subtitle mx-auto">Informasi publik dikelompokkan berdasarkan jenis ketersediaan</p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
            $categories = [
                [
                    'name' => 'Berkala',
                    'desc' => 'Informasi yang wajib disediakan dan diumumkan secara berkala oleh badan publik.',
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>',
                    'route' => 'berkala.index',
                    'color' => 'primary',
                ],
                [
                    'name' => 'Setiap Saat',
                    'desc' => 'Informasi yang wajib tersedia setiap saat dan dapat diakses oleh publik.',
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                    'route' => 'informasi.setiap-saat',
                    'color' => 'sky',
                ],
                [
                    'name' => 'Serta Merta',
                    'desc' => 'Informasi yang wajib diumumkan secara serta merta karena menyangkut hajat hidup orang banyak.',
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>',
                    'route' => 'informasi.serta-merta',
                    'color' => 'amber',
                ],
                [
                    'name' => 'Dikecualikan',
                    'desc' => 'Informasi yang dikecualikan sesuai ketentuan peraturan perundang-undangan.',
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>',
                    'route' => 'informasi.dikecualikan',
                    'color' => 'red',
                ],
            ];
            @endphp

            @foreach($categories as $cat)
            <a href="{{ route($cat['route']) }}" class="group block bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-lg hover:border-{{ $cat['color'] }}/20 hover:-translate-y-1 transition-all duration-300">
                <div class="w-14 h-14 rounded-xl bg-{{ $cat['color'] }}/10 flex items-center justify-center mb-5 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-7 h-7 text-{{ $cat['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        {!! $cat['icon'] !!}
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-navy mb-2 group-hover:text-primary transition-colors">{{ $cat['name'] }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed mb-4">{{ $cat['desc'] }}</p>
                <span class="inline-flex items-center gap-1 text-primary font-semibold text-sm group-hover:gap-2 transition-all">
                    Lihat Selengkapnya
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </span>
            </a>
            @endforeach
        </div>
    </div>
</section>

<section class="py-16 md:py-20 bg-primary relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <svg class="absolute top-0 left-0 w-full h-full" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="cta-dots" width="20" height="20" patternUnits="userSpaceOnUse">
                    <circle cx="2" cy="2" r="1" fill="white"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#cta-dots)"/>
        </svg>
    </div>
    <div class="absolute -top-20 -right-20 w-64 h-64 bg-accent/20 rounded-full blur-[80px]"></div>
    <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-secondary/20 rounded-full blur-[80px]"></div>

    <div class="container-custom text-center relative">
        <div class="max-w-2xl mx-auto">
            <svg class="w-16 h-16 text-accent/80 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
            </svg>
            <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-4">Butuh Informasi Publik?</h2>
            <p class="text-white/80 text-lg mb-8 leading-relaxed">Anda berhak mendapatkan informasi publik. Ajukan permohonan secara online dengan mudah dan cepat melalui portal PPID kami.</p>
            <a href="{{ route('layanan.permohonan.create') }}" class="btn-accent btn-lg group">
                <svg class="w-5 h-5 mr-2 group-hover:rotate-[-8deg] transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Ajukan Permohonan Informasi
            </a>
        </div>
    </div>
</section>

@endsection