@extends('admin.layouts.app')

@section('title', 'Edit Pengadaan')

@section('breadcrumb')
    <a href="{{ route('admin.pengadaan.index') }}" class="hover:text-primary">Pengadaan B&J</a>
    <svg class="w-4 h-4 inline" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
    <span class="text-gray-900">Edit</span>
@endsection

@section('content')
<div class="max-w-4xl">
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Edit Data Pengadaan</h1>

    <form action="{{ route('admin.pengadaan.update', $item) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="card bg-white rounded-lg shadow p-6 space-y-4">
            <h2 class="text-lg font-semibold text-gray-900 border-b pb-2">Data Pengadaan</h2>

            <div>
                <label class="input-label block text-sm font-medium text-gray-700 mb-1">Nama Paket <span class="text-red-500">*</span></label>
                <input type="text" name="nama_paket" value="{{ old('nama_paket', $item->nama_paket) }}" required class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary @error('nama_paket') border-red-500 @enderror">
                @error('nama_paket')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="input-label block text-sm font-medium text-gray-700 mb-1">Tahap <span class="text-red-500">*</span></label>
                    <select name="tahap" required class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
                        <option value="rencana" {{ old('tahap', $item->tahap) == 'rencana' ? 'selected' : '' }}>Rencana</option>
                        <option value="pemilihan" {{ old('tahap', $item->tahap) == 'pemilihan' ? 'selected' : '' }}>Pemilihan</option>
                        <option value="pelaksanaan" {{ old('tahap', $item->tahap) == 'pelaksanaan' ? 'selected' : '' }}>Pelaksanaan</option>
                    </select>
                </div>
                <div>
                    <label class="input-label block text-sm font-medium text-gray-700 mb-1">Tahun <span class="text-red-500">*</span></label>
                    <select name="tahun" required class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
                        @for($y = date('Y') + 1; $y >= 2020; $y--)
                            <option value="{{ $y }}" {{ old('tahun', $item->tahun) == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endfor
                    </select>
                </div>
                <div>
                    <label class="input-label block text-sm font-medium text-gray-700 mb-1">Nilai Pagu (Rp)</label>
                    <input type="number" name="nilai_pagu" value="{{ old('nilai_pagu', $item->nilai_pagu) }}" step="0.01" min="0" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="input-label block text-sm font-medium text-gray-700 mb-1">Penyedia</label>
                    <input type="text" name="penyedia" value="{{ old('penyedia', $item->penyedia) }}" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
                </div>
                <div>
                    <label class="input-label block text-sm font-medium text-gray-700 mb-1">No. Kontrak</label>
                    <input type="text" name="no_kontrak" value="{{ old('no_kontrak', $item->no_kontrak) }}" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="input-label block text-sm font-medium text-gray-700 mb-1">Tanggal Kontrak</label>
                    <input type="date" name="tanggal_kontrak" value="{{ old('tanggal_kontrak', $item->tanggal_kontrak?->format('Y-m-d')) }}" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
                </div>
                <div>
                    <label class="input-label block text-sm font-medium text-gray-700 mb-1">File</label>
                    @if($item->file_path)
                        <p class="text-sm text-gray-500 mb-1">File: <a href="{{ '/' . $item->file_path }}" target="_blank" class="text-primary hover:underline">{{ $item->file_name }}</a></p>
                    @endif
                    <input type="file" name="file" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
                </div>
            </div>

            <div>
                <label class="input-label block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea name="deskripsi" rows="3" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">{{ old('deskripsi', $item->deskripsi) }}</textarea>
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
            <a href="{{ route('admin.pengadaan.index') }}" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 text-sm">Batal</a>
        </div>
    </form>
</div>
@endsection
