@props(['name' => 'foto', 'current' => null, 'currentUrl' => null, 'accept' => '.jpg,.jpeg,.png,.webp', 'maxSize' => '2MB'])

<style>
    .drop-zone { border: 2px dashed #cbd5e1; border-radius: 0.75rem; transition: all 0.2s; cursor: pointer; position: relative; overflow: hidden; }
    .drop-zone:hover, .drop-zone.drag-over { border-color: #2563eb; background: #eff6ff; }
    .drop-zone.has-image { border-style: solid; border-color: #e2e8f0; }
    .drop-zone input[type="file"] { position: absolute; inset: 0; opacity: 0; cursor: pointer; z-index: 2; }
    .drop-zone .preview-img { width: 100%; height: 180px; object-fit: cover; border-radius: 0.5rem; }
    .drop-zone .remove-btn { position: absolute; top: 8px; right: 8px; z-index: 3; width: 28px; height: 28px; border-radius: 9999px; background: #ef4444; color: white; display: flex; align-items: center; justify-content: center; cursor: pointer; border: none; font-size: 14px; }
    .drop-zone .remove-btn:hover { background: #dc2626; }
</style>

<div id="drop-{{ $name }}" class="drop-zone {{ $current ? 'has-image' : '' }}" style="padding: {{ $current ? '12px' : '24px' }}; text-align: center;">
    <input type="file" name="{{ $name }}" id="input-{{ $name }}" accept="{{ $accept }}" onchange="handleFileSelect{{ $name }}(this)">

    <div id="placeholder-{{ $name }}" style="display: {{ $current ? 'none' : 'block' }};">
        <svg class="w-10 h-10 text-gray-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        <p class="text-sm text-gray-500 mb-1">Klik, paste (Ctrl+V), atau seret gambar ke sini</p>
        <p class="text-xs text-gray-400">Format: JPG, PNG, WEBP. Maks: {{ $maxSize }}</p>
    </div>

    <div id="preview-{{ $name }}" style="display: {{ $current ? 'block' : 'none' }};">
        <img id="img-{{ $name }}" src="{{ $currentUrl }}" class="preview-img" style="display: {{ $currentUrl ? 'block' : 'none' }};">
        <button type="button" class="remove-btn" onclick="removeImage{{ $name }}()" title="Hapus gambar">&times;</button>
    </div>
</div>

<script>
(function() {
    var dropZone = document.getElementById('drop-{{ $name }}');
    var input = document.getElementById('input-{{ $name }}');
    var placeholder = document.getElementById('placeholder-{{ $name }}');
    var preview = document.getElementById('preview-{{ $name }}');
    var img = document.getElementById('img-{{ $name }}');

    // Drag events
    dropZone.addEventListener('dragover', function(e) { e.preventDefault(); dropZone.classList.add('drag-over'); });
    dropZone.addEventListener('dragleave', function(e) { e.preventDefault(); dropZone.classList.remove('drag-over'); });
    dropZone.addEventListener('drop', function(e) {
        e.preventDefault();
        dropZone.classList.remove('drag-over');
        var files = e.dataTransfer.files;
        if (files.length > 0 && files[0].type.startsWith('image/')) {
            input.files = files;
            showPreview(files[0]);
        }
    });

    // Paste event
    document.addEventListener('paste', function(e) {
        if (document.activeElement === dropZone || dropZone.contains(document.activeElement)) {
            var items = e.clipboardData.items;
            for (var i = 0; i < items.length; i++) {
                if (items[i].type.startsWith('image/')) {
                    e.preventDefault();
                    var file = items[i].getAsFile();
                    var dt = new DataTransfer();
                    dt.items.add(file);
                    input.files = dt.files;
                    showPreview(file);
                    return;
                }
            }
        }
    });

    // Click to focus for paste
    dropZone.addEventListener('click', function(e) {
        if (e.target.tagName !== 'BUTTON' && e.target.tagName !== 'INPUT') {
            // Don't trigger file input on click if we want paste support
            // Only trigger on actual file input click
        }
    });

    window['handleFileSelect{{ $name }}'] = function(el) {
        if (el.files[0]) showPreview(el.files[0]);
    };

    window['removeImage{{ $name }}'] = function() {
        input.value = '';
        img.src = '';
        img.style.display = 'none';
        preview.style.display = 'none';
        placeholder.style.display = 'block';
        dropZone.classList.remove('has-image');
        dropZone.style.padding = '24px';
    };

    function showPreview(file) {
        var reader = new FileReader();
        reader.onload = function(e) {
            img.src = e.target.result;
            img.style.display = 'block';
            preview.style.display = 'block';
            placeholder.style.display = 'none';
            dropZone.classList.add('has-image');
            dropZone.style.padding = '12px';
        };
        reader.readAsDataURL(file);
    }
})();
</script>
