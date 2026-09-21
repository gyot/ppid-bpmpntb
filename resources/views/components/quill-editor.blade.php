@props(['name' => 'content', 'value' => '', 'height' => '250px', 'label' => '', 'uploadUrl' => ''])

<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
<style>
    .ql-editor { min-height: {{ $height }}; font-family: 'Inter', sans-serif; font-size: 14px; line-height: 1.7; }
    .ql-editor p { margin-bottom: 0.5em; }
    .ql-editor ul, .ql-editor ol { padding-left: 1.5em; margin-bottom: 0.5em; }
    .ql-editor li { margin-bottom: 0.25em; }
    .ql-toolbar { border-top: none !important; border-left: none !important; border-right: none !important; border-bottom: 1px solid #e2e8f0 !important; background: #f8fafc; border-radius: 0.5rem 0.5rem 0 0; }
    .ql-container { border: 1px solid #e2e8f0 !important; border-top: none !important; border-radius: 0 0 0.5rem 0.5rem; }
    .ql-toolbar .ql-formats { margin-right: 10px; }
    .editor-upload-progress { position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: rgba(0,0,0,0.7); color: white; padding: 8px 16px; border-radius: 8px; font-size: 13px; display: none; z-index: 10; }
</style>

@if($label)
<label class="input-label mb-3">{{ $label }}</label>
@endif

<div style="position:relative;">
    <div id="toolbar-{{ $name }}">
        <span class="ql-formats">
            <select class="ql-header"><option selected></option><option value="1">Heading 1</option><option value="2">Heading 2</option><option value="3">Heading 3</option></select>
        </span>
        <span class="ql-formats">
            <button class="ql-bold"></button>
            <button class="ql-italic"></button>
            <button class="ql-underline"></button>
            <button class="ql-strike"></button>
        </span>
        <span class="ql-formats">
            <select class="ql-color"></select>
            <select class="ql-background"></select>
        </span>
        <span class="ql-formats">
            <button class="ql-script" value="sub"></button>
            <button class="ql-script" value="super"></button>
        </span>
        <span class="ql-formats">
            <button class="ql-blockquote"></button>
            <button class="ql-code-block"></button>
        </span>
        <span class="ql-formats">
            <button class="ql-list" value="ordered"></button>
            <button class="ql-list" value="bullet"></button>
            <button class="ql-indent" value="-1"></button>
            <button class="ql-indent" value="+1"></button>
        </span>
        <span class="ql-formats">
            <button class="ql-direction" value="rtl"></button>
            <select class="ql-align"></select>
        </span>
        <span class="ql-formats">
            <button class="ql-link"></button>
            <button class="ql-image"></button>
            <button class="ql-video"></button>
        </span>
        <span class="ql-formats">
            <button class="ql-clean"></button>
        </span>
    </div>
    <div id="editor-{{ $name }}"></div>
    <div class="editor-upload-progress" id="progress-{{ $name }}">Mengupload gambar...</div>
    <input type="hidden" name="{{ $name }}" id="input-{{ $name }}" value="{{ $value }}">
</div>

<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var uploadUrl = '{{ $uploadUrl ?: route("admin.upload.image") }}';
    var csrfToken = '{{ csrf_token() }}';

    function imageHandler() {
        var input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');
        input.click();
        input.onchange = function() {
            if (input.files[0]) {
                uploadImage(input.files[0]);
            }
        };
    }

    function uploadImage(file) {
        var progress = document.getElementById('progress-{{ $name }}');
        progress.style.display = 'block';

        var formData = new FormData();
        formData.append('image', file);
        formData.append('_token', csrfToken);

        fetch(uploadUrl, {
            method: 'POST',
            body: formData,
        })
        .then(function(response) { return response.json(); })
        .then(function(data) {
            progress.style.display = 'none';
            if (data.success) {
                var range = quill{{ $name }}.getSelection(true);
                quill{{ $name }}.insertEmbed(range.index, 'image', data.url);
                quill{{ $name }}.setSelection(range.index + 1);
            } else {
                alert('Gagal mengupload gambar.');
            }
        })
        .catch(function(err) {
            progress.style.display = 'none';
            alert('Error upload: ' + err.message);
        });
    }

    var quill{{ $name }} = new Quill('#editor-{{ $name }}', {
        theme: 'snow',
        modules: {
            toolbar: {
                container: '#toolbar-{{ $name }}',
                handlers: {
                    image: imageHandler
                }
            },
            clipboard: {
                matchVisual: false
            }
        },
        placeholder: 'Tulis konten di sini...'
    });

    // Set initial content
    var initialContent = document.getElementById('input-{{ $name }}').value;
    if (initialContent) {
        quill{{ $name }}.root.innerHTML = initialContent;
    }

    // Handle paste images
    quill{{ $name }}.getModule('clipboard').addMatcher('IMG', function(node, delta) {
        // If pasted image has data-src or src that's a blob/file, we need to upload it
        return delta;
    });

    // Listen for paste event to handle pasted images
    quill{{ $name }}.root.addEventListener('paste', function(e) {
        var clipboardData = e.clipboardData || window.clipboardData;
        if (!clipboardData) return;

        var items = clipboardData.items;
        for (var i = 0; i < items.length; i++) {
            if (items[i].type.indexOf('image') !== -1) {
                e.preventDefault();
                e.stopPropagation();
                var file = items[i].getAsFile();
                uploadImage(file);
                return;
            }
        }
    });

    // Handle drag and drop images
    quill{{ $name }}.root.addEventListener('drop', function(e) {
        e.preventDefault();
        e.stopPropagation();
        var files = e.dataTransfer.files;
        for (var i = 0; i < files.length; i++) {
            if (files[i].type.indexOf('image') !== -1) {
                uploadImage(files[i]);
                return;
            }
        }
    });

    quill{{ $name }}.root.addEventListener('dragover', function(e) {
        e.preventDefault();
        e.stopPropagation();
    });

    // Sync content to hidden input on form submit
    var form = document.getElementById('input-{{ $name }}').closest('form');
    if (form) {
        form.addEventListener('submit', function() {
            document.getElementById('input-{{ $name }}').value = quill{{ $name }}.root.innerHTML;
        });
    }
});
</script>
