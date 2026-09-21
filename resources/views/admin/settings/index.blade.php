@extends('admin.layouts.app')

@section('title', 'Pengaturan')

@section('breadcrumb')
    <span class="text-gray-900">Pengaturan</span>
@endsection

@section('content')
<div class="max-w-4xl space-y-6">
    <h1 class="text-2xl font-bold text-gray-900">Pengaturan</h1>

    <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="card bg-white rounded-lg shadow p-6 space-y-4">
            <h2 class="text-lg font-semibold text-gray-900 border-b pb-2">Informasi Situs</h2>
            <div>
                <label class="input-label block text-sm font-medium text-gray-700 mb-1">Nama Situs</label>
                <input type="text" name="site_name" value="{{ old('site_name', $settings['site_name'] ?? '') }}" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary @error('site_name') border-red-500 @enderror">
                @error('site_name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="input-label block text-sm font-medium text-gray-700 mb-1">Tagline</label>
                <input type="text" name="site_tagline" value="{{ old('site_tagline', $settings['site_tagline'] ?? '') }}" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
            </div>
            <div>
                <label class="input-label block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea name="site_description" rows="3" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">{{ old('site_description', $settings['site_description'] ?? '') }}</textarea>
            </div>
        </div>

        <div class="card bg-white rounded-lg shadow p-6 space-y-4">
            <h2 class="text-lg font-semibold text-gray-900 border-b pb-2">Kontak</h2>
            <div>
                <label class="input-label block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="contact_email" value="{{ old('contact_email', $settings['contact_email'] ?? '') }}" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
            </div>
            <div>
                <label class="input-label block text-sm font-medium text-gray-700 mb-1">Telepon</label>
                <input type="text" name="contact_phone" value="{{ old('contact_phone', $settings['contact_phone'] ?? '') }}" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
            </div>
            <div>
                <label class="input-label block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                <textarea name="contact_address" rows="3" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">{{ old('contact_address', $settings['contact_address'] ?? '') }}</textarea>
            </div>
            <div>
                <label class="input-label block text-sm font-medium text-gray-700 mb-1">Fax</label>
                <input type="text" name="contact_fax" value="{{ old('contact_fax', $settings['contact_fax'] ?? '') }}" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
            </div>
        </div>

        <div class="card bg-white rounded-lg shadow p-6 space-y-4">
            <h2 class="text-lg font-semibold text-gray-900 border-b pb-2">Media Sosial</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="input-label block text-sm font-medium text-gray-700 mb-1">Facebook</label>
                    <input type="url" name="social_facebook" value="{{ old('social_facebook', $settings['social_facebook'] ?? '') }}" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary" placeholder="https://facebook.com/...">
                </div>
                <div>
                    <label class="input-label block text-sm font-medium text-gray-700 mb-1">Twitter</label>
                    <input type="url" name="social_twitter" value="{{ old('social_twitter', $settings['social_twitter'] ?? '') }}" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary" placeholder="https://twitter.com/...">
                </div>
                <div>
                    <label class="input-label block text-sm font-medium text-gray-700 mb-1">Instagram</label>
                    <input type="url" name="social_instagram" value="{{ old('social_instagram', $settings['social_instagram'] ?? '') }}" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary" placeholder="https://instagram.com/...">
                </div>
                <div>
                    <label class="input-label block text-sm font-medium text-gray-700 mb-1">YouTube</label>
                    <input type="url" name="social_youtube" value="{{ old('social_youtube', $settings['social_youtube'] ?? '') }}" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary" placeholder="https://youtube.com/...">
                </div>
            </div>
        </div>

        <div class="card bg-white rounded-lg shadow p-6 space-y-4">
            <h2 class="text-lg font-semibold text-gray-900 border-b pb-2">SEO</h2>
            <div>
                <label class="input-label block text-sm font-medium text-gray-700 mb-1">Meta Title</label>
                <input type="text" name="meta_title" value="{{ old('meta_title', $settings['meta_title'] ?? '') }}" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
            </div>
            <div>
                <label class="input-label block text-sm font-medium text-gray-700 mb-1">Meta Description</label>
                <textarea name="meta_description" rows="2" class="input-field w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">{{ old('meta_description', $settings['meta_description'] ?? '') }}</textarea>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="btn-primary px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 text-sm">Simpan Pengaturan</button>
        </div>
    </form>
</div>
@endsection
