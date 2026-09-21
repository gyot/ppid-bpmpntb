@extends('admin.layouts.app')

@section('title', 'Edit SOP')

@section('breadcrumb')
    <a href="{{ route('admin.sop.index') }}" class="hover:text-primary">SOP</a>
    <svg class="w-4 h-4 inline" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
    <span class="text-gray-900">Edit</span>
@endsection

@section('content')
<div class="max-w-4xl">
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Edit SOP</h1>

    <form action="{{ route('admin.sop.update', $item) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="card bg-white rounded-lg shadow p-6 space-y-4">
            <h2 class="text-lg font-semibold text-gray-900 border-b pb-2">Data SOP</h2>

            <div>
                <label class="input-label block text-sm font-medium text-gray-700 mb-1">Judul SOP <span class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ old('title', $item->title) }}" required class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary @error('title') border-red-500 @enderror">
                @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="input-label block text-sm font-medium text-gray-700 mb-1">Deskripsi <span class="text-red-500">*</span></label>
                <textarea name="deskripsi" rows="3" required class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary @error('deskripsi') border-red-500 @enderror">{{ old('deskripsi', $item->deskripsi) }}</textarea>
                @error('deskripsi')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="input-label block text-sm font-medium text-gray-700 mb-1">Konten / Langkah-langkah SOP <span class="text-red-500">*</span></label>
                <textarea name="konten" rows="10" required class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary @error('konten') border-red-500 @enderror">{{ old('konten', $item->konten) }}</textarea>
                @error('konten')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="input-label block text-sm font-medium text-gray-700 mb-1">Icon</label>
                    <input type="text" name="icon" value="{{ old('icon', $item->icon) }}" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
                </div>
                <div>
                    <label class="input-label block text-sm font-medium text-gray-700 mb-1">Urutan</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $item->sort_order) }}" min="0" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
                </div>
                <div>
                    <label class="input-label block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="is_active" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
                        <option value="1" {{ old('is_active', $item->is_active ? 1 : 0) == 1 ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ old('is_active', $item->is_active ? 1 : 0) == 0 ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="btn-primary px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 text-sm">Perbarui</button>
            <a href="{{ route('admin.sop.index') }}" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 text-sm">Batal</a>
        </div>
    </form>
</div>
@endsection
