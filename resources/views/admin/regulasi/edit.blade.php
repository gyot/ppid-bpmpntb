@extends('admin.layouts.app')

@section('title', 'Edit Regulasi')

@section('breadcrumb')
    <a href="{{ route('admin.regulasi.index') }}" class="hover:text-primary">Regulasi</a>
    <svg class="w-4 h-4 inline" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
    <span class="text-gray-900">Edit</span>
@endsection

@section('content')
<div class="max-w-4xl">
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Edit Regulasi</h1>

    <form action="{{ route('admin.regulasi.update', $item) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="card bg-white rounded-lg shadow p-6 space-y-4">
            <h2 class="text-lg font-semibold text-gray-900 border-b pb-2">Data Regulasi</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="input-label block text-sm font-medium text-gray-700 mb-1">Jenis Regulasi <span class="text-red-500">*</span></label>
                    <input type="text" name="kategori" value="{{ old('kategori', $item->kategori) }}" required class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary @error('kategori') border-red-500 @enderror">
                    @error('kategori')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="input-label block text-sm font-medium text-gray-700 mb-1">Nama Peraturan <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $item->title) }}" required class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary @error('title') border-red-500 @enderror">
                    @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <div>
                <label class="input-label block text-sm font-medium text-gray-700 mb-1">Status Berlaku <span class="text-red-500">*</span></label>
                <select name="status_berlaku" required class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary @error('status_berlaku') border-red-500 @enderror">
                    <option value="berlaku" {{ old('status_berlaku', $item->status_berlaku) == 'berlaku' ? 'selected' : '' }}>Berlaku</option>
                    <option value="tidak_berlaku" {{ old('status_berlaku', $item->status_berlaku) == 'tidak_berlaku' ? 'selected' : '' }}>Tidak Berlaku</option>
                </select>
                @error('status_berlaku')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="input-label block text-sm font-medium text-gray-700 mb-1">File (opsional)</label>
                    @if($item->file_path)
                        <p class="text-sm text-gray-500 mb-1">File: <a href="{{ Storage::url($item->file_path) }}" target="_blank" class="text-primary hover:underline">{{ $item->file_name }}</a></p>
                    @endif
                    <input type="file" name="file" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
                </div>
                <div>
                    <label class="input-label block text-sm font-medium text-gray-700 mb-1">Link Eksternal (opsional)</label>
                    <input type="url" name="link_eksternal" value="{{ old('link_eksternal', $item->link_eksternal) }}" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
                </div>
            </div>

            <div>
                <label class="input-label block text-sm font-medium text-gray-700 mb-1">Status Publikasi</label>
                <select name="status" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
                    <option value="draft" {{ old('status', $item->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ old('status', $item->status) == 'published' ? 'selected' : '' }}>Published</option>
                </select>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="btn-primary px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 text-sm">Perbarui</button>
            <a href="{{ route('admin.regulasi.index') }}" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 text-sm">Batal</a>
        </div>
    </form>
</div>
@endsection
