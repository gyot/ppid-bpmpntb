@extends('layouts.app')

@section('title', 'Dokumen')
@section('meta_description', 'Arsip dokumen resmi BPMP NTB')

@section('content')
<div class="page-header">
    <div class="container-custom py-8">
        <h1 class="text-3xl font-bold text-white mb-4">Dokumen</h1>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}" class="text-secondary hover:text-white">Beranda</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-white">Dokumen</span>
        </nav>
    </div>
</div>

<section class="py-12 bg-gray-50">
    <div class="container-custom">
        <div class="card p-6 mb-8">
            <form method="GET" action="">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari dokumen..." class="input-field w-full">
                    </div>
                    <div>
                        <select name="category" class="input-field w-full">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>{{ $category }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <select name="year" class="input-field w-full">
                            <option value="">Semua Tahun</option>
                            @foreach($years as $year)
                                <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="btn-primary w-full">Filter</button>
                    </div>
                </div>
            </form>
        </div>

        @if($dokumen->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($dokumen as $doc)
                    <div class="card hover:shadow-lg transition-shadow">
                        <div class="p-5">
                            <div class="flex items-start gap-4 mb-4">
                                <div class="flex-shrink-0 w-14 h-14 bg-primary/10 rounded-xl flex items-center justify-center">
                                    @php $ext = pathinfo($doc->file ?? '', PATHINFO_EXTENSION); @endphp
                                    @if($ext === 'pdf')
                                        <svg class="w-7 h-7 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6zm-1 2l5 5h-5V4zM8.5 13h2c.28 0 .5.22.5.5v2a.5.5 0 01-.5.5h-1.25V17H9a.5.5 0 010-1h.5v-1H8.5a.5.5 0 010-1zm5 0h1.5a.5.5 0 01.5.5v3a.5.5 0 01-.5.5H13a.5.5 0 01-.5-.5v-3a.5.5 0 01.5-.5zm.5 1v2h.5v-2h-.5zm3-1h1.5a.5.5 0 01.5.5v1h-2v.75h1.5v.75H18V17a.5.5 0 01-.5.5H16a.5.5 0 01-.5-.5v-3a.5.5 0 01.5-.5z"/>
                                        </svg>
                                    @elseif($ext === 'xlsx' || $ext === 'xls')
                                        <svg class="w-7 h-7 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6zm-1 2l5 5h-5V4zM7.5 13l2.5 3.5L7.5 20h2l1.5-2.5L12.5 20h2L12 16.5 14.5 13h-2L11 15.5 9.5 13h-2z"/>
                                        </svg>
                                    @else
                                        <svg class="w-7 h-7 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <a href="{{ route('dokumen.show', $doc->slug) }}" class="font-semibold text-navy hover:text-primary transition-colors line-clamp-2">
                                        {{ $doc->title }}
                                    </a>
                                    <div class="flex items-center gap-2 mt-1">
                                        @if($doc->category)
                                            <span class="badge-primary text-xs">{{ $doc->category }}</span>
                                        @endif
                                        @if($doc->year)
                                            <span class="text-xs text-charcoal">{{ $doc->year }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center justify-between text-sm text-charcoal">
                                <div class="flex items-center gap-3">
                                    @if($doc->file_size)
                                        <span>{{ number_format($doc->file_size / 1024, 1) }} KB</span>
                                    @endif
                                    <span>{{ $doc->download_count ?? 0 }} unduhan</span>
                                </div>
                            </div>

                            <div class="mt-4 pt-4 border-t border-gray-100 flex gap-2">
                                @php $ext = pathinfo($doc->file ?? '', PATHINFO_EXTENSION); @endphp
                                @if($ext === 'pdf' || $ext === 'jpg' || $ext === 'jpeg' || $ext === 'png')
                                    <button type="button" onclick="openPreview('{{ asset('storage/' . $doc->file) }}', '{{ $ext }}', '{{ addslashes($doc->title) }}')" class="flex-1 text-center text-sm py-2 px-3 rounded-lg border border-primary text-primary hover:bg-primary hover:text-white transition-colors font-medium">
                                        Preview
                                    </button>
                                @endif
                                <a href="{{ route('dokumen.download', $doc->slug) }}" class="flex-1 btn-accent text-center text-sm py-2">Download</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $dokumen->withQueryString()->links() }}
            </div>
        @else
            <div class="text-center py-16">
                <svg class="w-20 h-20 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <h3 class="text-lg font-semibold text-navy mb-2">Belum ada dokumen tersedia</h3>
                <p class="text-charcoal">Dokumen belum tersedia saat ini.</p>
            </div>
        @endif
    </div>
</section>

{{-- Preview Modal --}}
<div id="previewModal" class="fixed inset-0 z-50 hidden" x-data="{ open: false }">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="closePreview()"></div>
    <div class="relative w-full h-full flex items-center justify-center p-4 md:p-8">
        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-5xl max-h-[90vh] flex flex-col overflow-hidden">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <h3 id="previewTitle" class="font-bold text-navy text-lg line-clamp-1"></h3>
                <div class="flex items-center gap-2">
                    <a id="previewDownloadBtn" href="#" class="inline-flex items-center gap-1.5 px-4 py-2 bg-primary text-white rounded-lg text-sm font-medium hover:bg-primary-dark transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                        Download
                    </a>
                    <button onclick="closePreview()" class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>
            <div class="flex-1 overflow-auto p-2">
                <iframe id="previewFrame" src="" class="w-full h-full min-h-[70vh] border-0 rounded-lg hidden"></iframe>
                <img id="previewImage" src="" class="max-w-full h-auto mx-auto rounded-lg hidden" alt="Preview">
            </div>
        </div>
    </div>
</div>

<script>
function openPreview(url, ext, title) {
    const modal = document.getElementById('previewModal');
    const frame = document.getElementById('previewFrame');
    const img = document.getElementById('previewImage');
    const titleEl = document.getElementById('previewTitle');
    const downloadBtn = document.getElementById('previewDownloadBtn');

    titleEl.textContent = title;
    downloadBtn.href = url;

    frame.classList.add('hidden');
    img.classList.add('hidden');

    if (ext === 'pdf') {
        frame.src = url;
        frame.classList.remove('hidden');
    } else if (['jpg', 'jpeg', 'png'].includes(ext)) {
        img.src = url;
        img.classList.remove('hidden');
    }

    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closePreview() {
    const modal = document.getElementById('previewModal');
    const frame = document.getElementById('previewFrame');
    modal.classList.add('hidden');
    frame.src = '';
    document.body.style.overflow = '';
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closePreview();
});
</script>
@endsection
