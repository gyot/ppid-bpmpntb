@extends('admin.layouts.app')

@section('title', 'Kelola FAQ')

@section('breadcrumb')
    <span class="text-gray-900">FAQ</span>
@endsection

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h1 class="text-2xl font-bold text-gray-900">Kelola FAQ</h1>
        <a href="{{ route('admin.faq.create') }}" class="btn-primary inline-flex items-center px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 text-sm">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
            Tambah FAQ
        </a>
    </div>

    <div class="card bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table-custom w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-left py-3 px-4 font-medium text-gray-500 w-10"></th>
                        <th class="text-left py-3 px-4 font-medium text-gray-500">Pertanyaan</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-500">Kategori</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-500">Urutan</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-500">Aktif</th>
                        <th class="text-right py-3 px-4 font-medium text-gray-500">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($faqs as $item)
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="py-3 px-4 text-gray-400 cursor-grab">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"/></svg>
                            </td>
                            <td class="py-3 px-4">{{ Str::limit($item->question, 60) }}</td>
                            <td class="py-3 px-4"><span class="badge-primary text-xs px-2 py-1 rounded-full">{{ $item->category ?? '-' }}</span></td>
                            <td class="py-3 px-4">{{ $item->sort_order }}</td>
                            <td class="py-3 px-4">
                                <form method="POST" action="{{ route('admin.faq.toggle-active', $item) }}" class="inline">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="relative inline-flex h-5 w-9 items-center rounded-full transition-colors {{ $item->is_active ? 'bg-green-500' : 'bg-gray-300' }}">
                                        <span class="inline-block h-3.5 w-3.5 transform rounded-full bg-white transition-transform {{ $item->is_active ? 'translate-x-4' : 'translate-x-1' }}"></span>
                                    </button>
                                </form>
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.faq.edit', $item) }}" class="text-blue-600 hover:text-blue-800" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <button onclick="confirmDelete('{{ route('admin.faq.destroy', $item) }}')" class="text-red-600 hover:text-red-800" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="py-8 text-center text-gray-400">Tidak ada data FAQ</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($faqs->hasPages())
            <div class="px-4 py-3 border-t border-gray-100">{{ $faqs->links() }}</div>
        @endif
    </div>
</div>

<form id="delete-form" method="POST" class="hidden">@csrf @method('DELETE')</form>

@push('scripts')
<script>
function confirmDelete(url) {
    Swal.fire({
        title: 'Hapus FAQ?',
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
