@extends('admin.layouts.app')

@section('title', 'Upload Massal Informasi Publik')

@section('breadcrumb')
    <a href="{{ route('admin.informasi.index') }}" class="hover:text-primary">Informasi Publik</a>
    <svg class="w-4 h-4 inline" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
    <span class="text-gray-900">Upload Massal</span>
@endsection

@section('content')
<div class="max-w-4xl">
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Upload Massal Informasi Publik</h1>

    <form action="{{ route('admin.informasi.bulk-store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="card bg-white rounded-lg shadow p-6 space-y-4">
            <h2 class="text-lg font-semibold text-gray-900 border-b pb-2">Pengaturan Dokumen</h2>
            <p class="text-sm text-gray-500">Pengaturan ini akan diterapkan ke semua file yang diupload. Judul dan deskripsi akan otomatis diambil dari nama file.</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="input-label block text-sm font-medium text-gray-700 mb-1">Kategori <span class="text-red-500">*</span></label>
                    <select name="category" required class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary @error('category') border-red-500 @enderror">
                        <option value="">Pilih Kategori</option>
                        <option value="berkala" {{ old('category') == 'berkala' ? 'selected' : '' }}>Informasi Berkala</option>
                        <option value="serta_merta" {{ old('category') == 'serta_merta' ? 'selected' : '' }}>Informasi Serta Merta</option>
                        <option value="setiap_saat" {{ old('category') == 'setiap_saat' ? 'selected' : '' }}>Informasi Setiap Saat</option>
                        <option value="dikecualikan" {{ old('category') == 'dikecualikan' ? 'selected' : '' }}>Informasi Dikecualikan</option>
                    </select>
                    @error('category')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="input-label block text-sm font-medium text-gray-700 mb-1">Tahun <span class="text-red-500">*</span></label>
                    <select name="year" required class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary @error('year') border-red-500 @enderror">
                        @for($y = date('Y'); $y >= 2020; $y--)
                            <option value="{{ $y }}" {{ old('year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endfor
                    </select>
                    @error('year')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="input-label block text-sm font-medium text-gray-700 mb-1">Unit Pengelola</label>
                    <input type="text" name="unit_pengelola" value="{{ old('unit_pengelola') }}" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary @error('unit_pengelola') border-red-500 @enderror">
                    @error('unit_pengelola')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="input-label block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="card bg-white rounded-lg shadow p-6 space-y-4">
            <h2 class="text-lg font-semibold text-gray-900 border-b pb-2">Upload File</h2>

            <div
                x-data="{ files: [] }"
                x-on:dragover.prevent="$el.classList.add('border-primary', 'bg-primary/5')"
                x-on:dragleave.prevent="$el.classList.remove('border-primary', 'bg-primary/5')"
                x-on:drop.prevent="
                    $el.classList.remove('border-primary', 'bg-primary/5');
                    const dropped = Array.from($event.dataTransfer.files);
                    files = [...files, ...dropped];
                    $refs.fileInput.files = $event.dataTransfer.files;
                "
                class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center transition-colors"
            >
                <svg class="w-12 h-12 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                </svg>
                <p class="text-gray-600 mb-2">Drag & drop file di sini, atau</p>
                <label class="inline-block cursor-pointer">
                    <span class="btn-primary px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 text-sm">Pilih File</span>
                    <input
                        x-ref="fileInput"
                        type="file"
                        name="files[]"
                        multiple
                        accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx"
                        class="hidden"
                        x-on:change="files = Array.from($event.target.files)"
                        required
                    >
                </label>
                <p class="text-xs text-gray-500 mt-2">Format: PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX. Maks: 10MB per file</p>

                <template x-if="files.length > 0">
                    <div class="mt-4 text-left">
                        <p class="text-sm font-medium text-gray-700 mb-2" x-text="files.length + ' file dipilih:'"></p>
                        <ul class="space-y-1 max-h-48 overflow-y-auto">
                            <template x-for="(file, i) in files" :key="i">
                                <li class="flex items-center justify-between text-sm text-gray-600 bg-gray-50 rounded px-3 py-1.5">
                                    <span x-text="file.name" class="truncate mr-2"></span>
                                    <span x-text="(file.size / 1024 / 1024).toFixed(2) + ' MB'" class="text-gray-400 text-xs flex-shrink-0"></span>
                                </li>
                            </template>
                        </ul>
                    </div>
                </template>
            </div>
            @error('files')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            @error('files.*')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="btn-primary px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 text-sm">
                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                Upload Semua
            </button>
            <a href="{{ route('admin.informasi.index') }}" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 text-sm">Batal</a>
        </div>
    </form>
</div>
@endsection
