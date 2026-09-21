<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Apa itu PPID?',
                'answer' => 'PPID (Pejabat Pengelola Informasi dan Dokumentasi) adalah pejabat yang bertanggung jawab di bidang penyimpanan, pendokumentasian, penyediaan, dan pelayanan informasi di badan publik. PPID BPMP Provinsi Nusa Tenggara Barat merupakan unit yang ditugaskan untuk mengelola dan melayani permintaan informasi publik di lingkungan BPMP NTB sesuai amanat Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik.',
                'category' => 'Umum',
                'sort_order' => 1,
            ],
            [
                'question' => 'Bagaimana cara mengajukan permohonan informasi?',
                'answer' => "Untuk mengajukan permohonan informasi, Anda dapat mengikuti langkah-langkah berikut:\n1. Buka portal PPID BPMP NTB dan klik menu \"Ajukan Permohonan\".\n2. Isi formulir permohonan dengan data yang lengkap, termasuk identitas pemohon, informasi yang diminta, dan tujuan penggunaan informasi.\n3. Lampirkan dokumen identitas (KTP/Paspor) sebagai verifikasi.\n4. Kirim permohonan dan catat nomor registrasi yang diberikan.\n5. Pantau status permohonan melalui menu \"Cek Status\" menggunakan nomor registrasi.\n\nAnda juga dapat mengajukan permohonan secara langsung di kantor BPMP NTB dengan membawa identitas diri.",
                'category' => 'Permohonan',
                'sort_order' => 2,
            ],
            [
                'question' => 'Berapa lama proses permohonan informasi?',
                'answer' => 'Berdasarkan Undang-Undang Keterbukaan Informasi Publik, badan publik wajib memberikan informasi dalam waktu paling lambat 10 (sepuluh) hari kerja sejak permohonan diterima. Jika diperlukan, masa perpanjangan dapat diberikan paling lama 7 (tujuh) hari kerja tambahan dengan pemberitahuan tertulis kepada pemohon beserta alasan perpanjangan. Total waktu maksimal yang diperlukan adalah 17 (tujuh belas) hari kerja.',
                'category' => 'Permohonan',
                'sort_order' => 3,
            ],
            [
                'question' => 'Bagaimana cara mengecek status permohonan?',
                'answer' => 'Anda dapat mengecek status permohonan informasi melalui beberapa cara: (1) Masuk ke portal PPID BPMP NTB dan klik menu "Cek Status Permohonan", kemudian masukkan nomor registrasi yang Anda terima saat mengajukan permohonan; (2) Kirim email ke alamat PPID BPMP NTB dengan menyertakan nomor registrasi; (3) Hubungi layanan telepon PPID BPMP NTB pada jam kerja. Status permohonan akan menunjukkan tahapan proses, mulai dari diterima, dalam verifikasi, dalam proses, hingga selesai.',
                'category' => 'Permohonan',
                'sort_order' => 4,
            ],
            [
                'question' => 'Apa yang dimaksud informasi yang dikecualikan?',
                'answer' => 'Informasi yang dikecualikan adalah informasi yang dikecualikan dari hak akses publik berdasarkan ketentuan undang-undang. Informasi ini meliputi: (1) informasi yang dapat menghambat proses penegakan hukum; (2) informasi yang mengganggu kepentingan perlindungan hak atas kekayaan intelektual; (3) informasi yang membahayakan pertahanan dan keamanan negara; (4) informasi yang menyangkut rahasia pribadi; serta (5) informasi yang dinyatakan tertutup oleh undang-undang. Informasi dikecualikan ditetapkan melalui uji konsekuensi sesuai ketentuan peraturan perundang-undangan.',
                'category' => 'Informasi',
                'sort_order' => 5,
            ],
            [
                'question' => 'Bagaimana cara mengajukan keberatan?',
                'answer' => 'Jika permohonan informasi Anda ditolak atau tidak mendapat tanggapan, Anda dapat mengajukan keberatan dengan langkah berikut: (1) Ajukan keberatan secara tertulis kepada Atasan PPID BPMP NTB dalam jangka waktu paling lambat 30 hari kerja sejak keputusan diterima; (2) Sertakan alasan keberatan yang jelas beserta bukti pendukung; (3) Atasan PPID wajib memberikan jawaban dalam waktu paling lambat 30 hari kerja; (4) Jika keberatan tidak ditanggapi atau ditolak, Anda dapat mengajukan sengketa informasi ke Komisi Informasi Provinsi NTB.',
                'category' => 'Keberatan',
                'sort_order' => 6,
            ],
            [
                'question' => 'Apakah ada biaya untuk mendapatkan informasi?',
                'answer' => 'Pelayanan informasi publik di BPMP NTB tidak dipungut biaya (gratis) untuk permohonan informasi melalui portal online. Namun, untuk salinan dokumen fisik, pemohon dikenakan biaya penggantian yang meliputi biaya cetak dan pengiriman sesuai ketentuan yang berlaku. Biaya ini hanya sebatas penggantian atas materai, cetak, dan pengiriman, bukan biaya untuk informasi itu sendiri. Rincian biaya dapat dilihat di menu informasi biaya pada portal PPID BPMP NTB.',
                'category' => 'Biaya',
                'sort_order' => 7,
            ],
            [
                'question' => 'Siapa yang dapat mengajukan permohonan informasi?',
                'answer' => 'Setiap warga negara Indonesia dan badan hukum yang didirikan di Indonesia berhak mengajukan permohonan informasi publik kepada badan publik. Pemohon tidak perlu menyebutkan alasan atau kepentingan untuk memperoleh informasi yang bersifat terbuka. Pemohon hanya perlu mengisi formulir permohonan dengan identitas yang jelas dan menunjukkan identitas diri (KTP/Paspor/KITAS untuk warga negara asing). Badan publik tidak boleh menolak permohonan tanpa alasan yang sah sesuai undang-undang.',
                'category' => 'Permohonan',
                'sort_order' => 8,
            ],
            [
                'question' => 'Apa saja jenis informasi yang tersedia?',
                'answer' => 'PPID BPMP NTB menyediakan empat kategori informasi publik: (1) Informasi Berkala - informasi yang wajib diumumkan secara rutin seperti laporan kinerja, rencana strategis, dan data keuangan; (2) Informasi Setiap Saat - informasi yang dapat diakses kapan saja seperti struktur organisasi, prosedur pelayanan, dan data statistik; (3) Informasi Serta Merta - informasi yang harus segera diumumkan karena menyangkut hajat hidup orang banyak; (4) Informasi yang Dikecualikan - informasi yang tidak dapat diakses publik sesuai ketentuan undang-undang.',
                'category' => 'Informasi',
                'sort_order' => 9,
            ],
            [
                'question' => 'Bagaimana cara menghubungi PPID BPMP NTB?',
                'answer' => 'Anda dapat menghubungi PPID BPMP NTB melalui beberapa saluran: (1) Kunjungi langsung kantor BPMP Provinsi NTB pada jam kerja Senin-Jumat pukul 08.00-16.00 WITA; (2) Kirim email ke alamat email resmi PPID BPMP NTB; (3) Hubungi nomor telepon kantor BPMP NTB; (4) Kirim pesan melalui formulir kontak yang tersedia di portal PPID; (5) Ikuti media sosial resmi BPMP NTB untuk informasi terkini. Untuk keperluan permohonan informasi resmi, disarankan menggunakan portal online atau surat tertulis.',
                'category' => 'Kontak',
                'sort_order' => 10,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
