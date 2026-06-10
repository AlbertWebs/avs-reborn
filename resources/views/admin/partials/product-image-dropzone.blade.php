@php
    $isEdit = isset($product);
    $maxGalleryImages = 20;
    $existingGallery = $isEdit ? product_gallery_filenames($product, false) : [];
    $initialGallery = [];

    foreach ($existingGallery as $index => $filename) {
        $initialGallery[] = [
            'type' => 'existing',
            'filename' => $filename,
            'url' => url('/uploads/product/' . $filename),
            'label' => $index === 0 ? 'Main image' : 'Gallery ' . ($index + 1),
        ];
    }
@endphp

<div class="product-gallery-wrap">
    <div class="product-gallery-panel">
        <label class="control-label product-gallery-label">
            <i class="icon-picture"></i> Product Gallery
            @if(!$isEdit)
                <span class="text-danger">*</span>
            @endif
        </label>
        <p class="product-gallery-help">
            Drag and drop or click to add images. The first image is the main product image shown on the shop and product page.
            Up to {{ $maxGalleryImages }} images, 1.8MB each. Formats: JPG, PNG, GIF, WebP.
        </p>

        <div class="pg-dropzone" id="pg-dropzone">
            <div class="pg-dropzone-inner" id="pg-dropzone-trigger">
                <i class="icon-cloud-upload"></i>
                <strong>Drop images here</strong>
                <span>or click to browse — select multiple files at once</span>
            </div>
            <input
                type="file"
                id="pg-file-picker"
                accept="image/jpeg,image/png,image/gif,image/webp,image/jpg"
                multiple
                style="display: none;"
            >
        </div>

        <div class="pg-gallery-meta">
            <span><strong id="pg-count">0</strong> / {{ $maxGalleryImages }} images</span>
            <span class="pg-gallery-hint">First image = main product photo on the storefront</span>
        </div>

        <div class="pg-gallery-grid" id="pg-gallery-grid"></div>

        <input type="hidden" name="gallery_order_json" id="gallery_order_json" value="[]">
        <input type="file" name="gallery_files[]" id="gallery_files_input" multiple accept="image/*" style="display: none;">
    </div>
</div>

