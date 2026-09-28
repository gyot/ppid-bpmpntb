<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Informasi Lembaga
            ['key' => 'institution_name', 'value' => 'Balai Penjaminan Mutu Pendidikan Provinsi Nusa Tenggara Barat', 'group' => 'institution'],
            ['key' => 'institution_short_name', 'value' => 'BPMP NTB', 'group' => 'institution'],
            ['key' => 'institution_description', 'value' => 'Balai Penjaminan Mutu Pendidikan Provinsi Nusa Tenggara Barat adalah Unit Pelaksana Teknis di lingkungan Kementerian Pendidikan Dasar dan Menengah yang bertugas melaksanakan penjaminan mutu pendidikan.', 'group' => 'institution'],
            ['key' => 'website_url', 'value' => 'https://ppid.bpmpntb.id', 'group' => 'institution'],

            // Logo & Branding
            ['key' => 'site_logo', 'value' => null, 'group' => 'branding'],
            ['key' => 'site_favicon', 'value' => null, 'group' => 'branding'],
            ['key' => 'header_logo', 'value' => null, 'group' => 'branding'],
            ['key' => 'institution_stamp', 'value' => null, 'group' => 'branding'],

            // Pejabat PPID
            ['key' => 'ppid_head_name', 'value' => 'Hj. Lielies Miningrum, SE', 'group' => 'ppid'],
            ['key' => 'ppid_head_position', 'value' => 'Kepala Subbagian Umum BPMP Provinsi NTB', 'group' => 'ppid'],
            ['key' => 'ppid_head_nip', 'value' => '', 'group' => 'ppid'],

            // Kontak
            ['key' => 'contact_email', 'value' => 'ntblpmp@gmail.com', 'group' => 'contact'],
            ['key' => 'contact_phone', 'value' => '+62 811-3906-669', 'group' => 'contact'],
            ['key' => 'contact_whatsapp', 'value' => '628113906669', 'group' => 'contact'],
            ['key' => 'contact_fax', 'value' => '', 'group' => 'contact'],
            ['key' => 'contact_address', 'value' => 'Jl. Panji Tilarnegara, No. 08 Mataram - NTB', 'group' => 'contact'],
            ['key' => 'service_hours', 'value' => 'Senin - Jumat: 08:00 - 16:00 WITA', 'group' => 'contact'],

            // Media Sosial
            ['key' => 'social_facebook', 'value' => 'https://facebook.com/bpmpntb', 'group' => 'social'],
            ['key' => 'social_twitter', 'value' => 'https://twitter.com/bpmpntb', 'group' => 'social'],
            ['key' => 'social_instagram', 'value' => 'https://instagram.com/bpmpntb', 'group' => 'social'],
            ['key' => 'social_youtube', 'value' => 'https://www.youtube.com/@bpmpntb6747', 'group' => 'social'],
            ['key' => 'social_tiktok', 'value' => '', 'group' => 'social'],

            // SEO
            ['key' => 'meta_title', 'value' => 'PPID BPMP Provinsi Nusa Tenggara Barat - Portal Keterbukaan Informasi Publik', 'group' => 'seo'],
            ['key' => 'meta_description', 'value' => 'Portal Keterbukaan Informasi Publik Balai Penjaminan Mutu Pendidikan Provinsi Nusa Tenggara Barat. Akses informasi publik secara mudah, transparan, dan akuntabel.', 'group' => 'seo'],
            ['key' => 'footer_text', 'value' => '&copy; ' . date('Y') . ' PPID BPMP Provinsi Nusa Tenggara Barat. Hak Cipta Dilindungi.', 'group' => 'seo'],

            // Google Maps
            ['key' => 'google_maps_embed', 'value' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3945.0!2d116.1!3d-8.58!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zOMKwMzQnNDguMCJTIDExNsKwMDYnMDAuMCJF!5e0!3m2!1sid!2sid!4v1700000000000" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>', 'group' => 'general'],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}