@extends('layouts.app')

@section('title', 'Kalender Program - PPID BPMP NTB')

@section('meta_description', 'Daftar Program BPMP Provinsi Nusa Tenggara Barat - Kalender Program Tahun Anggaran')

@section('content')
<section class="bg-gradient-to-r from-primary to-primary-dark text-white py-12">
    <div class="container-custom">
        <nav class="flex items-center text-sm text-white/70 mb-4" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-white">Beranda</a>
            <svg class="w-4 h-4 mx-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
            <span class="text-white">Kalender Program</span>
        </nav>
        <h1 class="text-2xl lg:text-3xl font-bold">DAFTAR PROGRAM BPMP PROVINSI NUSA TENGGARA BARAT</h1>
        <p class="text-white/80 mt-2 text-lg">TAHUN ANGGARAN {{ $tahun }}</p>
    </div>
</section>

<section class="py-10">
    <div class="container-custom" x-data="publicTimeline()">
        <div class="card bg-white rounded-lg shadow p-4 mb-6">
            <form method="GET" class="grid grid-cols-1 sm:grid-cols-4 gap-3">
                <select name="tahun" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary" onchange="this.form.submit()">
                    @for($y = date('Y') + 1; $y >= 2020; $y--)
                        <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
                <select name="penanggung_jawab" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
                    <option value="">Semua Penanggung Jawab</option>
                    @foreach($penanggungJawabs as $pj)
                        <option value="{{ $pj }}" {{ request('penanggung_jawab') == $pj ? 'selected' : '' }}>{{ $pj }}</option>
                    @endforeach
                </select>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari program..." class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
                <div class="flex gap-2">
                    <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 text-sm">Filter</button>
                    <a href="{{ route('kalender-program') }}" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 text-sm">Reset</a>
                </div>
            </form>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="calendar-table w-full text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="col-pj text-left py-3 px-3 font-medium text-gray-500 bg-gray-50">Penanggung Jawab</th>
                            <th class="col-uraian text-left py-3 px-3 font-medium text-gray-500 bg-gray-50">Uraian Kegiatan</th>
                            @php $monthAbbr = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des']; @endphp
                            @foreach($monthAbbr as $m)
                                <th class="text-center py-3 px-2 font-medium text-gray-500 bg-gray-50">{{ $m }}</th>
                            @endforeach
                            <th class="text-right py-3 px-3 font-medium text-gray-500 bg-gray-50 min-w-[100px]">Anggaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($programs as $item)
                            <tr class="border-b border-gray-100 hover:bg-gray-50 cursor-pointer" @click="openDetail({{ json_encode($item) }})">
                                <td class="col-pj text-left py-2 px-3 font-medium text-gray-900 bg-white">{{ Str::limit($item->penanggung_jawab, 20) }}</td>
                                <td class="col-uraian text-left py-2 px-3 text-gray-700 bg-white">{{ Str::limit($item->uraian_kegiatan, 40) }}</td>
                                @for($m = 1; $m <= 12; $m++)
                                    @if(in_array($m, $item->bulan_array ?? []))
                                        <td class="text-center py-2 px-2" style="background-color: {{ $item->pj_color ?? '#2563eb' }}20;">
                                            <span class="inline-block w-6 h-6 leading-6 rounded text-xs font-bold" style="background-color: {{ $item->pj_color ?? '#2563eb' }}; color: white;">1</span>
                                        </td>
                                    @else
                                        <td class="text-center py-2 px-2 bg-gray-50/50"></td>
                                    @endif
                                @endfor
                                <td class="text-right py-2 px-3 text-gray-700">{{ $item->formatted_anggaran ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="15" class="py-8 text-center text-gray-400">Tidak ada data program untuk tahun {{ $tahun }}</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($programs->hasPages())
            <div class="mt-4">{{ $programs->withQueryString()->links() }}</div>
        @endif

        @include('components.calendar-detail-modal')
    </div>
</section>

@push('styles')
<link rel="stylesheet" href="{{ asset('css/calendar.css') }}">
@endpush

@push('scripts')
<script>
function publicTimeline() {
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
