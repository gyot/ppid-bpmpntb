@extends('layouts.app')

@section('title', 'Rencana Pengadaan - PPID BPMP NTB')
@section('meta_description', 'Rencana Umum Pengadaan (RUP) BPMP NTB Tahun ' . date('Y'))

@section('content')
<div class="page-header">
    <div class="container-custom py-8">
        <h1 class="text-3xl font-bold text-white mb-4">Rencana Pengadaan</h1>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}" class="text-secondary hover:text-white">Beranda</a>
            <span class="mx-2 text-gray-400">/</span>
            <a href="{{ route('pengadaan.index') }}" class="text-secondary hover:text-white">Pengadaan B&J</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-white">Rencana Pengadaan</span>
        </nav>
    </div>
</div>

<section class="py-12 bg-gray-50">
    <div class="container-custom">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-10 mb-8">
            <h2 class="text-2xl font-bold text-navy mb-4">Rencana Umum Pengadaan (RUP) {{ date('Y') }}</h2>
            <p class="text-charcoal leading-relaxed mb-4">Rencana Umum Pengadaan (RUP) BPMP Provinsi Nusa Tenggara Barat Tahun Anggaran {{ date('Y') }}.</p>
            @if($pengadaans->count() > 0)
                <div class="bg-accent/10 border border-accent/20 rounded-xl p-4">
                    <p class="text-sm text-charcoal font-medium">Terdapat {{ $pengadaans->count() }} paket dalam RUP {{ date('Y') }}.</p>
                </div>
            @endif
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Paket</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nilai Pagu</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tahun</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($pengadaans as $item)
                            <tr>
                                <td class="px-4 py-3 text-sm">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3 text-sm font-medium text-navy">{{ $item->nama_paket }}</td>
                                <td class="px-4 py-3 text-sm text-charcoal">{{ $item->formatted_pagu ?? '-' }}</td>
                                <td class="px-4 py-3 text-sm text-charcoal">{{ $item->tahun }}</td>
                                <td class="px-4 py-3 text-sm text-charcoal">{{ Str::limit($item->deskripsi, 80) ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                                    <svg class="w-16 h-16 mx-auto text-gray-200 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                                    </svg>
                                    <p class="font-medium">Data rencana pengadaan belum tersedia untuk tahun {{ date('Y') }}</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
