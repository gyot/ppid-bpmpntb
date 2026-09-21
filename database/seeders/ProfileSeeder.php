<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    public function run(): void
    {
        Setting::set('profil_tentang_teks', 'Informasi publik merupakan kebutuhan mendasar bagi setiap individu dalam mengembangkan diri dan berperan aktif di lingkungan sosialnya. Akses terhadap informasi juga menjadi bagian penting dalam menjaga transparansi, akuntabilitas, dan ketahanan nasional.

Setiap warga negara berhak memperoleh informasi publik, sementara Badan Publik memiliki kewajiban untuk menyediakannya secara terbuka, kecuali informasi yang termasuk kategori dikecualikan.

Balai Penjaminan Mutu Pendidikan Provinsi Nusa Tenggara Barat (BPMP NTB) sebagai salah satu Unit Pelaksana Teknis di lingkungan Kemendikdasmen berperan penting dalam menjalankan fungsi teknis operasional di bidang peningkatan mutu pendidikan. PPID BPMP NTB bertugas memastikan pelayanan informasi publik di lingkungan balai berjalan secara profesional, transparan, dan sesuai ketentuan yang berlaku.', 'profil_tentang');

        Setting::set('profil_visi_teks', 'Terwujudnya pelayanan informasi yang transparan dan akuntabel untuk memenuhi hak pemohon informasi sesuai dengan ketentuan peraturan perundang-undangan yang berlaku.', 'profil_visi');

        Setting::set('profil_misi_teks', "1. Menyediakan informasi publik yang akurat dan dapat dipertanggungjawabkan\n2. Membangun dan mengembangkan sistem penyediaan dan layanan informasi\n3. Meningkatkan pengelolaan informasi dan dokumentasi secara baik, efisien, mudah diakses dan bersifat desentralisasi\n4. Memanfaatkan teknologi informasi dalam memberikan layanan informasi publik kepada masyarakat", 'profil_misi');

        Setting::set('profil_tugas_teks', "1. Menyediakan, menyimpan, mendokumentasikan, dan mengamankan Informasi\n2. Menyediakan sumber daya untuk pelayanan dan pendokumentasian Informasi Publik\n3. Menganggarkan pembiayaan bagi pelayanan dan pendokumentasian Informasi Publik\n4. Membuat prosedur pelayanan dan pendokumentasian Informasi Publik\n5. Melayani permintaan informasi publik secara cepat, tepat dan sederhana\n6. Membuat pertimbangan tertulis atas setiap kebijakan yang diambil\n7. Mengoordinasikan dan mengonsolidasikan pengumpulan dokumen informasi publik\n8. Mengklasifikasikan informasi publik dan/atau pengubahannya\n9. Melakukan evaluasi terhadap pelayanan dan pendokumentasian Informasi Publik\n10. Menyusun laporan pelayanan dan pendokumentasian Informasi Publik", 'profil_tugas');

        Setting::set('profil_dasar_hukum_teks', "1. Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik\n2. Peraturan Pemerintah Nomor 61 Tahun 2010 tentang Pelaksanaan UU KIP\n3. Peraturan Komisi Informasi Nomor 1 Tahun 2021 tentang Standar Layanan Informasi Publik\n4. Peraturan Menteri Pendidikan, Kebudayaan, Riset, dan Teknologi Nomor 69 Tahun 2024 tentang Pengelolaan dan Pelayanan Informasi Publik\n5. Keputusan Menteri Pendidikan, Kebudayaan, Riset, dan Teknologi Nomor 263/O/2022 tentang Rincian Tugas BPMP", 'profil_dasar_hukum');

        Setting::set('profil_maklumat_teks', 'Kami, Badan Penjaminan Mutu Pendidikan Provinsi Nusa Tenggara Barat, berkomitmen untuk memberikan pelayanan informasi publik yang transparan, cepat, tepat waktu, dan mudah diakses oleh seluruh masyarakat. Kami menjamin hak setiap warga negara untuk memperoleh informasi publik sesuai dengan Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik. Kami akan melayani permohonan informasi dengan profesional, tidak diskriminatif, dan sesuai dengan prosedur yang berlaku.', 'profil_maklumat');

        Setting::set('profil_standar_teks', "1. Data dan Informasi Mutu Pendidikan\n2. Fasilitasi Penjaminan Mutu Pendidikan\n3. Kemitraan Penjaminan Mutu Pendidikan\n4. Pemetaan dan Supervisi Mutu Pendidikan\n5. Peminjaman Sarana dan Prasarana\n6. Penerimaan Peserta Magang\n7. Pengaduan Masyarakat", 'profil_standar');
    }
}
