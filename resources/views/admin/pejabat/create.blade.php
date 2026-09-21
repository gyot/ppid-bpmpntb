@extends('admin.layouts.app')
@section('title', 'Tambah Pejabat')

@section('content')
<h1 class="text-2xl font-bold text-gray-900 mb-6">Tambah Pejabat</h1>

<form method="POST" action="{{ route('admin.pejabat.store') }}" enctype="multipart/form-data" class="space-y-6">
    @csrf
    <div class="bg-white rounded-lg shadow p-6 space-y-5">
        <div class="grid sm:grid-cols-2 gap-5">
            <div>
                <label class="input-label">Nama Lengkap <span class="text-red-500">*</span></label>
                <input type="text" name="nama" value="{{ old('nama') }}" class="input-field w-full" required>
                @error('nama') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="input-label">Jabatan <span class="text-red-500">*</span></label>
                <input type="text" name="jabatan" value="{{ old('jabatan') }}" class="input-field w-full" required>
                @error('jabatan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>
        <div class="grid sm:grid-cols-2 gap-5">
            <div>
                <label class="input-label">Foto</label>
                <x-image-upload name="foto" />
                @error('foto') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="input-label">Urutan Tampil</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" class="input-field w-full" min="0">
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <x-quill-editor name="keterangan" :value="old('keterangan')" label="Keterangan (Bio / Riwayat Singkat)" height="200px" />
    </div>

    <div class="flex gap-3">
        <button type="submit" class="btn-primary">Simpan</button>
        <a href="{{ route('admin.pejabat.index') }}" class="btn-secondary">Batal</a>
    </div>
</form>
@endsection
