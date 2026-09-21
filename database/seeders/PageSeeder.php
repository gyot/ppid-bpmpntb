<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'title' => 'Maklumat Pelayanan',
                'content' => "<h2>Maklumat Pelayanan PPID BPMP Provinsi Nusa Tenggara Barat</h2>\n\n<p>Kami, Badan Penjaminan Mutu Pendidikan Provinsi Nusa Tenggara Barat, berkomitmen untuk memberikan pelayanan informasi publik yang transparan, cepat, tepat waktu, dan mudah diakses oleh seluruh masyarakat. Kami menjamin hak setiap warga negara untuk memperoleh informasi publik sesuai dengan Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik. Kami akan melayani permohonan informasi dengan profesional, tidak diskriminatif, dan sesuai dengan prosedur yang berlaku.</p>\n\n<p>Apabila kami tidak melaksanakan janji sebagaimana yang tertuang dalam maklumat pelayanan ini, maka masyarakat berhak untuk mengadukan ketidakpuasan tersebut kepada pimpinan BPMP NTB atau melalui mekanisme pengaduan yang tersedia. Kami akan menindaklanjuti setiap pengaduan secara profesional dan transparan.</p>",
                'meta_title' => 'Maklumat Pelayanan PPID BPMP NTB',
                'meta_description' => 'Maklumat pelayanan informasi publik PPID BPMP Provinsi Nusa Tenggara Barat.',
            ],
            [
                'title' => 'Standar Pelayanan',
                'content' => "<h2>Standar Pelayanan Informasi Publik PPID BPMP NTB</h2>\n\n<p>Standar Pelayanan Informasi Publik BPMP Provinsi Nusa Tenggara Barat ditetapkan sebagai pedoman dalam penyelenggaraan pelayanan informasi publik. Standar ini mencakup layanan unggulan BPMP NTB dalam rangka penjaminan mutu pendidikan di Provinsi Nusa Tenggara Barat.</p>\n\n<p><strong>1. Data dan Informasi Mutu Pendidikan</strong> – Penyediaan data dan informasi terkait mutu pendidikan di Provinsi NTB yang meliputi hasil asesmen, pemetaan mutu, dan capaian indikator pendidikan.</p>\n\n<p><strong>2. Fasilitasi Penjaminan Mutu Pendidikan</strong> – Layanan fasilitasi dalam rangka penjaminan mutu pendidikan yang mencakup pendampingan sekolah, pelatihan guru, dan pengembangan kurikulum.</p>\n\n<p><strong>3. Kemitraan Penjaminan Mutu Pendidikan</strong> – Layanan kemitraan dengan berbagai pihak dalam upaya peningkatan mutu pendidikan, termasuk kerja sama dengan perguruan tinggi, organisasi masyarakat, dan sektor swasta.</p>\n\n<p><strong>4. Pemetaan dan Supervisi Mutu Pendidikan</strong> – Layanan pemetaan kondisi mutu pendidikan dan supervisi di satuan pendidikan untuk memastikan standar nasional pendidikan terpenuhi.</p>\n\n<p><strong>5. Peminjaman Sarana dan Prasarana</strong> – Layanan peminjaman sarana dan prasarana milik BPMP NTB untuk mendukung kegiatan pendidikan dan pelatihan.</p>\n\n<p><strong>6. Penerimaan Peserta Magang</strong> – Layanan penerimaan peserta magang dari perguruan tinggi atau instansi lain yang ingin belajar dan berkontribusi di BPMP NTB.</p>\n\n<p><strong>7. Pengaduan Masyarakat</strong> – Layanan penerimaan dan tindaklanjuti pengaduan masyarakat terkait kualitas layanan dan penyelenggaraan pendidikan di Provinsi NTB.</p>",
                'meta_title' => 'Standar Pelayanan Informasi Publik PPID BPMP NTB',
                'meta_description' => 'Standar pelayanan informasi publik PPID BPMP Provinsi Nusa Tenggara Barat mencakup 7 layanan unggulan.',
            ],
            [
                'title' => 'SOP Pelayanan Informasi',
                'content' => "<h2>Standar Operasional Prosedur (SOP) Pelayanan Informasi Publik</h2>\n\n<p>Standar Operasional Prosedur (SOP) Pelayanan Informasi Publik PPID BPMP Provinsi Nusa Tenggara Barat disusun sebagai acuan teknis dalam pelaksanaan pelayanan informasi publik. SOP ini memastikan bahwa setiap permohonan informasi diproses secara sistematis, konsisten, dan sesuai dengan ketentuan peraturan perundang-undangan.</p>\n\n<p><strong>Tahap 1 – Penerimaan Permohonan:</strong> Petugas PPID menerima permohonan informasi melalui portal online, email, surat, atau kedatangan langsung. Permohonan diverifikasi kelengkapan data dan identitas pemohon. Nomor registrasi diberikan kepada pemohon sebagai bukti penerimaan permohonan.</p>\n\n<p><strong>Tahap 2 – Pencarian dan Penyiapan Informasi:</strong> Petugas melakukan pencarian informasi sesuai permohonan pada database dan arsip. Informasi yang ditemukan diverifikasi keakuratan dan kelengkapannya. Jika informasi melibatkan unit kerja lain, petugas berkoordinasi untuk mendapatkan informasi yang diminta.</p>\n\n<p><strong>Tahap 3 – Keputusan dan Penyampaian:</strong> PPID mengambil keputusan untuk memberikan, menolak, atau memberikan sebagian informasi yang diminta. Keputusan disampaikan secara tertulis kepada pemohon beserta alasan jika terdapat penolakan. Informasi yang disetujui diberikan dalam format yang diminta oleh pemohon.</p>\n\n<p><strong>Tahap 4 – Pencatatan dan Pelaporan:</strong> Setiap permohonan dan hasilnya dicatat dalam register informasi. Data digunakan untuk penyusunan laporan keterbukaan informasi secara berkala. Monitoring dan evaluasi dilakukan secara rutin untuk peningkatan kualitas pelayanan.</p>",
                'meta_title' => 'SOP Pelayanan Informasi Publik PPID BPMP NTB',
                'meta_description' => 'Standar Operasional Prosedur pelayanan informasi publik PPID BPMP Provinsi Nusa Tenggara Barat.',
            ],
        ];

        foreach ($pages as $page) {
            Page::create([
                'title' => $page['title'],
                'slug' => Str::slug($page['title']),
                'content' => $page['content'],
                'meta_title' => $page['meta_title'],
                'meta_description' => $page['meta_description'],
                'is_active' => true,
            ]);
        }
    }
}
