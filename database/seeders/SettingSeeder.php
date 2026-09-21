<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'site_name', 'value' => 'PPID BPMP Provinsi Nusa Tenggara Barat', 'group' => 'general'],
            ['key' => 'site_description', 'value' => 'Portal Keterbukaan Informasi Publik Balai Penjaminan Mutu Pendidikan Provinsi Nusa Tenggara Barat', 'group' => 'general'],
            ['key' => 'site_logo', 'value' => null, 'group' => 'general'],
            ['key' => 'site_favicon', 'value' => null, 'group' => 'general'],

            ['key' => 'contact_email', 'value' => 'ntblpmp@gmail.com', 'group' => 'contact'],
            ['key' => 'contact_phone', 'value' => '+62 811-3906-669', 'group' => 'contact'],
            ['key' => 'contact_whatsapp', 'value' => '628113906669', 'group' => 'contact'],
            ['key' => 'contact_fax', 'value' => null, 'group' => 'contact'],
            ['key' => 'contact_address', 'value' => 'Jl. Panji Tilarnegara, No. 08 Mataram - NTB', 'group' => 'contact'],
            ['key' => 'service_hours', 'value' => 'Senin - Jumat: 08:00 - 16:00 WITA', 'group' => 'contact'],

            ['key' => 'social_media_facebook', 'value' => 'https://facebook.com/bpmpntb', 'group' => 'social_media'],
            ['key' => 'social_media_twitter', 'value' => 'https://twitter.com/bpmpntb', 'group' => 'social_media'],
            ['key' => 'social_media_instagram', 'value' => 'https://instagram.com/bpmpntb', 'group' => 'social_media'],
            ['key' => 'social_media_youtube', 'value' => 'https://www.youtube.com/@bpmpntb6747', 'group' => 'social_media'],

            ['key' => 'google_maps_embed', 'value' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3945.0!2d116.1!3d-8.58!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zOMKwMzQnNDguMCJTIDExNsKwMDYnMDAuMCJF!5e0!3m2!1sid!2sid!4v1700000000000" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>', 'group' => 'general'],
            ['key' => 'footer_text', 'value' => '&copy; ' . date('Y') . ' PPID BPMP Provinsi Nusa Tenggara Barat. Hak Cipta Dilindungi.', 'group' => 'general'],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
