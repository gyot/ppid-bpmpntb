@extends('layouts.app')

@section('title', 'DIP Online - PPID BPMP NTB')
@section('meta_description', 'Daftar Informasi Publik Online PPID BPMP Provinsi Nusa Tenggara Barat')

@section('content')
<div class="page-header">
    <div class="container-custom py-8">
        <h1 class="text-3xl font-bold text-white mb-4">DIP Online</h1>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}" class="text-secondary hover:text-white">Beranda</a>
            <span class="mx-2 text-gray-400">/</span>
            <a href="{{ route('informasi.index') }}" class="text-secondary hover:text-white">Informasi Publik</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-white">DIP Online</span>
        </nav>
    </div>
</div>

<section class="py-12 bg-gray-50">
    <div class="container-custom">

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8 mb-8">
            <form method="GET" class="flex flex-col sm:flex-row gap-3">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari informasi..." class="input-field flex-1 border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
                <select name="category" class="input-field border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
                    <option value="">Semua Kategori</option>
                    <option value="berkala" {{ request('category') == 'berkala' ? 'selected' : '' }}>Berkala</option>
                    <option value="setiap_saat" {{ request('category') == 'setiap_saat' ? 'selected' : '' }}>Setiap Saat</option>
                    <option value="serta_merta" {{ request('category') == 'serta_merta' ? 'selected' : '' }}>Serta Merta</option>
                    <option value="dikecualikan" {{ request('category') == 'dikecualikan' ? 'selected' : '' }}>Dikecualikan</option>
                </select>
                <button type="submit" class="px-6 py-2.5 bg-primary text-white rounded-lg hover:bg-primary/90 text-sm font-medium">Cari</button>
            </form>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="text-left py-3 px-4 font-semibold text-gray-600 w-12">No</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-600">Judul Informasi</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-600">Jenis</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-600">Kategori</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-600">Sumber</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-600">Uraian</th>
                            <th class="text-center py-3 px-4 font-semibold text-gray-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dip as $item)
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="py-3 px-4 text-gray-500">{{ ($dip->currentPage() - 1) * $dip->perPage() + $loop->iteration }}</td>
                                <td class="py-3 px-4 font-medium text-gray-900">{{ $item->title }}</td>
                                <td class="py-3 px-4 text-gray-600">{{ $item->jenis_informasi }}</td>
                                <td class="py-3 px-4">
                                    @php
                                        $catColors = [
                                            'berkala' => 'bg-blue-100 text-blue-700',
                                            'setiap_saat' => 'bg-green-100 text-green-700',
                                            'serta_merta' => 'bg-red-100 text-red-700',
                                            'dikecualikan' => 'bg-yellow-100 text-yellow-700',
                                        ];
                                    @endphp
                                    <span class="text-xs px-2 py-1 rounded-full {{ $catColors[$item->category] ?? 'bg-gray-100 text-gray-700' }}">{{ $item->category_label }}</span>
                                </td>
                                <td class="py-3 px-4 text-gray-600">{{ $item->sumber_informasi ?? '-' }}</td>
                                <td class="py-3 px-4 text-gray-600">{{ Str::limit($item->uraian_informasi, 60) }}</td>
                                <td class="py-3 px-4 text-center">
                                    @if($item->file_path)
                                        <a href="{{ Storage::url($item->file_path) }}" target="_blank" class="inline-flex items-center text-primary hover:underline text-sm">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                            Unduh
                                        </a>
                                    @else
                                        <span class="text-gray-400 text-xs">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="py-12 text-center text-gray-400">Tidak ada data DIP yang ditemukan.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($dip->hasPages())
                <div class="px-4 py-3 border-t border-gray-100 bg-gray-50">{{ $dip->links() }}</div>
            @endif
        </div>

    </div>
</section>
@endsection
