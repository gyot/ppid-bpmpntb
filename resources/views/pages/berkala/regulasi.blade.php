@extends('layouts.app')

@section('title', 'Regulasi & Kebijakan - PPID BPMP NTB')
@section('meta_description', 'Regulasi terkait Keterbukaan Informasi Publik di lingkungan BPMP NTB')

@section('content')
<div class="page-header">
    <div class="container-custom py-8">
        <h1 class="text-3xl font-bold text-white mb-4">Regulasi & Kebijakan</h1>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}" class="text-secondary hover:text-white">Beranda</a>
            <span class="mx-2 text-gray-400">/</span>
            <a href="{{ route('berkala.index') }}" class="text-secondary hover:text-white">Informasi Wajib Berkala</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-white">Regulasi & Kebijakan</span>
        </nav>
    </div>
</div>

<section class="py-12 bg-gray-50">
    <div class="container-custom max-w-5xl">
        <div class="space-y-4">
            @forelse($regulasis as $item)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-start gap-4">
                    <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-1">
                            <h3 class="font-bold text-navy">{{ $item->title }}</h3>
                            <span class="text-xs px-2 py-0.5 rounded-full bg-primary/10 text-primary">{{ $item->kategori_label }}</span>
                        </div>
                        @if($item->deskripsi)
                            <p class="text-sm text-charcoal">{{ $item->deskripsi }}</p>
                        @endif
                        <div class="flex items-center gap-4 mt-3">
                            @if($item->file_path)
                                <a href="{{ Storage::url($item->file_path) }}" target="_blank" class="inline-flex items-center text-primary text-sm font-medium hover:underline">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    Unduh Dokumen
                                </a>
                            @endif
                            @if($item->link_eksternal)
                                <a href="{{ $item->link_eksternal }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center text-accent text-sm font-medium hover:underline">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                    Link Eksternal
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center">
                    <svg class="w-16 h-16 mx-auto text-gray-200 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>
                    </svg>
                    <p class="font-medium text-gray-500">Data regulasi belum tersedia</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
