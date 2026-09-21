@extends('layouts.app')

@section('title', 'Berita - PPID BPMP NTB')
@section('meta_description', 'Berita terbaru seputar PPID dan keterbukaan informasi publik BPMP Provinsi Nusa Tenggara Barat')

@section('content')
<div class="page-header">
    <div class="container-custom py-8">
        <h1 class="text-3xl font-bold text-white mb-4">Berita</h1>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}" class="text-secondary hover:text-white">Beranda</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-white">Berita</span>
        </nav>
    </div>
</div>

<section class="py-12 bg-gray-50">
    <div class="container-custom">

        @if($featuredNews)
        <div class="mb-12">
            <a href="{{ route('berita.show', $featuredNews->slug) }}" class="group block bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300">
                <div class="grid md:grid-cols-2">
                    <div class="relative h-64 md:h-auto">
                        @if($featuredNews->image)
                            <img src="{{ asset('storage/' . $featuredNews->image) }}" alt="{{ $featuredNews->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full min-h-[300px] bg-gradient-to-br from-primary/20 to-secondary/20 flex items-center justify-center">
                                <svg class="w-20 h-20 text-primary/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                </svg>
                            </div>
                        @endif
                        <div class="absolute top-4 left-4">
                            <span class="badge-primary">Featured</span>
                        </div>
                    </div>
                    <div class="p-8 flex flex-col justify-center">
                        <time class="text-sm text-gray-500 mb-3 flex items-center gap-2">
                            <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ $featuredNews->published_at?->translatedFormat('d F Y') ?? $featuredNews->created_at->translatedFormat('d F Y') }}
                        </time>
                        <h2 class="text-2xl md:text-3xl font-bold text-navy mb-4 group-hover:text-primary transition-colors leading-tight">{{ $featuredNews->title }}</h2>
                        <p class="text-gray-600 leading-relaxed mb-6">{{ Str::limit(strip_tags($featuredNews->excerpt ?? $featuredNews->body ?? ''), 250) }}</p>
                        <span class="inline-flex items-center gap-2 text-primary font-semibold group-hover:gap-3 transition-all">
                            Baca Selengkapnya
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </span>
                    </div>
                </div>
            </a>
        </div>
        @endif

        <form method="GET" action="{{ route('berita.index') }}" class="mb-8">
            <div class="flex gap-3 max-w-lg">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berita..." class="input-field flex-1">
                <button type="submit" class="btn-primary px-6">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </button>
            </div>
        </form>

        @if($news->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($news as $item)
            <article class="group bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                <div class="relative h-48 bg-gray-100 overflow-hidden">
                    @if($item->image)
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-primary/10 to-secondary/10 flex items-center justify-center">
                            <svg class="w-12 h-12 text-primary/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                            </svg>
                        </div>
                    @endif
                    @if($item->category)
                    <div class="absolute top-3 left-3">
                        <span class="badge-primary">{{ $item->category }}</span>
                    </div>
                    @endif
                </div>
                <div class="p-5">
                    <time class="text-xs text-gray-500 flex items-center gap-1 mb-2">
                        <svg class="w-3.5 h-3.5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        {{ $item->published_at?->translatedFormat('d F Y') ?? $item->created_at->translatedFormat('d F Y') }}
                    </time>
                    <h3 class="font-bold text-navy text-base mb-2 line-clamp-2 group-hover:text-primary transition-colors leading-snug">{{ $item->title }}</h3>
                    <p class="text-gray-500 text-sm mb-4 line-clamp-3 leading-relaxed">{{ Str::limit(strip_tags($item->excerpt ?? $item->body ?? ''), 120) }}</p>
                    <a href="{{ route('berita.show', $item->slug) }}" class="inline-flex items-center gap-1.5 text-primary font-semibold text-sm group-hover:gap-2.5 transition-all">
                        Baca Selengkapnya
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </article>
            @endforeach
        </div>

        <div class="mt-10">
            {{ $news->withQueryString()->links() }}
        </div>
        @else
        <div class="bg-white rounded-2xl p-12 text-center border border-gray-100 shadow-sm">
            <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-5">
                <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-navy mb-2">Belum Ada Berita</h3>
            <p class="text-gray-400 text-sm">Berita terbaru akan ditampilkan di sini.</p>
        </div>
        @endif
    </div>
</section>
@endsection
