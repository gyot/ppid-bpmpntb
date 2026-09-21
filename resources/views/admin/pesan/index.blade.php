@extends('admin.layouts.app')

@section('title', 'Pesan Kontak')

@section('breadcrumb')
    <span class="text-gray-900">Pesan Kontak</span>
@endsection

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h1 class="text-2xl font-bold text-gray-900">Pesan Kontak</h1>
    </div>

    <div class="card bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table-custom w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-left py-3 px-4 font-medium text-gray-500 w-10"></th>
                        <th class="text-left py-3 px-4 font-medium text-gray-500">Pengirim</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-500">Email</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-500">Subjek</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-500">Tanggal</th>
                        <th class="text-right py-3 px-4 font-medium text-gray-500">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($messages as $item)
                        <tr class="border-b border-gray-100 hover:bg-gray-50 {{ !$item->is_read ? 'bg-blue-50/30' : '' }}">
                            <td class="py-3 px-4">
                                @if(!$item->is_read)
                                    <div class="w-2.5 h-2.5 rounded-full bg-primary"></div>
                                @endif
                            </td>
                            <td class="py-3 px-4 font-medium {{ !$item->is_read ? 'text-gray-900' : 'text-gray-600' }}">{{ $item->name }}</td>
                            <td class="py-3 px-4 {{ !$item->is_read ? 'text-gray-900' : 'text-gray-600' }}">{{ $item->email }}</td>
                            <td class="py-3 px-4 {{ !$item->is_read ? 'font-medium text-gray-900' : 'text-gray-600' }}">{{ Str::limit($item->subject, 50) }}</td>
                            <td class="py-3 px-4 text-gray-500">{{ $item->created_at->format('d M Y H:i') }}</td>
                            <td class="py-3 px-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.pesan.show', $item) }}" class="text-primary hover:text-primary/80" title="Baca">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </a>
                                    <button onclick="confirmDelete('{{ route('admin.pesan.destroy', $item) }}')" class="text-red-600 hover:text-red-800" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="py-8 text-center text-gray-400">Tidak ada pesan</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($messages->hasPages())
            <div class="px-4 py-3 border-t border-gray-100">{{ $messages->links() }}</div>
        @endif
    </div>
</div>

<form id="delete-form" method="POST" class="hidden">@csrf @method('DELETE')</form>

@push('scripts')
<script>
function confirmDelete(url) {
    Swal.fire({
        title: 'Hapus Pesan?',
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
