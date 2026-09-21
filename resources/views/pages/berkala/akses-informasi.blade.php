@extends('layouts.app')

@section('title', 'Ringkasan Akses Informasi - PPID BPMP NTB')
@section('meta_description', 'Ringkasan Akses Informasi Publik BPMP Provinsi Nusa Tenggara Barat')

@section('content')
<div class="page-header">
    <div class="container-custom py-8">
        <h1 class="text-3xl font-bold text-white mb-4">Ringkasan Akses Informasi</h1>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}" class="text-secondary hover:text-white">Beranda</a>
            <span class="mx-2 text-gray-400">/</span>
            <a href="{{ route('berkala.index') }}" class="text-secondary hover:text-white">Informasi Wajib Berkala</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-white">Ringkasan Akses Informasi</span>
        </nav>
    </div>
</div>

<section class="py-12 bg-gray-50">
    <div class="container-custom">
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm" style="border-top: 3px solid #F0A800;">
                <div class="text-3xl font-extrabold text-navy mb-1">[0]</div>
                <div class="text-sm text-gray-500 font-medium">Total Permohonan</div>
            </div>
            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm" style="border-top: 3px solid #22c55e;">
                <div class="text-3xl font-extrabold text-navy mb-1">[0]</div>
                <div class="text-sm text-gray-500 font-medium">Diterima</div>
            </div>
            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm" style="border-top: 3px solid #ef4444;">
                <div class="text-3xl font-extrabold text-navy mb-1">[0]</div>
                <div class="text-sm text-gray-500 font-medium">Ditolak</div>
            </div>
            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm" style="border-top: 3px solid #3b82f6;">
                <div class="text-3xl font-extrabold text-navy mb-1">10 hari kerja</div>
                <div class="text-sm text-gray-500 font-medium">Rata-rata Waktu</div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8 mb-8">
            <h3 class="text-xl font-bold text-navy mb-4">Permohonan Informasi Per Bulan</h3>
            <div class="h-64 flex items-center justify-center text-gray-400">
                <p class="text-sm">Data statistik akan ditampilkan di sini setelah ada permohonan masuk.</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <h3 class="text-lg font-bold text-navy">Detail Permohonan Informasi</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Bulan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jumlah Permohonan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Diterima</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ditolak</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Dalam Proses</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach(['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] as $i => $bulan)
                        <tr>
                            <td class="px-6 py-3 text-sm">{{ $i + 1 }}</td>
                            <td class="px-6 py-3 text-sm font-medium text-navy">{{ $bulan }}</td>
                            <td class="px-6 py-3 text-sm text-charcoal">{{ isset($stats['permohonan_per_bulan'][$i + 1]) ? $stats['permohonan_per_bulan'][$i + 1] : 0 }}</td>
                            <td class="px-6 py-3 text-sm text-charcoal">-</td>
                            <td class="px-6 py-3 text-sm text-charcoal">-</td>
                            <td class="px-6 py-3 text-sm text-charcoal">-</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
