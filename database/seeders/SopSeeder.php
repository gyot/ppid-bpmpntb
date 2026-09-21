<?php

namespace Database\Seeders;

use App\Models\Sop;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SopSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'title' => 'SOP Permintaan Informasi Publik',
                'slug' => 'sop-permintaan-informasi-publik-' . Str::random(5),
                'deskripsi' => 'Prosedur pengajuan permintaan informasi publik oleh pemohon hingga penyerahan informasi oleh PPID.',
                'konten' => '<h3>Langkah-langkah Permintaan Informasi Publik:</h3><ol><li>Pemohon mengisi formulir permintaan informasi yang tersedia di kantor PPID atau melalui website.</li><li>PPID melakukan verifikasi kelengkapan data pemohon dalam waktu maksimal 2 hari kerja.</li><li>PPID mencari informasi yang diminta dari unit pengelola informasi terkait.</li><li>Jika informasi tersedia, PPID menyerahkan informasi dalam waktu maksimal 10 hari kerja.</li><li>Jika informasi tidak tersedia atau dikecualikan, PPID memberitahukan secara tertulis beserta alasan pengecualiannya.</li><li>Pemohon menandatangani bukti penerimaan informasi.</li></ol>',
                'icon' => 'document-text',
                'sort_order' => 1,
                'is_active' => true,
                'created_by' => 1,
            ],
            [
                'title' => 'SOP Penanganan Keberatan',
                'slug' => 'sop-penanganan-keberatan-' . Str::random(5),
                'deskripsi' => 'Prosedur penanganan keberatan atas informasi publik yang tidak diberikan atau tidak sesuai.',
                'konten' => '<h3>Langkah-langkah Penanganan Keberatan:</h3><ol><li>Pemohon mengajukan keberatan secara tertulis kepada Atasan PPID dalam waktu 30 hari kerja setelah keputusan diterima.</li><li>Atasan PPID menerima dan mencatat surat keberatan.</li><li>Atasan PPID melakukan klarifikasi dan verifikasi atas keberatan yang diajukan.</li><li>Atasan PPID mengambil keputusan dalam waktu maksimal 30 hari kerja sejak keberatan diterima.</li><li>Keputusan disampaikan secara tertulis kepada pemohon.</li><li>Jika pemohon tidak puas, dapat mengajukan sengketa ke Komisi Informasi.</li></ol>',
                'icon' => 'exclamation',
                'sort_order' => 2,
                'is_active' => true,
                'created_by' => 1,
            ],
            [
                'title' => 'SOP Penetapan dan Pemutakhiran DIP',
                'slug' => 'sop-penetapan-pemutakhiran-dip-' . Str::random(5),
                'deskripsi' => 'Prosedur penetapan dan pemutakhiran Daftar Informasi Publik (DIP) secara berkala.',
                'konten' => '<h3>Langkah-langkah Penetapan dan Pemutakhiran DIP:</h3><ol><li>PPID melakukan inventarisasi informasi yang dikuasai oleh badan publik.</li><li>PPID mengklasifikasikan informasi sesuai kategori (berkala, setiap saat, serta merta, dikecualikan).</li><li>PPID menyusun draf DIP dan melakukan konsultasi dengan unit terkait.</li><li>Draf DIP disahkan oleh Kepala Badan Publik.</li><li>DIP diumumkan melalui website dan media lainnya.</li><li>Pemutakhiran DIP dilakukan minimal 1 (satu) kali dalam 6 (enam) bulan.</li></ol>',
                'icon' => 'clipboard-list',
                'sort_order' => 3,
                'is_active' => true,
                'created_by' => 1,
            ],
            [
                'title' => 'SOP Pengujian Konsekuensi',
                'slug' => 'sop-pengujian-konsekuensi-' . Str::random(5),
                'deskripsi' => 'Prosedur pengujian konsekuensi untuk menentukan apakah suatu informasi dapat dikecualikan.',
                'konten' => '<h3>Langkah-langkah Pengujian Konsekuensi:</h3><ol><li>PPID menerima permintaan informasi yang termasuk kategori informasi yang dikecualikan.</li><li>PPID membentuk Tim Pengujian Konsekuensi yang terdiri dari unsur pimpinan dan ahli.</li><li>Tim melakukan pengujian dengan mempertimbangkan kerugian yang dapat ditimbulkan jika informasi dibuka.</li><li>Tim menyusun laporan hasil pengujian konsekuensi.</li><li>Keputusan akhir ditetapkan oleh Atasan PPID berdasarkan rekomendasi Tim.</li><li>Hasil pengujian disampaikan kepada pemohon secara tertulis.</li></ol>',
                'icon' => 'shield-check',
                'sort_order' => 4,
                'is_active' => true,
                'created_by' => 1,
            ],
            [
                'title' => 'SOP Pendokumentasian Informasi Publik',
                'slug' => 'sop-pendokumentasian-informasi-publik-' . Str::random(5),
                'deskripsi' => 'Prosedur pendokumentasian informasi publik dari penciptaan hingga pemusnahan sesuai jadwal retensi.',
                'konten' => '<h3>Langkah-langkah Pendokumentasian Informasi Publik:</h3><ol><li>Setiap unit kerja menciptakan dan mengelola dokumen sesuai tugas dan fungsinya.</li><li>Dokumen diklasifikasikan berdasarkan tingkat akses (terbuka, terbatas, rahasia).</li><li>PPID melakukan inventarisasi dan pendataan dokumen secara berkala.</li><li>Dokumen disimpan dalam sistem pengelolaan dokumen yang aman dan terstruktur.</li><li>Pemusnahan dokumen dilakukan sesuai jadwal retensi dan prosedur yang berlaku.</li><li>PPID melaporkan hasil pendokumentasian kepada pimpinan secara berkala.</li></ol>',
                'icon' => 'archive',
                'sort_order' => 5,
                'is_active' => true,
                'created_by' => 1,
            ],
        ];

        foreach ($data as $item) {
            Sop::create($item);
        }
    }
}
