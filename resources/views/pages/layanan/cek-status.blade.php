@extends('layouts.app')

@section('title', 'Cek Status Permohonan - PPID BPMP NTB')
@section('meta_description', 'Cek status permohonan informasi publik PPID BPMP Provinsi Nusa Tenggara Barat')

@section('content')
<div class="page-header">
    <div class="container-custom py-8">
        <h1 class="text-3xl font-bold text-white mb-4">Cek Status Permohonan</h1>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}" class="text-secondary hover:text-white">Beranda</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-white">Cek Status</span>
        </nav>
    </div>
</div>

<section class="py-12 bg-gray-50">
    <div class="container-custom max-w-3xl">

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8 mb-8">
            <h2 class="text-lg font-bold text-navy mb-4">Masukkan Nomor Registrasi</h2>
            <form method="POST" action="{{ route('layanan.cek-status.result') }}">
                @csrf
                <div class="flex gap-3">
                    <input type="text" name="registration_number" value="{{ old('registration_number', request('registration_number')) }}" placeholder="Contoh: REG-20240101-0001" class="input-field flex-1" required>
                    <button type="submit" class="btn-primary px-6">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        Cari
                    </button>
                </div>
            </form>
        </div>

        @if(isset($searched) && $searched && $permohonan)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8 mb-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h2 class="text-lg font-bold text-navy">Detail Permohonan</h2>
            </div>

            <div class="grid sm:grid-cols-2 gap-4 mb-6">
                <div>
                    <p class="text-xs text-gray-500">Nomor Registrasi</p>
                    <p class="font-semibold text-navy">{{ $permohonan->registration_number }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Nama Pemohon</p>
                    <p class="font-semibold text-navy">{{ $permohonan->nama }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Tanggal Pengajuan</p>
                    <p class="font-semibold text-navy">{{ $permohonan->created_at->translatedFormat('d F Y') }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Status</p>
                    @php
                        $statusColors = [
                            'pending' => 'badge-warning',
                            'verified' => 'badge-primary',
                            'processing' => 'badge-primary',
                            'completed' => 'badge-success',
                            'rejected' => 'badge-danger',
                        ];
                        $statusLabels = [
                            'pending' => 'Menunggu Verifikasi',
                            'verified' => 'Terverifikasi',
                            'processing' => 'Sedang Diproses',
                            'completed' => 'Selesai',
                            'rejected' => 'Ditolak',
                        ];
                    @endphp
                    <span class="{{ $statusColors[$permohonan->status] ?? 'badge-primary' }}">
                        {{ $statusLabels[$permohonan->status] ?? ucfirst($permohonan->status) }}
                    </span>
                </div>
            </div>

            <div>
                <p class="text-xs text-gray-500">Informasi yang Diminta</p>
                <p class="text-charcoal text-sm leading-relaxed">{{ $permohonan->informasi_diminta }}</p>
            </div>
        </div>

        @if($permohonan->histories && $permohonan->histories->count() > 0)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
            <h2 class="text-lg font-bold text-navy mb-6">Riwayat Status</h2>

            <div class="relative">
                <div class="absolute left-4 top-0 bottom-0 w-0.5 bg-gray-200"></div>

                <div class="space-y-6">
                    @foreach($permohonan->histories->sortByDesc('created_at') as $history)
                    @php
                        $dotColors = [
                            'pending' => 'bg-yellow-400',
                            'verified' => 'bg-blue-500',
                            'processing' => 'bg-primary',
                            'completed' => 'bg-green-500',
                            'rejected' => 'bg-red-500',
                        ];
                    @endphp
                    <div class="flex items-start gap-4 relative">
                        <div class="w-8 h-8 rounded-full {{ $dotColors[$history->status] ?? 'bg-gray-400' }} flex items-center justify-center flex-shrink-0 z-10 shadow-sm">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <div class="flex-1 pb-2">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="font-semibold text-navy text-sm">{{ $statusLabels[$history->status] ?? ucfirst($history->status) }}</span>
                                <span class="text-xs text-gray-400">{{ $history->created_at->translatedFormat('d F Y H:i') }}</span>
                            </div>
                            @if($history->notes)
                                <p class="text-gray-600 text-sm">{{ $history->notes }}</p>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
        @endif

        @if(isset($keberatan) && $keberatan)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8 mb-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-lg bg-orange-100 flex items-center justify-center">
                    <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                    </svg>
                </div>
                <h2 class="text-lg font-bold text-navy">Detail Keberatan</h2>
            </div>

            <div class="grid sm:grid-cols-2 gap-4 mb-6">
                <div>
                    <p class="text-xs text-gray-500">Nomor Registrasi</p>
                    <p class="font-semibold text-navy">{{ $keberatan->registration_number }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Nama Pemohon</p>
                    <p class="font-semibold text-navy">{{ $keberatan->nama }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Tanggal Pengajuan</p>
                    <p class="font-semibold text-navy">{{ $keberatan->created_at->translatedFormat('d F Y') }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Status</p>
                    @php
                        $kbStatusColors = [
                            'submitted' => 'badge-warning',
                            'reviewing' => 'badge-primary',
                            'responded' => 'badge-info',
                            'resolved' => 'badge-success',
                        ];
                        $kbStatusLabels = [
                            'submitted' => 'Diajukan',
                            'reviewing' => 'Sedang Ditinjau',
                            'responded' => 'Sudah Ditanggapi',
                            'resolved' => 'Selesai',
                        ];
                    @endphp
                    <span class="{{ $kbStatusColors[$keberatan->status] ?? 'badge-primary' }}">
                        {{ $kbStatusLabels[$keberatan->status] ?? ucfirst($keberatan->status) }}
                    </span>
                </div>
            </div>

            <div>
                <p class="text-xs text-gray-500">Alasan Keberatan</p>
                <p class="text-charcoal text-sm leading-relaxed">{{ $keberatan->alasan_keberatan }}</p>
            </div>

            @if($keberatan->response)
            <div class="mt-4 p-4 bg-blue-50 rounded-lg">
                <p class="text-xs text-blue-600 font-semibold mb-1">Tanggapan</p>
                <p class="text-sm text-blue-800">{{ $keberatan->response }}</p>
            </div>
            @endif
        </div>
        @endif

        @if(isset($searched) && $searched && !$permohonan && !$keberatan)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 text-center">
            <div class="w-16 h-16 rounded-full bg-red-100 flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-navy mb-2">Data Tidak Ditemukan</h3>
            <p class="text-gray-500 text-sm">Nomor registrasi yang Anda masukkan tidak ditemukan. Silakan periksa kembali nomor registrasi Anda.</p>
        </div>
        @endif

    </div>
</section>
@endsection
