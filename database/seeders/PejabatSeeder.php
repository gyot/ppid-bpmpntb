<?php

namespace Database\Seeders;

use App\Models\Pejabat;
use Illuminate\Database\Seeder;

class PejabatSeeder extends Seeder
{
    public function run(): void
    {
        Pejabat::create([
            'nama' => '[Nama Kepala BPMP NTB]',
            'jabatan' => 'Kepala BPMP Provinsi Nusa Tenggara Barat',
            'keterangan' => '<p>Kepala BPMP Provinsi Nusa Tenggara Barat bertanggung jawab atas seluruh kegiatan operasional balai dalam rangka peningkatan mutu pendidikan di Provinsi NTB.</p>',
            'sort_order' => 1, 'is_active' => true,
        ]);

        Pejabat::create([
            'nama' => 'Hj. Lielies Miningrum, SE',
            'jabatan' => 'Kepala Subbagian Umum BPMP Provinsi NTB — PPID Pelaksana',
            'keterangan' => '<p>PPID Pelaksana yang bertugas mengelola dan melayani permohonan informasi publik di lingkungan BPMP Provinsi Nusa Tenggara Barat.</p><ul><li>Eselon: IVb</li><li>TMT: 12 Juni 2023</li><li>Bertanggung jawab atas pelayanan informasi publik</li></ul>',
            'sort_order' => 2, 'is_active' => true,
        ]);

        Pejabat::create([
            'nama' => '[Nama Sekretaris BPMP NTB]',
            'jabatan' => 'Sekretaris BPMP Provinsi Nusa Tenggara Barat',
            'keterangan' => '<p>Sekretaris BPMP NTB membantu Kepala BPMP dalam koordinasi administrasi dan keuangan balai.</p>',
            'sort_order' => 3, 'is_active' => true,
        ]);
    }
}
