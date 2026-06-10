@extends('front.master-single')
@section('content')
@foreach($Products as $Product)
<?php 
    $SiteSettings = DB::table('sitesettings')->get();
    $Category = \App\Models\Category::find($Product->cat);
    $Reviews = DB::table('reviews')->where('product_id',$Product->id)->where('status','1')->get();
    $CountReviews = count($Reviews);
    $Ratings = DB::table('reviews')->where('product_id',$Product->id)->where('status','1')->avg('rating');
    $avg = $Ratings ? ceil($Ratings) : 5;
?>

<!-- JSON-LD Structured Data -->
<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "Product",
  "name": "{{$Product->name}}",
  "image": [
    @php $schemaGallery = product_gallery_filenames($Product); @endphp
    @if(count($schemaGallery) > 0)
    @foreach($schemaGallery as $index => $galleryFile)
    "{{url('/')}}/uploads/product/{{$galleryFile}}"{{ $index < count($schemaGallery) - 1 ? ',' : '' }}
    @endforeach
    @else
    "{{url('/')}}/uploads/product/{{$Product->image_one}}"
    @endif
  ],
  "description": "{{strip_tags($Product->meta)}}",
  "sku": "AVS-{{$Product->id}}",
  "brand": {
    "@type": "Brand",
    "name": "{{$Product->brand}}"
  },
  @if($CountReviews > 0)
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "{{$avg}}",
    "reviewCount": "{{$CountReviews}}"
  },
  "review": [
    @foreach($Reviews as $index => $review)
    {
      "@type": "Review",
      "author": {
        "@type": "Person",
        "name": "{{$review->name}}"
      },
      "datePublished": "{{$review->created_at}}",
      "reviewBody": "{{strip_tags(html_entity_decode($review->content))}}",
      "reviewRating": {
        "@type": "Rating",
        "ratingValue": "{{$review->rating}}"
      }
    }{{ $index < $CountReviews - 1 ? ',' : '' }}
    @endforeach
  ],
  @endif
  "offers": {
    "@type": "Offer",
    "url": "{{url('/')}}/product/{{$Product->slung}}",
    "priceCurrency": "KES",
    "price": "{{$Product->price}}",
    "priceValidUntil": "{{date('Y-12-31')}}",
    "itemCondition": "https://schema.org/NewCondition",
    "availability": "https://schema.org/{{ $Product->stock == 'In Stock' ? 'InStock' : 'OutOfStock' }}",
    "seller": {
      "@type": "Organization",
      "name": "Amani Vehicle Sounds"
    }
  }
}
</script>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [{
    "@type": "ListItem",
    "position": 1,
    "name": "Home",
    "item": "{{url('/')}}"
  },{
    "@type": "ListItem",
    "position": 2,
    "name": "{{$Category->cat}}",
    "item": "{{url('/')}}/products/{{$Category->slung}}"
  },{
    "@type": "ListItem",
    "position": 3,
    "name": "{{$Product->name}}",
    "item": "{{url('/')}}/product/{{$Product->slung}}"
  }]
}
</script>

