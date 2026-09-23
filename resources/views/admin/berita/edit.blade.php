@extends('admin.layouts.app')

@section('title', 'Edit Berita')

@section('breadcrumb')
    <a href="{{ route('admin.berita.index') }}" class="hover:text-primary">Berita</a>
    <svg class="w-4 h-4 inline" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
    <span class="text-gray-900">Edit</span>
@endsection

@section('content')
<div class="max-w-4xl">
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Edit Berita</h1>

    <form action="{{ route('admin.berita.update', $item) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="card bg-white rounded-lg shadow p-6 space-y-4">
            <h2 class="text-lg font-semibold text-gray-900 border-b pb-2">Data Berita</h2>

            <div>
                <label class="input-label block text-sm font-medium text-gray-700 mb-1">Judul <span class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ old('title', $item->title) }}" required class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary @error('title') border-red-500 @enderror">
                @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="input-label block text-sm font-medium text-gray-700 mb-1">Kategori <span class="text-red-500">*</span></label>
                    <select name="category" required class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary @error('category') border-red-500 @enderror">
                        <option value="">Pilih Kategori</option>
                        @foreach(['berita','pengumuman','artikel','kegiatan'] as $cat)
                            <option value="{{ $cat }}" {{ old('category', $item->category) == $cat ? 'selected' : '' }}>{{ ucfirst($cat) }}</option>
                        @endforeach
                    </select>
                    @error('category')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="input-label block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
                        <option value="draft" {{ old('status', $item->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status', $item->status) == 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="input-label block text-sm font-medium text-gray-700 mb-1">Gambar Utama</label>
                @if($item->image)
                    <div class="mb-2">
                        <img src="{{ Storage::url($item->image) }}" alt="{{ $item->title }}" class="w-32 h-20 object-cover rounded">
                    </div>
                @endif
                <input type="file" name="image" accept="image/*" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary @error('image') border-red-500 @enderror">
                @error('image')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="input-label block text-sm font-medium text-gray-700 mb-1">Ringkasan</label>
                <textarea name="excerpt" rows="2" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary @error('excerpt') border-red-500 @enderror">{{ old('excerpt', $item->excerpt) }}</textarea>
                @error('excerpt')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="input-label block text-sm font-medium text-gray-700 mb-1">Isi Berita <span class="text-red-500">*</span></label>
                <textarea name="body" rows="12" required class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary @error('body') border-red-500 @enderror">{{ old('body', $item->body) }}</textarea>
                @error('body')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured', $item->is_featured) ? 'checked' : '' }} class="rounded border-gray-300 text-primary focus:ring-primary">
                <label for="is_featured" class="text-sm text-gray-700">Jadikan Berita Unggulan</label>
            </div>
        </div>

        <div class="card bg-white rounded-lg shadow p-6 space-y-4">
            <h2 class="text-lg font-semibold text-gray-900 border-b pb-2">SEO</h2>
            <div>
                <label class="input-label block text-sm font-medium text-gray-700 mb-1">Meta Title</label>
                <input type="text" name="meta_title" value="{{ old('meta_title', $item->meta_title) }}" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
            </div>
            <div>
                <label class="input-label block text-sm font-medium text-gray-700 mb-1">Meta Description</label>
                <textarea name="meta_description" rows="2" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">{{ old('meta_description', $item->meta_description) }}</textarea>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="btn-primary px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 text-sm">Perbarui</button>
            <a href="{{ route('admin.berita.index') }}" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 text-sm">Batal</a>
        </div>
    </form>
</div>
@endsection
