@extends('admin.layouts.app')

@section('title', 'Timeline Kalender Program')

@section('breadcrumb')
    <a href="{{ route('admin.calendar-programs.index') }}" class="hover:text-primary">Kalender Program</a>
    <svg class="w-4 h-4 inline" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
    <span class="text-gray-900">Timeline</span>
@endsection

@section('content')
<div class="space-y-6" x-data="timelineApp()">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h1 class="text-2xl font-bold text-gray-900">Timeline Kalender Program</h1>
        <div class="flex flex-wrap items-center gap-2">
            <a href="{{ route('admin.calendar-programs.create') }}" class="inline-flex items-center px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 text-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                Tambah Program
            </a>
            <a href="{{ route('admin.calendar-programs.import.form') }}" class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 text-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                Import Excel
            </a>
            <a href="{{ route('admin.calendar-programs.export') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                Export Excel
            </a>
            <button onclick="window.print()" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 text-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                Print
            </button>
        </div>
    </div>

    <div class="card bg-white rounded-lg shadow p-4 print:shadow-none">
        <form method="GET" class="grid grid-cols-1 sm:grid-cols-5 gap-3 print:hidden">
            <select name="tahun" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
                <option value="">Semua Tahun</option>
                @for($y = date('Y') + 1; $y >= 2020; $y--)
                    <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>{{ $y }}</option>
                @endfor
            </select>
            <select name="penanggung_jawab" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
                <option value="">Semua Penanggung Jawab</option>
                @foreach($penanggungJawabs ?? [] as $pj)
                    <option value="{{ $pj }}" {{ request('penanggung_jawab') == $pj ? 'selected' : '' }}>{{ $pj }}</option>
                @endforeach
            </select>
            <select name="status" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
                <option value="">Semua Status</option>
                <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
            </select>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari program..." class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
            <div class="flex gap-2">
                <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 text-sm">Filter</button>
                <a href="{{ route('admin.calendar-programs.timeline') }}" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 text-sm">Reset</a>
            </div>
        </form>
    </div>

    <div class="card bg-white rounded-lg shadow overflow-hidden print:shadow-none">
        <div class="overflow-x-auto">
            <table class="calendar-table w-full text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="col-uraian text-left py-3 px-4 font-medium text-gray-500 bg-gray-50">Uraian Kegiatan</th>
                            @php $monthAbbr = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des']; @endphp
                            @foreach($monthAbbr as $m)
                                <th class="text-center py-3 px-2 font-medium text-gray-500 bg-gray-50">{{ $m }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($programs as $item)
                            <tr class="border-b border-gray-100 hover:bg-gray-50 cursor-pointer" @click="openDetail({{ json_encode($item) }})">
                                <td class="col-uraian text-left py-2.5 px-4 text-gray-700 bg-white">{{ Str::limit($item->uraian_kegiatan, 60) }}</td>
                                @for($m = 1; $m <= 12; $m++)
                                    @if(in_array($m, $item->bulan_array ?? []))
                                        <td class="text-center py-2.5 px-2" style="background-color: {{ $item->pj_color ?? '#2563eb' }};"></td>
                                    @else
                                        <td class="text-center py-2.5 px-2 bg-gray-50/50"></td>
                                    @endif
                                @endfor
                            </tr>
                        @empty
                            <tr><td colspan="13" class="py-8 text-center text-gray-400">Tidak ada data program</td></tr>
                        @endforelse
                </tbody>
            </table>
        </div>
        @if($programs->hasPages())
            <div class="px-4 py-3 border-t border-gray-100 print:hidden">{{ $programs->withQueryString()->links() }}</div>
        @endif
    </div>

    <div x-show="showModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm" @click.self="showModal = false" x-transition>
        <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full mx-4 max-h-[80vh] overflow-y-auto" @click.stop>
            <div class="flex items-center justify-between p-5 border-b border-gray-100">
                <h3 class="text-lg font-bold text-navy">Detail Program</h3>
                <button @click="showModal = false" class="p-1 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <div class="p-5 space-y-4" x-show="selectedProgram">
                <div class="space-y-3">
                    <div class="flex items-start gap-3">
                        <span class="text-sm text-gray-500 w-40 flex-shrink-0">Tahun</span>
                        <span class="text-sm font-medium text-navy" x-text="selectedProgram?.tahun"></span>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="text-sm text-gray-500 w-40 flex-shrink-0">Status</span>
                        <span class="text-sm font-medium" :class="selectedProgram?.status === 'aktif' ? 'text-green-600' : 'text-red-600'" x-text="selectedProgram?.status ? selectedProgram.status.charAt(0).toUpperCase() + selectedProgram.status.slice(1) : ''"></span>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="text-sm text-gray-500 w-40 flex-shrink-0">Penanggung Jawab</span>
                        <span class="text-sm font-medium text-navy" x-text="selectedProgram?.penanggung_jawab"></span>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="text-sm text-gray-500 w-40 flex-shrink-0">Uraian Kegiatan</span>
                        <span class="text-sm font-medium text-navy" x-text="selectedProgram?.uraian_kegiatan"></span>
                    </div>
                    <div x-show="selectedProgram?.deskripsi" class="flex items-start gap-3">
                        <span class="text-sm text-gray-500 w-40 flex-shrink-0">Deskripsi</span>
                        <span class="text-sm text-gray-700" x-text="selectedProgram?.deskripsi"></span>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="text-sm text-gray-500 w-40 flex-shrink-0">Anggaran</span>
                        <span class="text-sm font-medium text-navy" x-text="selectedProgram?.formatted_anggaran ?? 'Rp 0'"></span>
                    </div>
                </div>
                <div class="pt-3 border-t border-gray-100">
                    <span class="text-sm text-gray-500 mb-2 block">Bulan Pelaksanaan</span>
                    <div class="flex flex-wrap gap-1.5">
                        <template x-for="b in (selectedProgram?.bulan_array ?? [])" :key="b">
                            <span class="inline-block text-xs px-2.5 py-1 rounded-full font-medium text-white" :style="'background-color:' + (selectedProgram?.pj_color ?? '#2563eb')" x-text="['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'][b-1]"></span>
                        </template>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-2 p-5 border-t border-gray-100">
                <a :href="'{{ url('admin/calendar-programs') }}/' + selectedProgram?.id" class="px-4 py-2 bg-primary text-white rounded-lg text-sm hover:bg-primary/90">Lihat Detail</a>
                <a :href="'{{ url('admin/calendar-programs') }}/' + selectedProgram?.id + '/edit'" class="px-4 py-2 border border-primary text-primary rounded-lg text-sm hover:bg-primary/5">Edit</a>
                <button @click="showModal = false" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg text-sm hover:bg-gray-50">Tutup</button>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.calendar-table { table-layout: fixed; width: 100%; }
.calendar-table th, .calendar-table td { text-align: center; min-width: 50px; }
.calendar-table .col-uraian { position: sticky; left: 0; z-index: 10; background: white; min-width: 250px; text-align: left; }
.calendar-table thead th { position: sticky; top: 0; z-index: 20; }
@media print {
    .calendar-table .col-uraian { position: static; }
    @page { size: landscape; margin: 1cm; }
}
</style>
@endpush

@push('scripts')
<script>
function timelineApp() {
    return {
        showModal: false,
        selectedProgram: null,
        openDetail(program) {
            this.selectedProgram = program;
            this.showModal = true;
        }
    };
}
</script>
@endpush
@endsection
