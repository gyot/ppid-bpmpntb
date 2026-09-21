@extends('layouts.app')
@section('title', 'Pejabat PPID - PPID BPMP NTB')

@section('content')
<div class="page-header">
    <div class="container-custom py-8">
        <h1 class="text-3xl font-bold text-white mb-4">Pejabat PPID</h1>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}" class="text-secondary hover:text-white">Beranda</a>
            <span class="mx-2 text-gray-400">/</span>
            <a href="{{ route('profile.index') }}" class="text-secondary hover:text-white">Profil</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-white">Pejabat</span>
        </nav>
    </div>
</div>

<section class="py-12 bg-gray-50">
    <div class="container-custom max-w-4xl space-y-6">
        @forelse($pejabats as $pejabat)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="flex flex-col sm:flex-row">
                {{-- Foto --}}
                <div class="flex-shrink-0 sm:self-stretch sm:w-56 bg-gray-50 flex items-center justify-center">
                    @if($pejabat->foto_url)
                        <img src="{{ $pejabat->foto_url }}" class="w-full h-48 sm:h-full object-cover">
                    @else
                        <div class="w-full h-48 sm:h-full flex items-center justify-center text-primary text-3xl font-bold bg-primary/5">
                            {{ $pejabat->initials }}
                        </div>
                    @endif
                </div>

                {{-- Info --}}
                <div class="flex-1 p-6">
                    <h3 class="text-xl font-bold text-navy mb-1">{{ $pejabat->nama }}</h3>
                    <p class="text-primary font-semibold text-sm mb-4">{{ $pejabat->jabatan }}</p>

                    @if($pejabat->keterangan)
                        <div class="prose prose-sm max-w-none text-gray-600 leading-relaxed">{!! $pejabat->keterangan !!}</div>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center">
            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            <p class="text-gray-400">Belum ada data pejabat yang tersedia.</p>
        </div>
        @endforelse
    </div>
</section>
@endsection
