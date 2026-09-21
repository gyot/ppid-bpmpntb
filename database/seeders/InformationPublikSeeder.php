<?php

namespace Database\Seeders;

use App\Models\InformationPublik;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class InformationPublikSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'title' => 'Profil PPID BPMP Provinsi NTB',
                'category' => 'berkala',
                'year' => 2025,
                'description' => 'Profil lengkap PPID BPMP Provinsi NTB yang mencakup struktur organisasi, tugas dan fungsi, serta mekanisme pelayanan informasi publik yang disediakan oleh BPMP Provinsi Nusa Tenggara Barat.',
            ],
            [
                'title' => 'LHKPN Pejabat BPMP NTB',
                'category' => 'berkala',
                'year' => 2024,
                'description' => 'Laporan Harta Kekayaan Penyelenggara Negara (LHKPN) pejabat di lingkungan BPMP Provinsi Nusa Tenggara Barat sesuai dengan ketentuan peraturan perundang-undangan.',
            ],
            [
                'title' => 'Informasi Program BPMP NTB',
                'category' => 'berkala',
                'year' => 2025,
                'description' => 'Daftar program kerja BPMP Provinsi Nusa Tenggara Barat yang mencakup program penjaminan mutu pendidikan, fasilitasi, dan kemitraan di Provinsi NTB.',
            ],
            [
                'title' => 'Ringkasan CALK BPMP NTB',
                'category' => 'berkala',
                'year' => 2024,
                'description' => 'Catatan Atas Laporan Keuangan (CALK) BPMP Provinsi Nusa Tenggara Barat sebagai pelengkap laporan keuangan tahun berjalan.',
            ],
            [
                'title' => 'RKA BPMP NTB Tahun 2025',
                'category' => 'berkala',
                'year' => 2025,
                'description' => 'Rencana Kerja dan Anggaran (RKA) BPMP Provinsi Nusa Tenggara Barat Tahun Anggaran 2025 yang memuat rencana program dan kegiatan beserta anggarannya.',
            ],

            [
                'title' => 'Peraturan Menteri Pendidikan No. 11 Tahun 2022',
                'category' => 'setiap_saat',
                'year' => 2022,
                'description' => 'Peraturan Menteri Pendidikan Nomor 11 Tahun 2022 tentang Organisasi dan Tata Kerja Balai Penjaminan Mutu Pendidikan (BPMP) yang menjadi dasar pembentukan BPMP NTB.',
            ],
            [
                'title' => 'Data Perbendaharaan BPMP NTB',
                'category' => 'setiap_saat',
                'year' => 2024,
                'description' => 'Data keuangan perbendaharaan BPMP Provinsi Nusa Tenggara Barat yang mencakup realisasi anggaran dan laporan keuangan.',
            ],
            [
                'title' => 'Data BMN BPMP NTB',
                'category' => 'setiap_saat',
                'year' => 2024,
                'description' => 'Data Barang Milik Negara (BMN) yang dikelola oleh BPMP Provinsi Nusa Tenggara Barat beserta kondisi dan pemanfaatannya.',
            ],
            [
                'title' => 'SK PPID BPMP NTB',
                'category' => 'setiap_saat',
                'year' => 2024,
                'description' => 'Surat Keputusan Penetapan Pejabat Pengelola Informasi dan Dokumentasi (PPID) BPMP Provinsi Nusa Tenggara Barat.',
            ],
            [
                'title' => 'Pedoman Pelaksanaan Keterbukaan Informasi Publik',
                'category' => 'setiap_saat',
                'year' => 2024,
                'description' => 'Pedoman internal pelaksanaan keterbukaan informasi publik di lingkungan BPMP Provinsi Nusa Tenggara Barat sebagai acuan bagi seluruh pegawai.',
            ],

            [
                'title' => 'Pengumuman Darurat Pendidikan',
                'category' => 'serta_merta',
                'year' => 2025,
                'description' => 'Informasi keadaan darurat pendidikan yang memerlukan penanganan segera dan wajib diumumkan kepada masyarakat secara serta merta.',
            ],
            [
                'title' => 'Peringatan Keamanan Sekolah',
                'category' => 'serta_merta',
                'year' => 2025,
                'description' => 'Informasi keselamatan dan keamanan sekolah yang wajib diumumkan serta merta demi melindungi peserta didik dan warga sekolah.',
            ],
            [
                'title' => 'Informasi Bencana Alam',
                'category' => 'serta_merta',
                'year' => 2024,
                'description' => 'Informasi terkait bencana alam yang berdampak pada dunia pendidikan di Provinsi NTB yang wajib diumumkan secara serta merta.',
            ],
            [
                'title' => 'Pengumuman Penting Terkini',
                'category' => 'serta_merta',
                'year' => 2025,
                'description' => 'Pengumuman yang memerlukan perhatian segera dari masyarakat terkait layanan dan kebijakan BPMP Provinsi Nusa Tenggara Barat.',
            ],
            [
                'title' => 'Informasi Perubahan Jadwal Layanan',
                'category' => 'serta_merta',
                'year' => 2025,
                'description' => 'Informasi perubahan mendadak jadwal layanan informasi publik BPMP Provinsi Nusa Tenggara Barat yang wajib diumumkan serta merta.',
            ],

            [
                'title' => 'Informasi Rahasia Negara',
                'category' => 'dikecualikan',
                'year' => 2024,
                'description' => 'Informasi yang termasuk rahasia negara sesuai dengan ketentuan peraturan perundang-undangan yang dikecualikan dari akses publik.',
            ],
            [
                'title' => 'Data Pribadi Peserta Didik',
                'category' => 'dikecualikan',
                'year' => 2024,
                'description' => 'Data pribadi peserta didik yang dilindungi undang-undang dan tidak dapat diakses oleh publik tanpa persetujuan yang bersangkutan.',
            ],
            [
                'title' => 'Informasi Dalam Proses Hukum',
                'category' => 'dikecualikan',
                'year' => 2024,
                'description' => 'Informasi yang sedang dalam proses penyidikan dan penuntutan yang dikecualikan dari akses publik sesuai ketentuan hukum.',
            ],
            [
                'title' => 'Strategi Pengadaan',
                'category' => 'dikecualikan',
                'year' => 2025,
                'description' => 'Informasi strategi pengadaan barang dan jasa yang belum diumumkan dan dapat mengganggu proses pengadaan jika dibuka ke publik.',
            ],
            [
                'title' => 'Data Investigasi Internal',
                'category' => 'dikecualikan',
                'year' => 2024,
                'description' => 'Hasil investigasi internal BPMP Provinsi Nusa Tenggara Barat yang bersifat rahasia dan dikecualikan dari akses publik.',
            ],
        ];

        foreach ($items as $item) {
            $publishedAt = sprintf('%d-%02d-%02d %02d:%02d:00', $item['year'], rand(1, 12), rand(1, 28), rand(8, 16), rand(0, 59));

            InformationPublik::create([
                'title' => $item['title'],
                'slug' => Str::slug($item['title']),
                'category' => $item['category'],
                'year' => $item['year'],
                'description' => $item['description'],
                'file_path' => 'documents/informasi/' . Str::slug($item['title']) . '.pdf',
                'file_name' => Str::slug($item['title']) . '.pdf',
                'file_size' => rand(100000, 5000000),
                'mime_type' => 'application/pdf',
                'unit_pengelola' => 'BPMP Provinsi NTB',
                'status' => 'published',
                'published_at' => $publishedAt,
                'created_by' => 1,
            ]);
        }
    }
}
