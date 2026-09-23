@extends('admin.layouts.app')

@section('title', 'Kelola SOP')

@section('breadcrumb')
    <span class="text-gray-900">SOP</span>
@endsection

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h1 class="text-2xl font-bold text-gray-900">Standar Operasional Prosedur</h1>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.sop.create') }}" class="btn-primary inline-flex items-center px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 text-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                Tambah SOP
            </a>
            <a href="{{ route('admin.sop.bulk-create') }}" class="inline-flex items-center px-4 py-2 border border-primary text-primary rounded-lg hover:bg-primary/5 text-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                Upload Massal
            </a>
        </div>
    </div>

    <div class="card bg-white rounded-lg shadow p-4">
        <form method="GET" class="flex gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari SOP..." class="input-field flex-1 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
            <button type="submit" class="btn-primary px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 text-sm">Cari</button>
            @if(request('search'))
                <a href="{{ route('admin.sop.index') }}" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 text-sm">Reset</a>
            @endif
        </form>
    </div>

    <div class="card bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table-custom w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-left py-3 px-4 font-medium text-gray-500 w-10">No.</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-500">Judul SOP</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-500">File</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-500">Deskripsi</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-500">Urutan</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-500">Status</th>
                        <th class="text-right py-3 px-4 font-medium text-gray-500">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sops as $item)
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="py-3 px-4">{{ $loop->iteration }}</td>
                            <td class="py-3 px-4 font-medium">{{ $item->title }}</td>
                            <td class="py-3 px-4">
                                @if($item->file_path)
                                    <a href="{{ Storage::url($item->file_path) }}" target="_blank" class="text-primary hover:underline text-xs">
                                        <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                        {{ strtoupper(pathinfo($item->file_name, PATHINFO_EXTENSION)) }}
                                    </a>
                                @else
                                    <span class="text-gray-400 text-xs">-</span>
                                @endif
                            </td>
                            <td class="py-3 px-4">{{ Str::limit($item->deskripsi, 60) }}</td>
                            <td class="py-3 px-4">{{ $item->sort_order }}</td>
                            <td class="py-3 px-4">
                                <span class="badge-{{ $item->is_active ? 'success' : 'warning' }} text-xs px-2 py-1 rounded-full">{{ $item->is_active ? 'Aktif' : 'Nonaktif' }}</span>
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.sop.edit', $item) }}" class="text-blue-600 hover:text-blue-800" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form method="POST" action="{{ route('admin.sop.toggle-active', $item) }}" class="inline">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="{{ $item->is_active ? 'text-yellow-600 hover:text-yellow-800' : 'text-green-600 hover:text-green-800' }}" title="{{ $item->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        </button>
                                    </form>
                                    <button onclick="confirmDelete('{{ route('admin.sop.destroy', $item) }}')" class="text-red-600 hover:text-red-800" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="py-8 text-center text-gray-400">Tidak ada data SOP</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($sops->hasPages())
            <div class="px-4 py-3 border-t border-gray-100">{{ $sops->withQueryString()->links() }}</div>
        @endif
    </div>
</div>

<form id="delete-form" method="POST" class="hidden">@csrf @method('DELETE')</form>

@push('scripts')
<script>
function confirmDelete(url) {
    Swal.fire({
        title: 'Hapus SOP?',
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
