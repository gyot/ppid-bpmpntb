@extends('admin.layouts.app')

@section('title', 'Tambah DIP')

@section('breadcrumb')
    <a href="{{ route('admin.dip.index') }}" class="hover:text-primary">DIP</a>
    <svg class="w-4 h-4 inline" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
    <span class="text-gray-900">Tambah</span>
@endsection

@section('content')
<div class="max-w-4xl">
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Tambah Daftar Informasi Publik</h1>

    <form action="{{ route('admin.dip.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="card bg-white rounded-lg shadow p-6 space-y-4">
            <h2 class="text-lg font-semibold text-gray-900 border-b pb-2">Data DIP</h2>

            <div>
                <label class="input-label block text-sm font-medium text-gray-700 mb-1">Judul Informasi <span class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}" required class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary @error('title') border-red-500 @enderror">
                @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="input-label block text-sm font-medium text-gray-700 mb-1">Kategori <span class="text-red-500">*</span></label>
                    <select name="category" required class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary @error('category') border-red-500 @enderror">
                        <option value="">Pilih Kategori</option>
                        <option value="berkala" {{ old('category') == 'berkala' ? 'selected' : '' }}>Berkala</option>
                        <option value="setiap_saat" {{ old('category') == 'setiap_saat' ? 'selected' : '' }}>Setiap Saat</option>
                        <option value="serta_merta" {{ old('category') == 'serta_merta' ? 'selected' : '' }}>Serta Merta</option>
                        <option value="dikecualikan" {{ old('category') == 'dikecualikan' ? 'selected' : '' }}>Dikecualikan</option>
                    </select>
                    @error('category')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="input-label block text-sm font-medium text-gray-700 mb-1">Jenis Informasi <span class="text-red-500">*</span></label>
                    <input type="text" name="jenis_informasi" value="{{ old('jenis_informasi') }}" required class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary @error('jenis_informasi') border-red-500 @enderror">
                    @error('jenis_informasi')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <div>
                <label class="input-label block text-sm font-medium text-gray-700 mb-1">Uraian Informasi</label>
                <textarea name="uraian_informasi" rows="4" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary @error('uraian_informasi') border-red-500 @enderror">{{ old('uraian_informasi') }}</textarea>
                @error('uraian_informasi')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="input-label block text-sm font-medium text-gray-700 mb-1">Sumber Informasi</label>
                    <input type="text" name="sumber_informasi" value="{{ old('sumber_informasi') }}" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary @error('sumber_informasi') border-red-500 @enderror">
                    @error('sumber_informasi')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="input-label block text-sm font-medium text-gray-700 mb-1">Media Informasi</label>
                    <input type="text" name="media_informasi" value="{{ old('media_informasi') }}" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary @error('media_informasi') border-red-500 @enderror">
                    @error('media_informasi')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="input-label block text-sm font-medium text-gray-700 mb-1">JKD</label>
                    <input type="text" name="jkd" value="{{ old('jkd') }}" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary @error('jkd') border-red-500 @enderror">
                    @error('jkd')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <div>
                <label class="input-label block text-sm font-medium text-gray-700 mb-1">File</label>
                <input type="file" name="file" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary @error('file') border-red-500 @enderror">
                @error('file')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="input-label block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                </select>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="btn-primary px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 text-sm">Simpan</button>
            <a href="{{ route('admin.dip.index') }}" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 text-sm">Batal</a>
        </div>
    </form>
</div>
@endsection
