@extends('layouts.app')

@section('title', 'Alur Layanan - PPID BPMP NTB')
@section('meta_description', 'Alur layanan permohonan informasi dan pengajuan keberatan PPID BPMP Provinsi Nusa Tenggara Barat')

@section('content')
<div class="page-header">
    <div class="container-custom py-8">
        <h1 class="text-3xl font-bold text-white mb-4">Alur Layanan</h1>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}" class="text-secondary hover:text-white">Beranda</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-white">Alur Layanan</span>
        </nav>
    </div>
</div>

<section class="py-12 bg-gray-50">
    <div class="container-custom max-w-5xl">

        <div class="mb-16">
            <h2 class="text-2xl font-bold text-navy mb-2 text-center">Alur Permohonan Informasi</h2>
            <p class="text-gray-500 text-center mb-10">Proses pengajuan permohonan informasi publik</p>

            <div class="space-y-0">
                @php
                $permohonanSteps = [
                    ['num' => '1', 'title' => 'Pengajuan Permohonan', 'desc' => 'Pemohon mengisi formulir permohonan informasi melalui portal online, datang langsung ke kantor, atau mengirimkan surat resmi.', 'color' => 'primary'],
                    ['num' => '2', 'title' => 'Verifikasi & Pendaftaran', 'desc' => 'Petugas PPID melakukan verifikasi kelengkapan data dan mendaftarkan permohonan. Pemohon mendapat nomor registrasi.', 'color' => 'secondary'],
                    ['num' => '3', 'title' => 'Pencarian & Pengumpulan Informasi', 'desc' => 'PPID berkoordinasi dengan unit kerja terkait untuk mencari dan mengumpulkan informasi yang diminta.', 'color' => 'accent'],
                    ['num' => '4', 'title' => 'Keputusan Pemberian Informasi', 'desc' => 'PPID memutuskan untuk memberikan, menolak, atau memberikan sebagian informasi beserta alasan hukumnya.', 'color' => 'primary'],
                    ['num' => '5', 'title' => 'Penyerahan Informasi', 'desc' => 'Informasi diserahkan kepada pemohon sesuai cara memperoleh yang dipilih (email, pos, atau langsung).', 'color' => 'secondary'],
                ];
                @endphp

                @foreach($permohonanSteps as $step)
                <div class="flex items-stretch gap-6 relative">
                    <div class="flex flex-col items-center">
                        <div class="w-14 h-14 rounded-full bg-{{ $step['color'] }} text-white font-bold text-lg flex items-center justify-center shadow-lg flex-shrink-0 z-10">
                            {{ $step['num'] }}
                        </div>
                        @if(!$loop->last)
                        <div class="w-0.5 flex-1 bg-gray-200 my-2"></div>
                        @endif
                    </div>
                    <div class="bg-white rounded-xl p-6 border border-gray-100 shadow-sm mb-4 flex-1">
                        <h3 class="font-bold text-navy mb-2">{{ $step['title'] }}</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">{{ $step['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div>
            <h2 class="text-2xl font-bold text-navy mb-2 text-center">Alur Pengajuan Keberatan</h2>
            <p class="text-gray-500 text-center mb-10">Proses pengajuan keberatan atas informasi publik</p>

            <div class="space-y-0">
                @php
                $keberatanSteps = [
                    ['num' => '1', 'title' => 'Pengajuan Keberatan', 'desc' => 'Pemohon mengisi formulir keberatan secara online atau langsung dengan melampirkan alasan keberatan.', 'color' => 'red'],
                    ['num' => '2', 'title' => 'Penerimaan & Pendaftaran', 'desc' => 'PPID menerima, mendaftarkan, dan memberikan tanda terima pengajuan keberatan kepada pemohon.', 'color' => 'accent'],
                    ['num' => '3', 'title' => 'Penyelesaian Keberatan', 'desc' => 'Atasan PPID melakukan peninjauan dan memutuskan keberatan dalam jangka waktu paling lambat 30 hari kerja.', 'color' => 'primary'],
                    ['num' => '4', 'title' => 'Pemberitahuan Hasil', 'desc' => 'Hasil keberatan diberitahukan secara tertulis kepada pemohon beserta alasan penolakan atau penerimaan keberatan.', 'color' => 'secondary'],
                ];
                @endphp

                @foreach($keberatanSteps as $step)
                <div class="flex items-stretch gap-6 relative">
                    <div class="flex flex-col items-center">
                        <div class="w-14 h-14 rounded-full bg-{{ $step['color'] }} text-white font-bold text-lg flex items-center justify-center shadow-lg flex-shrink-0 z-10">
                            {{ $step['num'] }}
                        </div>
                        @if(!$loop->last)
                        <div class="w-0.5 flex-1 bg-gray-200 my-2"></div>
                        @endif
                    </div>
                    <div class="bg-white rounded-xl p-6 border border-gray-100 shadow-sm mb-4 flex-1">
                        <h3 class="font-bold text-navy mb-2">{{ $step['title'] }}</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">{{ $step['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="mt-12 flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('layanan.permohonan.create') }}" class="btn-primary">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Ajukan Permohonan
            </a>
            <a href="{{ route('layanan.keberatan.create') }}" class="btn-secondary">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                Ajukan Keberatan
            </a>
        </div>

    </div>
</section>
@endsection
