@extends('admin.layouts.app')

@section('title', 'Detail Permohonan')

@section('breadcrumb')
    <a href="{{ route('admin.permohonan.index') }}" class="hover:text-primary">Permohonan</a>
    <svg class="w-4 h-4 inline" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
    <span class="text-gray-900">{{ $permohonan->registration_number }}</span>
@endsection

@section('content')
<div class="space-y-6" x-data="{
    showVerify: false,
    showProcess: false,
    showComplete: false,
    showReject: false,
}">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h1 class="text-2xl font-bold text-gray-900">Detail Permohonan</h1>
        <div class="flex flex-wrap gap-2">
            @if($permohonan->status === 'baru')
                <button @click="showVerify = true" class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 text-sm">Verifikasi</button>
            @endif
            @if(in_array($permohonan->status, ['diverifikasi']))
                <button @click="showProcess = true" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 text-sm">Proses</button>
            @endif
            @if(in_array($permohonan->status, ['diverifikasi', 'diproses']))
                <button @click="showComplete = true" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 text-sm">Selesai</button>
                <button @click="showReject = true" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 text-sm">Tolak</button>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 card bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold text-gray-900 border-b pb-3 mb-4">Informasi Permohonan</h2>
            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-3">
                <div>
                    <dt class="text-xs text-gray-500 uppercase tracking-wider">No. Registrasi</dt>
                    <dd class="text-sm font-medium text-gray-900 mt-0.5">{{ $permohonan->registration_number }}</dd>
                </div>
                <div>
                    <dt class="text-xs text-gray-500 uppercase tracking-wider">Status</dt>
                    <dd class="mt-0.5">
                        @php
                            $statusColors = ['baru' => 'info', 'diverifikasi' => 'warning', 'diproses' => 'primary', 'selesai' => 'success', 'ditolak' => 'danger'];
                        @endphp
                        <span class="badge-{{ $statusColors[$permohonan->status] ?? 'info' }} text-xs px-2 py-1 rounded-full">{{ ucfirst($permohonan->status) }}</span>
                    </dd>
                </div>
                <div>
                    <dt class="text-xs text-gray-500 uppercase tracking-wider">Nama Pemohon</dt>
                    <dd class="text-sm text-gray-900 mt-0.5">{{ $permohonan->name }}</dd>
                </div>
                <div>
                    <dt class="text-xs text-gray-500 uppercase tracking-wider">Email</dt>
                    <dd class="text-sm text-gray-900 mt-0.5">{{ $permohonan->email }}</dd>
                </div>
                <div>
                    <dt class="text-xs text-gray-500 uppercase tracking-wider">Telepon</dt>
                    <dd class="text-sm text-gray-900 mt-0.5">{{ $permohonan->phone ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-xs text-gray-500 uppercase tracking-wider">NIK</dt>
                    <dd class="text-sm text-gray-900 mt-0.5">{{ $permohonan->nik ?? '-' }}</dd>
                </div>
                <div class="sm:col-span-2">
                    <dt class="text-xs text-gray-500 uppercase tracking-wider">Alamat</dt>
                    <dd class="text-sm text-gray-900 mt-0.5">{{ $permohonan->address ?? '-' }}</dd>
                </div>
                <div class="sm:col-span-2">
                    <dt class="text-xs text-gray-500 uppercase tracking-wider">Informasi yang Diminta</dt>
                    <dd class="text-sm text-gray-900 mt-0.5">{{ $permohonan->requested_information }}</dd>
                </div>
                <div>
                    <dt class="text-xs text-gray-500 uppercase tracking-wider">Tujuan Permohonan</dt>
                    <dd class="text-sm text-gray-900 mt-0.5">{{ $permohonan->purpose ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-xs text-gray-500 uppercase tracking-wider">Cara Memperoleh Informasi</dt>
                    <dd class="text-sm text-gray-900 mt-0.5">{{ $permohonan->delivery_method ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-xs text-gray-500 uppercase tracking-wider">Tanggal Pengajuan</dt>
                    <dd class="text-sm text-gray-900 mt-0.5">{{ $permohonan->created_at->format('d M Y H:i') }}</dd>
                </div>
                <div>
                    <dt class="text-xs text-gray-500 uppercase tracking-wider">Batas Waktu</dt>
                    <dd class="text-sm text-gray-900 mt-0.5">{{ $permohonan->deadline ? $permohonan->deadline->format('d M Y') : '-' }}</dd>
                </div>
            </dl>
        </div>

        <div class="card bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold text-gray-900 border-b pb-3 mb-4">Riwayat Status</h2>
            <div class="space-y-4">
                @forelse($permohonan->statusHistory ?? [] as $history)
                    <div class="flex gap-3">
                        <div class="flex flex-col items-center">
                            <div class="w-3 h-3 rounded-full bg-primary mt-1"></div>
                            @if(!$loop->last)
                                <div class="w-0.5 flex-1 bg-gray-200 mt-1"></div>
                            @endif
                        </div>
                        <div class="pb-4">
                            <p class="text-sm font-medium text-gray-900">{{ ucfirst($history->status) }}</p>
                            <p class="text-xs text-gray-500">{{ $history->created_at->format('d M Y H:i') }}</p>
                            @if($history->notes)
                                <p class="text-sm text-gray-600 mt-1">{{ $history->notes }}</p>
                            @endif
                            @if($history->user)
                                <p class="text-xs text-gray-400 mt-0.5">oleh {{ $history->user->name }}</p>
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-gray-400">Belum ada riwayat</p>
                @endforelse
            </div>
        </div>
    </div>

    <div x-show="showVerify" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" x-transition>
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4" @click.away="showVerify = false">
            <form method="POST" action="{{ route('admin.permohonan.verify', $permohonan) }}">
                @csrf @method('PATCH')
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Verifikasi Permohonan</h3>
                    <div>
                        <label class="input-label block text-sm font-medium text-gray-700 mb-1">Catatan (opsional)</label>
                        <textarea name="notes" rows="3" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary"></textarea>
                    </div>
                </div>
                <div class="flex justify-end gap-3 px-6 py-4 bg-gray-50 rounded-b-lg">
                    <button type="button" @click="showVerify = false" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 text-sm">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 text-sm">Verifikasi</button>
                </div>
            </form>
        </div>
    </div>

    <div x-show="showProcess" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" x-transition>
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4" @click.away="showProcess = false">
            <form method="POST" action="{{ route('admin.permohonan.process', $permohonan) }}">
                @csrf @method('PATCH')
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Proses Permohonan</h3>
                    <div>
                        <label class="input-label block text-sm font-medium text-gray-700 mb-1">Catatan</label>
                        <textarea name="notes" rows="3" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary"></textarea>
                    </div>
                </div>
                <div class="flex justify-end gap-3 px-6 py-4 bg-gray-50 rounded-b-lg">
                    <button type="button" @click="showProcess = false" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 text-sm">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 text-sm">Proses</button>
                </div>
            </form>
        </div>
    </div>

    <div x-show="showComplete" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" x-transition>
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4" @click.away="showComplete = false">
            <form method="POST" action="{{ route('admin.permohonan.complete', $permohonan) }}" enctype="multipart/form-data">
                @csrf @method('PATCH')
                <div class="p-6 space-y-4">
                    <h3 class="text-lg font-semibold text-gray-900">Selesaikan Permohonan</h3>
                    <div>
                        <label class="input-label block text-sm font-medium text-gray-700 mb-1">Catatan</label>
                        <textarea name="notes" rows="3" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary"></textarea>
                    </div>
                    <div>
                        <label class="input-label block text-sm font-medium text-gray-700 mb-1">Lampiran Jawaban</label>
                        <input type="file" name="attachment" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
                    </div>
                </div>
                <div class="flex justify-end gap-3 px-6 py-4 bg-gray-50 rounded-b-lg">
                    <button type="button" @click="showComplete = false" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 text-sm">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 text-sm">Selesai</button>
                </div>
            </form>
        </div>
    </div>

    <div x-show="showReject" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" x-transition>
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4" @click.away="showReject = false">
            <form method="POST" action="{{ route('admin.permohonan.reject', $permohonan) }}">
                @csrf @method('PATCH')
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-red-600 mb-4">Tolak Permohonan</h3>
                    <div>
                        <label class="input-label block text-sm font-medium text-gray-700 mb-1">Alasan Penolakan <span class="text-red-500">*</span></label>
                        <textarea name="notes" rows="3" required class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary"></textarea>
                    </div>
                </div>
                <div class="flex justify-end gap-3 px-6 py-4 bg-gray-50 rounded-b-lg">
                    <button type="button" @click="showReject = false" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 text-sm">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 text-sm">Tolak</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