<style>
    .product-gallery-wrap {
        width: 100%;
        clear: both;
        margin: 10px 0 25px;
    }

    .product-gallery-panel {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        border: 2px dashed #ddd;
    }

    .product-gallery-label {
        font-weight: 600;
        color: #333;
        display: block;
        margin-bottom: 10px;
    }

    .product-gallery-help {
        color: #666;
        font-size: 13px;
        margin-bottom: 15px;
    }

    .pg-dropzone {
        border: 2px dashed #667eea;
        border-radius: 10px;
        background: #fff;
        margin-bottom: 12px;
        transition: border-color 0.2s, background 0.2s;
    }

    .pg-dropzone.is-dragover {
        border-color: #28a745;
        background: #f3fff6;
    }

    .pg-dropzone-inner {
        padding: 28px 16px;
        text-align: center;
        cursor: pointer;
        color: #667eea;
    }

    .pg-dropzone-inner i {
        display: block;
        font-size: 36px;
        margin-bottom: 8px;
    }

    .pg-dropzone-inner strong {
        display: block;
        font-size: 15px;
        color: #333;
        margin-bottom: 4px;
    }

    .pg-dropzone-inner span {
        font-size: 13px;
        color: #888;
    }

    .pg-gallery-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 14px;
        font-size: 13px;
        color: #666;
    }

    .pg-gallery-hint {
        color: #999;
        font-size: 12px;
    }

    .pg-gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 14px;
    }

    .pg-gallery-grid:empty {
        display: none;
    }

    .pg-gallery-card {
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    .pg-gallery-card.is-main {
        border-color: #667eea;
        box-shadow: 0 0 0 1px #667eea;
    }

    .pg-gallery-thumb {
        width: 100%;
        height: 140px;
        background: #f1f3f5;
        overflow: hidden;
    }

    .pg-gallery-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .pg-gallery-card-body {
        padding: 8px 10px 10px;
        text-align: center;
    }

    .pg-gallery-badge {
        display: inline-block;
        font-size: 11px;
        font-weight: 600;
        color: #667eea;
        background: #eef1ff;
        border-radius: 20px;
        padding: 2px 8px;
        margin-bottom: 6px;
    }

    .pg-gallery-badge.is-secondary {
        color: #666;
        background: #f0f0f0;
    }

    .pg-gallery-actions {
        display: flex;
        justify-content: center;
        gap: 4px;
        flex-wrap: wrap;
    }

    .pg-gallery-actions button {
        border: none;
        background: #f8f9fa;
        color: #555;
        border-radius: 4px;
        padding: 3px 7px;
        font-size: 11px;
        cursor: pointer;
    }

    .pg-gallery-actions button:hover {
        background: #e9ecef;
    }

    .pg-gallery-actions .pg-remove {
        color: #dc3545;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var isEdit = {{ $isEdit ? 'true' : 'false' }};
    var maxImages = {{ $maxGalleryImages }};
    var maxFileSize = 1800000;
    var uploadBase = '{{ url('/uploads/product') }}';

    var queue = @json($initialGallery);

    var dropzone = document.getElementById('pg-dropzone');
    var trigger = document.getElementById('pg-dropzone-trigger');
    var picker = document.getElementById('pg-file-picker');
    var grid = document.getElementById('pg-gallery-grid');
    var countEl = document.getElementById('pg-count');
    var orderInput = document.getElementById('gallery_order_json');
    var filesInput = document.getElementById('gallery_files_input');
    var productForm = document.getElementById('productForm');

    function syncHiddenFields() {
        var order = [];
        var newIndex = 0;

        queue.forEach(function (entry) {
            if (entry.type === 'existing') {
                order.push({ type: 'existing', filename: entry.filename });
            } else {
                order.push({ type: 'new', index: newIndex });
                newIndex++;
            }
        });

        orderInput.value = JSON.stringify(order);

        if (typeof DataTransfer !== 'undefined' && filesInput) {
            var dt = new DataTransfer();
            queue.forEach(function (entry) {
                if (entry.type === 'new') {
                    dt.items.add(entry.file);
                }
            });
            filesInput.files = dt.files;
        }

        countEl.textContent = queue.length;
    }

    function renderGallery() {
        grid.innerHTML = '';

        queue.forEach(function (entry, index) {
            var card = document.createElement('div');
            card.className = 'pg-gallery-card' + (index === 0 ? ' is-main' : '');
            card.dataset.index = String(index);

            var src = entry.type === 'existing' ? entry.url : entry.preview;
            var label = index === 0 ? 'Main image' : 'Gallery ' + (index + 1);

            card.innerHTML =
                '<div class="pg-gallery-thumb"><img src="' + src + '" alt=""></div>' +
                '<div class="pg-gallery-card-body">' +
                    '<span class="pg-gallery-badge ' + (index === 0 ? '' : 'is-secondary') + '">' + label + '</span>' +
                    '<div class="pg-gallery-actions">' +
                        (index > 0 ? '<button type="button" class="pg-move-left" title="Move left">&larr;</button>' : '') +
                        (index < queue.length - 1 ? '<button type="button" class="pg-move-right" title="Move right">&rarr;</button>' : '') +
                        '<button type="button" class="pg-remove" title="Remove">Remove</button>' +
                    '</div>' +
                '</div>';

            grid.appendChild(card);
        });

        syncHiddenFields();
    }

    function addFiles(fileList) {
        Array.prototype.forEach.call(fileList, function (file) {
            if (queue.length >= maxImages) {
                return;
            }

            if (!file.type.match(/^image\//)) {
                return;
            }

            if (file.size >= maxFileSize) {
                alert('"' + file.name + '" exceeds the 1.8MB limit.');
                return;
            }

            var reader = new FileReader();
            reader.onload = function (e) {
                queue.push({
                    type: 'new',
                    file: file,
                    preview: e.target.result
                });
                renderGallery();
            };
            reader.readAsDataURL(file);
        });
    }

    function removeAt(index) {
        queue.splice(index, 1);
        renderGallery();
    }

    function moveAt(index, direction) {
        var target = index + direction;
        if (target < 0 || target >= queue.length) {
            return;
        }

        var temp = queue[index];
        queue[index] = queue[target];
        queue[target] = temp;
        renderGallery();
    }

    trigger.addEventListener('click', function () {
        picker.click();
    });

    picker.addEventListener('change', function () {
        if (picker.files && picker.files.length) {
            addFiles(picker.files);
            picker.value = '';
        }
    });

    ['dragenter', 'dragover'].forEach(function (eventName) {
        dropzone.addEventListener(eventName, function (e) {
            e.preventDefault();
            e.stopPropagation();
            dropzone.classList.add('is-dragover');
        });
    });

    ['dragleave', 'drop'].forEach(function (eventName) {
        dropzone.addEventListener(eventName, function (e) {
            e.preventDefault();
            e.stopPropagation();
            dropzone.classList.remove('is-dragover');
        });
    });

    dropzone.addEventListener('drop', function (e) {
        if (e.dataTransfer && e.dataTransfer.files) {
            addFiles(e.dataTransfer.files);
        }
    });

    grid.addEventListener('click', function (e) {
        var card = e.target.closest('.pg-gallery-card');
        if (!card) {
            return;
        }

        var index = parseInt(card.dataset.index, 10);

        if (e.target.classList.contains('pg-remove')) {
            removeAt(index);
        } else if (e.target.classList.contains('pg-move-left')) {
            moveAt(index, -1);
        } else if (e.target.classList.contains('pg-move-right')) {
            moveAt(index, 1);
        }
    });

    if (productForm) {
        productForm.addEventListener('submit', function (e) {
            syncHiddenFields();

            if (!isEdit && queue.length === 0) {
                e.preventDefault();
                alert('Please add at least one gallery image (main product image).');
            }
        });
    }

    renderGallery();
});
</script>
