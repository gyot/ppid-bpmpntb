<?php

namespace Database\Seeders;

use App\Models\Document;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DocumentSeeder extends Seeder
{
    public function run(): void
    {
        $documents = [
            ['title' => 'UU No. 14 Tahun 2008 tentang Keterbukaan Informasi Publik', 'category' => 'regulasi', 'year' => 2008, 'description' => 'Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik sebagai dasar hukum utama pelaksanaan keterbukaan informasi di Indonesia.'],
            ['title' => 'PP No. 61 Tahun 2010 tentang Pelaksanaan UU KIP', 'category' => 'regulasi', 'year' => 2010, 'description' => 'Peraturan Pemerintah Nomor 61 Tahun 2010 tentang Pelaksanaan Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik.'],
            ['title' => 'Permen PMK No. 2 Tahun 2011 tentang Tata Cara Penyelesaian Sengketa', 'category' => 'regulasi', 'year' => 2011, 'description' => 'Peraturan Menteri Pendayagunaan Aparatur Negara dan Reformasi Birokrasi Nomor 2 Tahun 2011 tentang Tata Cara Penyelesaian Sengketa Informasi Publik.'],
            ['title' => 'Perki No. 1 Tahun 2021 tentang Standar Layanan Informasi Publik', 'category' => 'regulasi', 'year' => 2021, 'description' => 'Peraturan Komisi Informasi Nomor 1 Tahun 2021 tentang Standar Layanan Informasi Publik yang menjadi acuan bagi badan publik.'],
            ['title' => 'Permendikbud No. 69 Tahun 2024 tentang Pengelolaan dan Pelayanan Informasi Publik', 'category' => 'regulasi', 'year' => 2024, 'description' => 'Peraturan Menteri Pendidikan, Kebudayaan, Riset, dan Teknologi Nomor 69 Tahun 2024 tentang Pengelolaan dan Pelayanan Informasi Publik di Lingkungan Kemendikbudristek.'],

            ['title' => 'SK PPID BPMP Provinsi NTB', 'category' => 'sk', 'year' => 2024, 'description' => 'Surat Keputusan Penetapan Pejabat Pengelola Informasi dan Dokumentasi (PPID) BPMP Provinsi Nusa Tenggara Barat.'],
            ['title' => 'Permendikbud No. 11 Tahun 2022 tentang Organisasi dan Tata Kerja BPMP', 'category' => 'sk', 'year' => 2022, 'description' => 'Peraturan Menteri Pendidikan Nomor 11 Tahun 2022 tentang Organisasi dan Tata Kerja Balai Penjaminan Mutu Pendidikan (BPMP).'],
            ['title' => 'Kepmendikbud No. 263/O/2022 tentang Rincian Tugas BPMP', 'category' => 'sk', 'year' => 2022, 'description' => 'Keputusan Menteri Pendidikan Nomor 263/O/2022 tentang Rincian Tugas Unit Pelaksana Teknis Balai Penjaminan Mutu Pendidikan (BPMP).'],

            ['title' => 'SOP Pelayanan Informasi Publik', 'category' => 'sop', 'year' => 2024, 'description' => 'Standar Operasional Prosedur Pelayanan Informasi Publik di lingkungan BPMP Provinsi Nusa Tenggara Barat.'],
            ['title' => 'SOP Penerimaan dan Verifikasi Permohonan', 'category' => 'sop', 'year' => 2024, 'description' => 'Standar Operasional Prosedur Penerimaan dan Verifikasi Permohonan Informasi Publik di BPMP Provinsi Nusa Tenggara Barat.'],
            ['title' => 'SOP Pengelolaan Dokumen dan Informasi', 'category' => 'sop', 'year' => 2024, 'description' => 'Standar Operasional Prosedur Pengelolaan Dokumen dan Informasi Publik di BPMP Provinsi Nusa Tenggara Barat.'],

            ['title' => 'Laporan Layanan Informasi Publik Tahun 2024', 'category' => 'laporan', 'year' => 2024, 'description' => 'Laporan penyelenggaraan pelayanan informasi publik BPMP Provinsi Nusa Tenggara Barat Tahun 2024.'],
            ['title' => 'Laporan Layanan Informasi Publik Tahun 2023', 'category' => 'laporan', 'year' => 2023, 'description' => 'Laporan penyelenggaraan pelayanan informasi publik BPMP Provinsi Nusa Tenggara Barat Tahun 2023.'],

            ['title' => 'Formulir Permohonan Informasi Publik', 'category' => 'formulir', 'year' => 2024, 'description' => 'Formulir untuk mengajukan permohonan informasi publik di BPMP Provinsi Nusa Tenggara Barat.'],
            ['title' => 'Formulir Pengajuan Keberatan', 'category' => 'formulir', 'year' => 2024, 'description' => 'Formulir untuk mengajukan keberatan atas permohonan informasi publik di BPMP Provinsi Nusa Tenggara Barat.'],
        ];

        foreach ($documents as $doc) {
            $month = rand(1, 12);
            $day = rand(1, 28);

            Document::create([
                'title' => $doc['title'],
                'slug' => Str::slug($doc['title']),
                'category' => $doc['category'],
                'year' => $doc['year'],
                'description' => $doc['description'],
                'file_path' => 'documents/' . $doc['category'] . '/' . Str::slug($doc['title']) . '.pdf',
                'file_name' => Str::slug($doc['title']) . '.pdf',
                'file_size' => rand(50000, 3000000),
                'mime_type' => 'application/pdf',
                'status' => 'published',
                'published_at' => sprintf('%d-%02d-%02d 08:00:00', $doc['year'], $month, $day),
                'created_by' => 1,
            ]);
        }
    }
}
