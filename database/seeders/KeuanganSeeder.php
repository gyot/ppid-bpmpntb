<?php

namespace Database\Seeders;

use App\Models\Keuangan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class KeuanganSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'title' => 'Laporan Keuangan Tahun 2025 (Audited)',
                'slug' => 'laporan-keuangan-2025-audited-' . Str::random(5),
                'category' => 'laporan_keuangan',
                'tahun' => 2025,
                'deskripsi' => 'Laporan keuangan BPMP NTB Tahun Anggaran 2025 yang telah diaudit oleh BPK.',
                'file_path' => 'uploads/keuangan/laporan-keuangan-2025.pdf',
                'file_name' => 'Laporan_Keuangan_2025_Audited.pdf',
                'file_size' => 2500000,
                'status' => 'published',
                'published_at' => now(),
                'download_count' => 15,
                'created_by' => 1,
            ],
            [
                'title' => 'RKA Tahun 2026',
                'slug' => 'rka-2026-' . Str::random(5),
                'category' => 'rka',
                'tahun' => 2026,
                'deskripsi' => 'Rencana Kerja dan Anggaran BPMP NTB Tahun Anggaran 2026.',
                'file_path' => 'uploads/keuangan/rka-2026.pdf',
                'file_name' => 'RKA_BPMP_NTB_2026.pdf',
                'file_size' => 1800000,
                'status' => 'published',
                'published_at' => now(),
                'download_count' => 8,
                'created_by' => 1,
            ],
            [
                'title' => 'DIPA Tahun 2026',
                'slug' => 'dipa-2026-' . Str::random(5),
                'category' => 'dipa',
                'tahun' => 2026,
                'deskripsi' => 'Daftar Isian Pelaksanaan Anggaran BPMP NTB Tahun Anggaran 2026.',
                'file_path' => 'uploads/keuangan/dipa-2026.pdf',
                'file_name' => 'DIPA_BPMP_NTB_2026.pdf',
                'file_size' => 1500000,
                'status' => 'published',
                'published_at' => now(),
                'download_count' => 12,
                'created_by' => 1,
            ],
            [
                'title' => 'Realisasi Keuangan Tahun 2025',
                'slug' => 'realisasi-keuangan-2025-' . Str::random(5),
                'category' => 'realisasi',
                'tahun' => 2025,
                'deskripsi' => 'Laporan realisasi keuangan semester I dan II BPMP NTB Tahun 2025.',
                'file_path' => 'uploads/keuangan/realisasi-2025.pdf',
                'file_name' => 'Realisasi_Keuangan_2025.pdf',
                'file_size' => 1200000,
                'status' => 'published',
                'published_at' => now(),
                'download_count' => 10,
                'created_by' => 1,
            ],
            [
                'title' => 'Ringkasan CALK Tahun 2025',
                'slug' => 'ringkasan-calk-2025-' . Str::random(5),
                'category' => 'calk',
                'tahun' => 2025,
                'deskripsi' => 'Ringkasan Catatan Atas Laporan Keuangan (CALK) BPMP NTB Tahun 2025.',
                'file_path' => 'uploads/keuangan/calk-2025.pdf',
                'file_name' => 'Ringkasan_CALK_2025.pdf',
                'file_size' => 900000,
                'status' => 'published',
                'published_at' => now(),
                'download_count' => 5,
                'created_by' => 1,
            ],
            [
                'title' => 'Neraca Tahun 2025',
                'slug' => 'neraca-2025-' . Str::random(5),
                'category' => 'neraca',
                'tahun' => 2025,
                'deskripsi' => 'Laporan Neraca BPMP NTB Tahun Anggaran 2025.',
                'file_path' => 'uploads/keuangan/neraca-2025.pdf',
                'file_name' => 'Neraca_BPMP_NTB_2025.pdf',
                'file_size' => 800000,
                'status' => 'published',
                'published_at' => now(),
                'download_count' => 7,
                'created_by' => 1,
            ],
        ];

        foreach ($data as $item) {
            Keuangan::create($item);
        }
    }
}
