<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        $news = [
            [
                'title' => 'Perkuat Sinergi Pemerintah Daerah, BPMP NTB Gelar Rakor Program MBG 2026',
                'excerpt' => 'BPMP Provinsi NTB menggelar rapat koordinasi bersama pemerintah daerah untuk memperkuat sinergi dalam pelaksanaan program Makan Bergizi Gratis (MBG) tahun 2026 di wilayah Nusa Tenggara Barat.',
                'body' => "BPMP Provinsi Nusa Tenggara Barat menggelar rapat koordinasi (Rakor) bersama pemerintah daerah dalam rangka memperkuat sinergi pelaksanaan program Makan Bergizi Gratis (MBG) tahun 2026. Kegiatan yang berlangsung di Aula BPMP NTB ini dihadiri oleh perwakilan Dinas Pendidikan kabupaten/kota se-NTB, Dinas Kesehatan, serta stakeholder terkait lainnya.\n\nDalam rakor tersebut, dibahas berbagai strategi implementasi program MBG yang meliputi kesiapan infrastruktur dapur sekolah, distribusi bahan baku, standar gizi, serta monitoring dan evaluasi pelaksanaan. Kepala BPMP NTB menekankan pentingnya kolaborasi antarinstansi untuk memastikan program MBG dapat berjalan efektif dan tepat sasaran di seluruh kabupaten/kota di NTB.",
                'category' => 'Program',
                'is_featured' => true,
                'published_at' => '2026-09-18 10:00:00',
            ],
            [
                'title' => 'BPMP NTB Laksanakan Monitoring dan Evaluasi Pelaksanaan Revitalisasi Sekolah',
                'excerpt' => 'BPMP NTB melaksanakan kegiatan monitoring dan evaluasi terhadap pelaksanaan program revitalisasi sekolah di berbagai wilayah di Provinsi NTB.',
                'body' => "BPMP Provinsi Nusa Tenggara Barat melaksanakan kegiatan monitoring dan evaluasi (Monev) terhadap pelaksanaan program revitalisasi sekolah di berbagai wilayah di Provinsi NTB. Kegiatan ini bertujuan untuk memastikan bahwa program revitalisasi berjalan sesuai rencana dan dapat memberikan manfaat optimal bagi dunia pendidikan.\n\nTim Monev BPMP NTB melakukan kunjungan langsung ke sejumlah sekolah yang menjadi lokus revitalisasi, memeriksa progress fisik pembangunan, kualitas material, serta kesesuaian dengan standar yang telah ditetapkan. Hasil evaluasi menunjukkan bahwa sebagian besar progres revitalisasi telah mencapai target yang diharapkan, dengan beberapa catatan perbaikan yang perlu segera ditindaklanjuti oleh pihak terkait.",
                'category' => 'Revitalisasi',
                'is_featured' => false,
                'published_at' => '2026-09-07 09:30:00',
            ],
            [
                'title' => 'BPMP NTB Kawal Sekolah Aman dan Nyaman Melalui Revitalisasi',
                'excerpt' => 'BPMP NTB mengawal program revitalisasi sekolah untuk menciptakan lingkungan belajar yang aman dan nyaman bagi peserta didik di seluruh NTB.',
                'body' => "BPMP Provinsi Nusa Tenggara Barat terus mengawal program revitalisasi sekolah guna menciptakan lingkungan belajar yang aman dan nyaman bagi seluruh peserta didik di wilayah NTB. Program ini merupakan bagian dari upaya pemerintah dalam meningkatkan kualitas infrastruktur pendidikan.\n\nDalam pelaksanaannya, BPMP NTB berkoordinasi dengan dinas pendidikan kabupaten/kota untuk mengidentifikasi sekolah-sekolah yang membutuhkan revitalisasi prioritas. Aspek yang menjadi perhatian meliputi perbaikan ruang kelas, sanitasi, perpustakaan, laboratorium, serta fasilitas pendukung lainnya. Dengan revitalisasi ini, diharapkan proses belajar mengajar dapat berlangsung lebih kondusif dan mendukung peningkatan mutu pendidikan di NTB.",
                'category' => 'Revitalisasi',
                'is_featured' => false,
                'published_at' => '2026-09-04 14:00:00',
            ],
            [
                'title' => 'Percepat Penanganan ATS, BPMP NTB Perkuat Sinergi Lintas Sektor',
                'excerpt' => 'BPMP NTB memperkuat sinergi lintas sektor dalam upaya percepatan penanganan Anak Tidak Sekolah (ATS) di Provinsi Nusa Tenggara Barat.',
                'body' => "BPMP Provinsi Nusa Tenggara Barat memperkuat sinergi lintas sektor dalam upaya percepatan penanganan Anak Tidak Sekolah (ATS) di wilayah Provinsi NTB. Langkah ini diambil sebagai respons terhadap masih tingginya angka ATS di beberapa kabupaten/kota di NTB.\n\nBPMP NTB mengundang berbagai pihak termasuk Dinas Pendidikan, Dinas Sosial, Dinas Kesehatan, perwakilan kecamatan, dan organisasi kemasyarakatan untuk bersama-sama merumuskan strategi penanganan ATS yang komprehensif. Pendekatan yang dilakukan meliputi pemetaan data ATS, intervensi program bantuan pendidikan, penguatan peran keluarga, serta kolaborasi dengan lembaga swadaya masyarakat dalam pendampingan anak-anak yang berisiko putus sekolah.",
                'category' => 'Sosialisasi',
                'is_featured' => false,
                'published_at' => '2026-09-03 11:00:00',
            ],
            [
                'title' => 'Perkuat Budaya Mutu, BPMP NTB Kawal Implementasi SPMI di 10 Kabupaten/Kota',
                'excerpt' => 'BPMP NTB mengawal implementasi Sistem Penjaminan Mutu Internal (SPMI) di 10 kabupaten/kota untuk memperkuat budaya mutu pendidikan.',
                'body' => "BPMP Provinsi Nusa Tenggara Barat mengawal implementasi Sistem Penjaminan Mutu Internal (SPMI) di 10 kabupaten/kota dalam rangka memperkuat budaya mutu pendidikan di wilayah NTB. Program ini merupakan tindak lanjut dari kebijakan pemerintah pusat dalam peningkatan mutu pendidikan nasional.\n\nKegiatan ini meliputi pelatihan guru dan tenaga kependidikan, pendampingan penyusunan dokumen SPMI, supervisi pelaksanaan penjaminan mutu, serta evaluasi hasil implementasi. BPMP NTB menugaskan fasilitator daerah yang bertugas mendampingi sekolah-sekolah dalam menjalankan siklus SPMI secara berkelanjutan. Diharapkan melalui pendampingan intensif ini, sekolah-sekolah di NTB mampu menerapkan budaya mutu secara mandiri dan berkelanjutan.",
                'category' => 'Program',
                'is_featured' => false,
                'published_at' => '2026-09-03 09:00:00',
            ],
            [
                'title' => 'Dari Kebiasaan Baik Menuju Generasi Hebat, BPMP NTB Perkuat G7KAIH',
                'excerpt' => 'BPMP NTB memperkuat implementasi Gerakan 7 Kebiasaan Anak Indonesia Hebat (G7KAIH) untuk membentuk karakter peserta didik yang unggul.',
                'body' => "BPMP Provinsi Nusa Tenggara Barat memperkuat implementasi Gerakan 7 Kebiasaan Anak Indonesia Hebat (G7KAIH) di sekolah-sekolah di wilayah NTB. Gerakan ini bertujuan untuk membentuk karakter peserta didik yang unggul melalui penanaman kebiasaan-kebiasaan positif sejak dini.\n\nDalam kegiatan ini, BPMP NTB menyelenggarakan sosialisasi dan pelatihan bagi guru dan kepala sekolah tentang penerapan G7KAIH di lingkungan sekolah. Tujuh kebiasaan yang ditanamkan meliputi disiplin, tanggung jawab, gotong royong, peduli lingkungan, gemar membaca, rajin berolahraga, dan cinta tanah air. Melalui gerakan ini, diharapkan terbentuk generasi muda NTB yang berkarakter, berprestasi, dan siap menghadapi tantangan masa depan.",
                'category' => 'Program',
                'is_featured' => false,
                'published_at' => '2026-09-03 08:30:00',
            ],
            [
                'title' => 'Awal Baru Semangat Baru di MPLS Ramah SMAN 2 Mataram',
                'excerpt' => 'SMAN 2 Mataram melaksanakan Masa Pengenalan Lingkungan Sekolah (MPLS) Ramah dengan semangat baru menyambut tahun ajaran baru 2026.',
                'body' => "SMAN 2 Mataram melaksanakan kegiatan Masa Pengenalan Lingkungan Sekolah (MPLS) Ramah dengan penuh semangat dalam menyambut tahun ajaran baru 2026. Kegiatan ini dirancang untuk membantu siswa baru beradaptasi dengan lingkungan sekolah secara positif dan menyenangkan.\n\nMPLS Ramah di SMAN 2 Mataram mengusung konsep kegiatan yang humanis, edukatif, dan menyenangkan tanpa kekerasan. Para siswa baru diperkenalkan dengan budaya sekolah, aturan, fasilitas, serta kegiatan ekstrakurikuler yang tersedia. BPMP NTB memberikan dukungan teknis dalam penyusunan modul MPLS Ramah yang sesuai dengan standar penjaminan mutu pendidikan, memastikan bahwa proses pengenalan sekolah berjalan aman, nyaman, dan bermakna bagi seluruh peserta didik baru.",
                'category' => 'Revitalisasi',
                'is_featured' => false,
                'published_at' => '2026-08-24 10:00:00',
            ],
            [
                'title' => 'Semangat Kemerdekaan dan Penghargaan Pengabdian Warnai Upacara HUT RI ke-81',
                'excerpt' => 'BPMP NTB melaksanakan upacara peringatan HUT RI ke-81 dengan penuh khidmat, diwarnai semangat kemerdekaan dan pemberian penghargaan pengabdian.',
                'body' => "BPMP Provinsi Nusa Tenggara Barat melaksanakan upacara peringatan Hari Ulang Tahun Kemerdekaan Republik Indonesia ke-81 dengan penuh khidmat di halaman kantor BPMP NTB. Upacara diikuti oleh seluruh pegawai dan tenaga kontrak di lingkungan BPMP NTB.\n\nDalam upacara tersebut, Kepala BPMP NTB menyampaikan amanat tentang pentingnya memaknai kemerdekaan dengan semangat pengabdian terbaik bagi bangsa dan negara. Pada kesempatan yang sama, diberikan penghargaan pengabdian kepada pegawai yang telah menunjukkan dedikasi dan loyalitas tinggi dalam menjalankan tugas. Pemberian penghargaan ini diharapkan dapat memotivasi seluruh jajaran BPMP NTB untuk terus memberikan kontribusi terbaik dalam penjaminan mutu pendidikan di NTB.",
                'category' => 'Peringatan',
                'is_featured' => false,
                'published_at' => '2026-08-17 08:00:00',
            ],
            [
                'title' => 'Perkuat Pendampingan Sekolah, BPMP NTB Siapkan Fasilitator Daerah',
                'excerpt' => 'BPMP NTB menyiapkan fasilitator daerah untuk memperkuat pendampingan sekolah dalam implementasi program penjaminan mutu pendidikan.',
                'body' => "BPMP Provinsi Nusa Tenggara Barat menyelenggarakan kegiatan persiapan fasilitator daerah dalam rangka memperkuat pendampingan sekolah di seluruh wilayah NTB. Kegiatan ini diikuti oleh calon fasilitator yang berasal dari tenaga pendidik berpengalaman dan pengawas sekolah.\n\nPara calon fasilitator daerah mendapatkan pelatihan intensif selama lima hari yang mencakup teknik pendampingan sekolah, pemahaman instrumen penjaminan mutu, strategi coaching dan mentoring, serta pelaporan hasil pendampingan. Setelah lulus pelatihan, fasilitator daerah akan ditugaskan di sekolah-sekolah sasaran untuk mendampingi proses implementasi Sistem Penjaminan Mutu Internal (SPMI) dan membantu sekolah dalam meningkatkan layanan pendidikan secara berkelanjutan.",
                'category' => 'Pelatihan',
                'is_featured' => false,
                'published_at' => '2026-08-01 09:00:00',
            ],
            [
                'title' => 'BPMP NTB Lepas Empat Pegawai Purna Tugas',
                'excerpt' => 'BPMP NTB menggelar acara pelepasan empat pegawai yang memasuki masa purna tugas sebagai bentuk penghargaan atas pengabdian mereka.',
                'body' => "BPMP Provinsi Nusa Tenggara Barat menggelar acara pelepasan empat pegawai yang memasuki masa purna tugas (pensiun). Acara yang berlangsung khidmat dan penuh keakraban ini dihadiri oleh seluruh pegawai BPMP NTB sebagai bentuk penghargaan atas dedikasi dan pengabdian para purna tugas.\n\nKeempat pegawai yang dilepas telah mengabdi selama puluhan tahun di lingkungan Kementerian Pendidikan dan kehadiran mereka di BPMP NTB memberikan kontribusi besar dalam membangun fondasi organisasi. Dalam sambutannya, Kepala BPMP NTB menyampaikan terima kasih atas pengabdian selama ini dan mendoakan yang terbaik bagi keempat purna tugas. Acara ditutup dengan pemberian cinderamata dan foto bersama sebagai kenang-kenangan.",
                'category' => 'Kegiatan',
                'is_featured' => false,
                'published_at' => '2026-08-01 08:00:00',
            ],
        ];

        foreach ($news as $item) {
            News::create([
                'title' => $item['title'],
                'slug' => Str::slug($item['title']),
                'excerpt' => $item['excerpt'],
                'body' => $item['body'],
                'category' => $item['category'],
                'status' => 'published',
                'is_featured' => $item['is_featured'],
                'published_at' => $item['published_at'],
                'author_id' => 1,
                'views_count' => rand(50, 500),
            ]);
        }
    }
}
