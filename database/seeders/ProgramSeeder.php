<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama_program' => 'Fasilitasi Penjaminan Mutu Pendidikan',
                'penanggung_jawab' => 'Kepala BPMP NTB',
                'target' => 'Sekolah/Madrasah se-NTB',
                'jadwal' => 'Jan - Des 2026',
                'sumber_anggaran' => 'APBN',
                'besaran_anggaran' => 550000000,
                'tahun' => 2026,
                'jenis' => 'strategis',
                'deskripsi' => 'Fasilitasi penjaminan mutu pendidikan di seluruh satuan pendidikan di Provinsi Nusa Tenggara Barat melalui supervisi, bimbingan teknis, dan monitoring.',
                'status' => 'published',
                'published_at' => now(),
                'created_by' => 1,
            ],
            [
                'nama_program' => 'Pemetaan dan Supervisi Mutu Pendidikan',
                'penanggung_jawab' => 'Kepala Bidang Penjaminan Mutu',
                'target' => 'Sekolah/Madrasah se-NTB',
                'jadwal' => 'Feb - Nov 2026',
                'sumber_anggaran' => 'APBN',
                'besaran_anggaran' => 350000000,
                'tahun' => 2026,
                'jenis' => 'strategis',
                'deskripsi' => 'Pemetaan kondisi mutu pendidikan dan pelaksanaan supervisi akademik dan manajerial di satuan pendidikan.',
                'status' => 'published',
                'published_at' => now(),
                'created_by' => 1,
            ],
            [
                'nama_program' => 'Kemitraan Penjaminan Mutu Pendidikan',
                'penanggung_jawab' => 'Kepala Bidang Penjaminan Mutu',
                'target' => 'Stakeholder Pendidikan NTB',
                'jadwal' => 'Jan - Des 2026',
                'sumber_anggaran' => 'APBN',
                'besaran_anggaran' => 200000000,
                'tahun' => 2026,
                'jenis' => 'program',
                'deskripsi' => 'Program kemitraan dengan berbagai pihak dalam rangka peningkatan mutu pendidikan di Provinsi NTB.',
                'status' => 'published',
                'published_at' => now(),
                'created_by' => 1,
            ],
            [
                'nama_program' => 'Penerimaan Peserta Magang',
                'penanggung_jawab' => 'Kepala Subbagian Umum',
                'target' => 'Mahasiswa/Pelajar',
                'jadwal' => 'Jan - Des 2026',
                'sumber_anggaran' => 'APBN',
                'besaran_anggaran' => 50000000,
                'tahun' => 2026,
                'jenis' => 'kegiatan',
                'deskripsi' => 'Kegiatan penerimaan dan pembimbingan peserta magang dari perguruan tinggi dan sekolah.',
                'status' => 'published',
                'published_at' => now(),
                'created_by' => 1,
            ],
            [
                'nama_program' => 'Sosialisasi Keterbukaan Informasi Publik',
                'penanggung_jawab' => 'PPID BPMP NTB',
                'target' => 'Masyarakat Umum',
                'jadwal' => 'Mar - Sep 2026',
                'sumber_anggaran' => 'APBN',
                'besaran_anggaran' => 75000000,
                'tahun' => 2026,
                'jenis' => 'kegiatan',
                'deskripsi' => 'Sosialisasi dan edukasi tentang keterbukaan informasi publik kepada masyarakat dan pemangku kepentingan.',
                'status' => 'published',
                'published_at' => now(),
                'created_by' => 1,
            ],
            [
                'nama_program' => 'Bimtek Pengelolaan PPID',
                'penanggung_jawab' => 'PPID BPMP NTB',
                'target' => 'Operator PPID',
                'jadwal' => 'Apr - Agu 2026',
                'sumber_anggaran' => 'APBN',
                'besaran_anggaran' => 100000000,
                'tahun' => 2026,
                'jenis' => 'kegiatan',
                'deskripsi' => 'Bimbingan teknis pengelolaan PPID bagi petugas dan operator informasi publik.',
                'status' => 'published',
                'published_at' => now(),
                'created_by' => 1,
            ],
            [
                'nama_program' => 'Monitoring dan Evaluasi',
                'penanggung_jawab' => 'Kepala BPMP NTB',
                'target' => 'Satuan Pendidikan se-NTB',
                'jadwal' => 'Jan - Des 2026',
                'sumber_anggaran' => 'APBN',
                'besaran_anggaran' => 300000000,
                'tahun' => 2026,
                'jenis' => 'program',
                'deskripsi' => 'Program monitoring dan evaluasi pelaksanaan penjaminan mutu pendidikan di Provinsi NTB.',
                'status' => 'published',
                'published_at' => now(),
                'created_by' => 1,
            ],
            [
                'nama_program' => 'Revitalisasi Sekolah',
                'penanggung_jawab' => 'Kepala Bidang Penjaminan Mutu',
                'target' => 'Sekolah Sasaran',
                'jadwal' => 'Jan - Des 2026',
                'sumber_anggaran' => 'APBN',
                'besaran_anggaran' => 450000000,
                'tahun' => 2026,
                'jenis' => 'strategis',
                'deskripsi' => 'Program revitalisasi sekolah dalam rangka peningkatan mutu dan pemerataan pendidikan.',
                'status' => 'published',
                'published_at' => now(),
                'created_by' => 1,
            ],
        ];

        foreach ($data as $item) {
            Program::create($item);
        }
    }
}
