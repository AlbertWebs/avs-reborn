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
    "{{url('/')}}/uploads/product/{{$Product->image_one}}",
    "{{url('/')}}/uploads/product/{{$Product->image_two}}",
    "{{url('/')}}/uploads/product/{{$Product->image_three}}"
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
                            <div class="row">
                                <!-- Main Image Display -->
                                <figure class="product-main-image" style="position: relative; margin-bottom: 1.5rem; background: #f8f9fa; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
                                    <div style="position: relative; padding-top: 100%; background: #fff;">
                                        <img id="product-zoom" 
                                             src="{{url('/')}}/uploads/product/{{$Product->image_one}}" 
                                             data-zoom-image="{{url('/')}}/uploads/product/{{$Product->image_one}}" 
                                             alt="{{$Product->name}}"
                                             style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: contain; transition: transform 0.3s ease; cursor: zoom-in;">
                                    </div>
                                    <a href="#" id="btn-product-gallery" class="btn-product-gallery" style="position: absolute; top: 15px; right: 15px; width: 44px; height: 44px; background: rgba(255,255,255,0.95); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 10px rgba(0,0,0,0.15); transition: all 0.3s ease; z-index: 10;">
                                        <i class="icon-arrows" style="font-size: 1.6rem; color: #333;"></i>
                                    </a>
                                    <div id="image-counter" style="position: absolute; bottom: 15px; left: 15px; background: rgba(0,0,0,0.7); color: white; padding: 6px 12px; border-radius: 20px; font-size: 0.85rem; font-weight: 500;">
                                        <span id="current-image">1</span> / <span id="total-images">1</span>
                                    </div>
                                </figure><!-- End .product-main-image -->

                                <!-- Thumbnail Gallery -->
                                <div id="product-zoom-gallery" class="product-image-gallery" style="display: flex; gap: 0.75rem; flex-wrap: wrap; justify-content: center; margin-top: 1rem;">
                                    <?php 
                                        $images = [];
                                        $images[] = ['url' => $Product->image_one, 'name' => 'Main Image'];
                                        if($Product->fb_pixels && $Product->fb_pixels != '0') {
                                            $images[] = ['url' => $Product->fb_pixels, 'name' => 'Image 2'];
                                        }
                                        if($Product->image_two && $Product->image_two != '0' && $Product->image_two != null) {
                                            $images[] = ['url' => $Product->image_two, 'name' => 'Image 3'];
                                        }
                                        if($Product->image_three && $Product->image_three != '0' && $Product->image_three != null) {
                                            $images[] = ['url' => $Product->image_three, 'name' => 'Image 4'];
                                        }
                                        $imageCount = count($images);
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
                        <div class="product-details">
                            <h1 class="product-title">{{$Product->name}}</h1><!-- End .product-title -->

                            <?php 
                                $Reviews = DB::table('reviews')->where('product_id',$Product->id)->get(); 
                                $CountReviews = count($Reviews);
                                $Ratings = DB::table('reviews')->where('product_id',$Product->id)->avg('rating');
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

                            <div class="product-price">
                                KES {{$Product->price}}
                                @if($Product->offer == 1)
                                &nbsp; <span style="text-decoration: line-through;" class="old-price">KES {{$Product->price_raw}}</span>
                                @endif
                            </div><!-- End .product-price -->

                            <div class="product-content">
                                <p>{{$Product->meta}} </p>
                            </div><!-- End .product-content -->

                            

                            

                            <div class="details-filter-row details-row-size">
                                <label for="qty">Qty:</label>
                                <div class="product-details-quantity">
                                    <input type="number" id="qty" class="form-control" value="1" min="1" max="10" step="1" data-decimals="0" required>
                                </div><!-- End .product-details-quantity -->
                            </div><!-- End .details-filter-row -->

                            <div class="product-details-action">
                                <a href="{{url('/')}}/shopping-cart/add-to-cart/{{$Product->id}}" class="btn-product btn-cart" style="margin-right: 10px;"><span>Add to Cart</span></a>

                                <?php
                                    $whatsappNumber = str_replace([' ', '-', '(', ')'], '', $Settings->mobile_one ?? $Settings->mobile ?? '254794301190');
                                    $whatsappMessage = urlencode("Hello, I am interested in {$Product->name}, Price: KES {$Product->price} from your website");
                                    $whatsappUrl = "https://wa.me/{$whatsappNumber}?text={$whatsappMessage}";
                                ?>
                                <a href="{{$whatsappUrl}}" target="_blank" class="btn-product btn-cart" style="background-color: #25D366; color: white; display: inline-flex; align-items: center;">
                                    <svg style="width: 18px; height: 18px; margin-right: 8px;" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                                    </svg>
                                    <span>Buy Now</span>
                                </a>
                            </div><!-- End .product-details-action -->

                            <div class="product-details-footer">
                                <div class="product-cat">
                                    <span>Category:</span>
                                    <?php $Category = DB::table('category')->where('id',$Product->cat)->get(); ?>
                                    @foreach ($Category as $Cat)
                                    <a href="{{url('/products')}}/{{$Cat->slung}}"> {{$Cat->cat}} </a> |
                                    @endforeach
                                    <a href="#">Brand</a>:
                                    <a href="{{url('/')}}/products/brand/{{$Product->brand}}">{{$Product->brand}}</a>
                                </div><!-- End .product-cat -->

                                <div class="social-icons social-icons-sm">
                                    <span class="social-label">Share:</span>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{url('/')}}/product/{{$Product->slung}}" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                    <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                    <a href="https://www.instagram.com/amanivehiclesounds/?hl=en" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                                    <a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                                </div>
                            </div><!-- End .product-details-footer -->
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
                                $categoryName = $Category->cat ?? 'car audio';
                                $categoryUrl = isset($Category->slung) ? url('/products/' . $Category->slung) : url('/products');
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
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Quantity and WhatsApp link update
        const qtyInput = document.getElementById('qty');
        const whatsappLink = document.querySelector('a[href*="wa.me"]');
        
        if (qtyInput && whatsappLink) {
            const originalWhatsappUrl = whatsappLink.href;
            
            qtyInput.addEventListener('change', updateWhatsappLink);
            qtyInput.addEventListener('input', updateWhatsappLink);

            function updateWhatsappLink() {
                const quantity = qtyInput.value;
                const productName = "{{ $Product->name }}";
                const productPrice = "{{ $Product->price }}";
                const whatsappNumber = "{{ str_replace([' ', '-', '(', ')'], '', $Settings->mobile_one ?? $Settings->mobile ?? '254794301190') }}";

                const newWhatsappMessage = encodeURIComponent(`Hello, I am interested in ${quantity} unit(s) of ${productName}, Price: KES ${productPrice} each, from your website`);
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