@extends('admin.layouts.app')
@section('title', 'Kelola Pejabat')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Kelola Pejabat</h1>
    <a href="{{ route('admin.pejabat.create') }}" class="btn-primary btn-sm">+ Tambah Pejabat</a>
</div>

@if(session('success'))
<div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg text-green-700 text-sm">{{ session('success') }}</div>
@endif

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="table-custom w-full">
        <thead>
            <tr>
                <th class="px-4 py-3">Foto</th>
                <th class="px-4 py-3">Nama</th>
                <th class="px-4 py-3">Jabatan</th>
                <th class="px-4 py-3">Urutan</th>
                <th class="px-4 py-3">Status</th>
                <th class="px-4 py-3 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pejabats as $item)
            <tr class="border-b border-gray-100 hover:bg-gray-50">
                <td class="px-4 py-3">
                    @if($item->foto)
                        <img src="{{ $item->foto_url }}" class="w-10 h-10 rounded-full object-cover">
                    @else
                        <div class="w-10 h-10 rounded-full bg-primary/10 text-primary flex items-center justify-center text-sm font-bold">{{ $item->initials }}</div>
                    @endif
                </td>
                <td class="px-4 py-3 font-medium text-gray-900">{{ $item->nama }}</td>
                <td class="px-4 py-3 text-sm text-gray-600">{{ $item->jabatan }}</td>
                <td class="px-4 py-3 text-sm">{{ $item->sort_order }}</td>
                <td class="px-4 py-3">
                    <form method="POST" action="{{ route('admin.pejabat.toggle-active', $item) }}" class="inline">@csrf
                        <button type="submit" class="text-xs px-2 py-1 rounded-full {{ $item->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">{{ $item->is_active ? 'Aktif' : 'Nonaktif' }}</button>
                    </form>
                </td>
                <td class="px-4 py-3 text-right">
                    <div class="flex items-center justify-end gap-2">
                        <a href="{{ route('admin.pejabat.edit', $item) }}" class="text-blue-600 hover:text-blue-800 text-sm">Edit</a>
                        <form method="POST" action="{{ route('admin.pejabat.destroy', $item) }}" class="inline" onsubmit="return confirm('Hapus pejabat ini?')">@csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="px-4 py-8 text-center text-gray-400">Belum ada data pejabat.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $pejabats->links() }}</div>
@endsection
