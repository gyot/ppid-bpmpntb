@extends('admin.layouts.app')

@section('title', 'Detail Pesan')

@section('breadcrumb')
    <a href="{{ route('admin.pesan.index') }}" class="hover:text-primary">Pesan Kontak</a>
    <svg class="w-4 h-4 inline" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
    <span class="text-gray-900">Detail</span>
@endsection

@section('content')
<div class="max-w-3xl">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Detail Pesan</h1>
        <button onclick="confirmDelete('{{ route('admin.pesan.destroy', $message) }}')" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 text-sm">Hapus</button>
    </div>

    <div class="card bg-white rounded-lg shadow p-6 space-y-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 border-b pb-4">
            <div>
                <p class="text-xs text-gray-500 uppercase tracking-wider">Pengirim</p>
                <p class="text-sm font-medium text-gray-900 mt-0.5">{{ $message->name }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-500 uppercase tracking-wider">Email</p>
                <p class="text-sm text-gray-900 mt-0.5">
                    <a href="mailto:{{ $message->email }}" class="text-primary hover:underline">{{ $message->email }}</a>
                </p>
            </div>
            <div>
                <p class="text-xs text-gray-500 uppercase tracking-wider">Telepon</p>
                <p class="text-sm text-gray-900 mt-0.5">{{ $message->phone ?? '-' }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-500 uppercase tracking-wider">Tanggal</p>
                <p class="text-sm text-gray-900 mt-0.5">{{ $message->created_at->format('d M Y H:i') }}</p>
            </div>
        </div>

        <div>
            <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Subjek</p>
            <p class="text-base font-semibold text-gray-900">{{ $message->subject }}</p>
        </div>

        <div>
            <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Pesan</p>
            <div class="text-sm text-gray-700 leading-relaxed whitespace-pre-wrap bg-gray-50 rounded-lg p-4">{{ $message->message }}</div>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('admin.pesan.index') }}" class="text-sm text-primary hover:underline">Kembali ke Daftar Pesan</a>
    </div>
</div>

<form id="delete-form" method="POST" action="{{ route('admin.pesan.destroy', $message) }}" class="hidden">@csrf @method('DELETE')</form>

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
            document.getElementById('delete-form').submit();
        }
    });
}
</script>
@endpush
@endsection
