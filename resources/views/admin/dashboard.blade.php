@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @php
            $statCards = [
                ['label' => 'Total Informasi', 'value' => $stats['total_informasi'] ?? 0, 'color' => 'primary', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>'],
                ['label' => 'Total Dokumen', 'value' => $stats['total_dokumen'] ?? 0, 'color' => 'secondary', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>'],
                ['label' => 'Total Berita', 'value' => $stats['total_berita'] ?? 0, 'color' => 'accent', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>'],
                ['label' => 'Permohonan Baru', 'value' => $stats['permohonan_baru'] ?? 0, 'color' => 'primary', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>'],
                ['label' => 'Permohonan Diproses', 'value' => $stats['permohonan_diproses'] ?? 0, 'color' => 'secondary', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>'],
                ['label' => 'Keberatan Masuk', 'value' => $stats['keberatan_masuk'] ?? 0, 'color' => 'accent', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>'],
            ];
        @endphp

        @foreach($statCards as $card)
            <div class="card bg-white rounded-lg shadow p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">{{ $card['label'] }}</p>
                        <p class="text-2xl font-bold text-gray-900 mt-1">{{ $card['value'] }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-{{ $card['color'] }}/10 flex items-center justify-center">
                        <svg class="w-6 h-6 text-{{ $card['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $card['icon'] !!}</svg>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="card bg-white rounded-lg shadow p-5">
            <h3 class="section-title text-lg font-semibold text-gray-900 mb-4">Permohonan per Bulan</h3>
            <div style="height:250px; position:relative;">
                <canvas id="permohonanChart"></canvas>
            </div>
        </div>
        <div class="card bg-white rounded-lg shadow p-5">
            <h3 class="section-title text-lg font-semibold text-gray-900 mb-4">Status Distribusi</h3>
            <div style="height:250px; position:relative;">
                <canvas id="statusChart"></canvas>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="card bg-white rounded-lg shadow p-5">
            <div class="flex items-center justify-between mb-4">
                <h3 class="section-title text-lg font-semibold text-gray-900">Permohonan Terbaru</h3>
                <a href="{{ route('admin.permohonan.index') }}" class="text-sm text-primary hover:underline">Lihat Semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="table-custom w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="text-left py-2 px-3 font-medium text-gray-500">No. Registrasi</th>
                            <th class="text-left py-2 px-3 font-medium text-gray-500">Nama</th>
                            <th class="text-left py-2 px-3 font-medium text-gray-500">Tanggal</th>
                            <th class="text-left py-2 px-3 font-medium text-gray-500">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentPermohonan as $item)
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="py-2 px-3">{{ $item->registration_number }}</td>
                                <td class="py-2 px-3">{{ $item->name }}</td>
                                <td class="py-2 px-3">{{ $item->created_at->format('d M Y') }}</td>
                                <td class="py-2 px-3">
                                    @php
                                        $statusColors = ['baru' => 'info', 'diverifikasi' => 'warning', 'diproses' => 'primary', 'selesai' => 'success', 'ditolak' => 'danger'];
                                    @endphp
                                    <span class="badge-{{ $statusColors[$item->status] ?? 'info' }} text-xs px-2 py-1 rounded-full">{{ ucfirst($item->status) }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="py-4 text-center text-gray-400">Belum ada permohonan</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card bg-white rounded-lg shadow p-5">
            <div class="flex items-center justify-between mb-4">
                <h3 class="section-title text-lg font-semibold text-gray-900">Berita Terbaru</h3>
                <a href="{{ route('admin.berita.index') }}" class="text-sm text-primary hover:underline">Lihat Semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="table-custom w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="text-left py-2 px-3 font-medium text-gray-500">Judul</th>
                            <th class="text-left py-2 px-3 font-medium text-gray-500">Kategori</th>
                            <th class="text-left py-2 px-3 font-medium text-gray-500">Tanggal</th>
                            <th class="text-left py-2 px-3 font-medium text-gray-500">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentNews as $item)
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="py-2 px-3">{{ Str::limit($item->title, 40) }}</td>
                                <td class="py-2 px-3"><span class="badge-primary text-xs px-2 py-1 rounded-full">{{ $item->category }}</span></td>
                                <td class="py-2 px-3">{{ $item->created_at->format('d M Y') }}</td>
                                <td class="py-2 px-3">
                                    <span class="badge-{{ $item->status === 'published' ? 'success' : 'warning' }} text-xs px-2 py-1 rounded-full">{{ ucfirst($item->status) }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="py-4 text-center text-gray-400">Belum ada berita</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const permohonanCtx = document.getElementById('permohonanChart').getContext('2d');
    new Chart(permohonanCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($stats['permohonan_months'] ?? ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des']) !!},
            datasets: [{
                label: 'Permohonan',
                data: {!! json_encode($stats['permohonan_monthly'] ?? [0,0,0,0,0,0,0,0,0,0,0,0]) !!},
                backgroundColor: '#2563eb',
                borderRadius: 4,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1 } }
            }
        }
    });

    const statusCtx = document.getElementById('statusChart').getContext('2d');
    new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($stats['status_labels'] ?? ['Baru','Diverifikasi','Diproses','Selesai','Ditolak']) !!},
            datasets: [{
                data: {!! json_encode($stats['status_counts'] ?? [0,0,0,0,0]) !!},
                backgroundColor: ['#3b82f6','#F0A800','#2563eb','#10b981','#ef4444'],
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
        }
    });
});
</script>
@endpush
@endsection
