<?php

namespace Database\Seeders;

use App\Models\Lhkpn;
use Illuminate\Database\Seeder;

class LhkpnSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama_pejabat' => 'Kepala BPMP NTB',
                'jabatan' => 'Kepala BPMP Provinsi NTB',
                'nip' => null,
                'periode' => 2025,
                'file_path' => 'uploads/lhkpn/lhkpn-kepala-2025.pdf',
                'file_name' => 'LHKPN_Kepala_BPMP_NTB_2025.pdf',
                'status' => 'published',
                'published_at' => now(),
                'created_by' => 1,
            ],
            [
                'nama_pejabat' => 'Kepala BPMP NTB',
                'jabatan' => 'Kepala BPMP Provinsi NTB',
                'nip' => null,
                'periode' => 2024,
                'file_path' => 'uploads/lhkpn/lhkpn-kepala-2024.pdf',
                'file_name' => 'LHKPN_Kepala_BPMP_NTB_2024.pdf',
                'status' => 'published',
                'published_at' => now(),
                'created_by' => 1,
            ],
            [
                'nama_pejabat' => 'Hj. Lielies Miningrum, SE',
                'jabatan' => 'Kepala Subbagian Umum',
                'nip' => '197508152005012001',
                'periode' => 2025,
                'file_path' => 'uploads/lhkpn/lhkpn-ka-subbag-2025.pdf',
                'file_name' => 'LHKPN_KaSubbagUmum_2025.pdf',
                'status' => 'published',
                'published_at' => now(),
                'created_by' => 1,
            ],
            [
                'nama_pejabat' => 'Pejabat Struktural 1',
                'jabatan' => 'Kepala Bidang Penjaminan Mutu',
                'nip' => null,
                'periode' => 2025,
                'file_path' => 'uploads/lhkpn/lhkpn-kabid-2025.pdf',
                'file_name' => 'LHKPN_KaBidPM_2025.pdf',
                'status' => 'published',
                'published_at' => now(),
                'created_by' => 1,
            ],
            [
                'nama_pejabat' => 'Pejabat Struktural 2',
                'jabatan' => 'Kepala Subbagian Program dan Keuangan',
                'nip' => null,
                'periode' => 2025,
                'file_path' => 'uploads/lhkpn/lhkpn-kasubag-prog-2025.pdf',
                'file_name' => 'LHKPN_KaSubbagProgKeg_2025.pdf',
                'status' => 'draft',
                'published_at' => null,
                'created_by' => 1,
            ],
        ];

        foreach ($data as $item) {
            Lhkpn::create($item);
        }
    }
}
