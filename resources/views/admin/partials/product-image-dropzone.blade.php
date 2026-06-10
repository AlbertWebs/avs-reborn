@php
    $isEdit = isset($product);
    $existingImages = [];

    if ($isEdit) {
        $imageFields = [
            ['field' => 'image_one', 'label' => 'Main Image'],
            ['field' => 'image_two', 'label' => 'Image Two'],
            ['field' => 'image_three', 'label' => 'Image Three'],
        ];

        foreach ($imageFields as $imageField) {
            $filename = $product->{$imageField['field']} ?? null;
            if (!empty($filename)) {
                $existingImages[] = [
                    'field' => $imageField['field'],
                    'label' => $imageField['label'],
                    'filename' => $filename,
                    'url' => url('/uploads/product/' . $filename),
                ];
            }
        }
    }
@endphp

<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />

<div class="product-gallery-wrap">
    <div class="product-gallery-panel">
        <label class="control-label product-gallery-label">
            <i class="icon-picture"></i> Product Gallery
            @if(!$isEdit)
                <span class="text-danger">*</span>
            @endif
        </label>
        <p class="product-gallery-help">
            Drag and drop up to 3 images. The first image is the main product image, followed by additional gallery images.
            Max file size: 1.8MB each. Accepted formats: JPG, PNG, GIF, WebP.
        </p>

        <div id="product-gallery-dropzone" class="product-gallery-dropzone"></div>

        <input type="file" name="image_one" id="dz-image_one" style="display: none;" accept="image/*">
        <input type="file" name="image_two" id="dz-image_two" style="display: none;" accept="image/*">
        <input type="file" name="image_three" id="dz-image_three" style="display: none;" accept="image/*">

        @if($isEdit)
            <input type="hidden" name="image_one_cheat" id="image_one_cheat" value="{{ $product->image_one }}">
            <input type="hidden" name="image_two_cheat" id="image_two_cheat" value="{{ $product->image_two }}">
            <input type="hidden" name="image_three_cheat" id="image_three_cheat" value="{{ $product->image_three }}">
        @endif
    </div>
</div>

<div id="product-gallery-preview-template" style="display: none;">
    <div class="dz-preview dz-file-preview product-gallery-preview">
        <div class="product-gallery-preview-card">
            <div class="dz-image product-gallery-thumb">
                <img data-dz-thumbnail alt="">
            </div>
            <div class="product-gallery-preview-meta">
                <span class="product-gallery-slot-label" data-dz-name></span>
                <a class="dz-remove product-gallery-remove" href="javascript:undefined;" data-dz-remove>Remove</a>
            </div>
        </div>
        <div class="dz-error-message"><span data-dz-errormessage></span></div>
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

    #product-gallery-dropzone.product-gallery-dropzone.dropzone {
        min-height: 0;
        border: none;
        background: transparent;
        padding: 0;
        width: 100%;
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 16px;
        align-items: stretch;
    }

    @media (max-width: 991px) {
        #product-gallery-dropzone.product-gallery-dropzone.dropzone {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 575px) {
        #product-gallery-dropzone.product-gallery-dropzone.dropzone {
            grid-template-columns: 1fr;
        }
    }

    #product-gallery-dropzone .dz-message {
        grid-column: 1 / -1;
        margin: 0;
        padding: 32px 16px;
        font-size: 14px;
        color: #667eea;
        font-weight: 500;
        text-align: center;
        border: 2px dashed #667eea;
        border-radius: 8px;
        background: #fff;
        box-sizing: border-box;
    }

    #product-gallery-dropzone.dz-started .dz-message {
        grid-column: auto;
        padding: 24px 12px;
        min-height: 180px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #product-gallery-dropzone.dz-started.dz-max-files-reached .dz-message {
        display: none !important;
    }

    #product-gallery-dropzone .product-gallery-preview {
        margin: 0 !important;
        min-height: 0 !important;
        width: 100% !important;
        position: relative;
        display: block !important;
    }

    #product-gallery-dropzone .product-gallery-preview-card {
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    #product-gallery-dropzone .product-gallery-thumb {
        width: 100% !important;
        height: 180px !important;
        border-radius: 0 !important;
        overflow: hidden;
        position: relative;
        display: block;
        background: #f1f3f5;
    }

    #product-gallery-dropzone .product-gallery-thumb img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    #product-gallery-dropzone .product-gallery-preview-meta {
        padding: 10px 12px;
        text-align: center;
        border-top: 1px solid #eee;
    }

    #product-gallery-dropzone .product-gallery-slot-label {
        display: block;
        font-size: 12px;
        color: #666;
        margin-bottom: 6px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    #product-gallery-dropzone .product-gallery-remove {
        color: #dc3545;
        text-decoration: none;
        font-size: 12px;
        font-weight: 600;
    }

    #product-gallery-dropzone .product-gallery-remove:hover {
        text-decoration: underline;
    }

    #product-gallery-dropzone .dz-details,
    #product-gallery-dropzone .dz-success-mark,
    #product-gallery-dropzone .dz-error-mark,
    #product-gallery-dropzone .dz-progress {
        display: none !important;
    }

    #product-gallery-dropzone .dz-error-message {
        position: static;
        display: block;
        opacity: 1;
        margin-top: 8px;
        width: 100%;
        background: #f8d7da;
        color: #842029;
        border-radius: 6px;
        padding: 6px 8px;
        font-size: 12px;
    }

    #product-gallery-dropzone .dz-error-message:after {
        display: none;
    }
