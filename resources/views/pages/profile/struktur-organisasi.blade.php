@extends('layouts.app')
@section('title', 'Struktur Organisasi - PPID BPMP NTB')

@section('content')
<div class="page-header">
    <div class="container-custom py-8">
        <h1 class="text-3xl font-bold text-white mb-4">Struktur Organisasi</h1>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}" class="text-secondary hover:text-white">Beranda</a>
            <span class="mx-2 text-gray-400">/</span>
            <a href="{{ route('profile.index') }}" class="text-secondary hover:text-white">Profil</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-white">Struktur Organisasi</span>
        </nav>
    </div>
</div>

<section class="py-12 bg-gray-50">
    <div class="container-custom max-w-5xl">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
            <h2 class="text-xl font-bold text-navy mb-6 text-center">Struktur Organisasi PPID BPMP Provinsi Nusa Tenggara Barat</h2>

            @if($strukturUrl)
                <div class="flex justify-center">
                    <img src="{{ $strukturUrl }}" alt="Struktur Organisasi PPID BPMP NTB" class="max-w-full h-auto rounded-lg shadow-sm">
                </div>
            @else
                <div class="text-center py-16">
                    <svg class="w-20 h-20 text-gray-200 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/></svg>
                    <p class="text-gray-400">Gambar struktur organisasi belum tersedia.</p>
                    <p class="text-gray-300 text-sm mt-1">Silakan upload melalui panel admin.</p>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection
