@extends('layouts.app')

@section('title', 'SOP Pendokumentasian Informasi Publik - PPID BPMP NTB')
@section('meta_description', 'SOP Pendokumentasian Informasi Publik PPID BPMP Provinsi Nusa Tenggara Barat')

@section('content')
<div class="page-header">
    <div class="container-custom py-8">
        <h1 class="text-3xl font-bold text-white mb-4">SOP Pendokumentasian Informasi Publik</h1>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}" class="text-secondary hover:text-white">Beranda</a>
            <span class="mx-2 text-gray-400">/</span>
            <a href="{{ route('profile.index') }}" class="text-secondary hover:text-white">Profil</a>
            <span class="mx-2 text-gray-400">/</span>
            <a href="{{ route('profile.sop') }}" class="text-secondary hover:text-white">SOP</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-white">Pendokumentasian</span>
        </nav>
    </div>
</div>

<section class="py-12 bg-gray-50">
    <div class="container-custom max-w-4xl">

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-10">
            <h2 class="text-xl font-bold text-navy mb-4 text-center">SOP Pendokumentasian Informasi Publik</h2>

            <div class="bg-blue-50 border-l-4 border-primary p-4 rounded-r-lg mb-8">
                <p class="text-charcoal text-sm leading-relaxed">
                    <strong>Pendokumentasian informasi publik</strong> adalah proses pengelolaan informasi yang dimiliki oleh badan publik mulai dari penciptaan, pengumpulan, pengolahan, penyimpanan, pemeliharaan, hingga pemusnahan. Pendokumentasian yang baik menjamin ketersediaan dan aksesibilitas informasi bagi publik.
                </p>
            </div>

            <div class="relative">
                <div class="absolute left-6 top-0 bottom-0 w-0.5 bg-gray-200 hidden md:block"></div>

                <div class="space-y-6">
                    @php
                    $steps = [
                        ['num' => '1', 'title' => 'Identifikasi Informasi yang Perlu Didokumentasikan', 'desc' => 'PPID mengidentifikasi seluruh informasi publik yang dimiliki dan dikelola oleh BPMP NTB. Informasi dikategorikan berdasarkan jenis, sifat, dan keterkaitan dengan tugas dan fungsi badan publik.', 'color' => 'primary'],
                        ['num' => '2', 'title' => 'Pengumpulan dan Pengelolaan Dokumen', 'desc' => 'Dokumen dan informasi dikumpulkan dari seluruh unit kerja. Pengelolaan meliputi penerimaan, pencatatan, dan penyebaran informasi sesuai dengan prosedur yang berlaku.', 'color' => 'secondary'],
                        ['num' => '3', 'title' => 'Klasifikasi dan Pengindeksan', 'desc' => 'Informasi dan dokumen diklasifikasikan berdasarkan kategori yang telah ditetapkan dan diindeks untuk memudahkan pencarian dan akses. Sistem klasifikasi disesuaikan dengan standar kearsipan nasional.', 'color' => 'accent'],
                        ['num' => '4', 'title' => 'Penyimpanan dan Pemeliharaan', 'desc' => 'Dokumen disimpan dalam sistem penyimpanan yang aman dan terstruktur, baik secara fisik maupun digital. Pemeliharaan dilakukan secara berkala untuk menjaga keutuhan dan keterbacaan dokumen.', 'color' => 'primary'],
                        ['num' => '5', 'title' => 'Pemusnahan Sesuai Jadwal Retensi', 'desc' => 'Dokumen yang telah melewati jadwal retensi dan tidak lagi diperlukan dimusnahkan sesuai dengan prosedur yang ditetapkan. Pemusnahan didokumentasikan dan mendapat persetujuan dari pejabat berwenang.', 'color' => 'secondary'],
                        ['num' => '6', 'title' => 'Pelaporan', 'desc' => 'PPID menyusun laporan berkala mengenai penyelenggaraan pendokumentasian informasi publik. Laporan meliputi jumlah dokumen yang dikelola, status penyimpanan, dan realisasi pemusnahan dokumen.', 'color' => 'accent'],
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
                <h3 class="font-bold text-navy mb-4 text-center">Alur Pendokumentasian Informasi Publik</h3>
                <div class="flex flex-col items-center gap-3 text-sm">
                    <div class="bg-primary text-white px-6 py-3 rounded-lg text-center w-full max-w-md">Identifikasi Informasi</div>
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                    <div class="bg-secondary text-white px-6 py-3 rounded-lg text-center w-full max-w-md">Pengumpulan & Pengelolaan Dokumen</div>
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                    <div class="bg-accent text-navy px-6 py-3 rounded-lg text-center w-full max-w-md font-semibold">Klasifikasi & Pengindeksan</div>
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                    <div class="bg-primary text-white px-6 py-3 rounded-lg text-center w-full max-w-md">Penyimpanan & Pemeliharaan</div>
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                    <div class="flex gap-4 w-full max-w-md">
                        <div class="bg-secondary text-white px-6 py-3 rounded-lg text-center flex-1">Pemusnahan Sesuai Retensi</div>
                        <div class="bg-accent text-navy px-6 py-3 rounded-lg text-center flex-1 font-semibold">Pelaporan</div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
