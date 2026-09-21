@extends('layouts.app')
@section('title', 'Profil PPID BPMP NTB')

@section('content')
<div class="page-header">
    <div class="container-custom py-8">
        <h1 class="text-3xl font-bold text-white mb-4">Profil PPID</h1>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}" class="text-secondary hover:text-white">Beranda</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-white">Profil PPID</span>
        </nav>
    </div>
</div>

<section class="py-12 bg-gray-50">
    <div class="container-custom">
        <div class="grid lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                    <h2 class="text-xl font-bold text-navy mb-4">Tentang PPID BPMP NTB</h2>
                        <div class="prose prose-sm max-w-none text-gray-600 leading-relaxed">{!! $tentang !!}</div>
                </div>

                <div class="grid sm:grid-cols-2 gap-6">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-bold text-navy mb-3 flex items-center gap-2">
                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            Visi
                        </h3>
                        <div class="text-gray-600 text-sm leading-relaxed">{!! $visi !!}</div>
                    </div>
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-bold text-navy mb-3 flex items-center gap-2">
                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            Misi
                        </h3>
                        <div class="text-gray-600 text-sm leading-relaxed">{!! $misi !!}</div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                    <h2 class="text-xl font-bold text-navy mb-4">Tugas dan Fungsi</h2>
                    <div class="text-gray-600 text-sm leading-relaxed">{!! $tugas !!}</div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                    <h2 class="text-xl font-bold text-navy mb-4">Dasar Hukum</h2>
                    <div class="text-gray-600 text-sm leading-relaxed">{!! $dasarHukum !!}</div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-navy mb-4">Menu Profil</h3>
                    <nav class="space-y-2">
                        <a href="{{ route('profile.index') }}" class="block px-4 py-2.5 rounded-lg text-sm font-medium bg-primary/5 text-primary">Profil PPID</a>
                        <a href="{{ route('profile.visi-misi') }}" class="block px-4 py-2.5 rounded-lg text-sm text-gray-600 hover:bg-gray-50 hover:text-primary transition-colors">Visi dan Misi</a>
                        <a href="{{ route('profile.tugas-fungsi') }}" class="block px-4 py-2.5 rounded-lg text-sm text-gray-600 hover:bg-gray-50 hover:text-primary transition-colors">Tugas dan Fungsi</a>
                        <a href="{{ route('profile.struktur-organisasi') }}" class="block px-4 py-2.5 rounded-lg text-sm text-gray-600 hover:bg-gray-50 hover:text-primary transition-colors">Struktur Organisasi</a>
                        <a href="{{ route('profile.pejabat') }}" class="block px-4 py-2.5 rounded-lg text-sm text-gray-600 hover:bg-gray-50 hover:text-primary transition-colors">Pejabat PPID</a>
                        <a href="{{ route('profile.maklumat') }}" class="block px-4 py-2.5 rounded-lg text-sm text-gray-600 hover:bg-gray-50 hover:text-primary transition-colors">Maklumat Pelayanan</a>
                        <a href="{{ route('profile.standar') }}" class="block px-4 py-2.5 rounded-lg text-sm text-gray-600 hover:bg-gray-50 hover:text-primary transition-colors">Standar Pelayanan</a>
                        <a href="{{ route('profile.sop') }}" class="block px-4 py-2.5 rounded-lg text-sm text-gray-600 hover:bg-gray-50 hover:text-primary transition-colors">SOP Pelayanan</a>
                    </nav>
                </div>

                <div class="bg-primary/5 border border-primary/10 rounded-2xl p-6">
                    <h3 class="text-sm font-bold text-navy mb-2">Butuh Informasi?</h3>
                    <p class="text-xs text-gray-500 mb-4">Ajukan permohonan informasi publik secara online.</p>
                    <a href="{{ route('layanan.permohonan.create') }}" class="btn-primary btn-sm w-full text-center text-sm">Ajukan Permohonan</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
