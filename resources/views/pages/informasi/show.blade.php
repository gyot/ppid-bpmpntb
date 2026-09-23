@extends('layouts.app')

@section('title', $informasi->title . ' - Informasi Publik')
@section('meta_description', Str::limit(strip_tags($informasi->description ?? $informasi->title), 160))

@section('content')
<div class="page-header">
    <div class="container-custom py-8">
        <h1 class="text-3xl font-bold text-white mb-4">Detail Informasi</h1>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}" class="text-secondary hover:text-white">Beranda</a>
            <span class="mx-2 text-gray-400">/</span>
            <a href="{{ route('informasi.index') }}" class="text-secondary hover:text-white">Informasi Publik</a>
            <span class="mx-2 text-gray-400">/</span>
            <a href="{{ route('informasi.show', $informasi->category_slug ?? '#') }}" class="text-secondary hover:text-white">{{ $informasi->category ?? 'Kategori' }}</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-white line-clamp-1">{{ $informasi->title }}</span>
        </nav>
    </div>
</div>

<section class="py-12 bg-gray-50">
    <div class="container-custom">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="card p-6 md:p-8">
                    <h2 class="text-2xl font-bold text-navy mb-4">{{ $informasi->title }}</h2>

                    <div class="flex flex-wrap items-center gap-3 mb-6 pb-6 border-b border-gray-200">
                        @if($informasi->category)
                            <span class="badge-primary">{{ $informasi->category }}</span>
                        @endif
                        @if($informasi->year)
                            <span class="text-sm text-charcoal">{{ $informasi->year }}</span>
                        @endif
                        @if($informasi->published_at)
                            <span class="text-sm text-charcoal">{{ \Carbon\Carbon::parse($informasi->published_at)->format('d M Y') }}</span>
                        @endif
                        @if($informasi->unit_pengelola)
                            <span class="text-sm text-charcoal">{{ $informasi->unit_pengelola }}</span>
                        @endif
                    </div>

                    @if($informasi->description)
                        <div class="prose prose-lg max-w-none text-charcoal">
                            {!! $informasi->description !!}
                        </div>
                    @endif

                    @if($informasi->file_path)
                        <div class="mt-8 p-4 bg-gray-50 rounded-lg border border-gray-200">
                            <div class="flex items-center gap-4">
                                <div class="flex-shrink-0 w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="font-medium text-navy">Lampiran Berkas</p>
                                    <p class="text-sm text-charcoal">{{ $informasi->file_name ?? basename($informasi->file_path) }}</p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('informasi.view', $informasi->slug) }}" target="_blank" class="inline-flex items-center gap-1.5 px-4 py-2 border border-primary text-primary rounded-lg hover:bg-primary/5 text-sm font-medium">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        Lihat
                                    </a>
                                    <a href="{{ route('informasi.download', $informasi->slug) }}" class="btn-primary px-5 py-2 text-sm inline-flex items-center gap-1.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                        Unduh
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="mt-6">
                    <a href="{{ route('informasi.index') }}" class="inline-flex items-center gap-2 text-primary hover:text-primary/80 font-medium">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali ke Informasi Publik
                    </a>
                </div>
            </div>

            <div class="lg:col-span-1">
                @if($related->count() > 0)
                    <div class="card p-6">
                        <h3 class="text-lg font-bold text-navy mb-4">Informasi Terkait</h3>
                        <ul class="space-y-4">
                            @foreach($related as $rel)
                                <li class="pb-4 border-b border-gray-100 last:border-0 last:pb-0">
                                    <a href="{{ route('informasi.show', $rel->slug) }}" class="text-charcoal hover:text-primary transition-colors font-medium text-sm line-clamp-2">
                                        {{ $rel->title }}
                                    </a>
                                    <div class="flex items-center gap-2 mt-1">
                                        @if($rel->category)
                                            <span class="text-xs text-primary">{{ $rel->category }}</span>
                                        @endif
                                        @if($rel->published_at)
                                            <span class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($rel->published_at)->format('d M Y') }}</span>
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
