@extends('layouts.app')

@section('title', 'SOP Penetapan dan Pemutakhiran DIP - PPID BPMP NTB')
@section('meta_description', 'SOP Penetapan dan Pemutakhiran Daftar Informasi Publik PPID BPMP Provinsi Nusa Tenggara Barat')

@section('content')
<div class="page-header">
    <div class="container-custom py-8">
        <h1 class="text-3xl font-bold text-white mb-4">SOP Penetapan dan Pemutakhiran DIP</h1>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}" class="text-secondary hover:text-white">Beranda</a>
            <span class="mx-2 text-gray-400">/</span>
            <a href="{{ route('profile.index') }}" class="text-secondary hover:text-white">Profil</a>
            <span class="mx-2 text-gray-400">/</span>
            <a href="{{ route('profile.sop') }}" class="text-secondary hover:text-white">SOP</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-white">Penetapan DIP</span>
        </nav>
    </div>
</div>

<section class="py-12 bg-gray-50">
    <div class="container-custom max-w-4xl">

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-10">
            <h2 class="text-xl font-bold text-navy mb-4 text-center">SOP Penetapan dan Pemutakhiran Daftar Informasi Publik</h2>

            <div class="bg-blue-50 border-l-4 border-primary p-4 rounded-r-lg mb-8">
                <p class="text-charcoal text-sm leading-relaxed">
                    <strong>Daftar Informasi Publik (DIP)</strong> adalah daftar yang memuat ringkasan isi informasi yang wajib disediakan dan diumumkan secara berkala, serta-merta, setiap saat, dan yang dikecualikan pada badan publik. DIP harus ditetapkan dan diperbarui secara berkala untuk memastikan ketersediaan informasi yang akurat.
                </p>
            </div>

            <div class="relative">
                <div class="absolute left-6 top-0 bottom-0 w-0.5 bg-gray-200 hidden md:block"></div>

                <div class="space-y-6">
                    @php
                    $steps = [
                        ['num' => '1', 'title' => 'Pengumpulan Data Informasi dari Unit Kerja', 'desc' => 'PPID mengumpulkan data informasi dari seluruh unit kerja di lingkungan BPMP NTB. Setiap unit kerja diminta menyerahkan daftar informasi yang dikelola beserta kategorinya.', 'color' => 'primary'],
                        ['num' => '2', 'title' => 'Klasifikasi Informasi', 'desc' => 'Informasi diklasifikasikan ke dalam empat kategori: informasi berkala (wajib diumumkan secara berkala), informasi setiap saat (wajib tersedia setiap saat), informasi serta-merta (wajib diumumkan seketika), dan informasi dikecualikan.', 'color' => 'secondary'],
                        ['num' => '3', 'title' => 'Penyusunan Draft DIP', 'desc' => 'Berdasarkan data yang telah dikumpulkan dan diklasifikasikan, PPID menyusun draft Daftar Informasi Publik yang memuat ringkasan isi informasi, sumber informasi, media informasi, dan jangka waktu kewajiban dokumentasi.', 'color' => 'accent'],
                        ['num' => '4', 'title' => 'Review dan Verifikasi', 'desc' => 'Draft DIP direview dan diverifikasi oleh Tim PPID untuk memastikan kelengkapan, akurasi, dan kesesuaian klasifikasi informasi. Perbaikan dilakukan jika diperlukan.', 'color' => 'primary'],
                        ['num' => '5', 'title' => 'Penetapan DIP oleh Pejabat Berwenang', 'desc' => 'Draft DIP yang telah diverifikasi diajukan kepada Pejabat Pengelola Informasi dan Dokumentasi (PPID) untuk ditetapkan melalui keputusan resmi.', 'color' => 'secondary'],
                        ['num' => '6', 'title' => 'Pemutakhiran Berkala', 'desc' => 'DIP diperbarui secara berkala minimal sekali dalam setahun atau sewaktu-waktu apabila terdapat perubahan informasi yang signifikan. Pemutakhiran mencakup penambahan, perubahan, dan penghapusan data informasi.', 'color' => 'accent'],
                        ['num' => '7', 'title' => 'Publikasi DIP', 'desc' => 'DIP yang telah ditetapkan dipublikasikan melalui website resmi, papan pengumuman, dan media lainnya agar dapat diakses oleh masyarakat luas.', 'color' => 'primary'],
                    ];
                    @endphp

                    @foreach($steps as $step)
                    <div class="flex items-start gap-5 relative">
                        <div class="w-12 h-12 rounded-full bg-{{ $step['color'] }} text-white font-bold flex items-center justify-center flex-shrink-0 shadow-md z-10">
                            {{ $step['num'] }}
                        </div>
                        <div class="flex-1 bg-gray-50 rounded-xl p-5 border border-gray-100">
                            <h3 class="font-bold text-navy mb-2">{{ $step['title'] }}</h3>
                            <p class="text-charcoal text-sm leading-relaxed">{{ $step['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="mt-10 bg-gray-50 rounded-xl p-6 border border-gray-100">
                <h3 class="font-bold text-navy mb-4 text-center">Alur Penetapan dan Pemutakhiran DIP</h3>
                <div class="flex flex-col items-center gap-3 text-sm">
                    <div class="bg-primary text-white px-6 py-3 rounded-lg text-center w-full max-w-md">Pengumpulan Data dari Unit Kerja</div>
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                    <div class="bg-secondary text-white px-6 py-3 rounded-lg text-center w-full max-w-md">Klasifikasi Informasi</div>
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                    <div class="bg-accent text-navy px-6 py-3 rounded-lg text-center w-full max-w-md font-semibold">Penyusunan Draft DIP</div>
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                    <div class="bg-primary text-white px-6 py-3 rounded-lg text-center w-full max-w-md">Review dan Verifikasi</div>
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                    <div class="bg-secondary text-white px-6 py-3 rounded-lg text-center w-full max-w-md">Penetapan oleh Pejabat Berwenang</div>
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                    <div class="flex gap-4 w-full max-w-md">
                        <div class="bg-accent text-navy px-6 py-3 rounded-lg text-center flex-1 font-semibold">Pemutakhiran Berkala</div>
                        <div class="bg-primary text-white px-6 py-3 rounded-lg text-center flex-1">Publikasi DIP</div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
