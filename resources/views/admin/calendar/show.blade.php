@extends('admin.layouts.app')

@section('title', 'Detail Kalender Program')

@section('breadcrumb')
    <a href="{{ route('admin.calendar-programs.index') }}" class="hover:text-primary">Kalender Program</a>
    <svg class="w-4 h-4 inline" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
    <span class="text-gray-900">Detail</span>
@endsection

@section('content')
<div class="max-w-4xl space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h1 class="text-2xl font-bold text-gray-900">Detail Program</h1>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.calendar-programs.edit', $program) }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 text-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                Edit
            </a>
            <form method="POST" action="{{ route('admin.calendar-programs.duplicate', $program->id) }}" class="inline">
                @csrf
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 text-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                    Duplikat
                </button>
            </form>
            <button onclick="confirmDelete('{{ route('admin.calendar-programs.destroy', $program) }}')" class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 text-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                Hapus
            </button>
        </div>
    </div>

    <div class="card bg-white rounded-lg shadow p-6 space-y-4">
        <h2 class="text-lg font-semibold text-gray-900 border-b pb-2">Informasi Program</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <p class="text-sm text-gray-500 mb-1">Tahun</p>
                <p class="font-medium text-gray-900">{{ $program->tahun }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500 mb-1">Penanggung Jawab</p>
                <p class="font-medium text-gray-900">{{ $program->penanggung_jawab }}</p>
            </div>
            <div class="sm:col-span-2">
                <p class="text-sm text-gray-500 mb-1">Uraian Kegiatan</p>
                <p class="font-medium text-gray-900">{{ $program->uraian_kegiatan }}</p>
            </div>
            @if($program->deskripsi)
            <div class="sm:col-span-2">
                <p class="text-sm text-gray-500 mb-1">Deskripsi</p>
                <p class="text-gray-900">{{ $program->deskripsi }}</p>
            </div>
            @endif
            <div>
                <p class="text-sm text-gray-500 mb-1">Anggaran</p>
                <p class="font-medium text-gray-900">{{ $program->formatted_anggaran ?? 'Rp 0' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500 mb-1">Urutan</p>
                <p class="font-medium text-gray-900">{{ $program->urutan }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500 mb-1">Status</p>
                <span class="text-xs px-2 py-1 rounded-full {{ $program->status == 'aktif' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">{{ ucfirst($program->status) }}</span>
            </div>
        </div>
    </div>

    <div class="card bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold text-gray-900 border-b pb-2 mb-4">Bulan Pelaksanaan</h2>
        <div class="flex flex-wrap gap-2">
            @php
                $monthNames = [1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'Mei',6=>'Jun',7=>'Jul',8=>'Agu',9=>'Sep',10=>'Okt',11=>'Nov',12=>'Des'];
                $activeBulan = $program->bulan_array ?? [];
            @endphp
            @for($m = 1; $m <= 12; $m++)
                @if(in_array($m, $activeBulan))
                    <div class="text-center px-4 py-3 rounded-lg text-white font-bold text-sm" style="background-color: {{ $program->pj_color ?? '#2563eb' }}">
                        {{ $monthNames[$m] }}
                    </div>
                @else
                    <div class="text-center px-4 py-3 rounded-lg bg-gray-100 text-gray-400 text-sm">
                        {{ $monthNames[$m] }}
                    </div>
                @endif
            @endfor
        </div>
    </div>

    <a href="{{ route('admin.calendar-programs.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 text-sm">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali
    </a>
</div>

<form id="delete-form" method="POST" class="hidden">@csrf @method('DELETE')</form>

@push('scripts')
<script>
function confirmDelete(url) {
    Swal.fire({
        title: 'Hapus Program?',
        text: 'Data yang dihapus tidak dapat dikembalikan.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form').action = url;
            document.getElementById('delete-form').submit();
        }
    });
}
</script>
@endpush
@endsection
