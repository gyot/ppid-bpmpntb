@extends('admin.layouts.app')

@section('title', 'Kelola Berita')

@section('breadcrumb')
    <span class="text-gray-900">Berita</span>
@endsection

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h1 class="text-2xl font-bold text-gray-900">Kelola Berita</h1>
        <a href="{{ route('admin.berita.create') }}" class="btn-primary inline-flex items-center px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 text-sm">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
            Tambah Berita
        </a>
    </div>

    <div class="card bg-white rounded-lg shadow p-4">
        <form method="GET" class="grid grid-cols-1 sm:grid-cols-4 gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berita..." class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
            <select name="category" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
                <option value="">Semua Kategori</option>
                @foreach(['berita','pengumuman','artikel','kegiatan'] as $cat)
                    <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ ucfirst($cat) }}</option>
                @endforeach
            </select>
            <select name="status" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
                <option value="">Semua Status</option>
                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
            </select>
            <div class="flex gap-2">
                <button type="submit" class="btn-primary px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 text-sm">Filter</button>
                <a href="{{ route('admin.berita.index') }}" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 text-sm">Reset</a>
            </div>
        </form>
    </div>

    <div class="card bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table-custom w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-left py-3 px-4 font-medium text-gray-500">Gambar</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-500">Judul</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-500">Kategori</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-500">Status</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-500">Unggulan</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-500">Views</th>
                        <th class="text-right py-3 px-4 font-medium text-gray-500">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($berita as $item)
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="py-3 px-4">
                                @if($item->image)
                                    <img src="{{ Storage::url($item->image) }}" alt="{{ $item->title }}" class="w-16 h-10 object-cover rounded">
                                @else
                                    <div class="w-16 h-10 bg-gray-200 rounded flex items-center justify-center text-gray-400 text-xs">N/A</div>
                                @endif
                            </td>
                            <td class="py-3 px-4">{{ Str::limit($item->title, 45) }}</td>
                            <td class="py-3 px-4"><span class="badge-primary text-xs px-2 py-1 rounded-full">{{ $item->category }}</span></td>
                            <td class="py-3 px-4">
                                <span class="badge-{{ $item->status === 'published' ? 'success' : 'warning' }} text-xs px-2 py-1 rounded-full">{{ ucfirst($item->status) }}</span>
                            </td>
                            <td class="py-3 px-4">
                                @if($item->is_featured)
                                    <span class="badge-info text-xs px-2 py-1 rounded-full">Ya</span>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="py-3 px-4">{{ $item->views ?? 0 }}</td>
                            <td class="py-3 px-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.berita.edit', $item) }}" class="text-blue-600 hover:text-blue-800" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form method="POST" action="{{ route('admin.berita.toggle-status', $item) }}" class="inline">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="{{ $item->status === 'published' ? 'text-yellow-600 hover:text-yellow-800' : 'text-green-600 hover:text-green-800' }}" title="{{ $item->status === 'published' ? 'Unpublish' : 'Publish' }}">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        </button>
                                    </form>
                                    <button onclick="confirmDelete('{{ route('admin.berita.destroy', $item) }}')" class="text-red-600 hover:text-red-800" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="py-8 text-center text-gray-400">Tidak ada data berita</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($berita->hasPages())
            <div class="px-4 py-3 border-t border-gray-100">{{ $berita->withQueryString()->links() }}</div>
        @endif
    </div>
</div>

<form id="delete-form" method="POST" class="hidden">@csrf @method('DELETE')</form>

@push('scripts')
<script>
function confirmDelete(url) {
    Swal.fire({
        title: 'Hapus Berita?',
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