@foreach($SiteSettings as $Settings)
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container d-flex align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                <?php $Category = \App\Models\Category::find($Product->cat); ?>
                <li class="breadcrumb-item"><a href="{{url('/')}}/products/{{$Category->slung}}"><?php  echo $Category->cat; ?></a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$Product->name}}</li>
            </ol>

            <?php 
                $CurrentID = $Product->id;
                $Next = $CurrentID+1;
                $Previous = $CurrentID-1;
                $NextProduct = \App\Models\Product::find($Next);
                $PreviousProduct = \App\Models\Product::find($Previous);
             ?>
            <nav class="product-pager ml-auto" aria-label="Product">
                @if($PreviousProduct==null)

                @else
                <a class="product-pager-link product-pager-prev" href="{{url('/')}}/product/{{$PreviousProduct->slung}}" aria-label="Previous" tabindex="-1">
                    <i class="icon-angle-left"></i>
                    <span>Prev</span>
                </a>
                @endif

                @if($NextProduct==null)

                @else
                <a class="product-pager-link product-pager-next" href="{{url('/')}}/product/{{$NextProduct->slung}}" aria-label="Next" tabindex="-1">
                    <span>Next</span>
                    <i class="icon-angle-right"></i>
                </a>
                @endif
            </nav><!-- End .pager-nav -->
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="product-details-top">
                <div class="row">
                    <div class="col-md-6">
                        <div class="product-gallery product-gallery-vertical" style="position: relative;">
                            @php
                                $productGallery = product_gallery_filenames($Product);
                                $mainGalleryImage = $productGallery[0] ?? $Product->image_one;
                                $imageCount = count($productGallery);
                            @endphp
                            <div class="row">
                                <!-- Main Image Display -->
                                <figure class="product-main-image" style="position: relative; margin-bottom: 1.5rem; background: #f8f9fa; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
                                    <div style="position: relative; padding-top: 100%; background: #fff;">
                                        <img id="product-zoom" 
                                             src="{{url('/')}}/uploads/product/{{$mainGalleryImage}}" 
                                             data-zoom-image="{{url('/')}}/uploads/product/{{$mainGalleryImage}}" 
                                             alt="{{$Product->name}}"
                                             style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: contain; transition: transform 0.3s ease; cursor: zoom-in;">
                                    </div>
                                    <a href="#" id="btn-product-gallery" class="btn-product-gallery" style="position: absolute; top: 15px; right: 15px; width: 44px; height: 44px; background: rgba(255,255,255,0.95); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 10px rgba(0,0,0,0.15); transition: all 0.3s ease; z-index: 10;">
                                        <i class="icon-arrows" style="font-size: 1.6rem; color: #333;"></i>
                                    </a>
                                    <div id="image-counter" style="position: absolute; bottom: 15px; left: 15px; background: rgba(0,0,0,0.7); color: white; padding: 6px 12px; border-radius: 20px; font-size: 0.85rem; font-weight: 500;{{ $imageCount <= 1 ? ' display: none;' : '' }}">
                                        <span id="current-image">1</span> / <span id="total-images">{{ max($imageCount, 1) }}</span>
                                    </div>
                                </figure><!-- End .product-main-image -->

                                <!-- Thumbnail Gallery -->
                                <div id="product-zoom-gallery" class="product-image-gallery" style="display: flex; gap: 0.75rem; flex-wrap: wrap; justify-content: center; margin-top: 1rem;">
                                    <?php
                                        $images = [];
                                        foreach ($productGallery as $galleryIndex => $galleryFile) {
                                            if ($galleryFile === ($Product->fb_pixels ?? null)) {
                                                $label = 'Facebook Pixel';
                                            } elseif ($galleryFile === ($Product->thumbnail ?? null)) {
                                                $label = 'Thumbnail';
                                            } elseif ($galleryIndex === 0) {
                                                $label = 'Main Image';
                                            } else {
                                                $label = 'Image ' . ($galleryIndex + 1);
                                            }
                                            $images[] = [
                                                'url' => $galleryFile,
                                                'name' => $label,
                                            ];
                                        }
                                    ?>
                                    @foreach($images as $index => $img)
                                    <a class="product-gallery-item {{$index == 0 ? 'active' : ''}}" 
                                       href="#" 
                                       data-image="{{url('/')}}/uploads/product/{{$img['url']}}" 
                                       data-zoom-image="{{url('/')}}/uploads/product/{{$img['url']}}"
                                       data-index="{{$index + 1}}"
                                       style="position: relative; display: block; width: 90px; height: 90px; border-radius: 8px; overflow: hidden; border: 3px solid transparent; transition: all 0.3s ease; background: #fff; box-shadow: 0 2px 8px rgba(0,0,0,0.1); cursor: pointer;">
                                        <img src="{{url('/')}}/uploads/product/{{$img['url']}}" 
                                             alt="{{$Product->name}} - {{$img['name']}}"
                                             style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;">
                                        <div class="gallery-item-overlay" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.05); opacity: 0; transition: opacity 0.3s ease;"></div>
                                    </a>
                                    @endforeach
                                </div><!-- End .product-image-gallery -->
                            </div><!-- End .row -->
                        </div><!-- End .product-gallery -->
                    </div><!-- End .col-md-6 -->

                    <div class="col-md-6">
                        @php
                            $productCategory = \App\Models\Category::find($Product->cat);
                            $categoryName = $productCategory->cat ?? null;
                            $categorySlug = $productCategory->slung ?? null;
                            $brandName = trim($Product->brand ?? '');
                            $productCode = trim($Product->code ?? '') ?: 'AVS-' . $Product->id;
                            $rawPrice = $Product->price;
                            $hasPrice = $rawPrice !== null && $rawPrice !== '' && is_numeric($rawPrice) && (float) $rawPrice > 0;
                            $formattedPrice = $hasPrice ? number_format((float) $rawPrice) : null;
                            $isInStock = ($Product->stock ?? '') === 'In Stock';
                            $hasOffer = ($Product->offer ?? 0) == 1 && !empty($Product->price_raw) && is_numeric($Product->price_raw);
                            $formattedOldPrice = $hasOffer ? number_format((float) $Product->price_raw) : null;
                            $productTag = null;
                            if (!empty($Product->tag)) {
                                $tagRow = DB::table('tags')->where('id', $Product->tag)->first();
                                $productTag = $tagRow->title ?? null;
                            }
                            $whatsappNumber = str_replace([' ', '-', '(', ')'], '', $Settings->mobile_one ?? $Settings->mobile ?? '254794301190');
                            $whatsappPriceText = $formattedPrice ? ", Price: KES {$formattedPrice}" : '';
                            $whatsappMessage = urlencode("Hello, I am interested in {$Product->name}{$whatsappPriceText} from your website");
                            $whatsappUrl = "https://wa.me/{$whatsappNumber}?text={$whatsappMessage}";
                            $detailReviews = DB::table('reviews')->where('product_id', $Product->id)->where('status', '1')->get();
                            $detailReviewCount = count($detailReviews);
                            $detailAvgRating = $detailReviews->isEmpty() ? 0 : ceil(DB::table('reviews')->where('product_id', $Product->id)->where('status', '1')->avg('rating'));
                        @endphp

                        <div class="product-details product-summary-panel">
                            @if($categoryName)
                            <div class="product-summary-category">
                                <a href="{{ url('/products/' . $categorySlug) }}">{{ $categoryName }}</a>
                            </div>
                            @endif

                            <h1 class="product-title">{{ $Product->name }}</h1>

                            @if($detailReviewCount > 0)
                            <div class="ratings-container">
                                <div class="ratings">
                                    <div class="ratings-val" style="width: {{ $detailAvgRating }}%;"></div>
                                </div>
                                <span class="ratings-text">({{ $detailReviewCount }} {{ $detailReviewCount === 1 ? 'Review' : 'Reviews' }})</span>
                            </div>
                            @endif

                            <div class="product-price-block">
                                @if($hasPrice)
                                    <div class="product-price">
                                        <span class="price-currency">KES</span>
                                        <span class="price-amount">{{ $formattedPrice }}</span>
                                    </div>
                                    @if($hasOffer)
                                    <span class="old-price">KES {{ $formattedOldPrice }}</span>
                                    <span class="offer-badge">On Sale</span>
                                    @endif
                                @else
                                    <div class="product-price product-price-contact">
                                        <a href="{{ $whatsappUrl }}" target="_blank">Contact for price</a>
                                    </div>
                                @endif
                            </div>

                            <div class="product-stock-row">
                                <span class="stock-badge {{ $isInStock ? 'in-stock' : 'out-of-stock' }}">
                                    {{ $isInStock ? 'In Stock' : 'Available to Order' }}
                                </span>
                                <span class="sku-label">SKU: {{ $productCode }}</span>
                            </div>

                            @if(!empty(trim($Product->meta ?? '')))
                            <div class="product-excerpt">
                                <p>{{ $Product->meta }}</p>
                            </div>
                            @endif

                            <ul class="product-specs-list">
                                <li>
                                    <span class="spec-label">Product Code</span>
                                    <span class="spec-value">{{ $productCode }}</span>
                                </li>
                                @if($categoryName)
                                <li>
                                    <span class="spec-label">Category</span>
                                    <span class="spec-value">
                                        <a href="{{ url('/products/' . $categorySlug) }}">{{ $categoryName }}</a>
                                    </span>
                                </li>
                                @endif
                                @if($brandName !== '')
                                <li>
                                    <span class="spec-label">Brand</span>
                                    <span class="spec-value">
                                        <a href="{{ url('/products/brand/' . $brandName) }}">{{ $brandName }}</a>
                                    </span>
                                </li>
                                @endif
                                <li>
                                    <span class="spec-label">Availability</span>
                                    <span class="spec-value {{ $isInStock ? 'text-success' : '' }}">
                                        {{ $isInStock ? 'In stock — ready to ship' : 'Available to order' }}
                                    </span>
                                </li>
                                @if($productTag)
                                <li>
                                    <span class="spec-label">Tag</span>
                                    <span class="spec-value">{{ $productTag }}</span>
                                </li>
                                @endif
                                <li>
                                    <span class="spec-label">Delivery</span>
                                    <span class="spec-value">Nairobi &amp; nationwide</span>
                                </li>
                            </ul>

                            <div class="product-trust-badges">
                                <div class="trust-badge">
                                    <i class="icon-truck"></i>
                                    <span>Fast Delivery</span>
                                </div>
                                <div class="trust-badge">
                                    <i class="icon-check-circle-o"></i>
                                    <span>Genuine Products</span>
                                </div>
                                <div class="trust-badge">
                                    <i class="icon-headphones"></i>
                                    <span>Expert Support</span>
                                </div>
                            </div>

                            <div class="details-filter-row details-row-size product-qty-row">
                                <label for="qty">Quantity</label>
                                <div class="product-details-quantity">
                                    <input type="number" id="qty" class="form-control" value="1" min="1" max="10" step="1" data-decimals="0" required>
                                </div>
                            </div>

                            <div class="product-details-action product-action-row">
                                <a href="{{ url('/') }}/shopping-cart/add-to-cart/{{ $Product->id }}" class="btn-product btn-cart btn-add-cart">
                                    <span>Add to Cart</span>
                                </a>
                                <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener" class="btn-product btn-cart btn-whatsapp" id="btn-whatsapp-buy">
                                    <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                                    </svg>
                                    <span>Buy on WhatsApp</span>
                                </a>
                            </div>

                            <div class="product-details-footer product-summary-footer">
                                <div class="product-help-line">
                                    <i class="icon-phone"></i>
                                    Need help? Call <a href="tel:{{ $Settings->mobile_one ?? $Settings->mobile }}">{{ $Settings->mobile_one ?? $Settings->mobile ?? '+254 794 301190' }}</a>
                                </div>
                                <div class="social-icons social-icons-sm">
                                    <span class="social-label">Share:</span>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url('/product/' . $Product->slung)) }}" class="social-icon" title="Facebook" target="_blank" rel="noopener"><i class="icon-facebook-f"></i></a>
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(url('/product/' . $Product->slung)) }}&text={{ urlencode($Product->name) }}" class="social-icon" title="Twitter" target="_blank" rel="noopener"><i class="icon-twitter"></i></a>
                                    <a href="https://www.instagram.com/amanivehiclesounds/?hl=en" class="social-icon" title="Instagram" target="_blank" rel="noopener"><i class="icon-instagram"></i></a>
                                    <a href="https://wa.me/?text={{ urlencode($Product->name . ' - ' . url('/product/' . $Product->slung)) }}" class="social-icon" title="WhatsApp" target="_blank" rel="noopener"><i class="icon-whatsapp"></i></a>
                                </div>
                            </div>
                        </div><!-- End .product-details -->
                    </div><!-- End .col-md-6 -->
                </div><!-- End .row -->
            </div><!-- End .product-details-top -->

            <div class="product-details-tab">
                <ul class="nav nav-pills justify-content-center" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab" role="tab" aria-controls="product-desc-tab" aria-selected="true">Description</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product-info-link" data-toggle="tab" href="#product-info-tab" role="tab" aria-controls="product-info-tab" aria-selected="false">Additional information</a>
                    </li>
                
                    <li class="nav-item">
                        <a class="nav-link" id="product-review-link" data-toggle="tab" href="#product-review-tab" role="tab" aria-controls="product-review-tab" aria-selected="false">Reviews (<?php $Review = DB::table('reviews')->where('product_id',$Product->id)->where('status','1')->get(); $countReview=count($Review); echo $countReview; ?>)</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel" aria-labelledby="product-desc-link">
                        <div class="product-desc-content">
                            <h3>Product Information</h3>
                            <p>{!!html_entity_decode($Product->content)!!}</p>

                            @php
                                $productCategory = \App\Models\Category::find($Product->cat);
                                $categoryName = $productCategory->cat ?? 'car audio';
                                $categoryUrl = isset($productCategory->slung) ? url('/products/' . $productCategory->slung) : url('/products');
                                $formattedPrice = is_numeric($Product->price) ? number_format((float) $Product->price) : $Product->price;
                                $brandName = trim($Product->brand ?? '');
                                $brandPhrase = $brandName !== '' ? $brandName . ' ' : '';
                                $stockPhrase = ($Product->stock ?? '') === 'In Stock' ? 'in stock and ready to ship' : 'available to order';
                            @endphp

                            <aside class="product-seo-snippet" aria-label="Buy {{ $Product->name }} in Kenya">
                                <p>
                                    Buy <strong>{{ $Product->name }}</strong> in
                                    <a href="{{ $categoryUrl }}">{{ $categoryName }}</a>
                                    from <strong>Amani Vehicle Sounds</strong> at
                                    <strong>KES {{ $formattedPrice }}</strong> in Kenya today.
                                    @if($brandName !== '')
                                        Shop genuine <strong>{{ $brandName }}</strong> car audio gear with confidence —
                                    @else
                                        Shop premium car audio gear with confidence —
                                    @endif
                                    {{ $stockPhrase }}, fast delivery in <strong>Nairobi</strong> and nationwide, professional installation support, and unbeatable value on
                                    {{ strtolower($brandPhrase) }}{{ strtolower($categoryName) }}, car speakers, car stereos, subwoofers, tweeters, Android radios, alarms, reverse cameras, and dashcams.
                                    Order online now from Kenya's trusted car sound specialists and transform your in-car entertainment experience.
                                </p>
                            </aside>
                        </div><!-- End .product-desc-content -->
                    </div><!-- .End .tab-pane -->
                    <div class="tab-pane fade" id="product-info-tab" role="tabpanel" aria-labelledby="product-info-link">
                        <div class="product-desc-content">
                            <h3>Information</h3>
                            <a href="#">
                                <img width="100" src="{{url('/')}}/uploads/product/{{$Product->image_one}}" alt="Product Manufacturer Image">
                            </a>
                            <p><strong>Type</strong> <?php $CategoryName = DB::table('category')->where('id',$Product->cat)->get();  ?> @foreach($CategoryName as $Cat) {{$Cat->cat}} @endforeach</p>
                            <p><strong>Brand</strong> {{$Product->brand}}</p>
                        </div><!-- End .product-desc-content -->
                    </div><!-- .End .tab-pane -->
                 
                    <div class="tab-pane fade" id="product-review-tab" role="tabpanel" aria-labelledby="product-review-link">
                        <div class="reviews">
                            <h3>Reviews (<?php $Review = DB::table('reviews')->where('product_id',$Product->id)->where('status','1')->get(); $countReview=count($Review); echo $countReview; ?>)</h3>
                            @foreach($Review as $review)
                            <div class="review">
                                <div class="row no-gutters">
                                    <div class="col-auto">
                                        <h4><a href="#">{{$review->name}}</a></h4>
                                        <div class="ratings-container">
                                            <div class="ratings">
                                                <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->
                                            </div><!-- End .ratings -->
                                        </div><!-- End .rating-container -->
                                        <span class="review-date"> <?php  $timestamp = $review->created_at; echo timeago($timestamp); ?> </span>
                                    </div><!-- End .col -->
                                    <div class="col">
                                        <h4>{{$review->title}}</h4>

                                        <div class="review-content">
                                            <p>{!!html_entity_decode($review->content)!!}</p>
                                        </div><!-- End .review-content -->

                                        <div class="review-action">
                                            <a href="#"><i class="icon-thumbs-up"></i>Helpful ({{$review->liked}})</a>
                                            <a href="#"><i class="icon-thumbs-down"></i>Unhelpful ({{$review->unlike}})</a>
                                        </div><!-- End .review-action -->
                                    </div><!-- End .col-auto -->
                                </div><!-- End .row -->
                            </div><!-- End .review -->
                            @endforeach
                        </div><!-- End .reviews -->
                    </div><!-- .End .tab-pane -->
                </div><!-- End .tab-content -->
            </div><!-- End .product-details-tab -->

            <h2 class="title text-center mb-4">You May Also Like</h2><!-- End .title text-center -->

            <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" 
                data-owl-options='{
                    "nav": true, 
                    "dots": true,
                    "margin": 20,
                    "loop": true,
                    "responsive": {
                        "0": {
                            "items":1
                        },
                        "480": {
                            "items":2
                        },
                        "768": {
                            "items":3
                        },
                        "992": {
                            "items":5
                        },
                        "1200": {
                            "items":4,
                            "nav": true,
                            "dots": false
                        }
                    }
                }'>
                <?php $Trending = DB::table('product')->where('stock','In Stock')->where('cat',$Product->cat)->limit('15')->get(); ?>
                @foreach ($Trending as $item)
                <div class="product">
                    <figure class="product-media">
                        {{-- <span class="product-label label-out">Out of Stock</span> --}}
                        {{-- <span class="product-label label-new">New</span> --}}
                        <a href="{{url('/')}}/product/{{$item->slung}}">
                            <img style="max-width:217px !important; !important; margin:0 auto;" src="{{url('/')}}/uploads/product/{{$item->thumbnail}}" alt="{{$item->name}}" class="product-image">
                        </a>

                        <div class="product-action-vertical">
                            <a href="{{url('/')}}/wishlist/add-to-wishlist/{{$item->id}}" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                            <a href="{{url('/')}}/compare/add-to-compare/{{$item->id}}" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                            <a href="{{url('/')}}/popup/{{$item->slung}}" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                        </div><!-- End .product-action-vertical -->

                        <div class="product-action">
                            <a href="{{url('/')}}/shopping-cart/add-to-cart/{{$item->id}}" class="btn-product btn-cart" title="Add to cart"><span>add to cart</span></a>
                        </div><!-- End .product-action -->
                    </figure><!-- End .product-media -->

                    <div class="product-body">
                        <div class="product-cat">
                            <?php $Category = DB::table('category')->where('id',$item->cat)->get(); ?>
                            @foreach ($Category as $Cat)
                            <a href="{{url('/products')}}/{{$Cat->slung}}"> {{$Cat->cat}} </a> 
                            @endforeach
                        </div><!-- End .product-cat -->
                        <h3 class="product-title"><a href="{{url('/')}}/product/{{$item->slung}}">{{$item->name}}</a></h3><!-- End .product-title -->
                        <div class="product-price">
                            KES{{$item->price}}
                        </div><!-- End .product-price -->
                        <?php 
                        $Reviews = DB::table('reviews')->where('product_id',$item->id)->get(); 
                        $CountReviews = count($Reviews);
                        $Ratings = DB::table('reviews')->where('product_id',$item->id)->avg('rating');
                        $avg = ceil($Ratings);
                            ?>
                            @if($Reviews->isEmpty())

                            @else
                            <div class="ratings-container">
                                <div class="ratings">
                                    <?php
                                        //Average Rating 
                                    ?>
                                    <div class="ratings-val" style="width: {{$avg}}%;"></div><!-- End .ratings-val -->
                                </div>
                                <span class="ratings-text">( {{$CountReviews}} Reviews )</span>
                            </div>
                            @endif
                            <!-- End .rating-container -->
                            {{--  --}}
                            <div class="product-cat">
                                <a href="{{url('/product')}}/{{$item->slung}}"> {{$item->meta}} </a> 
                            </div>
                    <!-- End .product-cat -->
                        {{--  --}}
                    </div><!-- End .product-body -->
                </div><!-- End .product -->
                @endforeach
            </div><!-- End .owl-carousel -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->

