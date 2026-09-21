@extends('layouts.app')

@section('title', 'Ringkasan Akses Informasi - PPID BPMP NTB')
@section('meta_description', 'Ringkasan statistik akses informasi publik BPMP NTB')

@push('styles')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4"></script>
@endpush

@section('content')
<div class="page-header">
    <div class="container-custom py-8">
        <h1 class="text-3xl font-bold text-white mb-4">Ringkasan Akses Informasi</h1>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}" class="text-secondary hover:text-white">Beranda</a>
            <span class="mx-2 text-gray-400">/</span>
            <a href="{{ route('laporan.ringkasan-akses') }}" class="text-secondary hover:text-white">Laporan</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-white">Ringkasan Akses Informasi</span>
        </nav>
    </div>
</div>

<section class="py-12 bg-gray-50">
    <div class="container-custom">
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm" style="border-top: 3px solid #F0A800;">
                <div class="text-3xl font-extrabold text-navy mb-1">{{ $stats['total_permohonan'] }}</div>
                <div class="text-sm text-gray-500 font-medium">Total Permohonan</div>
            </div>
            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm" style="border-top: 3px solid #22c55e;">
                <div class="text-3xl font-extrabold text-navy mb-1">{{ $stats['permohonan_diterima'] }}</div>
                <div class="text-sm text-gray-500 font-medium">Diterima</div>
            </div>
            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm" style="border-top: 3px solid #ef4444;">
                <div class="text-3xl font-extrabold text-navy mb-1">{{ $stats['permohonan_ditolak'] }}</div>
                <div class="text-sm text-gray-500 font-medium">Ditolak</div>
            </div>
            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm" style="border-top: 3px solid #3b82f6;">
                <div class="text-3xl font-extrabold text-navy mb-1">{{ $stats['rata_waktu'] }}</div>
                <div class="text-sm text-gray-500 font-medium">Rata-rata Waktu</div>
            </div>
        </div>

        <div class="grid lg:grid-cols-2 gap-8 mb-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-navy mb-4">Permohonan Per Bulan</h3>
                <canvas id="barChart" height="200"></canvas>
            </div>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-navy mb-4">Distribusi Status</h3>
                <canvas id="doughnutChart" height="200"></canvas>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <h3 class="text-lg font-bold text-navy">Detail Per Bulan {{ date('Y') }}</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Bulan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach(['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] as $i => $bulan)
                        <tr>
                            <td class="px-6 py-3 text-sm font-medium text-navy">{{ $bulan }}</td>
                            <td class="px-6 py-3 text-sm text-charcoal">{{ $stats['permohonan_per_bulan'][$i + 1] ?? 0 }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des'];
    const data = @json(array_map(fn($m) => $stats['permohonan_per_bulan'][$m] ?? 0, range(1, 12)));

    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: months,
            datasets: [{
                label: 'Permohonan',
                data: data,
                backgroundColor: 'rgba(26, 54, 93, 0.8)',
                borderRadius: 6,
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
        }
    });

    new Chart(document.getElementById('doughnutChart'), {
        type: 'doughnut',
        data: {
            labels: ['Diterima', 'Ditolak', 'Dalam Proses'],
            datasets: [{
                data: [{{ $stats['permohonan_diterima'] }}, {{ $stats['permohonan_ditolak'] }}, {{ max(0, $stats['total_permohonan'] - $stats['permohonan_diterima'] - $stats['permohonan_ditolak']) }}],
                backgroundColor: ['#22c55e', '#ef4444', '#f59e0b'],
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'bottom' } }
        }
    });
});
</script>
@endpush
