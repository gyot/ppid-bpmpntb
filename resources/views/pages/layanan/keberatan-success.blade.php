@extends('layouts.app')

@section('title', 'Keberatan Berhasil - PPID BPMP NTB')

@section('content')
<div class="page-header">
    <div class="container-custom py-8">
        <h1 class="text-3xl font-bold text-white mb-4">Pengajuan Keberatan</h1>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}" class="text-secondary hover:text-white">Beranda</a>
            <span class="mx-2 text-gray-400">/</span>
            <a href="{{ route('layanan.alur') }}" class="text-secondary hover:text-white">Layanan</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-white">Keberatan Berhasil</span>
        </nav>
    </div>
</div>

<section class="py-16 bg-gray-50">
    <div class="container-custom max-w-2xl">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 md:p-12 text-center">
            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>

            <h2 class="text-2xl font-bold text-navy mb-3">Keberatan Berhasil Diajukan!</h2>
            <p class="text-gray-500 mb-8">Pengajuan keberatan Anda telah kami terima. Simpan nomor registrasi berikut untuk melacak status keberatan Anda.</p>

            <div class="bg-gray-50 rounded-xl p-6 mb-8">
                <p class="text-sm text-gray-500 mb-2">Nomor Registrasi Keberatan</p>
                <p class="text-3xl font-bold text-primary tracking-wider">{{ $keberatan->registration_number }}</p>
            </div>

            <div class="grid sm:grid-cols-2 gap-4 text-left mb-8">
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-xs text-gray-400 mb-1">Nama</p>
                    <p class="text-sm font-semibold text-navy">{{ $keberatan->nama }}</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-xs text-gray-400 mb-1">Email</p>
                    <p class="text-sm font-semibold text-navy">{{ $keberatan->email }}</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-xs text-gray-400 mb-1">Tanggal</p>
                    <p class="text-sm font-semibold text-navy">{{ $keberatan->created_at->format('d M Y H:i') }}</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-xs text-gray-400 mb-1">Status</p>
                    <span class="badge-warning text-xs px-2 py-1 rounded-full">Menunggu Proses</span>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <a href="{{ route('layanan.cek-status') }}" class="btn-primary">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    Cek Status
                </a>
                <a href="{{ route('home') }}" class="btn-secondary">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