<style>
    /* Enhanced Product Gallery Styles */
    .product-gallery-item.active {
        border-color: #cc9966 !important;
        box-shadow: 0 4px 12px rgba(204, 153, 102, 0.3) !important;
        transform: scale(1.05);
    }
    
    .product-gallery-item:hover {
        border-color: #cc9966 !important;
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 6px 16px rgba(204, 153, 102, 0.25) !important;
    }
    
    .product-gallery-item:hover img {
        transform: scale(1.1);
    }
    
    .product-gallery-item:hover .gallery-item-overlay {
        opacity: 1 !important;
    }
    
    .product-gallery-item.active .gallery-item-overlay {
        opacity: 0.3 !important;
    }
    
    #btn-product-gallery:hover {
        background: #cc9966 !important;
        transform: rotate(90deg) scale(1.1);
    }
    
    #btn-product-gallery:hover i {
        color: white !important;
    }
    
    #product-zoom:hover {
        transform: scale(1.05);
    }
    
    /* Image counter animation */
    #image-counter {
        animation: fadeIn 0.3s ease;
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .product-image-gallery {
            gap: 0.5rem !important;
        }
        
        .product-gallery-item {
            width: 70px !important;
            height: 70px !important;
        }
        
        #btn-product-gallery {
            width: 38px !important;
            height: 38px !important;
            top: 10px !important;
            right: 10px !important;
        }
        
        #image-counter {
            bottom: 10px !important;
            left: 10px !important;
            font-size: 0.75rem !important;
            padding: 4px 10px !important;
        }
    }

    .product-seo-snippet {
        margin-top: 2rem;
        padding: 1.25rem 1.5rem;
        background: linear-gradient(135deg, #f8f9fc 0%, #f3f6ff 100%);
        border-left: 4px solid #667eea;
        border-radius: 0 8px 8px 0;
    }

    .product-seo-snippet p {
        margin: 0;
        font-size: 0.95rem;
        line-height: 1.75;
        color: #444;
    }

    .product-seo-snippet a {
        color: #667eea;
        font-weight: 600;
        text-decoration: none;
    }

    .product-seo-snippet a:hover {
        text-decoration: underline;
    }

    .product-summary-panel {
        padding: 0.5rem 0 1rem;
    }

    .product-summary-category {
        margin-bottom: 0.75rem;
    }

    .product-summary-category a {
        display: inline-block;
        padding: 0.35rem 0.85rem;
        background: #f3f6ff;
        color: #667eea;
        font-size: 0.82rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        border-radius: 20px;
        text-decoration: none;
    }

    .product-summary-panel .product-title {
        font-size: 1.85rem;
        line-height: 1.3;
        margin-bottom: 0.75rem;
    }

    .product-price-block {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 0.75rem;
        margin: 1rem 0;
        padding: 1rem 0;
        border-top: 1px solid #eee;
        border-bottom: 1px solid #eee;
    }

    .product-price-block .product-price {
        margin: 0;
        display: flex;
        align-items: baseline;
        gap: 0.35rem;
    }

    .product-price-block .price-currency {
        font-size: 1rem;
        font-weight: 600;
        color: #cc9966;
    }

    .product-price-block .price-amount {
        font-size: 2rem;
        font-weight: 700;
        color: #cc9966;
        line-height: 1;
    }

    .product-price-contact a {
        color: #25D366;
        font-weight: 700;
        font-size: 1.25rem;
        text-decoration: none;
    }

    .product-price-block .old-price {
        font-size: 1.1rem;
        color: #999;
        text-decoration: line-through;
    }

    .offer-badge {
        background: #dc3545;
        color: #fff;
        font-size: 0.75rem;
        font-weight: 700;
        padding: 0.25rem 0.6rem;
        border-radius: 4px;
        text-transform: uppercase;
    }

    .product-stock-row {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .stock-badge {
        display: inline-block;
        padding: 0.3rem 0.75rem;
        border-radius: 4px;
        font-size: 0.82rem;
        font-weight: 600;
    }

    .stock-badge.in-stock {
        background: #e8f5e9;
        color: #2e7d32;
    }

    .stock-badge.out-of-stock {
        background: #fff3e0;
        color: #e65100;
    }

    .sku-label {
        font-size: 0.85rem;
        color: #777;
    }

    .product-excerpt {
        margin-bottom: 1.25rem;
        padding: 1rem 1.15rem;
        background: #fafafa;
        border-radius: 8px;
        border-left: 3px solid #cc9966;
    }

    .product-excerpt p {
        margin: 0;
        color: #555;
        line-height: 1.65;
        font-size: 0.95rem;
    }

    .product-specs-list {
        list-style: none;
        margin: 0 0 1.25rem;
        padding: 0;
        border: 1px solid #eee;
        border-radius: 8px;
        overflow: hidden;
    }

    .product-specs-list li {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
        padding: 0.7rem 1rem;
        border-bottom: 1px solid #eee;
        font-size: 0.9rem;
    }

    .product-specs-list li:last-child {
        border-bottom: none;
    }

    .product-specs-list .spec-label {
        color: #888;
        font-weight: 500;
        flex-shrink: 0;
    }

    .product-specs-list .spec-value {
        color: #333;
        font-weight: 600;
        text-align: right;
    }

    .product-specs-list .spec-value a {
        color: #667eea;
        text-decoration: none;
    }

    .product-specs-list .spec-value a:hover {
        text-decoration: underline;
    }

    .product-specs-list .text-success {
        color: #2e7d32 !important;
    }

    .product-trust-badges {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        margin-bottom: 1.5rem;
    }

    .trust-badge {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.5rem 0.85rem;
        background: #f8f9fa;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 600;
        color: #555;
    }

    .trust-badge i {
        color: #cc9966;
        font-size: 1rem;
    }

    .product-qty-row {
        margin-bottom: 1rem;
    }

    .product-action-row {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        margin-bottom: 1.25rem;
    }

    .product-action-row .btn-product {
        flex: 1;
        min-width: 140px;
        justify-content: center;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-whatsapp {
        background-color: #25D366 !important;
        color: #fff !important;
        border-color: #25D366 !important;
    }

    .btn-whatsapp:hover {
        background-color: #1da851 !important;
        color: #fff !important;
    }

    .product-summary-footer {
        padding-top: 1rem;
        border-top: 1px solid #eee;
    }

    .product-help-line {
        font-size: 0.9rem;
        color: #666;
        margin-bottom: 0.75rem;
    }

    .product-help-line i {
        color: #cc9966;
        margin-right: 0.35rem;
    }

    .product-help-line a {
        color: #333;
        font-weight: 600;
        text-decoration: none;
    }

    @media (max-width: 768px) {
        .product-summary-panel .product-title {
            font-size: 1.45rem;
        }

        .product-price-block .price-amount {
            font-size: 1.65rem;
        }

        .product-specs-list li {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.25rem;
        }

        .product-specs-list .spec-value {
            text-align: left;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Quantity and WhatsApp link update
        const qtyInput = document.getElementById('qty');
        const whatsappLink = document.getElementById('btn-whatsapp-buy');
        
        if (qtyInput && whatsappLink) {
            qtyInput.addEventListener('change', updateWhatsappLink);
            qtyInput.addEventListener('input', updateWhatsappLink);

            function updateWhatsappLink() {
                const quantity = qtyInput.value;
                const productName = @json($Product->name);
                const productPrice = @json($formattedPrice ?? '');
                const whatsappNumber = @json(str_replace([' ', '-', '(', ')'], '', $Settings->mobile_one ?? $Settings->mobile ?? '254794301190'));
                const pricePart = productPrice ? `, Price: KES ${productPrice} each` : '';

                const newWhatsappMessage = encodeURIComponent(`Hello, I am interested in ${quantity} unit(s) of ${productName}${pricePart} from your website`);
                whatsappLink.href = `https://wa.me/${whatsappNumber}?text=${newWhatsappMessage}`;
            }
        }
        
        // Enhanced Image Gallery Functionality
        const mainImage = document.getElementById('product-zoom');
        const galleryItems = document.querySelectorAll('.product-gallery-item');
        const currentImageSpan = document.getElementById('current-image');
        const totalImagesSpan = document.getElementById('total-images');
        
        // Set total images count
        if (totalImagesSpan && galleryItems.length > 0) {
            totalImagesSpan.textContent = galleryItems.length;
        }
        
        // Handle thumbnail clicks
        galleryItems.forEach((item, index) => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Remove active class from all items
                galleryItems.forEach(thumb => thumb.classList.remove('active'));
                
                // Add active class to clicked item
                this.classList.add('active');
                
                // Update main image
                const newImageSrc = this.getAttribute('data-image');
                const newZoomSrc = this.getAttribute('data-zoom-image');
                
                if (mainImage) {
                    // Smooth fade transition
                    mainImage.style.opacity = '0';
                    mainImage.style.transition = 'opacity 0.3s ease';
                    setTimeout(() => {
                        mainImage.src = newImageSrc;
                        mainImage.setAttribute('data-zoom-image', newZoomSrc);
                        mainImage.style.opacity = '1';
                    }, 150);
                }
                
                // Update image counter
                if (currentImageSpan) {
                    currentImageSpan.textContent = index + 1;
                }
                
                // Reinitialize zoom if available
                if (typeof $.fn.elevateZoom !== 'undefined') {
                    $('#product-zoom').elevateZoom({
                        zoomType: "inner",
                        cursor: "crosshair",
                        zoomWindowFadeIn: 500,
                        zoomWindowFadeOut: 500
                    });
                }
            });
        });
        
        // Keyboard navigation for images
        let currentIndex = 0;
        document.addEventListener('keydown', function(e) {
            if (galleryItems.length === 0) return;
            
            if (e.key === 'ArrowLeft' && currentIndex > 0) {
                currentIndex--;
                galleryItems[currentIndex].click();
            } else if (e.key === 'ArrowRight' && currentIndex < galleryItems.length - 1) {
                currentIndex++;
                galleryItems[currentIndex].click();
            }
        });
        
        // Update current index when clicking thumbnails
        galleryItems.forEach((item, index) => {
            item.addEventListener('click', function() {
                currentIndex = index;
            });
        });
        
        // Fullscreen gallery button
        const fullscreenBtn = document.getElementById('btn-product-gallery');
        if (fullscreenBtn) {
            fullscreenBtn.addEventListener('click', function(e) {
                e.preventDefault();
                // Open fullscreen view or lightbox
                const currentActive = document.querySelector('.product-gallery-item.active');
                if (currentActive) {
                    const imageSrc = currentActive.getAttribute('data-image');
                    window.open(imageSrc, '_blank');
                }
            });
        }
    });
</script>

@endforeach
@endforeach
@endsection