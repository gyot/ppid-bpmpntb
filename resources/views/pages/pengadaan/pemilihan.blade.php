@extends('layouts.app')

@section('title', 'Pemilihan Penyedia - PPID BPMP NTB')
@section('meta_description', 'Dokumen tahap pemilihan penyedia barang dan jasa BPMP NTB')

@section('content')
<div class="page-header">
    <div class="container-custom py-8">
        <h1 class="text-3xl font-bold text-white mb-4">Pemilihan Penyedia</h1>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}" class="text-secondary hover:text-white">Beranda</a>
            <span class="mx-2 text-gray-400">/</span>
            <a href="{{ route('pengadaan.index') }}" class="text-secondary hover:text-white">Pengadaan B&J</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-white">Pemilihan</span>
        </nav>
    </div>
</div>

<section class="py-12 bg-gray-50">
    <div class="container-custom">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-10 mb-8">
            <h2 class="text-2xl font-bold text-navy mb-4">Dokumen Tahap Pemilihan - {{ $pengadaans->count() }} Paket</h2>
            <p class="text-charcoal leading-relaxed">Dokumen-dokumen terkait tahap pemilihan penyedia barang dan jasa untuk BPMP NTB Tahun {{ date('Y') }}.</p>
        </div>

        @forelse($pengadaans as $item)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8 mb-6">
                <h3 class="text-lg font-bold text-navy mb-2">{{ $item->nama_paket }}</h3>
                @if($item->deskripsi)
                    <p class="text-sm text-charcoal mb-4">{{ $item->deskripsi }}</p>
                @endif
                @if($item->formatted_pagu)
                    <p class="text-sm text-primary font-medium mb-4">Nilai Pagu: {{ $item->formatted_pagu }}</p>
                @endif
                @if($item->file_path)
                    <a href="{{ '/' . $item->file_path }}" target="_blank" class="inline-flex items-center text-primary text-sm font-medium hover:underline">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Unduh Dokumen
                    </a>
                @endif
            </div>
        @empty
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center">
                <svg class="w-16 h-16 mx-auto text-gray-200 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                </svg>
                <p class="font-medium text-gray-500">Data pengadaan tahap pemilihan belum tersedia untuk tahun {{ date('Y') }}</p>
            </div>
        @endforelse
    </div>
</section>
@endsection
