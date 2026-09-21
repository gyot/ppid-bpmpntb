@extends('layouts.app')

@section('title', $document->title . ' - Dokumen')
@section('meta_description', Str::limit(strip_tags($document->description ?? $document->title), 160))

@section('content')
<div class="page-header">
    <div class="container-custom py-8">
        <h1 class="text-3xl font-bold text-white mb-4">Detail Dokumen</h1>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}" class="text-secondary hover:text-white">Beranda</a>
            <span class="mx-2 text-gray-400">/</span>
            <a href="{{ route('dokumen.index') }}" class="text-secondary hover:text-white">Dokumen</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-white line-clamp-1">{{ $document->title }}</span>
        </nav>
    </div>
</div>

<section class="py-12 bg-gray-50">
    <div class="container-custom">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="card p-6 md:p-8">
                    <h2 class="text-2xl font-bold text-navy mb-4">{{ $document->title }}</h2>

                    <div class="flex flex-wrap items-center gap-3 mb-6 pb-6 border-b border-gray-200">
                        @if($document->category)
                            <span class="badge-primary">{{ $document->category }}</span>
                        @endif
                        @if($document->year)
                            <span class="text-sm text-charcoal">{{ $document->year }}</span>
                        @endif
                        @if($document->published_at)
                            <span class="text-sm text-charcoal">{{ \Carbon\Carbon::parse($document->published_at)->format('d M Y') }}</span>
                        @endif
                    </div>

                    @if($document->description)
                        <div class="prose prose-lg max-w-none text-charcoal mb-8">
                            {!! $document->description !!}
                        </div>
                    @endif

                    <div class="p-5 bg-gray-50 rounded-lg border border-gray-200">
                        <h3 class="text-lg font-semibold text-navy mb-4">Informasi Berkas</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="flex items-center gap-3">
                                <div class="flex-shrink-0 w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-charcoal">Nama Berkas</p>
                                    <p class="font-medium text-navy text-sm">{{ basename($document->file ?? '-') }}</p>
                                </div>
                            </div>

                            @if($document->file_size)
                                <div class="flex items-center gap-3">
                                    <div class="flex-shrink-0 w-10 h-10 bg-secondary/20 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-charcoal">Ukuran</p>
                                        <p class="font-medium text-navy text-sm">{{ number_format($document->file_size / 1024, 1) }} KB</p>
                                    </div>
                                </div>
                            @endif

                            <div class="flex items-center gap-3">
                                <div class="flex-shrink-0 w-10 h-10 bg-accent/20 rounded-lg flex items-center justify-center">
                                    @php $ext = pathinfo($document->file ?? '', PATHINFO_EXTENSION); @endphp
                                    <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-charcoal">Tipe</p>
                                    <p class="font-medium text-navy text-sm">{{ strtoupper($ext ?: '-') }}</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-3">
                                <div class="flex-shrink-0 w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-charcoal">Jumlah Unduhan</p>
                                    <p class="font-medium text-navy text-sm">{{ $document->download_count ?? 0 }} unduhan</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($document->file)
                        <div class="mt-6">
                            <a href="{{ route('dokumen.download', $document->slug) }}" class="btn-primary inline-flex items-center gap-2 px-8 py-3 text-base">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                </svg>
                                Download Dokumen
                            </a>
                        </div>
                    @endif
                </div>

                <div class="mt-6">
                    <a href="{{ route('dokumen.index') }}" class="inline-flex items-center gap-2 text-primary hover:text-primary/80 font-medium">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali ke Daftar Dokumen
                    </a>
                </div>
            </div>

            <div class="lg:col-span-1">
                @if(isset($related) && $related->count() > 0)
                    <div class="card p-6">
                        <h3 class="text-lg font-bold text-navy mb-4">Dokumen Terkait</h3>
                        <ul class="space-y-4">
                            @foreach($related as $rel)
                                <li class="pb-4 border-b border-gray-100 last:border-0 last:pb-0">
                                    <a href="{{ route('dokumen.show', $rel->slug) }}" class="text-charcoal hover:text-primary transition-colors font-medium text-sm line-clamp-2">
                                        {{ $rel->title }}
                                    </a>
                                    <div class="flex items-center gap-2 mt-1">
                                        @if($rel->category)
                                            <span class="badge-primary text-xs">{{ $rel->category }}</span>
                                        @endif
                                        @if($rel->year)
                                            <span class="text-xs text-gray-400">{{ $rel->year }}</span>
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
