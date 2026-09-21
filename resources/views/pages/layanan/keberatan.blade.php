@extends('layouts.app')

@section('title', 'Pengajuan Keberatan - PPID BPMP NTB')
@section('meta_description', 'Formulir pengajuan keberatan atas informasi publik PPID BPMP Provinsi Nusa Tenggara Barat')

@section('content')
<div class="page-header">
    <div class="container-custom py-8">
        <h1 class="text-3xl font-bold text-white mb-4">Pengajuan Keberatan</h1>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}" class="text-secondary hover:text-white">Beranda</a>
            <span class="mx-2 text-gray-400">/</span>
            <a href="{{ route('layanan.alur') }}" class="text-secondary hover:text-white">Layanan</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-white">Keberatan</span>
        </nav>
    </div>
</div>

<section class="py-12 bg-gray-50">
    <div class="container-custom max-w-3xl">

        @if(session('success'))
        <div class="mb-8 p-5 bg-green-50 border border-green-200 rounded-xl text-green-700 flex items-start gap-3">
            <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('success') }}
        </div>
        @endif

        <div class="bg-primary/5 border border-primary/10 rounded-2xl p-6 md:p-8 mb-8">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="font-bold text-navy mb-2">Tentang Pengajuan Keberatan</h2>
                    <p class="text-gray-600 text-sm leading-relaxed">Keberatan dapat diajukan oleh pemohon informasi publik apabila: (1) permohonan informasi ditolak; (2) informasi yang diberikan tidak sesuai dengan permohonan; (3) permohonan tidak ditanggapi; (4) permohonan dipenuhi melebihi jangka waktu yang ditentukan; atau (5) pengenaan biaya yang tidak wajar.</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-10">
            <h2 class="text-xl font-bold text-navy mb-6">Formulir Keberatan</h2>

            <form method="POST" action="{{ route('layanan.keberatan.store') }}">
                @csrf

                <div class="grid sm:grid-cols-2 gap-5">
                    <div>
                        <label for="nama" class="block text-sm font-medium text-navy mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama') }}" class="input-field w-full" required>
                        @error('nama')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="nik" class="block text-sm font-medium text-navy mb-1.5">NIK <span class="text-red-500">*</span></label>
                        <input type="text" id="nik" name="nik" value="{{ old('nik') }}" class="input-field w-full" maxlength="16" required>
                        @error('nik')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid sm:grid-cols-2 gap-5 mt-5">
                    <div>
                        <label for="email" class="block text-sm font-medium text-navy mb-1.5">Email <span class="text-red-500">*</span></label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" class="input-field w-full" required>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="phone" class="block text-sm font-medium text-navy mb-1.5">No. Telepon <span class="text-red-500">*</span></label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone') }}" class="input-field w-full" required>
                        @error('phone')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-5">
                    <label for="alamat" class="block text-sm font-medium text-navy mb-1.5">Alamat <span class="text-red-500">*</span></label>
                    <textarea id="alamat" name="alamat" rows="3" class="input-field w-full resize-none" required>{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-5">
                    <label for="informasi_terkait" class="block text-sm font-medium text-navy mb-1.5">Informasi Terkait <span class="text-red-500">*</span></label>
                    <textarea id="informasi_terkait" name="informasi_terkait" rows="3" class="input-field w-full resize-none" placeholder="Jelaskan informasi yang dimaksud" required>{{ old('informasi_terkait') }}</textarea>
                    @error('informasi_terkait')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-5">
                    <label for="alasan_keberatan" class="block text-sm font-medium text-navy mb-1.5">Alasan Keberatan <span class="text-red-500">*</span></label>
                    <textarea id="alasan_keberatan" name="alasan_keberatan" rows="4" class="input-field w-full resize-none" placeholder="Jelaskan alasan keberatan Anda secara rinci" required>{{ old('alasan_keberatan') }}</textarea>
                    @error('alasan_keberatan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-8">
                    <button type="submit" class="btn-primary">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                        Kirim Keberatan
                    </button>
                </div>
            </form>
        </div>

    </div>
</section>
@endsection