</style>

<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    if (typeof Dropzone === 'undefined') {
        return;
    }

    Dropzone.autoDiscover = false;

    var isEdit = {{ $isEdit ? 'true' : 'false' }};
    var existingImages = @json($existingImages);
    var slots = ['image_one', 'image_two', 'image_three'];
    var slotLabels = ['Main Image', 'Image Two', 'Image Three'];
    var maxFileSizeMb = 1.8;
    var previewTemplate = document.getElementById('product-gallery-preview-template');

    var dropzoneElement = document.getElementById('product-gallery-dropzone');
    if (!dropzoneElement || dropzoneElement.dropzone) {
        return;
    }

    var galleryDropzone = new Dropzone('#product-gallery-dropzone', {
        url: '{{ $isEdit ? url('/admin/edit_Product/' . $product->id) : url('/admin/add_Product') }}',
        autoProcessQueue: false,
        uploadMultiple: false,
        parallelUploads: 1,
        maxFiles: 3,
        addRemoveLinks: false,
        previewTemplate: previewTemplate ? previewTemplate.innerHTML : undefined,
        acceptedFiles: 'image/jpeg,image/png,image/gif,image/webp,image/jpg',
        maxFilesize: maxFileSizeMb,
        dictDefaultMessage: '<i class="icon-cloud-upload" style="font-size: 36px; display: block; margin-bottom: 8px;"></i>Add gallery image',
        dictMaxFilesExceeded: 'You can only upload up to 3 gallery images.',
        dictFileTooBig: 'File is too large. Max: ' + maxFileSizeMb + 'MB per image.',
        dictInvalidFileType: 'Only image files are allowed.',
        init: function () {
            var dz = this;

            function refreshGalleryState() {
                if (dz.files.length > 0) {
                    dz.element.classList.add('dz-started');
                } else {
                    dz.element.classList.remove('dz-started');
                }

                if (dz.files.length >= dz.options.maxFiles) {
                    dz.element.classList.add('dz-max-files-reached');
                } else {
                    dz.element.classList.remove('dz-max-files-reached');
                }

                dz.files.forEach(function (file, index) {
                    if (!file.previewElement) {
                        return;
                    }

                    var label = file.previewElement.querySelector('.product-gallery-slot-label');
                    if (label) {
                        label.textContent = slotLabels[index] || ('Image ' + (index + 1));
                    }
                });
            }

            existingImages.forEach(function (image) {
                var mockFile = {
                    name: image.filename,
                    size: 12345,
                    accepted: true,
                    isExisting: true,
                    serverName: image.filename,
                    field: image.field
                };

                dz.emit('addedfile', mockFile);
                dz.emit('thumbnail', mockFile, image.url);
                dz.emit('complete', mockFile);
                dz.files.push(mockFile);

                if (mockFile.previewElement) {
                    mockFile.previewElement.classList.add('dz-success', 'dz-complete', 'dz-image-preview');
                }
            });

            refreshGalleryState();

            dz.on('addedfile', function (file) {
                refreshGalleryState();

                if (file.previewElement) {
                    file.previewElement.classList.add('dz-image-preview');
                }
            });

            dz.on('removedfile', function (file) {
                refreshGalleryState();

                if (file.isExisting && isEdit) {
                    var cheatInput = document.getElementById(file.field + '_cheat');
                    if (cheatInput) {
                        cheatInput.value = '';
                    }
                }
            });

            dz.on('maxfilesexceeded', function (file) {
                dz.removeFile(file);
                alert('You can only upload up to 3 gallery images.');
            });
        }
    });

    function clearHiddenFileInput(slot) {
        var input = document.getElementById('dz-' + slot);
        if (!input) {
            return;
        }

        input.value = '';
    }

    function assignFileToInput(slot, file) {
        var input = document.getElementById('dz-' + slot);
        if (!input || typeof DataTransfer === 'undefined') {
            return false;
        }

        var dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);
        input.files = dataTransfer.files;
        return true;
    }

    function syncDropzoneToForm() {
        slots.forEach(clearHiddenFileInput);

        if (isEdit) {
            slots.forEach(function (slot) {
                var cheatInput = document.getElementById(slot + '_cheat');
                if (cheatInput) {
                    cheatInput.value = '';
                }
            });
        }

        var slotIndex = 0;

        galleryDropzone.files.forEach(function (file) {
            if (slotIndex >= slots.length) {
                return;
            }

            var slot = slots[slotIndex];

            if (file.isExisting) {
                if (isEdit) {
                    var cheatInput = document.getElementById(slot + '_cheat');
                    if (cheatInput) {
                        cheatInput.value = file.serverName;
                    }
                }
            } else {
                assignFileToInput(slot, file);
            }

            slotIndex++;
        });

        if (!isEdit && galleryDropzone.files.length === 0) {
            return false;
        }

        return true;
    }

    var productForm = document.getElementById('productForm');
    if (productForm) {
        productForm.addEventListener('submit', function (event) {
            if (!syncDropzoneToForm()) {
                event.preventDefault();
                alert('Please add at least one gallery image (main product image).');
            }
        });
    }
});
</script>
