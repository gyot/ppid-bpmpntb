@extends('admin.layouts.app')

@section('title', 'Tambah LHKPN')

@section('breadcrumb')
    <a href="{{ route('admin.lhkpn.index') }}" class="hover:text-primary">LHKPN</a>
    <svg class="w-4 h-4 inline" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
    <span class="text-gray-900">Tambah</span>
@endsection

@section('content')
<div class="max-w-4xl">
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Tambah Data LHKPN</h1>

    <form action="{{ route('admin.lhkpn.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="card bg-white rounded-lg shadow p-6 space-y-4">
            <h2 class="text-lg font-semibold text-gray-900 border-b pb-2">Data Pejabat</h2>

            <div>
                <label class="input-label block text-sm font-medium text-gray-700 mb-1">Nama Pejabat <span class="text-red-500">*</span></label>
                <input type="text" name="nama_pejabat" value="{{ old('nama_pejabat') }}" required class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary @error('nama_pejabat') border-red-500 @enderror">
                @error('nama_pejabat')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="input-label block text-sm font-medium text-gray-700 mb-1">Jabatan <span class="text-red-500">*</span></label>
                <input type="text" name="jabatan" value="{{ old('jabatan') }}" required class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary @error('jabatan') border-red-500 @enderror">
                @error('jabatan')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="input-label block text-sm font-medium text-gray-700 mb-1">NIP</label>
                    <input type="text" name="nip" value="{{ old('nip') }}" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary @error('nip') border-red-500 @enderror">
                    @error('nip')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="input-label block text-sm font-medium text-gray-700 mb-1">Periode (Tahun) <span class="text-red-500">*</span></label>
                    <select name="periode" required class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary @error('periode') border-red-500 @enderror">
                        @for($y = date('Y'); $y >= 2020; $y--)
                            <option value="{{ $y }}" {{ old('periode') == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endfor
                    </select>
                    @error('periode')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <div>
                <label class="input-label block text-sm font-medium text-gray-700 mb-1">File LHKPN <span class="text-red-500">*</span></label>
                <input type="file" name="file" required class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary @error('file') border-red-500 @enderror">
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
            <a href="{{ route('admin.lhkpn.index') }}" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 text-sm">Batal</a>
        </div>
    </form>
</div>
@endsection
