@extends('layouts.app')

@section('title', $page->title . ' - PPID BPMP NTB')
@section('meta_description', Str::limit(strip_tags($page->content ?? ''), 160))

@section('content')
<div class="page-header">
    <div class="container-custom py-8">
        <h1 class="text-3xl font-bold text-white mb-4">{{ $page->title }}</h1>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}" class="text-secondary hover:text-white">Beranda</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-white">{{ $page->title }}</span>
        </nav>
    </div>
</div>

<section class="py-12 bg-gray-50">
    <div class="container-custom max-w-4xl">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-10">
            <div class="prose prose-lg max-w-none text-charcoal leading-relaxed">
                {!! $page->content !!}
            </div>
        </div>
    </div>
</section>
@endsection
