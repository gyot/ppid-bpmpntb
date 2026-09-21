@extends('layouts.app')

@section('title', 'Program dan Kegiatan - PPID BPMP NTB')
@section('meta_description', 'Program dan Kegiatan BPMP NTB Tahun ' . date('Y'))

@section('content')
<div class="page-header">
    <div class="container-custom py-8">
        <h1 class="text-3xl font-bold text-white mb-4">Program dan Kegiatan</h1>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}" class="text-secondary hover:text-white">Beranda</a>
            <span class="mx-2 text-gray-400">/</span>
            <a href="{{ route('berkala.index') }}" class="text-secondary hover:text-white">Informasi Wajib Berkala</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-white">Program dan Kegiatan</span>
        </nav>
    </div>
</div>

<section class="py-12 bg-gray-50">
    <div class="container-custom">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-10 mb-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center">
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-navy">Program dan Kegiatan BPMP NTB Tahun {{ date('Y') }}</h2>
            </div>
            <p class="text-charcoal leading-relaxed">Daftar program dan kegiatan BPMP Provinsi Nusa Tenggara Barat beserta penanggung jawab, target, jadwal, sumber anggaran, dan besaran anggaran.</p>
        </div>

        @php
            $programItems = $programs->whereIn('jenis', ['program', 'kegiatan']);
            $strategisItems = $programs->where('jenis', 'strategis');
        @endphp

        @if($programItems->count() > 0)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-8">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Program</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jenis</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Penanggungjawab</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Target</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jadwal</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Sumber Anggaran</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Besaran Anggaran</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($programItems as $item)
                            <tr>
                                <td class="px-4 py-3 text-sm">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3 text-sm font-medium text-navy">{{ $item->nama_program }}</td>
                                <td class="px-4 py-3 text-sm text-charcoal">{{ ucfirst($item->jenis) }}</td>
                                <td class="px-4 py-3 text-sm text-charcoal">{{ $item->penanggung_jawab ?? '-' }}</td>
                                <td class="px-4 py-3 text-sm text-charcoal">{{ $item->target ?? '-' }}</td>
                                <td class="px-4 py-3 text-sm text-charcoal">{{ $item->jadwal ?? '-' }}</td>
                                <td class="px-4 py-3 text-sm text-charcoal">{{ $item->sumber_anggaran ?? '-' }}</td>
                                <td class="px-4 py-3 text-sm text-charcoal">{{ $item->formatted_anggaran ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        @if($strategisItems->count() > 0)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
            <h3 class="text-xl font-bold text-navy mb-4">Program Strategis</h3>
            <div class="space-y-4">
                @foreach($strategisItems as $item)
                    <div class="p-4 bg-gray-50 rounded-xl border-l-4 border-primary">
                        <p class="font-semibold text-navy">{{ $item->nama_program }}</p>
                        <p class="text-sm text-charcoal mt-1">{{ $item->deskripsi ?? '' }}</p>
                        @if($item->formatted_anggaran)
                            <p class="text-sm text-primary font-medium mt-2">Anggaran: {{ $item->formatted_anggaran }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        @if($programs->count() === 0)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center">
            <svg class="w-16 h-16 mx-auto text-gray-200 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
            </svg>
            <p class="font-medium text-gray-500">Data program dan kegiatan belum tersedia untuk tahun {{ date('Y') }}</p>
        </div>
        @endif
    </div>
</section>
@endsection
