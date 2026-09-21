@extends('layouts.app')

@section('title', 'Informasi Publik')
@section('meta_description', 'Daftar Informasi Publik BPMP NTB - Berkala, Setiap Saat, Serta Merta, dan Dikecualikan')

@section('content')
<div class="page-header">
    <div class="container-custom py-8">
        <h1 class="text-3xl font-bold text-white mb-4">Informasi Publik</h1>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}" class="text-secondary hover:text-white">Beranda</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-white">Informasi Publik</span>
        </nav>
    </div>
</div>

<section class="py-16 bg-gray-50">
    <div class="container-custom">
        <div class="section-title text-center mb-12">
            <h2 class="text-2xl font-bold text-navy">Kategori Informasi Publik</h2>
            <p class="text-charcoal mt-2">Jelajahi informasi publik berdasarkan kategori yang tersedia</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="card group hover:shadow-xl transition-all duration-300">
                <div class="flex items-start gap-5 p-6">
                    <div class="flex-shrink-0 w-16 h-16 bg-primary/10 rounded-xl flex items-center justify-center group-hover:bg-primary/20 transition-colors">
                        <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-navy mb-2">Informasi Berkala</h3>
                        <p class="text-charcoal text-sm mb-4">Informasi yang wajib disediakan dan diumumkan secara berkala oleh badan publik.</p>
                        <div class="flex items-center justify-between">
                            <span class="text-primary font-semibold">{{ $berkalaCount }} informasi</span>
                            <a href="{{ route('informasi.berkala') }}" class="btn-primary text-sm px-5 py-2">Lihat</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card group hover:shadow-xl transition-all duration-300">
                <div class="flex items-start gap-5 p-6">
                    <div class="flex-shrink-0 w-16 h-16 bg-secondary/20 rounded-xl flex items-center justify-center group-hover:bg-secondary/30 transition-colors">
                        <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-navy mb-2">Informasi Setiap Saat</h3>
                        <p class="text-charcoal text-sm mb-4">Informasi yang wajib tersedia setiap saat dan dapat diakses oleh publik kapan saja.</p>
                        <div class="flex items-center justify-between">
                            <span class="text-primary font-semibold">{{ $setiapSaatCount }} informasi</span>
                            <a href="{{ route('informasi.setiap-saat') }}" class="btn-primary text-sm px-5 py-2">Lihat</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card group hover:shadow-xl transition-all duration-300">
                <div class="flex items-start gap-5 p-6">
                    <div class="flex-shrink-0 w-16 h-16 bg-accent/20 rounded-xl flex items-center justify-center group-hover:bg-accent/30 transition-colors">
                        <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-navy mb-2">Informasi Serta Merta</h3>
                        <p class="text-charcoal text-sm mb-4">Informasi yang dapat mengancam hajat hidup orang banyak dan ketertiban umum.</p>
                        <div class="flex items-center justify-between">
                            <span class="text-primary font-semibold">{{ $sertaMertaCount }} informasi</span>
                            <a href="{{ route('informasi.serta-merta') }}" class="btn-primary text-sm px-5 py-2">Lihat</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card group hover:shadow-xl transition-all duration-300">
                <div class="flex items-start gap-5 p-6">
                    <div class="flex-shrink-0 w-16 h-16 bg-gray-200 rounded-xl flex items-center justify-center group-hover:bg-gray-300 transition-colors">
                        <svg class="w-8 h-8 text-charcoal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-navy mb-2">Informasi Dikecualikan</h3>
                        <p class="text-charcoal text-sm mb-4">Informasi yang dikecualikan dari hak akses publik sesuai peraturan perundang-undangan.</p>
                        <div class="flex items-center justify-between">
                            <span class="text-primary font-semibold">{{ $dikecualikanCount }} informasi</span>
                            <a href="{{ route('informasi.dikecualikan') }}" class="btn-primary text-sm px-5 py-2">Lihat</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
