@extends('admin.layouts.app')

@section('title', 'Import Regulasi dari Excel')

@section('breadcrumb')
    <a href="{{ route('admin.regulasi.index') }}" class="hover:text-primary">Regulasi</a>
    <svg class="w-4 h-4 inline" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
    <span class="text-gray-900">Import Excel</span>
@endsection

@section('content')
<div class="max-w-4xl">
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Import Regulasi dari Excel</h1>

    <div class="card bg-white rounded-lg shadow p-6 mb-6">
        <h2 class="text-lg font-semibold text-gray-900 border-b pb-2 mb-4">Format File Excel</h2>
        <p class="text-sm text-gray-600 mb-4">Pastikan file Excel memiliki header kolom sebagai berikut:</p>
        <div class="overflow-x-auto">
            <table class="w-full text-sm border border-gray-200 rounded-lg">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-left py-2 px-3 font-medium text-gray-500 border">Jenis Regulasi</th>
                        <th class="text-left py-2 px-3 font-medium text-gray-500 border">Nama Peraturan</th>
                        <th class="text-left py-2 px-3 font-medium text-gray-500 border">Status Berlaku</th>
                        <th class="text-left py-2 px-3 font-medium text-gray-500 border">Link Eksternal (opsional)</th>
                        <th class="text-left py-2 px-3 font-medium text-gray-500 border">Status Publikasi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="py-2 px-3 border text-gray-500">Undang-Undang</td>
                        <td class="py-2 px-3 border text-gray-500">UU No. 14 Tahun 2008</td>
                        <td class="py-2 px-3 border text-gray-500">Berlaku</td>
                        <td class="py-2 px-3 border text-gray-500">https://...</td>
                        <td class="py-2 px-3 border text-gray-500">Published</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <ul class="mt-4 text-sm text-gray-600 space-y-1">
            <li>- <strong>Jenis Regulasi</strong>: bebas diisi (contoh: Undang-Undang, Peraturan Pemerintah, dll)</li>
            <li>- <strong>Nama Peraturan</strong>: judul lengkap peraturan (wajib)</li>
            <li>- <strong>Status Berlaku</strong>: isi "Berlaku" atau "Tidak Berlaku"</li>
            <li>- <strong>Link Eksternal</strong>: URL dokumen (opsional, kosongkan jika tidak ada)</li>
            <li>- <strong>Status Publikasi</strong>: isi "Published" atau "Draft"</li>
        </ul>
    </div>

    <form action="{{ route('admin.regulasi.import') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="card bg-white rounded-lg shadow p-6 space-y-4">
            <h2 class="text-lg font-semibold text-gray-900 border-b pb-2">Upload File</h2>

            <div>
                <label class="input-label block text-sm font-medium text-gray-700 mb-1">File Excel <span class="text-red-500">*</span></label>
                <input type="file" name="file" accept=".xlsx,.xls,.csv" required class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary @error('file') border-red-500 @enderror">
                <p class="text-xs text-gray-500 mt-1">Format: XLSX, XLS, CSV. Maks: 10MB</p>
                @error('file')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="btn-primary px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 text-sm">
                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                Import
            </button>
            <a href="{{ route('admin.regulasi.index') }}" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 text-sm">Batal</a>
        </div>
    </form>
</div>
@endsection
