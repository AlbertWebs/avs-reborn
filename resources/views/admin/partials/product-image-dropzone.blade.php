@php
    $isEdit = isset($product);
    $gallerySlots = [
        ['field' => 'image_one', 'label' => 'Main Image', 'required' => !$isEdit],
        ['field' => 'image_two', 'label' => 'Image Two', 'required' => false],
        ['field' => 'image_three', 'label' => 'Image Three', 'required' => false],
    ];
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
            Upload up to 3 gallery images. The first slot is the main product image.
            Max file size: 1.8MB each. Accepted formats: JPG, PNG, GIF, WebP.
        </p>

        <div class="row product-gallery-slots">
            @foreach($gallerySlots as $slot)
                @php
                    $field = $slot['field'];
                    $existingFile = $isEdit ? ($product->{$field} ?? '') : '';
                    $previewUrl = $existingFile !== '' ? url('/uploads/product/' . $existingFile) : '';
                @endphp
                <div class="col-lg-4 col-md-4 col-sm-12" style="margin-bottom: 20px;">
                    <div class="gallery-slot-card" data-slot="{{ $field }}">
                        <label class="gallery-slot-label">
                            {{ $slot['label'] }}
                            @if($slot['required'])
                                <span class="text-danger">*</span>
                            @endif
                        </label>

                        <div class="gallery-slot-preview" id="preview-box-{{ $field }}">
                            @if($previewUrl !== '')
                                <img src="{{ $previewUrl }}" alt="{{ $slot['label'] }}" class="gallery-slot-image">
                            @else
                                <div class="gallery-slot-placeholder">
                                    <i class="icon-picture"></i>
                                </div>
                            @endif
                        </div>

                        <div class="gallery-slot-actions">
                            <label class="btn btn-primary btn-sm gallery-slot-choose">
                                <i class="icon-upload"></i>
                                <span>{{ $previewUrl !== '' ? 'Change' : 'Select Image' }}</span>
                                <input
                                    type="file"
                                    name="{{ $field }}"
                                    id="input-{{ $field }}"
                                    class="gallery-slot-input"
                                    accept="image/jpeg,image/png,image/gif,image/webp,image/jpg"
                                    @if($slot['required'] && !$isEdit) data-required-slot="1" @endif
                                >
                            </label>
                            <button type="button" class="btn btn-danger btn-sm gallery-slot-clear" data-slot="{{ $field }}">
                                <i class="icon-trash"></i> Remove
                            </button>
                        </div>

                        @if($isEdit)
                            <input type="hidden" name="{{ $field }}_cheat" id="{{ $field }}_cheat" value="{{ $existingFile }}">
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
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

    .gallery-slot-card {
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 15px;
        text-align: center;
        height: 100%;
    }

    .gallery-slot-label {
        display: block;
        font-weight: 600;
        color: #333;
        margin-bottom: 12px;
        font-size: 14px;
    }

    .gallery-slot-preview {
        width: 100%;
        height: 180px;
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 6px;
        overflow: hidden;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .gallery-slot-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .gallery-slot-placeholder {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        color: #ccc;
        font-size: 48px;
    }

    .gallery-slot-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        justify-content: center;
    }

    .gallery-slot-choose {
        margin: 0 !important;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .gallery-slot-input {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        opacity: 0;
        cursor: pointer;
    }

    .gallery-slot-clear {
        margin: 0 !important;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var isEdit = {{ $isEdit ? 'true' : 'false' }};
    var maxFileSize = 1800000;
    var slots = ['image_one', 'image_two', 'image_three'];

    function setPreview(slot, src) {
        var box = document.getElementById('preview-box-' + slot);
        if (!box) {
            return;
        }

        if (src) {
            box.innerHTML = '<img src="' + src + '" alt="" class="gallery-slot-image">';
        } else {
            box.innerHTML = '<div class="gallery-slot-placeholder"><i class="icon-picture"></i></div>';
        }
    }

    function updateChooseLabel(slot, hasImage) {
        var card = document.querySelector('.gallery-slot-card[data-slot="' + slot + '"]');
        if (!card) {
            return;
        }

        var label = card.querySelector('.gallery-slot-choose span');
        if (label) {
            label.textContent = hasImage ? 'Change' : 'Select Image';
        }
    }

    slots.forEach(function (slot) {
        var input = document.getElementById('input-' + slot);
        var cheat = document.getElementById(slot + '_cheat');
        var clearBtn = document.querySelector('.gallery-slot-clear[data-slot="' + slot + '"]');

        if (!input) {
            return;
        }

        input.addEventListener('change', function () {
            var file = input.files && input.files[0];

            if (!file) {
                return;
            }

            if (file.size >= maxFileSize) {
                alert('File exceeded the maximum allowed size of 1.8MB.');
                input.value = '';
                return;
            }

            if (cheat) {
                cheat.value = '';
            }

            var reader = new FileReader();
            reader.onload = function (e) {
                setPreview(slot, e.target.result);
                updateChooseLabel(slot, true);
            };
            reader.readAsDataURL(file);
        });

        if (clearBtn) {
            clearBtn.addEventListener('click', function () {
                input.value = '';
                if (cheat) {
                    cheat.value = '';
                }
                setPreview(slot, null);
                updateChooseLabel(slot, false);
            });
        }
    });

    var productForm = document.getElementById('productForm');
    if (productForm && !isEdit) {
        productForm.addEventListener('submit', function (event) {
            var hasGalleryImage = false;

            slots.forEach(function (slot) {
                var input = document.getElementById('input-' + slot);
                if (input && input.files && input.files.length > 0) {
                    hasGalleryImage = true;
                }
            });

            if (!hasGalleryImage) {
                event.preventDefault();
                alert('Please add at least one gallery image (main product image).');
            }
        });
    }
});
</script>
