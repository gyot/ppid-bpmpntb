<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- SEO --}}
    <title>@yield('title', 'PPID BPMP Provinsi Nusa Tenggara Barat')</title>
    <meta name="description" content="@yield('meta_description', 'Portal Keterbukaan Informasi Publik PPID BPMP Provinsi Nusa Tenggara Barat. Akses informasi publik secara mudah, transparan, cepat, dan akuntabel.')">
    <meta name="keywords" content="@yield('meta_keywords', 'PPID, BPMP, NTB, Nusa Tenggara Barat, Keterbukaan Informasi Publik, Informasi Publik')">
    <link rel="canonical" href="@yield('canonical_url', url()->current())">

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('og_title', 'PPID BPMP Provinsi Nusa Tenggara Barat')">
    <meta property="og:description" content="@yield('og_description', 'Portal Keterbukaan Informasi Publik PPID BPMP Provinsi Nusa Tenggara Barat')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="PPID BPMP NTB">
    <meta property="og:locale" content="id_ID">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', 'PPID BPMP Provinsi Nusa Tenggara Barat')">
    <meta name="twitter:description" content="@yield('twitter_description', 'Portal Keterbukaan Informasi Publik PPID BPMP Provinsi Nusa Tenggara Barat')">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body class="bg-white text-charcoal antialiased" x-data="{ mobileMenuOpen: false }">

    {{-- Top Bar --}}
    @include('partials.topbar')

    {{-- Navbar --}}
    @include('partials.navbar')

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('partials.footer')

    {{-- Floating Action Button --}}
    <div class="fixed bottom-6 right-6 z-50 print:hidden">
        <a href="{{ route('layanan.permohonan.create') }}"
           class="flex items-center gap-2 bg-accent text-navy font-bold px-5 py-3 rounded-full shadow-lg hover:shadow-xl hover:bg-accent-light transition-all duration-300 group text-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <span class="hidden sm:inline">Ajukan Permohonan</span>
        </a>
    </div>

    @stack('scripts')
</body>
</html>
