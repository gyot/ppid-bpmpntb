@extends('layouts.app')

@section('title', 'SOP - PPID BPMP NTB')
@section('meta_description', 'Standar Operasional Prosedur PPID BPMP Provinsi Nusa Tenggara Barat')

@section('content')
<div class="page-header">
    <div class="container-custom py-8">
        <h1 class="text-3xl font-bold text-white mb-4">Standar Operasional Prosedur</h1>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}" class="text-secondary hover:text-white">Beranda</a>
            <span class="mx-2 text-gray-400">/</span>
            <a href="{{ route('profile.index') }}" class="text-secondary hover:text-white">Profil</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-white">SOP</span>
        </nav>
    </div>
</div>

<section class="py-12 bg-gray-50">
    <div class="container-custom">

        <div class="text-center mb-10">
            <h2 class="text-2xl font-bold text-navy mb-3">Daftar SOP PPID BPMP NTB</h2>
            <p class="text-charcoal text-sm max-w-2xl mx-auto">Standar Operasional Prosedur (SOP) yang mengatur penyelenggaraan pelayanan informasi publik di lingkungan BPMP Provinsi Nusa Tenggara Barat sesuai ketentuan perundang-undangan.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">
            @forelse($sops as $item)
                @php
                    $colors = ['bg-primary/10', 'bg-secondary/10', 'bg-accent/30', 'bg-emerald-50', 'bg-blue-50'];
                    $textColors = ['text-primary', 'text-secondary', 'text-navy', 'text-emerald-600', 'text-blue-600'];
                    $colorIndex = $loop->index % count($colors);
                @endphp
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
                    <div class="w-14 h-14 {{ $colors[$colorIndex] }} rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-7 h-7 {{ $textColors[$colorIndex] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-navy mb-2">{{ $item->title }}</h3>
                    <p class="text-charcoal text-sm mb-4">{{ $item->deskripsi }}</p>
                    @if($item->file_path)
                        <div class="flex items-center gap-3 pt-3 border-t border-gray-100">
                            <a href="{{ route('profile.sop.view', $item) }}" target="_blank" class="inline-flex items-center gap-1.5 text-primary hover:text-primary/80 text-sm font-semibold">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                Lihat
                            </a>
                            <span class="text-gray-300">|</span>
                            <a href="{{ route('profile.sop.download', $item) }}" class="inline-flex items-center gap-1.5 text-accent hover:text-accent/80 text-sm font-semibold">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                Unduh
                            </a>
                        </div>
                    @else
                        <a href="{{ route('profile.sop') }}" class="inline-flex items-center text-primary text-sm font-semibold hover:underline">
                            Lihat
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    @endif
                </div>
            @empty
                <div class="col-span-full bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center">
                    <svg class="w-16 h-16 mx-auto text-gray-200 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    <p class="font-medium text-gray-500">Data SOP belum tersedia</p>
                </div>
            @endforelse
        </div>

        @foreach($sops as $item)
            @if($item->konten)
            <div class="max-w-4xl mx-auto mt-10">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                    <h3 class="text-xl font-bold text-navy mb-4">{{ $item->title }}</h3>
                    <div class="prose prose-sm max-w-none text-charcoal">
                        {!! $item->konten !!}
                    </div>
                </div>
            </div>
            @break
            @endif
        @endforeach

    </div>
</section>
@endsection
