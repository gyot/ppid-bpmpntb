@extends('layouts.app')

@section('title', 'Laporan Tahunan - PPID BPMP NTB')
@section('meta_description', 'Laporan Layanan Informasi Publik BPMP Provinsi Nusa Tenggara Barat')

@section('content')
<div class="page-header">
    <div class="container-custom py-8">
        <h1 class="text-3xl font-bold text-white mb-4">Laporan Layanan Informasi Publik</h1>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}" class="text-secondary hover:text-white">Beranda</a>
            <span class="mx-2 text-gray-400">/</span>
            <a href="{{ route('laporan.ringkasan-akses') }}" class="text-secondary hover:text-white">Laporan</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-white">Laporan Tahunan</span>
        </nav>
    </div>
</div>

<section class="py-12 bg-gray-50">
    <div class="container-custom max-w-5xl">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-10 mb-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center">
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-navy">Laporan Layanan Informasi Publik</h2>
            </div>
            <p class="text-charcoal leading-relaxed">Laporan layanan informasi publik BPMP Provinsi Nusa Tenggara Barat disusun sesuai ketentuan peraturan perundang-undangan. Laporan ini memuat informasi tentang penyelenggaraan pelayanan informasi publik selama satu tahun.</p>
        </div>

        @php
            $keuangans = \App\Models\Keuangan::where('status', 'published')
                ->where('category', 'laporan_keuangan')
                ->orderByDesc('tahun')
                ->get();
        @endphp

        <div class="space-y-4">
            @forelse($keuangans as $item)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-navy">{{ $item->title }}</h3>
                            <p class="text-sm text-gray-500 mt-1">PPID BPMP Provinsi Nusa Tenggara Barat</p>
                        </div>
                    </div>
                    @if($item->file_path)
                        <a href="{{ Storage::url($item->file_path) }}" target="_blank" class="btn-primary btn-sm flex-shrink-0">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Unduh
                        </a>
                    @endif
                </div>
            @empty
                @foreach([2025, 2024, 2023] as $year)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-navy">Laporan Layanan Informasi Publik Tahun {{ $year }}</h3>
                            <p class="text-sm text-gray-500 mt-1">PPID BPMP Provinsi Nusa Tenggara Barat</p>
                        </div>
                    </div>
                    <span class="text-sm text-gray-400">Belum Tersedia</span>
                </div>
                @endforeach
            @endforelse
        </div>
    </div>
</section>
@endsection
