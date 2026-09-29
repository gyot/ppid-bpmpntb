@extends('admin.layouts.app')

@section('title', 'Import Kalender Program')

@section('breadcrumb')
    <a href="{{ route('admin.calendar-programs.index') }}" class="hover:text-primary">Kalender Program</a>
    <svg class="w-4 h-4 inline" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
    <span class="text-gray-900">Import Excel</span>
@endsection

@section('content')
<div class="max-w-4xl">
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Import Kalender Program dari Excel</h1>

    <div class="card bg-white rounded-lg shadow p-6 mb-6">
        <h2 class="text-lg font-semibold text-gray-900 border-b pb-2 mb-4">Format File Excel</h2>
        <p class="text-sm text-gray-600 mb-4">Pastikan file Excel memiliki header kolom sebagai berikut:</p>
        <div class="overflow-x-auto">
            <table class="w-full text-sm border border-gray-200 rounded-lg">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-left py-2 px-3 font-medium text-gray-500 border">Penanggung Jawab</th>
                        <th class="text-left py-2 px-3 font-medium text-gray-500 border">Uraian Kegiatan</th>
                        <th class="text-left py-2 px-3 font-medium text-gray-500 border">Deskripsi</th>
                        <th class="text-left py-2 px-3 font-medium text-gray-500 border">Jan s/d Des (1/0)</th>
                        <th class="text-left py-2 px-3 font-medium text-gray-500 border">Anggaran</th>
                        <th class="text-left py-2 px-3 font-medium text-gray-500 border">Urutan</th>
                        <th class="text-left py-2 px-3 font-medium text-gray-500 border">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="py-2 px-3 border text-gray-500">PAUD</td>
                        <td class="py-2 px-3 border text-gray-500">Monitoring PAUD</td>
                        <td class="py-2 px-3 border text-gray-500">Deskripsi...</td>
                        <td class="py-2 px-3 border text-gray-500">1,0,1,0,0,0,0,0,0,0,0,0</td>
                        <td class="py-2 px-3 border text-gray-500">50000000</td>
                        <td class="py-2 px-3 border text-gray-500">1</td>
                        <td class="py-2 px-3 border text-gray-500">aktif</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <ul class="mt-4 text-sm text-gray-600 space-y-1">
            <li>- <strong>Penanggung Jawab</strong>: nama unit/bidang (wajib)</li>
            <li>- <strong>Uraian Kegiatan</strong>: judul kegiatan (wajib)</li>
            <li>- <strong>Deskripsi</strong>: keterangan tambahan (opsional)</li>
            <li>- <strong>Jan s/d Des</strong>: isi 1 jika aktif di bulan tersebut, 0 jika tidak</li>
            <li>- <strong>Anggaran</strong>: nominal tanpa titik/koma (opsional)</li>
            <li>- <strong>Urutan</strong>: angka urut tampil (opsional, default 0)</li>
            <li>- <strong>Status</strong>: "aktif" atau "nonaktif" (default: aktif)</li>
        </ul>
    </div>

    <form action="{{ route('admin.calendar-programs.import') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="card bg-white rounded-lg shadow p-6 space-y-4">
            <h2 class="text-lg font-semibold text-gray-900 border-b pb-2">Upload File</h2>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tahun <span class="text-red-500">*</span></label>
                <select name="tahun" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary @error('tahun') border-red-500 @enderror">
                    @for($y = date('Y') + 1; $y >= 2020; $y--)
                        <option value="{{ $y }}" {{ old('tahun', date('Y')) == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
                @error('tahun')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">File Excel <span class="text-red-500">*</span></label>
                <input type="file" name="file" accept=".xlsx,.xls" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary @error('file') border-red-500 @enderror">
                <p class="text-xs text-gray-500 mt-1">Format: XLSX, XLS. Maks: 10MB</p>
                @error('file')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 text-sm">
                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                Import
            </button>
            <a href="{{ route('admin.calendar-programs.template') }}" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 text-sm">
                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                Download Template
            </a>
            <a href="{{ route('admin.calendar-programs.index') }}" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 text-sm">Batal</a>
        </div>
    </form>
</div>
@endsection
