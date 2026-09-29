@extends('admin.layouts.app')

@section('title', 'Edit Kalender Program')

@section('breadcrumb')
    <a href="{{ route('admin.calendar-programs.index') }}" class="hover:text-primary">Kalender Program</a>
    <svg class="w-4 h-4 inline" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
    <span class="text-gray-900">Edit</span>
@endsection

@section('content')
<div class="max-w-4xl">
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Edit Program</h1>

    <form action="{{ route('admin.calendar-programs.update', $program) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="card bg-white rounded-lg shadow p-6 space-y-4">
            <h2 class="text-lg font-semibold text-gray-900 border-b pb-2">Data Program</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tahun <span class="text-red-500">*</span></label>
                    <input type="number" name="tahun" value="{{ old('tahun', $program->tahun) }}" min="2020" max="2099" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary @error('tahun') border-red-500 @enderror">
                    @error('tahun')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Penanggung Jawab <span class="text-red-500">*</span></label>
                    <input type="text" name="penanggung_jawab" value="{{ old('penanggung_jawab', $program->penanggung_jawab) }}" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary @error('penanggung_jawab') border-red-500 @enderror">
                    @error('penanggung_jawab')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Uraian Kegiatan <span class="text-red-500">*</span></label>
                <input type="text" name="uraian_kegiatan" value="{{ old('uraian_kegiatan', $program->uraian_kegiatan) }}" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary @error('uraian_kegiatan') border-red-500 @enderror">
                @error('uraian_kegiatan')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea name="deskripsi" rows="4" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">{{ old('deskripsi', $program->deskripsi) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Bulan Pelaksanaan <span class="text-red-500">*</span></label>
                <div class="flex gap-2 mb-3">
                    <button type="button" onclick="toggleAllMonths(true)" class="text-xs px-3 py-1 bg-primary text-white rounded hover:bg-primary/90">Pilih Semua</button>
                    <button type="button" onclick="toggleAllMonths(false)" class="text-xs px-3 py-1 border border-gray-300 text-gray-700 rounded hover:bg-gray-50">Reset</button>
                </div>
                @php
                    $selectedBulan = old('bulan', $program->bulan_array ?? []);
                @endphp
                <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 gap-3" id="months-grid">
                    @php
                        $months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
                    @endphp
                    @foreach($months as $i => $month)
                        <label class="flex items-center gap-2 p-2 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer">
                            <input type="checkbox" name="bulan[]" value="{{ $i + 1 }}" {{ in_array($i + 1, $selectedBulan) ? 'checked' : '' }} class="rounded border-gray-300 text-primary focus:ring-primary month-checkbox">
                            <span class="text-sm">{{ $month }}</span>
                        </label>
                    @endforeach
                </div>
                @error('bulan')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                @error('bulan.*')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Anggaran (Rp)</label>
                    <div class="relative">
                        <span class="absolute left-3 top-2 text-sm text-gray-500">Rp</span>
                        <input type="number" name="anggaran" value="{{ old('anggaran', $program->anggaran) }}" min="0" step="1" class="w-full border border-gray-300 rounded-lg pl-10 pr-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Urutan</label>
                    <input type="number" name="urutan" value="{{ old('urutan', $program->urutan) }}" min="0" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
                        <option value="aktif" {{ old('status', $program->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ old('status', $program->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 text-sm">Perbarui</button>
            <a href="{{ route('admin.calendar-programs.index') }}" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 text-sm">Batal</a>
        </div>
    </form>
</div>

@push('scripts')
<script>
function toggleAllMonths(checked) {
    document.querySelectorAll('.month-checkbox').forEach(cb => cb.checked = checked);
}
</script>
@endpush
@endsection
