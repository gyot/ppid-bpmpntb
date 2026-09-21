@extends('admin.layouts.app')

@section('title', 'Tambah Program')

@section('breadcrumb')
    <a href="{{ route('admin.program.index') }}" class="hover:text-primary">Program & Kegiatan</a>
    <svg class="w-4 h-4 inline" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
    <span class="text-gray-900">Tambah</span>
@endsection

@section('content')
<div class="max-w-4xl">
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Tambah Program / Kegiatan</h1>

    <form action="{{ route('admin.program.store') }}" method="POST" class="space-y-6">
        @csrf

        <div class="card bg-white rounded-lg shadow p-6 space-y-4">
            <h2 class="text-lg font-semibold text-gray-900 border-b pb-2">Data Program</h2>

            <div>
                <label class="input-label block text-sm font-medium text-gray-700 mb-1">Nama Program <span class="text-red-500">*</span></label>
                <input type="text" name="nama_program" value="{{ old('nama_program') }}" required class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary @error('nama_program') border-red-500 @enderror">
                @error('nama_program')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="input-label block text-sm font-medium text-gray-700 mb-1">Jenis <span class="text-red-500">*</span></label>
                    <select name="jenis" required class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary @error('jenis') border-red-500 @enderror">
                        <option value="">Pilih Jenis</option>
                        <option value="program" {{ old('jenis') == 'program' ? 'selected' : '' }}>Program</option>
                        <option value="kegiatan" {{ old('jenis') == 'kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                        <option value="strategis" {{ old('jenis') == 'strategis' ? 'selected' : '' }}>Strategis</option>
                    </select>
                    @error('jenis')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="input-label block text-sm font-medium text-gray-700 mb-1">Tahun <span class="text-red-500">*</span></label>
                    <select name="tahun" required class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary @error('tahun') border-red-500 @enderror">
                        @for($y = date('Y') + 1; $y >= 2020; $y--)
                            <option value="{{ $y }}" {{ old('tahun') == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endfor
                    </select>
                    @error('tahun')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="input-label block text-sm font-medium text-gray-700 mb-1">Penanggung Jawab</label>
                    <input type="text" name="penanggung_jawab" value="{{ old('penanggung_jawab') }}" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
                </div>
                <div>
                    <label class="input-label block text-sm font-medium text-gray-700 mb-1">Target</label>
                    <input type="text" name="target" value="{{ old('target') }}" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="input-label block text-sm font-medium text-gray-700 mb-1">Jadwal</label>
                    <input type="text" name="jadwal" value="{{ old('jadwal') }}" placeholder="Jan - Des 2026" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
                </div>
                <div>
                    <label class="input-label block text-sm font-medium text-gray-700 mb-1">Sumber Anggaran</label>
                    <input type="text" name="sumber_anggaran" value="{{ old('sumber_anggaran') }}" placeholder="APBN" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
                </div>
            </div>

            <div>
                <label class="input-label block text-sm font-medium text-gray-700 mb-1">Besaran Anggaran (Rp)</label>
                <input type="number" name="besaran_anggaran" value="{{ old('besaran_anggaran') }}" step="0.01" min="0" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary @error('besaran_anggaran') border-red-500 @enderror">
                @error('besaran_anggaran')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="input-label block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea name="deskripsi" rows="4" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">{{ old('deskripsi') }}</textarea>
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
            <a href="{{ route('admin.program.index') }}" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 text-sm">Batal</a>
        </div>
    </form>
</div>
@endsection
