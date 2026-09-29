@extends('admin.layouts.app')

@section('title', 'Kalender Program')

@section('breadcrumb')
    <span class="text-gray-900">Kalender Program</span>
@endsection

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h1 class="text-2xl font-bold text-gray-900">Kalender Program</h1>
        <div class="flex flex-wrap items-center gap-2">
            <a href="{{ route('admin.calendar-programs.create') }}" class="inline-flex items-center px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 text-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                Tambah Program
            </a>
            <a href="{{ route('admin.calendar-programs.import.form') }}" class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 text-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                Import Excel
            </a>
            <a href="{{ route('admin.calendar-programs.export') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                Export Excel
            </a>
            <a href="{{ route('admin.calendar-programs.timeline') }}" class="inline-flex items-center px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 text-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Timeline
            </a>
        </div>
    </div>

    <div class="card bg-white rounded-lg shadow p-4">
        <form method="GET" class="grid grid-cols-1 sm:grid-cols-5 gap-3">
            <select name="tahun" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
                <option value="">Semua Tahun</option>
                @for($y = date('Y') + 1; $y >= 2020; $y--)
                    <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>{{ $y }}</option>
                @endfor
            </select>
            <select name="penanggung_jawab" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
                <option value="">Semua Penanggung Jawab</option>
                @foreach($penanggungJawabs ?? [] as $pj)
                    <option value="{{ $pj }}" {{ request('penanggung_jawab') == $pj ? 'selected' : '' }}>{{ $pj }}</option>
                @endforeach
            </select>
            <select name="status" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
                <option value="">Semua Status</option>
                <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
            </select>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari program..." class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
            <div class="flex gap-2">
                <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 text-sm">Filter</button>
                <a href="{{ route('admin.calendar-programs.index') }}" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 text-sm">Reset</a>
            </div>
        </form>
    </div>

    <div class="card bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-center py-3 px-4 font-medium text-gray-500 w-12">No</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-500">Penanggung Jawab</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-500">Uraian Kegiatan</th>
                        <th class="text-center py-3 px-4 font-medium text-gray-500">Bulan</th>
                        <th class="text-right py-3 px-4 font-medium text-gray-500">Anggaran</th>
                        <th class="text-center py-3 px-4 font-medium text-gray-500">Status</th>
                        <th class="text-center py-3 px-4 font-medium text-gray-500">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($programs as $item)
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="text-center py-3 px-4 text-gray-500">{{ $programs->firstItem() + $loop->index }}</td>
                            <td class="py-3 px-4 font-medium text-gray-900">{{ $item->penanggung_jawab }}</td>
                            <td class="py-3 px-4">{{ Str::limit($item->uraian_kegiatan, 60) }}</td>
                            <td class="py-3 px-4">
                                <div class="flex flex-wrap gap-1 justify-center">
                                    @foreach($item->bulan_array ?? [] as $bulan)
                                        <span class="inline-block text-xs px-1.5 py-0.5 rounded font-medium text-white" style="background-color: {{ $item->pj_color ?? '#2563eb' }}">{{ $bulan }}</span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="text-right py-3 px-4">{{ $item->formatted_anggaran ?? '-' }}</td>
                            <td class="text-center py-3 px-4">
                                <span class="text-xs px-2 py-1 rounded-full {{ $item->status == 'aktif' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">{{ ucfirst($item->status) }}</span>
                            </td>
                            <td class="text-center py-3 px-4">
                                <div class="flex items-center justify-center gap-1">
                                    <a href="{{ route('admin.calendar-programs.show', $item) }}" class="text-blue-600 hover:text-blue-800 p-1" title="Detail">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </a>
                                    <a href="{{ route('admin.calendar-programs.edit', $item) }}" class="text-yellow-600 hover:text-yellow-800 p-1" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form method="POST" action="{{ route('admin.calendar-programs.duplicate', $item->id) }}" class="inline">
                                        @csrf
                                        <button type="submit" class="text-green-600 hover:text-green-800 p-1" title="Duplikat">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                        </button>
                                    </form>
                                    <button onclick="confirmDelete('{{ route('admin.calendar-programs.destroy', $item) }}')" class="text-red-600 hover:text-red-800 p-1" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="py-8 text-center text-gray-400">Tidak ada data program</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($programs->hasPages())
            <div class="px-4 py-3 border-t border-gray-100">{{ $programs->withQueryString()->links() }}</div>
        @endif
    </div>
</div>

<form id="delete-form" method="POST" class="hidden">@csrf @method('DELETE')</form>

@push('scripts')
<script>
function confirmDelete(url) {
    Swal.fire({
        title: 'Hapus Program?',
        text: 'Data yang dihapus tidak dapat dikembalikan.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form').action = url;
            document.getElementById('delete-form').submit();
        }
    });
}
</script>
@endpush
@endsection
