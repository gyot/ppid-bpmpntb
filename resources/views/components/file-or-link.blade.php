@props([
    'name' => 'file',
    'linkName' => 'link',
    'label' => 'Dokumen',
    'currentFile' => null,
    'currentLink' => null,
    'required' => false,
    'accept' => '.pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.jpg,.jpeg,.png',
    'maxSize' => '10MB',
])

@php
    $hasFile = $currentFile ? true : false;
    $hasLink = $currentLink ? true : false;
    $activeTab = $hasLink ? 'link' : 'file';
@endphp

<div x-data="{ activeTab: '{{ $activeTab }}' }">
    <label class="block text-sm font-medium text-gray-700 mb-2">{{ $label }} @if($required)<span class="text-red-500">*</span>@endif</label>
    
    {{-- Tab buttons --}}
    <div class="flex gap-1 mb-3 bg-gray-100 p-1 rounded-lg w-fit">
        <button type="button" @click="activeTab = 'file'" 
            :class="activeTab === 'file' ? 'bg-white shadow-sm text-primary' : 'text-gray-500 hover:text-gray-700'"
            class="px-4 py-1.5 rounded-md text-sm font-medium transition-all">
            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
            Unggah Berkas
        </button>
        <button type="button" @click="activeTab = 'link'" 
            :class="activeTab === 'link' ? 'bg-white shadow-sm text-primary' : 'text-gray-500 hover:text-gray-700'"
            class="px-4 py-1.5 rounded-md text-sm font-medium transition-all">
            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
            Link
        </button>
    </div>

    {{-- File upload --}}
    <div x-show="activeTab === 'file'" x-transition>
        <input type="file" name="{{ $name }}" accept="{{ $accept }}" {{ $required && !$hasFile && !$hasLink ? 'required' : '' }}
            class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors">
        <p class="text-xs text-gray-500 mt-1">Format: {{ strtoupper(str_replace('.', '', str_replace(',', ', ', $accept))) }}. Maks: {{ $maxSize }}</p>
        @if($hasFile)
            <p class="text-xs text-green-600 mt-1 flex items-center gap-1">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"/></svg>
                File saat ini: {{ basename($currentFile) }}
            </p>
        @endif
    </div>

    {{-- Link input --}}
    <div x-show="activeTab === 'link'" x-transition>
        <input type="url" name="{{ $linkName }}" value="{{ old($linkName, $currentLink) }}" 
            placeholder="https://drive.google.com/file/d/... atau https://..."
            class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors"
            {{ $required && !$hasFile && !$hasLink ? '' : '' }}>
        <p class="text-xs text-gray-500 mt-1">Masukkan link Google Drive, Dropbox, atau URL dokumen lainnya</p>
        @if($hasLink)
            <p class="text-xs text-blue-600 mt-1 flex items-center gap-1">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                Link saat ini: <a href="{{ $currentLink }}" target="_blank" class="underline hover:text-primary">{{ Str::limit($currentLink, 50) }}</a>
            </p>
        @endif
    </div>

    @error($name)
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
    @error($linkName)
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>