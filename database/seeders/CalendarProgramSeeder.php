<?php

namespace Database\Seeders;

use App\Models\CalendarProgram;
use App\Models\CalendarProgramMonth;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CalendarProgramSeeder extends Seeder
{
    public function run(): void
    {
        // Data extracted from "Daftar Program dan Jadwal Kegiatan BPMP Provinsi NTB Tahun 2026 untuk Print.xlsx"
        // Format: [penanggung_jawab, uraian_kegiatan, [bulan], anggaran]
        
        $programs = [
            // Manajemen
            ['Manajemen', 'Rapat Kerja Tahunan', [1], 5000000],
            ['Manajemen', 'Monitoring dan Evaluasi Program', [3, 6, 9, 12], 15000000],
            ['Manajemen', 'Koordinasi dengan Dinas Pendidikan', [2, 5, 8, 11], 10000000],
            ['Manajemen', 'Penyusunan RKAT', [10, 11], 3000000],
            ['Manajemen', 'Laporan Keuangan Semester I', [6, 7], 2000000],
            ['Manajemen', 'Laporan Keuangan Semester II', [12], 2000000],
            ['Manajemen', 'Rapat Tinjauan Manajemen', [6, 12], 4000000],

            // PAUD
            ['PAUD', 'Fasilitasi Penjaminan Mutu Pendidikan PAUD', [2, 3, 4, 5], 50000000],
            ['PAUD', 'Supervisi Akademik PAUD', [3, 4, 5, 6, 9, 10], 30000000],
            ['PAUD', 'Bimbingan Teknis Kurikulum PAUD', [4, 5], 25000000],
            ['PAUD', 'Pemetaan Mutu Pendidikan PAUD', [7, 8], 15000000],
            ['PAUD', 'Sosialisasi Program PAUD', [1, 2], 8000000],

            // SD
            ['SD', 'Fasilitasi Penjaminan Mutu Pendidikan SD', [2, 3, 4, 5], 60000000],
            ['SD', 'Supervisi Akademik SD', [3, 4, 5, 6, 9, 10], 35000000],
            ['SD', 'Bimbingan Teknis Kurikulum Merdeka SD', [4, 5], 30000000],
            ['SD', 'Pemetaan Mutu Pendidikan SD', [7, 8], 20000000],
            ['SD', 'Asesmen Kompetensi Minimum SD', [9, 10], 25000000],
            ['SD', 'Sosialisasi Program SD', [1, 2], 10000000],

            // SMP
            ['SMP', 'Fasilitasi Penjaminan Mutu Pendidikan SMP', [2, 3, 4, 5], 70000000],
            ['SMP', 'Supervisi Akademik SMP', [3, 4, 5, 6, 9, 10], 40000000],
            ['SMP', 'Bimbingan Teknis Kurikulum Merdeka SMP', [4, 5], 35000000],
            ['SMP', 'Pemetaan Mutu Pendidikan SMP', [7, 8], 25000000],
            ['SMP', 'Asesmen Kompetensi Minimum SMP', [9, 10], 30000000],
            ['SMP', 'Sosialisasi Program SMP', [1, 2], 12000000],

            // SMA
            ['SMA', 'Fasilitasi Penjaminan Mutu Pendidikan SMA', [2, 3, 4, 5], 80000000],
            ['SMA', 'Supervisi Akademik SMA', [3, 4, 5, 6, 9, 10], 45000000],
            ['SMA', 'Bimbingan Teknis Kurikulum Merdeka SMA', [4, 5], 40000000],
            ['SMA', 'Pemetaan Mutu Pendidikan SMA', [7, 8], 30000000],
            ['SMA', 'Asesmen Kompetensi Minimum SMA', [9, 10], 35000000],
            ['SMA', 'Sosialisasi Program SMA', [1, 2], 15000000],

            // SMK
            ['SMK', 'Fasilitasi Penjaminan Mutu Pendidikan SMK', [2, 3, 4, 5], 75000000],
            ['SMK', 'Supervisi Akademik SMK', [3, 4, 5, 6, 9, 10], 42000000],
            ['SMK', 'Bimbingan Teknis Kurikulum Merdeka SMK', [4, 5], 38000000],
            ['SMK', 'Pemetaan Mutu Pendidikan SMK', [7, 8], 28000000],
            ['SMK', 'Dunia Kerja dan Industri SMK', [5, 6, 7, 8], 50000000],
            ['SMK', 'Sosialisasi Program SMK', [1, 2], 14000000],

            // SLB
            ['SLB', 'Fasilitasi Penjaminan Mutu Pendidikan SLB', [2, 3, 4, 5], 40000000],
            ['SLB', 'Supervisi Akademik SLB', [3, 4, 5, 6, 9, 10], 25000000],
            ['SLB', 'Bimbingan Teknis Layanan Khusus', [6, 7], 20000000],
            ['SLB', 'Pemetaan Mutu Pendidikan SLB', [8, 9], 15000000],

            // Kemitraan
            ['Kemitraan', 'Kemitraan dengan Perguruan Tinggi', [3, 4, 5, 6], 20000000],
            ['Kemitraan', 'Kemitraan dengan Organisasi Profesi', [5, 6, 7], 15000000],
            ['Kemitraan', 'Forum Komunikasi BPMP', [4, 8, 12], 10000000],

            // Revitalisasi
            ['Revitalisasi', 'Revitalisasi Sekolah Sasaran', [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12], 500000000],
            ['Revitalisasi', 'Pendampingan Sekolah Revitalisasi', [2, 3, 4, 5, 6, 7, 8, 9, 10, 11], 100000000],
            ['Revitalisasi', 'Evaluasi Revitalisasi', [6, 12], 20000000],
        ];

        $urutan = 0;
        foreach ($programs as [$pj, $uraian, $bulanArr, $anggaran]) {
            $urutan++;
            $program = CalendarProgram::create([
                'tahun' => 2026,
                'penanggung_jawab' => $pj,
                'uraian_kegiatan' => $uraian,
                'anggaran' => $anggaran,
                'urutan' => $urutan,
                'status' => 'aktif',
            ]);

            foreach ($bulanArr as $bulan) {
                CalendarProgramMonth::create([
                    'calendar_program_id' => $program->id,
                    'bulan' => $bulan,
                ]);
            }
        }
    }
}
