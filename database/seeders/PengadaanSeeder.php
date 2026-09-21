<?php

namespace Database\Seeders;

use App\Models\Pengadaan;
use Illuminate\Database\Seeder;

class PengadaanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama_paket' => 'Pengadaan Alat Tulis Kantor dan Bahan Habis Pakai',
                'nilai_pagu' => 150000000,
                'tahun' => 2026,
                'tahap' => 'rencana',
                'deskripsi' => 'Pengadaan ATK dan bahan habis pakai untuk kebutuhan operasional BPMP NTB Tahun 2026.',
                'status' => 'published',
                'published_at' => now(),
                'created_by' => 1,
            ],
            [
                'nama_paket' => 'Pengadaan Jasa Konsultasi Supervisi Pendidikan',
                'nilai_pagu' => 350000000,
                'tahun' => 2026,
                'tahap' => 'rencana',
                'deskripsi' => 'Pengadaan jasa konsultasi untuk kegiatan supervisi akademik dan manajerial satuan pendidikan.',
                'status' => 'published',
                'published_at' => now(),
                'created_by' => 1,
            ],
            [
                'nama_paket' => 'Pengadaan Cetakan dan Media Publikasi',
                'nilai_pagu' => 85000000,
                'tahun' => 2025,
                'tahap' => 'pelaksanaan',
                'penyedia' => 'CV. Percetakan Lombok',
                'no_kontrak' => '001/PPB/BPMP-NTB/2025',
                'tanggal_kontrak' => '2025-03-15',
                'deskripsi' => 'Pengadaan cetakan dan media publikasi untuk kebutuhan sosialisasi dan dokumentasi.',
                'file_path' => 'uploads/pengadaan/kontrak-cetakan-2025.pdf',
                'file_name' => 'Kontrak_Cetakan_2025.pdf',
                'status' => 'published',
                'published_at' => now(),
                'created_by' => 1,
            ],
            [
                'nama_paket' => 'Pengadaan Perjalanan Dinas Dalam Kota',
                'nilai_pagu' => 120000000,
                'tahun' => 2025,
                'tahap' => 'pelaksanaan',
                'penyedia' => 'PT. Travel Nusa Indah',
                'no_kontrak' => '002/PPB/BPMP-NTB/2025',
                'tanggal_kontrak' => '2025-04-01',
                'deskripsi' => 'Pengadaan jasa perjalanan dinas dalam kota untuk kegiatan supervisi dan monitoring.',
                'file_path' => 'uploads/pengadaan/kontrak-perdin-2025.pdf',
                'file_name' => 'Kontrak_Perdin_2025.pdf',
                'status' => 'published',
                'published_at' => now(),
                'created_by' => 1,
            ],
        ];

        foreach ($data as $item) {
            Pengadaan::create($item);
        }
    }
}
