@extends('layouts.app')

@section('title', 'Pengadaan Barang dan Jasa - PPID BPMP NTB')
@section('meta_description', 'Informasi Pengadaan Barang dan Jasa BPMP Provinsi Nusa Tenggara Barat')

@section('content')
<div class="page-header">
    <div class="container-custom py-8">
        <h1 class="text-3xl font-bold text-white mb-4">Pengadaan Barang dan Jasa</h1>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}" class="text-secondary hover:text-white">Beranda</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-white">Pengadaan B&J</span>
        </nav>
    </div>
</div>

<section class="py-12 bg-gray-50">
    <div class="container-custom">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-10 mb-8">
            <p class="text-charcoal leading-relaxed mb-4">Informasi pengadaan barang dan jasa di lingkungan BPMP Provinsi Nusa Tenggara Barat. Silakan akses tautan berikut untuk informasi lebih lanjut:</p>
            <div class="flex flex-wrap gap-4">
                <a href="https://sirup.lkpp.go.id/sirup/home/penyediaSatker?idSatker=385951" target="_blank" class="btn-primary btn-sm">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    SIRUP LKPP
                </a>
                <a href="#" class="btn-secondary btn-sm">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    LPSE
                </a>
            </div>
        </div>

        @php
        $cards = [
            ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>', 'title' => 'Rencana Pengadaan', 'desc' => 'Rencana Umum Pengadaan (RUP) BPMP NTB Tahun 2026', 'route' => 'pengadaan.rencana', 'color' => 'primary'],
            ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>', 'title' => 'Pemilihan', 'desc' => 'Dokumen tahap pemilihan penyedia barang dan jasa', 'route' => 'pengadaan.pemilihan', 'color' => 'accent'],
            ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>', 'title' => 'Pelaksanaan', 'desc' => 'Dokumen tahap pelaksanaan kontrak pengadaan', 'route' => 'pengadaan.pelaksanaan', 'color' => 'sky'],
        ];
        @endphp

        <div class="grid sm:grid-cols-3 gap-6">
            @foreach($cards as $card)
            <a href="{{ route($card['route']) }}" class="group block bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-lg hover:border-{{ $card['color'] }}/20 hover:-translate-y-1 transition-all duration-300">
                <div class="w-14 h-14 rounded-xl bg-{{ $card['color'] }}/10 flex items-center justify-center mb-5 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-7 h-7 text-{{ $card['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $card['icon'] !!}</svg>
                </div>
                <h3 class="text-lg font-bold text-navy mb-2 group-hover:text-primary transition-colors">{{ $card['title'] }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed mb-4">{{ $card['desc'] }}</p>
                <span class="inline-flex items-center gap-1 text-primary font-semibold text-sm group-hover:gap-2 transition-all">Lihat <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg></span>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endsection
