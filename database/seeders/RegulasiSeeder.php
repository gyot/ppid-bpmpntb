<?php

namespace Database\Seeders;

use App\Models\Regulasi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RegulasiSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'title' => 'Undang-Undang Nomor 14 Tahun 2008',
                'slug' => 'uu-no-14-tahun-2008-' . Str::random(5),
                'nomor' => 'No. 14 Tahun 2008',
                'pembuat' => 'DPR RI dan Presiden',
                'kategori' => 'uu',
                'tanggal' => '2008-04-30',
                'deskripsi' => 'Tentang Keterbukaan Informasi Publik. UU ini menjadi dasar hukum utama penyelenggaraan keterbukaan informasi publik di Indonesia.',
                'file_path' => 'uploads/regulasi/uu-14-2008.pdf',
                'file_name' => 'UU_No_14_Tahun_2008.pdf',
                'status' => 'published',
                'published_at' => now(),
                'created_by' => 1,
            ],
            [
                'title' => 'Peraturan Pemerintah Nomor 61 Tahun 2010',
                'slug' => 'pp-no-61-tahun-2010-' . Str::random(5),
                'nomor' => 'No. 61 Tahun 2010',
                'pembuat' => 'Pemerintah RI',
                'kategori' => 'pp',
                'tanggal' => '2010-10-01',
                'deskripsi' => 'Tentang Pelaksanaan Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik.',
                'file_path' => 'uploads/regulasi/pp-61-2010.pdf',
                'file_name' => 'PP_No_61_Tahun_2010.pdf',
                'status' => 'published',
                'published_at' => now(),
                'created_by' => 1,
            ],
            [
                'title' => 'Peraturan Mahkamah Agung Nomor 2 Tahun 2011',
                'slug' => 'perma-no-2-tahun-2011-' . Str::random(5),
                'nomor' => 'No. 2 Tahun 2011',
                'pembuat' => 'Mahkamah Agung RI',
                'kategori' => 'perma',
                'tanggal' => '2011-06-22',
                'deskripsi' => 'Tentang Tata Cara Penyelesaian Sengketa Informasi Publik di Pengadilan.',
                'file_path' => 'uploads/regulasi/perma-2-2011.pdf',
                'file_name' => 'PERMA_No_2_Tahun_2011.pdf',
                'status' => 'published',
                'published_at' => now(),
                'created_by' => 1,
            ],
            [
                'title' => 'Peraturan Komisi Informasi Nomor 1 Tahun 2021',
                'slug' => 'perki-no-1-tahun-2021-' . Str::random(5),
                'nomor' => 'No. 1 Tahun 2021',
                'pembuat' => 'Komisi Informasi Pusat',
                'kategori' => 'perki',
                'tanggal' => '2021-03-15',
                'deskripsi' => 'Tentang Standar Layanan Publik Badan Publik. Mengatur standar pelayanan informasi publik yang wajib dipenuhi oleh badan publik.',
                'file_path' => 'uploads/regulasi/perki-1-2021.pdf',
                'file_name' => 'PERKI_No_1_Tahun_2021.pdf',
                'status' => 'published',
                'published_at' => now(),
                'created_by' => 1,
            ],
            [
                'title' => 'Peraturan Menteri Pendidikan, Kebudayaan, Riset, dan Teknologi Nomor 69 Tahun 2024',
                'slug' => 'permendikbud-no-69-tahun-2024-' . Str::random(5),
                'nomor' => 'No. 69 Tahun 2024',
                'pembuat' => 'Mendikbudristek',
                'kategori' => 'permendikbud',
                'tanggal' => '2024-10-15',
                'deskripsi' => 'Tentang Pedoman Tata Kelola Keterbukaan Informasi Publik di Lingkungan Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi.',
                'file_path' => 'uploads/regulasi/permendikbud-69-2024.pdf',
                'file_name' => 'Permendikbud_No_69_Tahun_2024.pdf',
                'status' => 'published',
                'published_at' => now(),
                'created_by' => 1,
            ],
            [
                'title' => 'Peraturan Menteri Pendidikan, Kebudayaan, Riset, dan Teknologi Nomor 11 Tahun 2022',
                'slug' => 'permendikbud-no-11-tahun-2022-' . Str::random(5),
                'nomor' => 'No. 11 Tahun 2022',
                'pembuat' => 'Mendikbudristek',
                'kategori' => 'permendikbud',
                'tanggal' => '2022-07-20',
                'deskripsi' => 'Tentang Organisasi dan Tata Kerja Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi.',
                'file_path' => 'uploads/regulasi/permendikbud-11-2022.pdf',
                'file_name' => 'Permendikbud_No_11_Tahun_2022.pdf',
                'status' => 'published',
                'published_at' => now(),
                'created_by' => 1,
            ],
            [
                'title' => 'Keputusan Menteri Pendidikan, Kebudayaan, Riset, dan Teknologi Nomor 263/O/2022',
                'slug' => 'kepmendikbud-263-2022-' . Str::random(5),
                'nomor' => 'No. 263/O/2022',
                'pembuat' => 'Mendikbudristek',
                'kategori' => 'lainnya',
                'tanggal' => '2022-08-10',
                'deskripsi' => 'Tentang Penunjukan Pejabat Pengelola Informasi dan Dokumentasi di Lingkungan Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi.',
                'file_path' => 'uploads/regulasi/kepmendikbud-263-2022.pdf',
                'file_name' => 'Kepmendikbud_263_O_2022.pdf',
                'status' => 'published',
                'published_at' => now(),
                'created_by' => 1,
            ],
            [
                'title' => 'Peraturan Menteri Pendidikan Dasar dan Menengah Nomor 1 Tahun 2024',
                'slug' => 'permendikdasmen-no-1-tahun-2024-' . Str::random(5),
                'nomor' => 'No. 1 Tahun 2024',
                'pembuat' => 'Mendikdasmen',
                'kategori' => 'lainnya',
                'tanggal' => '2024-11-20',
                'deskripsi' => 'Tentang Organisasi dan Tata Kerja Kementerian Pendidikan Dasar dan Menengah.',
                'file_path' => 'uploads/regulasi/permendikdasmen-1-2024.pdf',
                'file_name' => 'Permendikdasmen_No_1_Tahun_2024.pdf',
                'status' => 'published',
                'published_at' => now(),
                'created_by' => 1,
            ],
        ];

        foreach ($data as $item) {
            Regulasi::create($item);
        }
    }
}
