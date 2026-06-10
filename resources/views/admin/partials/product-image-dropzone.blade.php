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

<div class="col-lg-12" style="margin-bottom: 25px;">
    <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; border: 2px dashed #ddd;">
        <label class="control-label" style="font-weight: 600; color: #333; display: block; margin-bottom: 10px;">
            <i class="icon-picture"></i> Product Gallery
            @if(!$isEdit)
                <span style="color: #dc3545;">*</span>
            @endif
        </label>
        <p style="color: #666; font-size: 13px; margin-bottom: 15px;">
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

<style>
    .product-gallery-dropzone {
        min-height: 200px;
        border: 2px dashed #667eea;
        border-radius: 8px;
        background: #fff;
        padding: 10px;
    }

    .product-gallery-dropzone .dz-message {
        margin: 2em 0;
        font-size: 15px;
        color: #667eea;
        font-weight: 500;
    }

    .product-gallery-dropzone .dz-preview {
        margin: 10px;
    }

    .product-gallery-dropzone .dz-preview .dz-image {
        border-radius: 8px;
        overflow: hidden;
    }

    .product-gallery-dropzone .dz-preview .dz-remove {
        color: #dc3545;
        text-decoration: none;
        font-size: 12px;
        margin-top: 5px;
        display: inline-block;
    }

    .product-gallery-dropzone .dz-preview .dz-remove:hover {
        text-decoration: underline;
    }

    .product-gallery-dropzone .dz-error-message {
        top: 140px;
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
    var maxFileSizeMb = 1.8;

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
        addRemoveLinks: true,
        acceptedFiles: 'image/jpeg,image/png,image/gif,image/webp,image/jpg',
        maxFilesize: maxFileSizeMb,
        dictDefaultMessage: '<i class="icon-cloud-upload" style="font-size: 42px; display: block; margin-bottom: 10px;"></i>Drop gallery images here or click to browse',
        dictRemoveFile: 'Remove',
        dictMaxFilesExceeded: 'You can only upload up to 3 gallery images.',
        dictFileTooBig: 'File is too large. Max: ' + maxFileSizeMb + 'MB per image.',
        dictInvalidFileType: 'Only image files are allowed.',
        init: function () {
            var dz = this;

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
                    mockFile.previewElement.classList.add('dz-success', 'dz-complete');
                }
            });

            dz.on('removedfile', function (file) {
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
