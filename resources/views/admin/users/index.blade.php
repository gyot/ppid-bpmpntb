@extends('admin.layouts.app')

@section('title', 'Kelola Pengguna')

@section('breadcrumb')
    <span class="text-gray-900">Kelola Pengguna</span>
@endsection

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h1 class="text-2xl font-bold text-gray-900">Kelola Pengguna</h1>
        <a href="{{ route('admin.users.create') }}" class="btn-primary inline-flex items-center px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 text-sm">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
            Tambah Pengguna
        </a>
    </div>

    <div class="card bg-white rounded-lg shadow p-4">
        <form method="GET" class="flex gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari pengguna..." class="input-field flex-1 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
            <button type="submit" class="btn-primary px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 text-sm">Cari</button>
            @if(request('search'))
                <a href="{{ route('admin.users.index') }}" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 text-sm">Reset</a>
            @endif
        </form>
    </div>

    <div class="card bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table-custom w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-left py-3 px-4 font-medium text-gray-500">Nama</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-500">Email</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-500">Role</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-500">Telepon</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-500">Terdaftar</th>
                        <th class="text-right py-3 px-4 font-medium text-gray-500">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="py-3 px-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center text-xs font-medium">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                                    <span>{{ $user->name }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-4">{{ $user->email }}</td>
                            <td class="py-3 px-4">
                                @php
                                    $roleColors = ['admin' => 'danger', 'ppid' => 'primary', 'operator' => 'warning', 'user' => 'info'];
                                @endphp
                                <span class="badge-{{ $roleColors[$user->role] ?? 'info' }} text-xs px-2 py-1 rounded-full">{{ ucfirst($user->role) }}</span>
                            </td>
                            <td class="py-3 px-4">{{ $user->phone ?? '-' }}</td>
                            <td class="py-3 px-4">{{ $user->created_at->format('d M Y') }}</td>
                            <td class="py-3 px-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-600 hover:text-blue-800" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    @if($user->id !== Auth::id())
                                        <button onclick="confirmDelete('{{ route('admin.users.destroy', $user) }}')" class="text-red-600 hover:text-red-800" title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="py-8 text-center text-gray-400">Tidak ada pengguna</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($users->hasPages())
            <div class="px-4 py-3 border-t border-gray-100">{{ $users->links() }}</div>
        @endif
    </div>
</div>

<form id="delete-form" method="POST" class="hidden">@csrf @method('DELETE')</form>

@push('scripts')
<script>
function confirmDelete(url) {
    Swal.fire({
        title: 'Hapus Pengguna?',
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
