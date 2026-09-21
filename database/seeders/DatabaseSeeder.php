<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@ppidbpmpntb.id',
            'password' => Hash::make('password'),
            'role' => 'super_admin',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Admin PPID',
            'email' => 'ppid@ppidbpmpntb.id',
            'password' => Hash::make('password'),
            'role' => 'admin_ppid',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Petugas PPID',
            'email' => 'petugas@ppidbpmpntb.id',
            'password' => Hash::make('password'),
            'role' => 'petugas',
            'email_verified_at' => now(),
        ]);

        $this->call([
            InformationPublikSeeder::class,
            DocumentSeeder::class,
            NewsSeeder::class,
            FaqSeeder::class,
            SettingSeeder::class,
            PageSeeder::class,
            DipSeeder::class,
            LhkpnSeeder::class,
            ProgramSeeder::class,
            KeuanganSeeder::class,
            PengadaanSeeder::class,
            SopSeeder::class,
            RegulasiSeeder::class,
        ]);
    }
}
