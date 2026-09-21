@extends('layouts.app')

@section('title', 'Permohonan Informasi - PPID BPMP NTB')
@section('meta_description', 'Formulir pengajuan permohonan informasi publik PPID BPMP Provinsi Nusa Tenggara Barat')

@section('content')
<div class="page-header">
    <div class="container-custom py-8">
        <h1 class="text-3xl font-bold text-white mb-4">Permohonan Informasi</h1>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}" class="text-secondary hover:text-white">Beranda</a>
            <span class="mx-2 text-gray-400">/</span>
            <a href="{{ route('layanan.alur') }}" class="text-secondary hover:text-white">Layanan</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-white">Permohonan Informasi</span>
        </nav>
    </div>
</div>

<section class="py-12 bg-gray-50">
    <div class="container-custom max-w-4xl">

        <div class="mb-10">
            <h2 class="text-lg font-bold text-navy mb-6 text-center">Alur Permohonan Informasi</h2>
            <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
                @php
                $flowSteps = [
                    ['num' => '1', 'title' => 'Isi Formulir', 'color' => 'primary'],
                    ['num' => '2', 'title' => 'Verifikasi', 'color' => 'secondary'],
                    ['num' => '3', 'title' => 'Proses', 'color' => 'accent'],
                    ['num' => '4', 'title' => 'Keputusan', 'color' => 'primary'],
                    ['num' => '5', 'title' => 'Informasi Diterima', 'color' => 'secondary'],
                ];
                @endphp

                @foreach($flowSteps as $index => $step)
                <div class="flex items-center gap-3">
                    <div class="flex flex-col items-center">
                        <div class="w-12 h-12 rounded-full bg-{{ $step['color'] }} text-white font-bold flex items-center justify-center shadow-md">
                            {{ $step['num'] }}
                        </div>
                        <p class="text-xs font-semibold text-navy mt-2 text-center">{{ $step['title'] }}</p>
                    </div>
                    @if(!$loop->last)
                    <svg class="w-6 h-6 text-gray-300 hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    @endif
                </div>
                @endforeach
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-10">
            <h2 class="text-xl font-bold text-navy mb-6">Formulir Permohonan Informasi</h2>

            <form method="POST" action="{{ route('layanan.permohonan.store') }}" enctype="multipart/form-data">
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
                    <label for="informasi_diminta" class="block text-sm font-medium text-navy mb-1.5">Informasi yang Diminta <span class="text-red-500">*</span></label>
                    <textarea id="informasi_diminta" name="informasi_diminta" rows="4" class="input-field w-full resize-none" required>{{ old('informasi_diminta') }}</textarea>
                    @error('informasi_diminta')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-5">
                    <label for="tujuan_permohonan" class="block text-sm font-medium text-navy mb-1.5">Tujuan Permohonan <span class="text-red-500">*</span></label>
                    <textarea id="tujuan_permohonan" name="tujuan_permohonan" rows="3" class="input-field w-full resize-none" required>{{ old('tujuan_permohonan') }}</textarea>
                    @error('tujuan_permohonan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid sm:grid-cols-2 gap-5 mt-5">
                    <div>
                        <label for="cara_memperoleh" class="block text-sm font-medium text-navy mb-1.5">Cara Memperoleh Informasi <span class="text-red-500">*</span></label>
                        <select id="cara_memperoleh" name="cara_memperoleh" class="input-field w-full" required>
                            <option value="">-- Pilih --</option>
                            <option value="email" {{ old('cara_memperoleh') == 'email' ? 'selected' : '' }}>Email</option>
                            <option value="pos" {{ old('cara_memperoleh') == 'pos' ? 'selected' : '' }}>Pos</option>
                            <option value="langsung" {{ old('cara_memperoleh') == 'langsung' ? 'selected' : '' }}>Langsung</option>
                        </select>
                        @error('cara_memperoleh')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="cara_mendapatkan" class="block text-sm font-medium text-navy mb-1.5">Format Informasi <span class="text-red-500">*</span></label>
                        <select id="cara_mendapatkan" name="cara_mendapatkan" class="input-field w-full" required>
                            <option value="">-- Pilih --</option>
                            <option value="elektronik" {{ old('cara_mendapatkan') == 'elektronik' ? 'selected' : '' }}>Elektronik</option>
                            <option value="non_elektronik" {{ old('cara_mendapatkan') == 'non_elektronik' ? 'selected' : '' }}>Non Elektronik</option>
                        </select>
                        @error('cara_mendapatkan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-5">
                    <label for="identity_file" class="block text-sm font-medium text-navy mb-1.5">Identitas (KTP) <span class="text-red-500">*</span></label>
                    <input type="file" id="identity_file" name="identity_file" accept=".pdf,.jpg,.jpeg,.png" class="input-field w-full" required>
                    <p class="text-xs text-gray-500 mt-1">Format: PDF, JPG, PNG. Maks: 2MB</p>
                    @error('identity_file')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-8">
                    <button type="submit" class="btn-primary">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                        Kirim Permohonan
                    </button>
                </div>
            </form>
        </div>

    </div>
</section>
@endsection
