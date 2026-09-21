<?php

namespace Database\Seeders;

use App\Models\DaftarInformasiPublik;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DipSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['title' => 'Profil BPMP Nusa Tenggara Barat', 'category' => 'berkala', 'jenis_informasi' => 'Profil Organisasi', 'uraian_informasi' => 'Informasi mengenai profil Badan Pembinaan Masyarakat Pendidikan Provinsi Nusa Tenggara Barat meliputi sejarah, visi, misi, dan struktur organisasi.', 'sumber_informasi' => 'BPMP NTB', 'media_informasi' => 'Website, Dokumen', 'jkd' => '1 Tahun'],
            ['title' => 'Laporan Harta Kekayaan Penyelenggara Negara (LHKPN)', 'category' => 'berkala', 'jenis_informasi' => 'Laporan Keuangan', 'uraian_informasi' => 'Laporan harta kekayaan penyelenggara negara di lingkungan BPMP NTB yang dilaporkan secara berkala kepada KPK.', 'sumber_informasi' => 'BPMP NTB', 'media_informasi' => 'Dokumen', 'jkd' => '1 Tahun'],
            ['title' => 'Program Kerja Tahunan BPMP NTB', 'category' => 'berkala', 'jenis_informasi' => 'Program dan Kegiatan', 'uraian_informasi' => 'Rencana program kerja tahunan BPMP NTB yang mencakup target, sasaran, dan indikator kinerja.', 'sumber_informasi' => 'BPMP NTB', 'media_informasi' => 'Website, Dokumen', 'jkd' => '1 Tahun'],
            ['title' => 'Laporan Keuangan BPMP NTB', 'category' => 'berkala', 'jenis_informasi' => 'Laporan Keuangan', 'uraian_informasi' => 'Laporan keuangan BPMP NTB termasuk realisasi anggaran, laporan neraca, dan laporan operasional.', 'sumber_informasi' => 'BPMP NTB', 'media_informasi' => 'Dokumen', 'jkd' => '1 Tahun'],
            ['title' => 'Ringkasan Akses Informasi Publik', 'category' => 'berkala', 'jenis_informasi' => 'Statistik Pelayanan', 'uraian_informasi' => 'Ringkasan data permohonan informasi, keberatan, dan sengketa informasi publik yang diterima BPMP NTB.', 'sumber_informasi' => 'PPID BPMP NTB', 'media_informasi' => 'Website, Dokumen', 'jkd' => '3 Bulan'],
            ['title' => 'Daftar Regulasi di Lingkungan BPMP NTB', 'category' => 'berkala', 'jenis_informasi' => 'Regulasi', 'uraian_informasi' => 'Daftar peraturan perundang-undangan yang berlaku di lingkungan BPMP NTB beserta statusnya.', 'sumber_informasi' => 'BPMP NTB', 'media_informasi' => 'Website', 'jkd' => '6 Bulan'],
            ['title' => 'Rencana Strategis BPMP NTB', 'category' => 'berkala', 'jenis_informasi' => 'Perencanaan', 'uraian_informasi' => 'Rencana strategis BPMP NTB untuk periode 5 tahun yang memuat arah kebijakan dan program prioritas.', 'sumber_informasi' => 'BPMP NTB', 'media_informasi' => 'Website, Dokumen', 'jkd' => '5 Tahun'],
            ['title' => 'Laporan Kinerja Instansi (LAKIP)', 'category' => 'berkala', 'jenis_informasi' => 'Laporan Kinerja', 'uraian_informasi' => 'Laporan akuntabilitas kinerja instansi pemerintah BPMP NTB sebagai bentuk pertanggungjawaban pelaksanaan program.', 'sumber_informasi' => 'BPMP NTB', 'media_informasi' => 'Dokumen', 'jkd' => '1 Tahun'],

            ['title' => 'Peraturan Menteri Pendidikan Nomor 11 Tahun 2022', 'category' => 'setiap_saat', 'jenis_informasi' => 'Regulasi', 'uraian_informasi' => 'Peraturan Menteri tentang Organisasi dan Tata Kerja Badan Pembinaan Masyarakat Pendidikan.', 'sumber_informasi' => 'Kementerian Pendidikan', 'media_informasi' => 'Website, Dokumen', 'jkd' => 'Setiap Saat'],
            ['title' => 'Data Barang Milik Negara (BMN)', 'category' => 'setiap_saat', 'jenis_informasi' => 'Data Aset', 'uraian_informasi' => 'Daftar barang milik negara yang dikelola oleh BPMP NTB termasuk tanah, gedung, dan peralatan.', 'sumber_informasi' => 'BPMP NTB', 'media_informasi' => 'Dokumen', 'jkd' => 'Setiap Saat'],
            ['title' => 'Data Perbendaharaan BPMP NTB', 'category' => 'setiap_saat', 'jenis_informasi' => 'Data Keuangan', 'uraian_informasi' => 'Data perbendaharaan yang meliputi DIPA, rencana penarikan dana, dan realisasi anggaran terkini.', 'sumber_informasi' => 'BPMP NTB', 'media_informasi' => 'Dokumen', 'jkd' => 'Setiap Saat'],
            ['title' => 'SK Penetapan PPID BPMP NTB', 'category' => 'setiap_saat', 'jenis_informasi' => 'Keputusan', 'uraian_informasi' => 'Surat Keputusan tentang Penetapan Pejabat Pengelola Informasi dan Dokumentasi di lingkungan BPMP NTB.', 'sumber_informasi' => 'BPMP NTB', 'media_informasi' => 'Website, Dokumen', 'jkd' => 'Setiap Saat'],
            ['title' => 'Pedoman Teknis Bimbingan dan Konseling', 'category' => 'setiap_saat', 'jenis_informasi' => 'Pedoman', 'uraian_informasi' => 'Pedoman teknis pelaksanaan bimbingan dan konseling di satuan pendidikan.', 'sumber_informasi' => 'BPMP NTB', 'media_informasi' => 'Website, Dokumen', 'jkd' => 'Setiap Saat'],
            ['title' => 'Data Statistik Pendidikan NTB', 'category' => 'setiap_saat', 'jenis_informasi' => 'Data Statistik', 'uraian_informasi' => 'Data statistik pendidikan Provinsi Nusa Tenggara Barat yang mencakup jumlah sekolah, siswa, guru, dan tenaga kependidikan.', 'sumber_informasi' => 'BPMP NTB', 'media_informasi' => 'Website', 'jkd' => 'Setiap Saat'],

            ['title' => 'Pengumuman Kegawatdaruratan Pendidikan', 'category' => 'serta_merta', 'jenis_informasi' => 'Pengumuman Darurat', 'uraian_informasi' => 'Informasi mengenai keadaan darurat di bidang pendidikan yang dapat mengancam hajat hidup orang banyak.', 'sumber_informasi' => 'BPMP NTB', 'media_informasi' => 'Website, Media Sosial', 'jkd' => 'Seketika'],
            ['title' => 'Peringatan Keamanan dan Keselamatan Sekolah', 'category' => 'serta_merta', 'jenis_informasi' => 'Peringatan', 'uraian_informasi' => 'Informasi peringatan keamanan dan keselamatan satuan pendidikan akibat bencana alam atau ancaman lainnya.', 'sumber_informasi' => 'BPMP NTB', 'media_informasi' => 'Website, Media Sosial', 'jkd' => 'Seketika'],
            ['title' => 'Informasi Bencana yang Mempengaruhi Dunia Pendidikan', 'category' => 'serta_merta', 'jenis_informasi' => 'Info Bencana', 'uraian_informasi' => 'Informasi terkini mengenai bencana alam yang berdampak pada satuan pendidikan di Provinsi NTB.', 'sumber_informasi' => 'BPMP NTB, BNPB', 'media_informasi' => 'Website, Media Sosial', 'jkd' => 'Seketika'],

            ['title' => 'Informasi yang Termasuk Rahasia Negara', 'category' => 'dikecualikan', 'jenis_informasi' => 'Rahasia Negara', 'uraian_informasi' => 'Informasi yang apabila dibuka dan diberikan kepada umum dapat mengancam pertahanan dan keamanan negara.', 'sumber_informasi' => 'BPMP NTB', 'media_informasi' => '-', 'jkd' => '-'],
            ['title' => 'Data Pribadi Pegawai dan Peserta Didik', 'category' => 'dikecualikan', 'jenis_informasi' => 'Data Pribadi', 'uraian_informasi' => 'Informasi yang berkaitan dengan data pribadi pegawai dan peserta didik yang dilindungi undang-undang.', 'sumber_informasi' => 'BPMP NTB', 'media_informasi' => '-', 'jkd' => '-'],
            ['title' => 'Informasi Proses Hukum yang Sedang Berlangsung', 'category' => 'dikecualikan', 'jenis_informasi' => 'Proses Hukum', 'uraian_informasi' => 'Informasi yang berkaitan dengan proses hukum yang sedang berlangsung yang apabila dibuka dapat menghambat penegakan hukum.', 'sumber_informasi' => 'BPMP NTB', 'media_informasi' => '-', 'jkd' => '-'],
            ['title' => 'Rencana Penganggaran yang Belum Ditetapkan', 'category' => 'dikecualikan', 'jenis_informasi' => 'Rencana Anggaran', 'uraian_informasi' => 'Informasi rencana penganggaran yang masih dalam tahap pembahasan dan belum ditetapkan secara resmi.', 'sumber_informasi' => 'BPMP NTB', 'media_informasi' => '-', 'jkd' => '-'],
        ];

        foreach ($items as $item) {
            DaftarInformasiPublik::create(array_merge($item, [
                'slug' => Str::slug($item['title']) . '-' . Str::random(5),
                'status' => 'published',
                'created_by' => 1,
            ]));
        }
    }
}
