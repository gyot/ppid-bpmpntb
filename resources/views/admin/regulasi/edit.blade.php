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

            <div>
                <label class="input-label block text-sm font-medium text-gray-700 mb-1">Judul <span class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ old('title', $item->title) }}" required class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary @error('title') border-red-500 @enderror">
                @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="input-label block text-sm font-medium text-gray-700 mb-1">Nomor</label>
                    <input type="text" name="nomor" value="{{ old('nomor', $item->nomor) }}" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
                </div>
                <div>
                    <label class="input-label block text-sm font-medium text-gray-700 mb-1">Pembuat</label>
                    <input type="text" name="pembuat" value="{{ old('pembuat', $item->pembuat) }}" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="input-label block text-sm font-medium text-gray-700 mb-1">Kategori <span class="text-red-500">*</span></label>
                    <select name="kategori" required class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
                        <option value="uu" {{ old('kategori', $item->kategori) == 'uu' ? 'selected' : '' }}>Undang-Undang</option>
                        <option value="pp" {{ old('kategori', $item->kategori) == 'pp' ? 'selected' : '' }}>Peraturan Pemerintah</option>
                        <option value="perma" {{ old('kategori', $item->kategori) == 'perma' ? 'selected' : '' }}>Peraturan MA</option>
                        <option value="perki" {{ old('kategori', $item->kategori) == 'perki' ? 'selected' : '' }}>Peraturan KI</option>
                        <option value="permendikbud" {{ old('kategori', $item->kategori) == 'permendikbud' ? 'selected' : '' }}>Permendikbud</option>
                        <option value="lainnya" {{ old('kategori', $item->kategori) == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>
                <div>
                    <label class="input-label block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                    <input type="date" name="tanggal" value="{{ old('tanggal', $item->tanggal?->format('Y-m-d')) }}" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
                </div>
            </div>

            <div>
                <label class="input-label block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea name="deskripsi" rows="3" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">{{ old('deskripsi', $item->deskripsi) }}</textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="input-label block text-sm font-medium text-gray-700 mb-1">File</label>
                    @if($item->file_path)
                        <p class="text-sm text-gray-500 mb-1">File: <a href="{{ Storage::url($item->file_path) }}" target="_blank" class="text-primary hover:underline">{{ $item->file_name }}</a></p>
                    @endif
                    <input type="file" name="file" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
                </div>
                <div>
                    <label class="input-label block text-sm font-medium text-gray-700 mb-1">Link Eksternal</label>
                    <input type="url" name="link_eksternal" value="{{ old('link_eksternal', $item->link_eksternal) }}" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
                </div>
            </div>

            <div>
                <label class="input-label block text-sm font-medium text-gray-700 mb-1">Status</label>
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
