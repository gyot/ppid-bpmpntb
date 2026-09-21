@extends('layouts.app')

@section('title', 'Daftar Informasi Publik')
@section('meta_description', 'Daftar lengkap informasi publik BPMP NTB')

@section('content')
<div class="page-header">
    <div class="container-custom py-8">
        <h1 class="text-3xl font-bold text-white mb-4">Daftar Informasi Publik</h1>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}" class="text-secondary hover:text-white">Beranda</a>
            <span class="mx-2 text-gray-400">/</span>
            <a href="{{ route('informasi.index') }}" class="text-secondary hover:text-white">Informasi Publik</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-white">Daftar Informasi</span>
        </nav>
    </div>
</div>

<section class="py-12 bg-gray-50">
    <div class="container-custom">
        <div class="card p-6 mb-8">
            <form method="GET" action="">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari informasi..." class="input-field w-full">
                    </div>
                    <div>
                        <select name="category" class="input-field w-full">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>{{ $category }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <select name="year" class="input-field w-full">
                            <option value="">Semua Tahun</option>
                            @foreach($years as $year)
                                <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="btn-primary w-full">Filter</button>
                    </div>
                </div>
            </form>
        </div>

        @if($informasi->count() > 0)
            <div class="overflow-x-auto">
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th class="w-12">No</th>
                            <th>Informasi</th>
                            <th>Kategori</th>
                            <th>Tahun</th>
                            <th>Format</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($informasi as $index => $item)
                            <tr>
                                <td class="text-center">{{ ($informasi->currentPage() - 1) * $informasi->perPage() + $index + 1 }}</td>
                                <td>
                                    <a href="{{ route('informasi.show', $item->slug) }}" class="text-primary hover:underline font-medium">
                                        {{ $item->title }}
                                    </a>
                                </td>
                                <td><span class="badge-primary">{{ $item->category ?? '-' }}</span></td>
                                <td>{{ $item->year ?? '-' }}</td>
                                <td>
                                    @if($item->file)
                                        @php $ext = pathinfo($item->file, PATHINFO_EXTENSION); @endphp
                                        <span class="badge-{{ $ext === 'pdf' ? 'danger' : ($ext === 'xlsx' || $ext === 'xls' ? 'success' : 'warning') }}">
                                            {{ strtoupper($ext) }}
                                        </span>
                                    @else
                                        <span class="text-charcoal">-</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('informasi.show', $item->slug) }}" class="text-primary hover:text-primary/80 text-sm font-medium">Lihat</a>
                                        @if($item->file)
                                            <span class="text-gray-300">|</span>
                                            <a href="{{ route('informasi.download', $item->slug) }}" class="text-accent hover:text-accent/80 text-sm font-medium">Download</a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-8">
                {{ $informasi->withQueryString()->links() }}
            </div>
        @else
            <div class="text-center py-16">
                <svg class="w-20 h-20 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <h3 class="text-lg font-semibold text-navy mb-2">Belum ada informasi tersedia</h3>
                <p class="text-charcoal">Data informasi publik belum tersedia saat ini.</p>
            </div>
        @endif
    </div>
</section>
@endsection
