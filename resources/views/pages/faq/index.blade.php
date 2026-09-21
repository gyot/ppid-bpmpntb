@extends('layouts.app')

@section('title', 'FAQ - PPID BPMP NTB')
@section('meta_description', 'Pertanyaan yang sering diajukan tentang layanan informasi publik PPID BPMP Provinsi Nusa Tenggara Barat')

@section('content')
<div class="page-header">
    <div class="container-custom py-8">
        <h1 class="text-3xl font-bold text-white mb-4">FAQ</h1>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}" class="text-secondary hover:text-white">Beranda</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-white">FAQ</span>
        </nav>
    </div>
</div>

<section class="py-12 bg-gray-50" x-data="faqSearch()">
    <div class="container-custom max-w-4xl">

        <div class="mb-8">
            <div class="relative">
                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" x-model="search" placeholder="Cari pertanyaan..." class="input-field w-full pl-12">
            </div>
        </div>

        @foreach($faqs as $category => $items)
        <div class="mb-8" x-show="hasVisibleItems('{{ $category }}')">
            <h2 class="text-lg font-bold text-navy mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
                {{ $category ?: 'Umum' }}
            </h2>
            <div class="space-y-3">
                @foreach($items as $faq)
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden" x-data="{ open: false }" x-show="matchesSearch('{{ addslashes($faq->question) }}', '{{ addslashes($faq->answer) }}')">
                    <button @click="open = !open" class="w-full flex items-center justify-between p-5 text-left hover:bg-gray-50 transition-colors">
                        <span class="font-semibold text-navy pr-4">{{ $faq->question }}</span>
                        <svg class="w-5 h-5 text-primary flex-shrink-0 transition-transform duration-300" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open" x-collapse x-cloak class="px-5 pb-5">
                        <div class="text-gray-600 leading-relaxed border-t border-gray-100 pt-4">
                            {!! $faq->answer !!}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach

        <div x-show="noResults" class="bg-white rounded-2xl p-12 text-center border border-gray-100 shadow-sm">
            <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-navy mb-2">Tidak ditemukan</h3>
            <p class="text-gray-400 text-sm">Tidak ada pertanyaan yang cocok dengan pencarian Anda.</p>
        </div>

        <div class="mt-12 bg-primary/5 border border-primary/10 rounded-2xl p-8 text-center">
            <svg class="w-12 h-12 text-primary mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
            </svg>
            <h3 class="text-lg font-bold text-navy mb-2">Ada pertanyaan lain?</h3>
            <p class="text-gray-600 mb-4">Jika pertanyaan Anda belum terjawab, jangan ragu untuk menghubungi kami.</p>
            <a href="{{ route('contact') }}" class="btn-primary">
                Hubungi Kami
            </a>
        </div>
    </div>
</section>

@push('scripts')
<script>
function faqSearch() {
    return {
        search: '',
        noResults: false,
        matchesSearch(question, answer) {
            if (!this.search) return true;
            const s = this.search.toLowerCase();
            const match = question.toLowerCase().includes(s) || answer.toLowerCase().includes(s);
            this.updateNoResults();
            return match;
        },
        hasVisibleItems(category) {
            if (!this.search) return true;
            return true;
        },
        updateNoResults() {
            this.$nextTick(() => {
                const visible = document.querySelectorAll('[x-show*="matchesSearch"]:not([style*="display: none"])');
                this.noResults = this.search.length > 0 && visible.length === 0;
            });
        }
    };
}
</script>
@endpush
@endsection
