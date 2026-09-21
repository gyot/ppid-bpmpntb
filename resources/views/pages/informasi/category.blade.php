@extends('layouts.app')

@section('title', $categoryName . ' - Informasi Publik')
@section('meta_description', 'Daftar informasi publik kategori ' . $categoryName . ' BPMP NTB')

@section('content')
<div class="page-header">
    <div class="container-custom py-8">
        <h1 class="text-3xl font-bold text-white mb-4">{{ $categoryName }}</h1>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}" class="text-secondary hover:text-white">Beranda</a>
            <span class="mx-2 text-gray-400">/</span>
            <a href="{{ route('informasi.index') }}" class="text-secondary hover:text-white">Informasi Publik</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-white">{{ $categoryName }}</span>
        </nav>
    </div>
</div>

<section class="py-12 bg-gray-50">
    <div class="container-custom">
        <form method="GET" action="" class="mb-8">
            <div class="flex gap-3">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari informasi..." class="input-field flex-1">
                <button type="submit" class="btn-primary px-6">Cari</button>
            </div>
        </form>

        @if($informasi->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($informasi as $item)
                    <div class="card hover:shadow-lg transition-shadow">
                        <div class="p-5">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="badge-primary">{{ $item->year ?? '' }}</span>
                                @if($item->unit_pengelola)
                                    <span class="text-xs text-charcoal">{{ $item->unit_pengelola }}</span>
                                @endif
                            </div>
                            <h3 class="font-semibold text-navy mb-3 line-clamp-2">
                                <a href="{{ route('informasi.show', $item->slug) }}" class="hover:text-primary transition-colors">
                                    {{ $item->title }}
                                </a>
                            </h3>
                            @if($item->published_at)
                                <p class="text-sm text-charcoal">{{ \Carbon\Carbon::parse($item->published_at)->format('d M Y') }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $informasi->withQueryString()->links() }}
            </div>
        @else
            <div class="text-center py-16">
                <svg class="w-20 h-20 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <h3 class="text-lg font-semibold text-navy mb-2">Belum ada informasi tersedia</h3>
                <p class="text-charcoal">Informasi untuk kategori ini belum tersedia saat ini.</p>
            </div>
        @endif
    </div>
</section>
@endsection
