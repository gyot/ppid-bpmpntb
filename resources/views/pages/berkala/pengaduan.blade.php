@extends('layouts.app')

@section('title', 'Tata Cara Pengaduan - PPID BPMP NTB')
@section('meta_description', 'Tata cara pengaduan penyalahgunaan wewenang di BPMP Provinsi Nusa Tenggara Barat')

@section('content')
<div class="page-header">
    <div class="container-custom py-8">
        <h1 class="text-3xl font-bold text-white mb-4">Tata Cara Pengaduan</h1>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}" class="text-secondary hover:text-white">Beranda</a>
            <span class="mx-2 text-gray-400">/</span>
            <a href="{{ route('berkala.index') }}" class="text-secondary hover:text-white">Informasi Wajib Berkala</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-white">Tata Cara Pengaduan</span>
        </nav>
    </div>
</div>

<section class="py-12 bg-gray-50">
    <div class="container-custom max-w-5xl">
        <div class="grid md:grid-cols-2 gap-8 mb-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-10 h-10 rounded-lg bg-red-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-navy">Pengaduan oleh Pejabat Badan Publik</h3>
                </div>
                <p class="text-charcoal leading-relaxed mb-4">Pejabat Badan Publik yang mengetahui adanya penyalahgunaan wewenang dalam pengelolaan informasi publik dapat melaporkan kepada atasan langsung atau melalui mekanisme pengawasan internal.</p>
                <ul class="space-y-2 text-sm text-charcoal">
                    <li class="flex items-start gap-2">
                        <span class="w-5 h-5 rounded-full bg-primary/10 text-primary text-xs font-bold flex items-center justify-center flex-shrink-0 mt-0.5">1</span>
                        <span>Buat laporan tertulis</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="w-5 h-5 rounded-full bg-primary/10 text-primary text-xs font-bold flex items-center justify-center flex-shrink-0 mt-0.5">2</span>
                        <span>Sertakan bukti pendukung</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="w-5 h-5 rounded-full bg-primary/10 text-primary text-xs font-bold flex items-center justify-center flex-shrink-0 mt-0.5">3</span>
                        <span>Kirimkan ke unit pengawasan</span>
                    </li>
                </ul>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-10 h-10 rounded-lg bg-amber-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-navy">Pengaduan oleh Pihak dengan Izin/Perjanjian</h3>
                </div>
                <p class="text-charcoal leading-relaxed mb-4">Pihak yang memiliki izin atau perjanjian dengan Badan Publik yang mengetahui adanya penyalahgunaan wewenang dapat mengajukan pengaduan melalui jalur yang tersedia.</p>
                <ul class="space-y-2 text-sm text-charcoal">
                    <li class="flex items-start gap-2">
                        <span class="w-5 h-5 rounded-full bg-primary/10 text-primary text-xs font-bold flex items-center justify-center flex-shrink-0 mt-0.5">1</span>
                        <span>Isi formulir pengaduan</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="w-5 h-5 rounded-full bg-primary/10 text-primary text-xs font-bold flex items-center justify-center flex-shrink-0 mt-0.5">2</span>
                        <span>Lampirkan dokumen perjanjian/izin</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="w-5 h-5 rounded-full bg-primary/10 text-primary text-xs font-bold flex items-center justify-center flex-shrink-0 mt-0.5">3</span>
                        <span>Sampaikan kronologi kejadian</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
            <h3 class="text-xl font-bold text-navy mb-6">Saluran Pengaduan</h3>
            <div class="grid sm:grid-cols-2 gap-4">
                <a href="https://www.lapor.go.id" target="_blank" class="group p-4 bg-gray-50 rounded-xl hover:bg-primary/5 transition-colors flex items-start gap-3">
                    <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9"/></svg>
                    </div>
                    <div>
                        <p class="font-semibold text-navy group-hover:text-primary transition-colors">SP4N LAPOR!</p>
                        <p class="text-sm text-gray-500">Sistem Pengelolaan Pengaduan Pelayanan Publik Nasional</p>
                    </div>
                </a>

                <a href="#" class="group p-4 bg-gray-50 rounded-xl hover:bg-primary/5 transition-colors flex items-start gap-3">
                    <div class="w-10 h-10 rounded-lg bg-emerald-100 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <p class="font-semibold text-navy group-hover:text-primary transition-colors">WBS Kemendikdasmen</p>
                        <p class="text-sm text-gray-500">Whistle Blowing System Kementerian Pendidikan</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
