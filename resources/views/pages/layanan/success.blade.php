@extends('layouts.app')

@section('title', 'Permohonan Berhasil - PPID BPMP NTB')
@section('meta_description', 'Permohonan informasi publik berhasil dikirim')

@section('content')
<div class="page-header">
    <div class="container-custom py-8">
        <h1 class="text-3xl font-bold text-white mb-4">Permohonan Informasi</h1>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}" class="text-secondary hover:text-white">Beranda</a>
            <span class="mx-2 text-gray-400">/</span>
            <a href="{{ route('layanan.permohonan.create') }}" class="text-secondary hover:text-white">Permohonan</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-white">Berhasil</span>
        </nav>
    </div>
</div>

<section class="py-16 bg-gray-50">
    <div class="container-custom max-w-2xl">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 md:p-12 text-center">

            <div class="w-20 h-20 rounded-full bg-green-100 flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>

            <h2 class="text-2xl font-bold text-navy mb-3">Permohonan Berhasil Dikirim!</h2>
            <p class="text-gray-600 mb-6 leading-relaxed">Permohonan informasi publik Anda telah berhasil dikirim. Silakan simpan nomor registrasi berikut untuk melacak status permohonan Anda.</p>

            <div class="bg-gray-50 rounded-xl p-6 mb-8">
                <p class="text-sm text-gray-500 mb-2">Nomor Registrasi</p>
                <p class="text-3xl font-extrabold text-primary tracking-wide">{{ $permohonan->registration_number }}</p>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <a href="{{ route('layanan.cek-status') }}" class="btn-primary">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                    </svg>
                    Cek Status
                </a>
                <a href="{{ route('home') }}" class="btn-secondary">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
