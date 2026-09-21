<nav class="bg-white shadow-navbar sticky top-0 z-50 print:hidden" x-data="{ mobileOpen: false, activeDropdown: null }" @click.away="activeDropdown = null">
    <div class="container-custom">
        <div class="flex items-center justify-between h-16 lg:h-20">
            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3 flex-shrink-0">
                <div class="w-10 h-10 lg:w-12 lg:h-12 bg-primary rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 lg:w-7 lg:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div class="hidden sm:block">
                    <div class="text-primary font-bold text-base lg:text-lg leading-tight">PPID BPMP NTB</div>
                    <div class="text-gray-400 text-xs leading-tight">Keterbukaan Informasi Publik</div>
                </div>
            </a>

            {{-- Desktop Menu --}}
            <div class="hidden lg:flex items-center gap-1">
                <a href="{{ route('home') }}" class="px-3 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('home') ? 'text-primary bg-primary/5' : 'text-gray-600 hover:text-primary hover:bg-gray-50' }}">Beranda</a>

                {{-- Profil Dropdown --}}
                <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button class="px-3 py-2 text-sm font-medium rounded-lg transition-colors flex items-center gap-1 {{ request()->routeIs('profile.*') ? 'text-primary bg-primary/5' : 'text-gray-600 hover:text-primary hover:bg-gray-50' }}">
                        Profil PPID
                        <svg class="w-4 h-4 transition-transform" :class="open && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-1" class="absolute left-0 mt-1 w-56 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50">
                        <a href="{{ route('profile.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors">Profil PPID</a>
                        <a href="{{ route('profile.visi-misi') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors">Visi & Misi</a>
                        <a href="{{ route('profile.tugas-fungsi') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors">Tugas & Fungsi</a>
                        <a href="{{ route('profile.struktur-organisasi') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors">Struktur Organisasi</a>
                        <a href="{{ route('profile.pejabat') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors">Pejabat PPID</a>
                        <a href="{{ route('profile.maklumat') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors">Maklumat Pelayanan</a>
                        <a href="{{ route('profile.standar') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors">Standar Pelayanan</a>
                        <a href="{{ route('profile.sop') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors">SOP Pelayanan</a>
                        <a href="{{ route('profile.sk-ppid') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors font-medium">SK PPID</a>
                        <hr class="my-1 border-gray-100">
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors font-medium">SK PPID</a>
                    </div>
                </div>

                {{-- Informasi Publik Dropdown --}}
                <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button class="px-3 py-2 text-sm font-medium rounded-lg transition-colors flex items-center gap-1 {{ request()->routeIs('informasi.*') ? 'text-primary bg-primary/5' : 'text-gray-600 hover:text-primary hover:bg-gray-50' }}">
                        Informasi Publik
                        <svg class="w-4 h-4 transition-transform" :class="open && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-1" class="absolute left-0 mt-1 w-56 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50">
                        <a href="{{ route('informasi.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors">Semua Informasi</a>
                        <a href="{{ route('informasi.berkala') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors">Informasi Berkala</a>
                        <a href="{{ route('informasi.setiap-saat') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors">Informasi Setiap Saat</a>
                        <a href="{{ route('informasi.serta-merta') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors">Informasi Serta Merta</a>
                        <a href="{{ route('informasi.dikecualikan') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors">Informasi Dikecualikan</a>
                        <hr class="my-1 border-gray-100">
                        <a href="{{ route('berkala.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors font-medium">Informasi Wajib Berkala</a>
                        <a href="{{ route('berkala.profil') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors pl-6">- Profil Badan Publik</a>
                        <a href="{{ route('berkala.lhkpn') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors pl-6">- LHKPN Pejabat</a>
                        <a href="{{ route('berkala.program') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors pl-6">- Program & Kegiatan</a>
                        <a href="{{ route('berkala.keuangan') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors pl-6">- Informasi Keuangan</a>
                        <hr class="my-1 border-gray-100">
                        <a href="{{ route('informasi.daftar') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors font-medium">Daftar Informasi Publik</a>
                    </div>
                </div>

                {{-- Layanan Dropdown --}}
                <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button class="px-3 py-2 text-sm font-medium rounded-lg transition-colors flex items-center gap-1 {{ request()->routeIs('layanan.*') ? 'text-primary bg-primary/5' : 'text-gray-600 hover:text-primary hover:bg-gray-50' }}">
                        Layanan
                        <svg class="w-4 h-4 transition-transform" :class="open && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-1" class="absolute left-0 mt-1 w-56 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50">
                        <a href="{{ route('layanan.permohonan.create') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors">Permohonan Informasi</a>
                        <a href="{{ route('layanan.cek-status') }}" class="cek-status block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors">Cek Status Permohonan</a>
                        <a href="{{ route('layanan.keberatan.create') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors">Pengajuan Keberatan</a>
                        <hr class="my-1 border-gray-100">
                        <a href="{{ route('layanan.alur') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors">Alur Layanan</a>
                        <a href="{{ route('berkala.pengaduan') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors">Tata Cara Pengaduan</a>
                    </div>
                </div>

                <a href="{{ route('dokumen.index') }}" class="px-3 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('dokumen.*') ? 'text-primary bg-primary/5' : 'text-gray-600 hover:text-primary hover:bg-gray-50' }}">Dokumen</a>
                <a href="{{ route('pengadaan.index') }}" class="px-3 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('pengadaan.*') ? 'text-primary bg-primary/5' : 'text-gray-600 hover:text-primary hover:bg-gray-50' }}">Pengadaan</a>
                <a href="{{ route('faq') }}" class="px-3 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('faq') ? 'text-primary bg-primary/5' : 'text-gray-600 hover:text-primary hover:bg-gray-50' }}">FAQ</a>
                <a href="{{ route('contact') }}" class="px-3 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('contact*') ? 'text-primary bg-primary/5' : 'text-gray-600 hover:text-primary hover:bg-gray-50' }}">Kontak</a>
            </div>

            {{-- CTA + Mobile Toggle --}}
            <div class="flex items-center gap-3">
                <a href="{{ route('layanan.permohonan.create') }}" class="hidden lg:inline-flex btn-primary btn-sm">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Ajukan Permohonan
                </a>

                @auth
                    <a href="{{ route('admin.dashboard') }}" class="hidden lg:inline-flex items-center gap-1.5 px-3 py-2 text-sm font-medium text-gray-600 hover:text-primary rounded-lg transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                        Dashboard
                    </a>
                @endauth

                {{-- Mobile Menu Button --}}
                <button @click="mobileOpen = !mobileOpen" class="lg:hidden p-2 rounded-lg text-gray-600 hover:bg-gray-100 transition-colors">
                    <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    <svg x-show="mobileOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div x-show="mobileOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2" class="lg:hidden pb-4 border-t border-gray-100 mt-2 pt-4" x-cloak>
            <div class="flex flex-col gap-1">
                <a href="{{ route('home') }}" class="px-4 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('home') ? 'text-primary bg-primary/5' : 'text-gray-600' }}">Beranda</a>

                {{-- Mobile Profil --}}
                <div x-data="{ open: false }">
                    <button @click="open = !open" class="w-full flex items-center justify-between px-4 py-2.5 text-sm font-medium text-gray-600 rounded-lg">
                        Profil PPID
                        <svg class="w-4 h-4 transition-transform" :class="open && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open" class="pl-4">
                        <a href="{{ route('profile.index') }}" class="block px-4 py-2 text-sm text-gray-500 hover:text-primary">Profil PPID</a>
                        <a href="{{ route('profile.visi-misi') }}" class="block px-4 py-2 text-sm text-gray-500 hover:text-primary">Visi & Misi</a>
                        <a href="{{ route('profile.tugas-fungsi') }}" class="block px-4 py-2 text-sm text-gray-500 hover:text-primary">Tugas & Fungsi</a>
                        <a href="{{ route('profile.struktur-organisasi') }}" class="block px-4 py-2 text-sm text-gray-500 hover:text-primary">Struktur Organisasi</a>
                        <a href="{{ route('profile.pejabat') }}" class="block px-4 py-2 text-sm text-gray-500 hover:text-primary">Pejabat PPID</a>
                        <a href="{{ route('profile.maklumat') }}" class="block px-4 py-2 text-sm text-gray-500 hover:text-primary">Maklumat Pelayanan</a>
                        <a href="{{ route('profile.standar') }}" class="block px-4 py-2 text-sm text-gray-500 hover:text-primary">Standar Pelayanan</a>
                        <a href="{{ route('profile.sop') }}" class="block px-4 py-2 text-sm text-gray-500 hover:text-primary">SOP Pelayanan</a>
                        <a href="{{ route('profile.sk-ppid') }}" class="block px-4 py-2 text-sm text-gray-500 hover:text-primary font-medium">SK PPID</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-500 hover:text-primary font-medium">SK PPID</a>
                    </div>
                </div>

                {{-- Mobile Informasi --}}
                <div x-data="{ open: false }">
                    <button @click="open = !open" class="w-full flex items-center justify-between px-4 py-2.5 text-sm font-medium text-gray-600 rounded-lg">
                        Informasi Publik
                        <svg class="w-4 h-4 transition-transform" :class="open && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open" class="pl-4">
                        <a href="{{ route('informasi.index') }}" class="block px-4 py-2 text-sm text-gray-500 hover:text-primary">Semua Informasi</a>
                        <a href="{{ route('informasi.berkala') }}" class="block px-4 py-2 text-sm text-gray-500 hover:text-primary">Informasi Berkala</a>
                        <a href="{{ route('informasi.setiap-saat') }}" class="block px-4 py-2 text-sm text-gray-500 hover:text-primary">Informasi Setiap Saat</a>
                        <a href="{{ route('informasi.serta-merta') }}" class="block px-4 py-2 text-sm text-gray-500 hover:text-primary">Informasi Serta Merta</a>
                        <a href="{{ route('informasi.dikecualikan') }}" class="block px-4 py-2 text-sm text-gray-500 hover:text-primary">Informasi Dikecualikan</a>
                        <a href="{{ route('berkala.index') }}" class="block px-4 py-2 text-sm text-gray-500 hover:text-primary font-medium">Informasi Wajib Berkala</a>
                        <a href="{{ route('informasi.daftar') }}" class="block px-4 py-2 text-sm text-gray-500 hover:text-primary font-medium">Daftar Informasi Publik</a>
                    </div>
                </div>

                {{-- Mobile Layanan --}}
                <div x-data="{ open: false }">
                    <button @click="open = !open" class="w-full flex items-center justify-between px-4 py-2.5 text-sm font-medium text-gray-600 rounded-lg">
                        Layanan
                        <svg class="w-4 h-4 transition-transform" :class="open && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open" class="pl-4">
                        <a href="{{ route('layanan.permohonan.create') }}" class="block px-4 py-2 text-sm text-gray-500 hover:text-primary">Permohonan Informasi</a>
                        <a href="{{ route('layanan.cek-status') }}" class="block px-4 py-2 text-sm text-gray-500 hover:text-primary">Cek Status</a>
                        <a href="{{ route('layanan.keberatan.create') }}" class="block px-4 py-2 text-sm text-gray-500 hover:text-primary">Pengajuan Keberatan</a>
                        <a href="{{ route('layanan.alur') }}" class="block px-4 py-2 text-sm text-gray-500 hover:text-primary">Alur Layanan</a>
                        <a href="{{ route('berkala.pengaduan') }}" class="block px-4 py-2 text-sm text-gray-500 hover:text-primary">Tata Cara Pengaduan</a>
                    </div>
                </div>

                <a href="{{ route('dokumen.index') }}" class="px-4 py-2.5 text-sm font-medium text-gray-600 rounded-lg">Dokumen</a>
                <a href="{{ route('pengadaan.index') }}" class="px-4 py-2.5 text-sm font-medium text-gray-600 rounded-lg">Pengadaan</a>
                <a href="{{ route('faq') }}" class="px-4 py-2.5 text-sm font-medium text-gray-600 rounded-lg">FAQ</a>
                <a href="{{ route('contact') }}" class="px-4 py-2.5 text-sm font-medium text-gray-600 rounded-lg">Kontak</a>

                <div class="pt-3 mt-2 border-t border-gray-100">
                    <a href="{{ route('layanan.permohonan.create') }}" class="btn-primary btn-sm w-full text-center text-sm">Ajukan Permohonan Informasi</a>
                </div>

                @auth
                    <a href="{{ route('admin.dashboard') }}" class="px-4 py-2.5 text-sm font-medium text-primary rounded-lg">Dashboard Admin</a>
                @endauth
            </div>
        </div>
    </div>
</nav>
