@extends('admin.layouts.app')

@section('title', 'Keberatan')

@section('breadcrumb')
    <span class="text-gray-900">Keberatan</span>
@endsection

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h1 class="text-2xl font-bold text-gray-900">Keberatan Informasi</h1>
    </div>

    <div class="card bg-white rounded-lg shadow p-4">
        <div class="flex flex-wrap gap-2">
            @php
                $tabs = [
                    ['label' => 'Semua', 'value' => ''],
                    ['label' => 'Baru', 'value' => 'baru'],
                    ['label' => 'Diproses', 'value' => 'diproses'],
                    ['label' => 'Selesai', 'value' => 'selesai'],
                    ['label' => 'Ditolak', 'value' => 'ditolak'],
                ];
            @endphp
            @foreach($tabs as $tab)
                <a href="{{ route('admin.keberatan.index', ['status' => $tab['value']]) }}"
                   class="px-4 py-2 text-sm rounded-lg transition-colors {{ request('status', '') == $tab['value'] ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    {{ $tab['label'] }}
                </a>
            @endforeach
        </div>
    </div>

    <div class="card bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table-custom w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-left py-3 px-4 font-medium text-gray-500">No. Registrasi</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-500">Nama Pemohon</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-500">Permohonan Terkait</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-500">Alasan</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-500">Tanggal</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-500">Status</th>
                        <th class="text-right py-3 px-4 font-medium text-gray-500">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($keberatan as $item)
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="py-3 px-4 font-mono text-xs">{{ $item->registration_number }}</td>
                            <td class="py-3 px-4">{{ $item->name }}</td>
                            <td class="py-3 px-4">{{ $item->permohonan->registration_number ?? '-' }}</td>
                            <td class="py-3 px-4">{{ Str::limit($item->reason, 40) }}</td>
                            <td class="py-3 px-4">{{ $item->created_at->format('d M Y') }}</td>
                            <td class="py-3 px-4">
                                @php
                                    $statusColors = ['baru' => 'info', 'diproses' => 'primary', 'selesai' => 'success', 'ditolak' => 'danger'];
                                @endphp
                                <span class="badge-{{ $statusColors[$item->status] ?? 'info' }} text-xs px-2 py-1 rounded-full">{{ ucfirst($item->status) }}</span>
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex items-center justify-end">
                                    <a href="{{ route('admin.keberatan.show', $item) }}" class="text-primary hover:text-primary/80 text-sm font-medium">Detail</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="py-8 text-center text-gray-400">Tidak ada keberatan</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($keberatan->hasPages())
            <div class="px-4 py-3 border-t border-gray-100">{{ $keberatan->withQueryString()->links() }}</div>
        @endif
    </div>
</div>
@endsection
