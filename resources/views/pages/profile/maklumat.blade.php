@extends('layouts.app')
@section('title', 'Maklumat Pelayanan - PPID BPMP NTB')

@section('content')
<div class="page-header">
    <div class="container-custom py-8">
        <h1 class="text-3xl font-bold text-white mb-4">Maklumat Pelayanan</h1>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}" class="text-secondary hover:text-white">Beranda</a>
            <span class="mx-2 text-gray-400">/</span>
            <a href="{{ route('profile.index') }}" class="text-secondary hover:text-white">Profil</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-white">Maklumat Pelayanan</span>
        </nav>
    </div>
</div>

<section class="py-12 bg-gray-50">
    <div class="container-custom max-w-4xl">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 md:p-12">
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <h2 class="text-2xl font-bold text-navy">Maklumat Pelayanan</h2>
                <p class="text-gray-500 text-sm mt-2">PPID BPMP Provinsi Nusa Tenggara Barat</p>
            </div>
            <div class="prose prose-sm max-w-none text-gray-600 leading-relaxed text-justify">{!! $content !!}</div>
        </div>
    </div>
</section>
@endsection
