@extends('layouts.app')

@section('title', 'Informasi Keuangan - PPID BPMP NTB')
@section('meta_description', 'Informasi Keuangan BPMP Provinsi Nusa Tenggara Barat')

@section('content')
<div class="page-header">
    <div class="container-custom py-8">
        <h1 class="text-3xl font-bold text-white mb-4">Informasi Keuangan</h1>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}" class="text-secondary hover:text-white">Beranda</a>
            <span class="mx-2 text-gray-400">/</span>
            <a href="{{ route('berkala.index') }}" class="text-secondary hover:text-white">Informasi Wajib Berkala</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-white">Informasi Keuangan</span>
        </nav>
    </div>
</div>

<section class="py-12 bg-gray-50">
    <div class="container-custom">
        @forelse($keuangans as $category => $items)
            @php
                $firstItem = $items->first();
                $categoryColors = [
                    'laporan_keuangan' => ['bg' => 'bg-primary/10', 'text' => 'text-primary'],
                    'rka' => ['bg' => 'bg-accent/10', 'text' => 'text-accent'],
                    'dipa' => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-600'],
                    'realisasi' => ['bg' => 'bg-amber-50', 'text' => 'text-amber-600'],
                    'calk' => ['bg' => 'bg-blue-50', 'text' => 'text-blue-600'],
                    'neraca' => ['bg' => 'bg-purple-50', 'text' => 'text-purple-600'],
                    'arus_kas' => ['bg' => 'bg-rose-50', 'text' => 'text-rose-600'],
                ];
                $color = $categoryColors[$category] ?? ['bg' => 'bg-gray-50', 'text' => 'text-gray-600'];
            @endphp
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-lg {{ $color['bg'] }} flex items-center justify-center">
                        <svg class="w-5 h-5 {{ $color['text'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-navy">{{ $firstItem->category_label }}</h3>
                </div>
                <ul class="space-y-3">
                    @foreach($items as $item)
                        <li class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div>
                                <span class="text-sm text-charcoal font-medium">{{ $item->title }}</span>
                                <span class="text-xs text-gray-400 ml-2">({{ $item->tahun }})</span>
                                @if($item->file_size)
                                    <span class="text-xs text-gray-400 ml-1">- {{ $item->formatted_file_size }}</span>
                                @endif
                            </div>
                            @if($item->file_path)
                                <a href="{{ '/' . $item->file_path }}" target="_blank" class="text-primary text-sm font-medium hover:underline">Unduh</a>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        @empty
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center">
                <svg class="w-16 h-16 mx-auto text-gray-200 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="font-medium text-gray-500">Data dokumen keuangan belum tersedia</p>
            </div>
        @endforelse
    </div>
</section>
@endsection
