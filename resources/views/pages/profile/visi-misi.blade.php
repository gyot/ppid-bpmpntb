@extends('layouts.app')

@section('title', 'Visi & Misi - PPID BPMP NTB')
@section('meta_description', 'Visi dan Misi PPID BPMP Provinsi Nusa Tenggara Barat')

@section('content')
<div class="page-header">
    <div class="container-custom py-8">
        <h1 class="text-3xl font-bold text-white mb-4">Visi & Misi</h1>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}" class="text-secondary hover:text-white">Beranda</a>
            <span class="mx-2 text-gray-400">/</span>
            <a href="{{ route('profile.index') }}" class="text-secondary hover:text-white">Profil</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-white">Visi & Misi</span>
        </nav>
    </div>
</div>

<section class="py-12 bg-gray-50">
    <div class="container-custom max-w-5xl">

        <div class="grid md:grid-cols-2 gap-8">
            <div class="relative bg-white rounded-2xl shadow-sm border border-gray-100 p-8 md:p-10 overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
                <div class="absolute bottom-0 left-0 w-24 h-24 bg-secondary/10 rounded-full translate-y-1/2 -translate-x-1/2"></div>
                <div class="relative">
                    <div class="w-16 h-16 rounded-2xl bg-primary/10 flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-navy mb-4">Visi</h2>
                    <div class="text-charcoal leading-relaxed text-lg">{!! $visi !!}</div>
                </div>
            </div>

            <div class="relative bg-white rounded-2xl shadow-sm border border-gray-100 p-8 md:p-10 overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-accent/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
                <div class="absolute bottom-0 left-0 w-24 h-24 bg-secondary/10 rounded-full translate-y-1/2 -translate-x-1/2"></div>
                <div class="relative">
                    <div class="w-16 h-16 rounded-2xl bg-accent/10 flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-navy mb-4">Misi</h2>
                    <div class="text-charcoal leading-relaxed">{!! $misi !!}</div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
