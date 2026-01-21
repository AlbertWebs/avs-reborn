@extends('front.master-one')
@section('content')
<main class="main bg-light">
    <?php $Slider = DB::table('product')->where('stock','In Stock')->limit(10)->InRandomOrder()->where('slider','1')->get(); $CountSlider = count($Slider); ?>
    @if($CountSlider > 0)
    <div class="intro-slider-container">
        <div class="intro-slider owl-carousel owl-simple owl-nav-inside" data-toggle="owl" data-owl-options='{
                "nav": false,
                "responsive": {
                    "992": {
                        "nav": true
                    }
                }
            }'>
            @foreach($Slider as $slider)
            <div class="intro-slide" style="background-image: url('{{url('/')}}/uploads/product/{{$slider->image_two}}');">
                <div class="container intro-content">
                    <div class="row">
                        <?php $Category = DB::table('category')->where('id',$slider->cat)->get(); ?>
                        @foreach ($Category as $Cat)
                        <div class="col-auto offset-lg-3 intro-col">
                            <h3 class="intro-subtitle">{{$Cat->cat}}</h3>
                            <!-- End .h3 intro-subtitle -->
                            <h1 class="intro-title width-300">{{$slider->name}}
                                <span class="the-price">
                                    <sup class="font-weight-light">from</sup>
                                    <span class="text-primary">KES {{$slider->price}}<sup>,00</sup></span>
                                </span>
                            </h1><!-- End .intro-title -->

                            <a href="{{url('/')}}/product/{{$slider->slung}}" class="btn btn-outline-primary-2">
                                <span>Shop Now</span>
                                <i class="icon-long-arrow-right"></i>
                            </a>
                        </div><!-- End .col-auto offset-lg-3 -->
                        @endforeach
                    </div><!-- End .row -->
                </div><!-- End .container intro-content -->
            </div><!-- End .intro-slide -->
            @endforeach
        </div><!-- End .owl-carousel owl-simple -->

        <span class="slider-loader"></span><!-- End .slider-loader -->
    </div><!-- End .intro-slider-container -->
    <div class="mb-5"></div>
    @endif

    <br><br>
    <!-- Modern Categories Section -->
    <div class="container py-4 popular-categories-section">
        <div class="section-header text-center mb-4">
            <h1 class="section-title" style="font-size: 2.5rem; font-weight: 800; color: #333; margin-bottom: 0.5rem;">Your go-to plug for car audio systems</h1>
            <p class="section-subtitle" style="color: #666; font-size: 1.1rem;">Transform your cabin into a concert hall with our handpicked audio collections.</p>
        </div>

        <?php $Categories = DB::table('category')->where('home','1')->orderBy('order', 'asc')->limit('6')->get(); ?>
        @if(!$Categories->isEmpty())
        <div class="modern-categories-grid">
            <div class="row g-3">
                @foreach($Categories as $Cat)
                <div class="col-6 col-sm-4 col-lg-2">
                    <a href="{{url('/')}}/products/{{$Cat->slung}}" class="modern-cat-card">
                        <div class="cat-card-image">
                            <img loading="lazy" src="{{url('/')}}/uploads/categories/{{$Cat->image}}" alt="{{$Cat->cat}}" class="img-fluid">
                        </div>
                        <h3 class="cat-card-title">{{$Cat->cat}}</h3>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    <style>
    .modern-cat-card {
        display: block;
        text-decoration: none;
        background: #fff;
        border-radius: 16px;
        padding: 1.5rem 1rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid #f0f0f0;
        text-align: center;
        height: 100%;
        position: relative;
        overflow: hidden;
    }
    .modern-cat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #66139b 0%, #764ba2 100%);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }
    .modern-cat-card:hover::before {
        transform: scaleX(1);
    }
    .modern-cat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(102, 126, 234, 0.15);
        border-color: #66139b;
    }
    .cat-card-image {
        width: 100%;
        height: 140px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
        position: relative;
    }
    .cat-card-image img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        transition: transform 0.3s ease;
    }
    .modern-cat-card:hover .cat-card-image img {
        transform: scale(1.1);
    }
    .cat-card-title {
        font-size: 0.9rem;
        font-weight: 600;
        color: #333;
        margin: 0;
        line-height: 1.4;
        transition: color 0.3s ease;
    }
    .modern-cat-card:hover .cat-card-title {
        color: #66139b;
    }
    @media (max-width: 576px) {
        .popular-categories-section {
            padding: 1.25rem 0.5rem !important;
        }
        
        .popular-categories-section .section-title {
            font-size: 1.35rem !important;
        }
        
        .popular-categories-section .section-subtitle {
            font-size: 0.85rem !important;
        }
        
        .modern-cat-card {
            padding: 0.875rem 0.5rem !important;
            min-height: 130px !important;
        }
        .cat-card-image {
            height: 90px !important;
            margin-bottom: 0.625rem !important;
        }
        .cat-card-title {
            font-size: 0.7rem !important;
            line-height: 1.2 !important;
        }
    }
    
    @media (max-width: 480px) {
        .popular-categories-section {
            padding: 1rem 0.5rem !important;
        }
        
        .popular-categories-section .section-title {
            font-size: 1.25rem !important;
        }
        
        .popular-categories-section .section-subtitle {
            font-size: 0.8rem !important;
        }
        
        .modern-cat-card {
            padding: 0.75rem 0.4rem !important;
            min-height: 120px !important;
        }
        
        .cat-card-image {
            height: 85px !important;
        }
        
        .cat-card-title {
            font-size: 0.65rem !important;
        }
    }
    </style>

    
    <!-- Modern Offer Banners Section -->
    <?php $Full = DB::table('product')->where('stock','In Stock')->where('offer','11')->limit('10')->inRandomOrder()->get();  ?>
    @if(!$Full->isEmpty())
    <div class="container py-4">
        <div class="modern-banners-grid">
            <div class="row g-3">
            @foreach($Full as $full)
                <div class="col-12 col-sm-6 col-lg-4">
                    <a href="{{url('/')}}/product/{{$full->slung}}" class="modern-banner-card">
                        <div class="banner-image-wrapper">
                            <img loading="lazy" src="{{url('/')}}/uploads/product/{{$full->offer_banner}}" alt="{{$full->name}}" class="banner-image">
                            <div class="banner-overlay"></div>
                        </div>
                    </a>
                </div>
            @endforeach
            </div>
        </div>
    </div>
    @endif

    <style>
    .modern-banner-card {
        display: block;
        position: relative;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
        min-height: 200px;
    }
    .modern-banner-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(0,0,0,0.15);
    }
    .banner-image-wrapper {
        position: relative;
        width: 100%;
        height: 100%;
        min-height: 200px;
        overflow: hidden;
    }
    .banner-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .modern-banner-card:hover .banner-image {
        transform: scale(1.05);
    }
    .banner-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to bottom, transparent 0%, rgba(0,0,0,0.1) 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .modern-banner-card:hover .banner-overlay {
        opacity: 1;
    }
    @media (max-width: 576px) {
        .modern-banner-card {
            min-height: 180px;
        }
    }
    </style>

    <div class="mb-4"></div>

    <!-- Modern Hot Deals Section -->
    <?php $Trending = DB::table('product')->where('stock','In Stock')->where('trending','1')->limit('10')->get(); ?>
    @if(!$Trending->isEmpty())
    <div class="modern-deals-section" style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); padding: 3rem 0;">
        <div class="container">
            <div class="tab-content tab-content-carousel">
                <div class="tab-pane p-0 fade show active" id="hot-all-tab" role="tabpanel" aria-labelledby="hot-all-link">
                    <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl"
                        data-owl-options='{
                            "nav": false,
                            "dots": true,
                            "margin": 10,
                            "loop": true,
                            "responsive": {
                                "0": {
                                    "items":2
                                },
                                "480": {
                                    "items":2
                                },
                                "768": {
                                    "items":3
                                },
                                "992": {
                                    "items":4
                                },
                                "1280": {
                                    "items":5,
                                    "nav": true
                                }
                            }
                        }'>
                        @foreach ($Trending as $item)
                        <div class="product">
                            <figure class="product-media" style="position: relative; overflow: hidden; border-radius: 16px 16px 0 0;">
                                @if($item->stock == "Out of Stock")
                                <span class="product-label label-out" style="position: absolute; top: 10px; left: 10px; z-index: 2; background: #f5576c; color: white; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.75rem; font-weight: 600;">Out of Stock</span>
                                @endif
                                @if($item->offer == 1)
                                    <?php
                                        $OldPrice = $item->price_raw;
                                        if($OldPrice == null || $OldPrice == 0){
                                            $OldPrice = $item->price;
                                        }
                                        $NewPrice = $item->price;
                                        $Change = ($NewPrice*100)/$OldPrice;
                                        $Change = ceil($Change);

                                        $Difference = 100-$Change;
                                    ?>
                                    <span class="product-label label-out" style="position: absolute; top: 10px; right: 10px; z-index: 2; background: #66139b; color: white; padding: 0.5rem 0.75rem; border-radius: 20px; font-size: 0.85rem; font-weight: 700; box-shadow: 0 4px 12px rgba(102, 19, 155, 0.3);"><strong>{{$Difference}}% Off</strong></span>
                                @endif
                                @if($item->offer == 1)
                                <a href="{{url('/')}}/product/{{$item->slung}}">
                                    <img loading="lazy" style="width: 100%; height: 250px; object-fit: cover;" src="{{url('/')}}/uploads/product/{{$item->offer_banner}}" alt="{{$item->name}}" class="product-image">
                                </a>
                                @else
                                <a href="{{url('/')}}/product/{{$item->slung}}">
                                    <img loading="lazy" style="width: 100%; height: 250px; object-fit: cover;" src="{{url('/')}}/uploads/product/{{$item->thumbnail}}" alt="{{$item->name}}" class="product-image">
                                </a>
                                @endif

                                <div class="product-action-vertical">
                                    <a href="{{url('/')}}/wishlist/add-to-wishlist/{{$item->id}}" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                                    <a href="{{url('/')}}/popup/{{$item->slung}}" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                                </div><!-- End .product-action-vertical -->

                                @if($item->stock == "Out of Stock")
                                <div class="product-action">
                                    <a onclick="alert('Out Of Stock')" href="#" class="btn-product btn-cart" title="Add to cart"><span>Buy Now</span></a>
                                </div><!-- End .product-action -->
                                @else
                                <div class="product-action">
                                    <a targer="new" href="https://wa.me/254794301190/?text=Hello, i am intesereted in {{$item->name}}, Price: {{$item->price}} from your website" class="btn-product btn-cart" title="Add to cart"><span>Buy Now</span></a>
                                </div><!-- End .product-action -->
                                @endif
                            </figure><!-- End .product-media -->

                            <div class="product-body" style="padding: 1.25rem; background: white;">
                                <div class="product-cat" style="margin-bottom: 0.5rem;">
                                    <?php $Category = DB::table('category')->where('id',$item->cat)->get(); ?>
                                    @foreach ($Category as $Cat)
                                    <a href="{{url('/products')}}/{{$Cat->slung}}" style="color: #66139b; font-size: 0.85rem; font-weight: 500; text-decoration: none;"> {{$Cat->cat}} </a>
                                    @endforeach
                                </div>
                                <h3 class="product-title" style="margin-bottom: 0.75rem; line-height: 1.4;">
                                    <a href="{{url('/')}}/product/{{$item->slung}}" style="color: #333; font-size: 1rem; font-weight: 600; text-decoration: none; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">{{$item->name}}</a>
                                </h3>
                                <div class="product-price" style="font-size: 1.25rem; font-weight: 700; color: #66139b; margin-bottom: 1rem;">
                                    KES {{number_format($item->price, 0)}}
                                </div>
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
                                    <div class="product-cat meta" style="margin-top: 0.5rem;">
                                        <a href="{{url('/product')}}/{{$item->slung}}" style="color: #666; font-size: 0.85rem; text-decoration: none;"> {{$item->meta}} </a>
                                    </div>
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->
                        @endforeach
                    </div><!-- End .owl-carousel -->
                </div><!-- .End .tab-pane -->
            </div><!-- End .tab-content -->
        </div><!-- End .container -->
    </div><!-- End .modern-deals-section -->
    @endif



    {{-- <div class="mb-3"></div><!-- End .mb-3 -->
    <?php $ctaBanner = DB::table('product')->where('id','127')->get(); ?>
    @if($ctaBanner->isEmpty())

    @else
    @foreach ($ctaBanner as $item)
    <div class="container">
        <div class="cta cta-border mb-5" style="background-image: url('{{asset('theme/assets/images/demos/demo-4/bg-1.jpg')}}');">
            <img width="258" src="{{url('/')}}/uploads/product/5-Inch-Foldable-Car-LCD-Dashboard-mon-001-removebg-preview.png" alt="camera" class="cta-img">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="cta-content">
                        <div class="cta-text text-right text-white">
                            <p>{{$item->meta}} <br><strong>{{$item->name}}</strong></p>
                        </div><!-- End .cta-text -->
                        <a href="{{url('/')}}/product/{{$item->slung}}" class="btn btn-primary btn-round"><span>Shop Now - KES{{$item->price}}</span><i class="icon-long-arrow-right"></i></a>
                    </div><!-- End .cta-content -->
                </div><!-- End .col-md-12 -->
            </div><!-- End .row -->
        </div><!-- End .cta -->
    </div>
    @endforeach
    @endif --}}

    <?php $Category = DB::table('category')->limit('15')->get(); $counter = 1; ?>
    @foreach ($Category as $category)
        <?php 
            // Check if category has featured products to display
            $Featured = DB::table('product')->where('stock','In Stock')->where('cat',$category->id)->where('featured','1')->limit('4')->get();
            $CountFeatured = count($Featured);
        ?>
        @if($CountFeatured > 0)
        <div class="container py-5 category-section-container" style="background: #f8f9fa; border-radius: 24px; margin: 2rem auto; padding: 2.5rem !important;">
            <div class="section-header-modern d-flex justify-content-between align-items-center mb-4 flex-wrap">
                <div class="section-header-content">
                    <h2 class="section-title-modern" style="font-size: 1.75rem; font-weight: 700; color: #333; margin-bottom: 0.25rem;">{{$category->cat}}</h2>
                    <p class="section-subtitle-modern" style="color: #666; font-size: 0.9rem; margin: 0;">Premium quality products</p>
                </div>
                <!-- View All Button -->
                <a href="{{url('/')}}/products/{{$category->slung}}" class="btn-modern-view-all" style="padding: 0.75rem 1.5rem; background-color: rgb(102, 19, 155); color: white; border-radius: 10px; text-decoration: none; font-weight: 600; transition: all 0.3s ease; display: inline-block; white-space: nowrap;">
                    View All <i class="icon-long-arrow-right"></i>
                </a>
            </div>

        <div class="tab-content tab-content-carousel">
                <div class="products">
                <div class="row">
                    @foreach ($Featured as $item)
                    <div class="col-6 col-md-4 col-lg-4 col-xl-3">
                        <div class="product" style="background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.08); transition: all 0.3s ease; height: 100%;">
                            <figure class="product-media" style="position: relative; overflow: hidden;">
                                @if($item->stock == "Out of Stock")
                                <span class="product-label label-out" style="position: absolute; top: 10px; left: 10px; z-index: 2; background: #f5576c; color: white; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.75rem; font-weight: 600;">Out of Stock</span>
                                @endif
                                @if($item->offer == 1)
                                    <?php
                                        $OldPrice = $item->price_raw;
                                        if($OldPrice == null || $OldPrice == 0){
                                            $OldPrice = $item->price;
                                        }
                                        $NewPrice = $item->price;
                                        $Change = ($NewPrice*100)/$OldPrice;
                                        $Change = ceil($Change);

                                        $Difference = 100-$Change;
                                    ?>
                                    <span class="product-label label-out" style="position: absolute; top: 10px; right: 10px; z-index: 2; background: #66139b; color: white; padding: 0.5rem 0.75rem; border-radius: 20px; font-size: 0.85rem; font-weight: 700; box-shadow: 0 4px 12px rgba(102, 19, 155, 0.3);"><strong>{{$Difference}}% Off</strong></span>
                                @endif
                                @if($item->offer == 1)
                                <a href="{{url('/')}}/product/{{$item->slung}}">
                                    <img loading="lazy" style="width: 100%; height: 220px; object-fit: cover;" src="{{url('/')}}/uploads/product/{{$item->offer_banner}}" alt="{{$item->name}}" class="product-image">
                                </a>
                                @else
                                <a href="{{url('/')}}/product/{{$item->slung}}">
                                    <img loading="lazy" style="width: 100%; height: 220px; object-fit: cover;" src="{{url('/')}}/uploads/product/{{$item->thumbnail}}" alt="{{$item->name}}" class="product-image">
                                </a>
                                @endif

                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                                    <a href="{{url('/')}}/popup/{{$item->slung}}" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                                </div><!-- End .product-action-vertical -->

                                @if($item->stock == "Out of Stock")
                                <div class="product-action">
                                    <a onclick="alert('Out Of Stock')" href="#" class="btn-product btn-cart" title="Add to cart"><span>Buy Now</span></a>
                                </div><!-- End .product-action -->
                                @else
                                <div class="product-action">
                                    <a targer="new" href="https://wa.me/254794301190/?text=Hello, i am intesereted in {{$item->name}}, Price: {{$item->price}} from your website" class="btn-product btn-cart" title="Add to cart"><span>Buy Now</span></a>
                                </div><!-- End .product-action -->
                                @endif
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
                                <div class="product-cat meta">
                                    <a href="{{url('/product')}}/{{$item->slung}}"> {{$item->meta}} </a>
                                </div>
                                <!-- End .product-cat -->
                                {{--  --}}
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->
                    </div>
                    @endforeach

                    {{--  --}}
                </div><!-- End .row -->
            </div><!-- End .products -->
        </div><!-- End .tab-content -->
    </div><!-- End .container -->

    <?php $OfferBanners = DB::table('offers')->where('category_id',$category->id)->get(); ?>

    @if(!$OfferBanners->isEmpty())
    <div class="container">
        <div class="row justify-content-center">
            @foreach ($OfferBanners as $offer)
            @if($offer->format == '1')
            <div class="col-12">
                <div class="banner banner-rad mt-5">
                    <div class="bg-image d-flex justify-content-center pt-4 pb-4 mb-4 car-audio" style=" background-image: url('{{url('/')}}/uploads/CategoryBanners/{{$offer->banner}}'); background-size:cover">
                        <div class="banner-content position-relative pt-0">
                            <h4 class="banner-subtitle letter-spacing-normal font-size-normal text-white text-center pt-0 mb-1">
                                <a href="#"></a>
                            </h4>

                            <h3 class="banner-title text-white text-center font-weight-bold mb-0">
                                <a href="#">
                                    <br> </a>
                            </h3>

                        </div>

                    </div>
                </div>
            </div>
            @else

            <div class="col-sm-6 col-md-<?php if($offer->format == '1'){ echo "12"; }elseif($offer->format == '2'){ echo "6"; }else { echo "4"; } ?>">
                <div class="banner banner-overlay banner-sm banner-ad content-right align-center">
                    <a href="#">
                        <img src="{{url('/')}}/uploads/CategoryBanners/{{$offer->banner}}" alt="Banner">
                    </a>
                    <div class="banner-content">
                        {{-- <h4 class="banner-subtitle" style="color:#ffffff;">{!!html_entity_decode($offer->content)!!}</h4> --}}
                        <h4 class="banner-price"><span style="color:#ffffff;" class="price">{{$offer->title}}</span></h4>
                        <?php $ProductIDD = DB::table('product')->where('id',$offer->product_id)->get(); ?>
                        @foreach ($ProductIDD as $productidd)
                        <a target="new" href="https://wa.me/254794301190/?text=Hello, i am intesereted in {{$productidd->name}}, Price: {{$productidd->price}} from your website" class="banner-link">Buy Now<i class="icon-long-arrow-right"></i></a>
                        @endforeach

                    </div>
                </div>
            </div>


            @endif
            @endforeach

        </div>
    </div>
    @endif

    <style>
    /* ============================================
       MOBILE RESPONSIVE STYLES - COMPREHENSIVE FIX
       ============================================ */
    
    /* Prevent horizontal scrolling */
    body {
        overflow-x: hidden;
        max-width: 100vw;
    }
    
    /* Ensure all containers respect viewport - CRITICAL FIX */
    @media (max-width: 991px) {
        .container {
            max-width: 100% !important;
            width: 100% !important;
            padding-left: 15px !important;
            padding-right: 15px !important;
            margin-left: 0 !important;
            margin-right: 0 !important;
            box-sizing: border-box !important;
        }
        
        /* Fix for popular categories section */
        .popular-categories-section.container {
            max-width: 100% !important;
            width: 100% !important;
            padding-left: 15px !important;
            padding-right: 15px !important;
        }
    }
    
    /* Extra small mobile devices */
    @media (max-width: 576px) {
        .container {
            padding-left: 10px !important;
            padding-right: 10px !important;
        }
        
        .popular-categories-section.container {
            padding-left: 10px !important;
            padding-right: 10px !important;
        }
    }
    
    /* Hide sections on mobile */
    @media (max-width: 768px) {
        .modern-newsletter-section {
            display: none !important;
        }
        
        .modern-blog-section {
            display: none !important;
        }
    }
    
    /* Optimize Popular Categories Section for Mobile */
    @media (max-width: 768px) {
        .popular-categories-section {
            display: block !important;
            padding: 1.5rem 0.75rem !important;
        }
        
        .popular-categories-section .section-header {
            margin-bottom: 1.5rem !important;
            padding: 0 0.5rem;
        }
        
        .popular-categories-section .section-title {
            font-size: 1.5rem !important;
            font-weight: 700 !important;
            color: #333 !important;
            margin-bottom: 0.5rem !important;
            line-height: 1.3 !important;
        }
        
        .popular-categories-section .section-subtitle {
            font-size: 0.9rem !important;
            color: #666 !important;
            padding: 0 0.5rem;
            line-height: 1.5 !important;
        }
        
        .popular-categories-section .row {
            margin-left: -0.5rem !important;
            margin-right: -0.5rem !important;
        }
        
        .popular-categories-section .col-6 {
            padding-left: 0.5rem !important;
            padding-right: 0.5rem !important;
            margin-bottom: 0.75rem !important;
        }
        
        .popular-categories-section .modern-cat-card {
            padding: 1rem 0.5rem !important;
            border-radius: 12px !important;
            min-height: 140px !important;
        }
        
        .popular-categories-section .cat-card-image {
            height: 100px !important;
            margin-bottom: 0.75rem !important;
        }
        
        .popular-categories-section .cat-card-title {
            font-size: 0.75rem !important;
            font-weight: 600 !important;
            line-height: 1.3 !important;
        }
    }
    
    /* Category Product Sections - Mobile Fixes */
    @media (max-width: 768px) {
        /* Override all inline styles for category containers - use attribute selector for higher specificity */
        div.category-section-container[style*="padding"],
        .category-section-container,
        .category-section-container.py-5 {
            padding: 1.25rem !important;
            margin: 1rem 0.75rem !important;
            border-radius: 16px !important;
            max-width: calc(100% - 1.5rem) !important;
            box-sizing: border-box !important;
            width: calc(100% - 1.5rem) !important;
        }
        
        .category-section-container.container,
        div.container.category-section-container {
            padding-left: 0.75rem !important;
            padding-right: 0.75rem !important;
            max-width: calc(100% - 1.5rem) !important;
            margin-left: auto !important;
            margin-right: auto !important;
        }
        
        /* Section header responsive - Mobile Full Width with Background */
        .section-header-modern {
            width: calc(100% + 1.5rem) !important;
            background-color: rgb(102, 19, 155) !important;
            padding: 1rem 1.25rem !important;
            margin-left: -0.75rem !important;
            margin-right: -0.75rem !important;
            margin-bottom: 1.5rem !important;
            border-radius: 0 !important;
            flex-direction: column !important;
            align-items: flex-start !important;
            justify-content: flex-start !important;
            gap: 0 !important;
        }
        
        .section-header-content {
            width: 100% !important;
            padding: 0 !important;
        }
        
        .section-title-modern {
            font-size: 1.25rem !important;
            font-weight: 700 !important;
            margin-bottom: 0 !important;
            line-height: 1.3 !important;
            color: white !important;
            word-wrap: break-word;
        }
        
        .section-subtitle-modern {
            display: none !important;
        }
        
        /* Hide View All Button on Mobile */
        .btn-modern-view-all {
            display: none !important;
        }
        
        /* Product grid responsive */
        .category-section-container .row {
            margin-left: -0.5rem !important;
            margin-right: -0.5rem !important;
            width: calc(100% + 1rem) !important;
            max-width: 100% !important;
        }
        
        .category-section-container .col-6,
        .category-section-container .col-md-4,
        .category-section-container .col-lg-4,
        .category-section-container .col-xl-3 {
            padding-left: 0.5rem !important;
            padding-right: 0.5rem !important;
            margin-bottom: 1rem !important;
            width: 100%;
            max-width: 100%;
        }
        
        /* Product cards */
        .category-section-container .product {
            margin-bottom: 0 !important;
            width: 100% !important;
            max-width: 100% !important;
            box-sizing: border-box;
        }
        
        /* Product images */
        .category-section-container figure.product-media img.product-image,
        .category-section-container .product-media .product-image,
        .category-section-container .product-image {
            height: 180px !important;
            max-height: 180px !important;
            width: 100% !important;
            object-fit: cover !important;
        }
        
        /* Product body */
        .category-section-container .product-body {
            padding: 1rem !important;
        }
        
        .category-section-container .product-title,
        .category-section-container .product-title a {
            font-size: 0.9rem !important;
            line-height: 1.3 !important;
        }
        
        .category-section-container .product-price {
            font-size: 1rem !important;
        }
        
        .category-section-container .product-cat {
            font-size: 0.8rem !important;
        }
        
        .category-section-container .product-cat.meta {
            font-size: 0.75rem !important;
        }
    }
    
    @media (max-width: 576px) {
        /* Section Header - Small Mobile Improvements */
        .section-header-modern {
            gap: 0.5rem;
            margin-bottom: 1.25rem !important;
        }
        
        .section-header-content {
            padding-right: 0.4rem;
        }
        
        .section-title-modern {
            font-size: 1.15rem !important;
            margin-bottom: 0.2rem !important;
        }
        
        /* Section header - Small Mobile - Ensure full width background */
        .section-header-modern {
            width: calc(100% + 1rem) !important;
            padding: 0.875rem 1rem !important;
            margin-left: -0.5rem !important;
            margin-right: -0.5rem !important;
        }
        
        .section-title-modern {
            font-size: 1.15rem !important;
        }
        
        /* Category Product Sections - Small Mobile */
        .category-section-container {
            padding: 1rem !important;
            margin: 0.75rem 0.5rem !important;
            border-radius: 12px !important;
        }
        
        .category-section-container.container {
            padding-left: 0.5rem !important;
            padding-right: 0.5rem !important;
        }
        
        /* Product images smaller on small screens */
        .category-section-container figure.product-media img.product-image,
        .category-section-container .product-media .product-image,
        .category-section-container .product-image {
            height: 160px !important;
            max-height: 160px !important;
        }
        
        .category-section-container .product-body {
            padding: 0.75rem !important;
        }
        
        .category-section-container .product-title,
        .category-section-container .product-title a {
            font-size: 0.85rem !important;
            line-height: 1.2 !important;
        }
        
        .category-section-container .product-price {
            font-size: 0.9rem !important;
        }
        
        .category-section-container .product-cat {
            font-size: 0.75rem !important;
        }
        
        .category-section-container .product-cat.meta {
            font-size: 0.7rem !important;
        }
    }
    
    @media (max-width: 576px) {
        /* Popular Categories Section */
        .popular-categories-section {
            padding: 0.75rem 0 !important;
        }
        
        .popular-categories-section .section-title {
            font-size: 1.25rem !important;
            margin-bottom: 0.375rem !important;
        }
        
        .popular-categories-section .section-subtitle {
            font-size: 0.85rem !important;
            padding: 0 0.75rem;
        }
        
        /* Category Product Sections */
        .category-section-container {
            padding: 1rem !important;
            margin: 0.75rem 0.5rem !important;
            border-radius: 12px !important;
            max-width: 100% !important;
            box-sizing: border-box !important;
        }
        
        .category-section-container.container {
            padding-left: 0.5rem !important;
            padding-right: 0.5rem !important;
        }
        
        .section-title-modern {
            font-size: 1.2rem !important;
        }
        
        .section-subtitle-modern {
            font-size: 0.8rem !important;
        }
        
        .btn-modern-view-all {
            padding: 0.5rem 1rem !important;
            font-size: 0.85rem !important;
        }
        
        /* Override inline styles for product images on small screens */
        .category-section-container figure.product-media img.product-image,
        .category-section-container .product-media .product-image,
        .category-section-container .product-image {
            height: 160px !important;
            max-height: 160px !important;
        }
        
        .category-section-container .product-body {
            padding: 0.75rem !important;
        }
        
        .category-section-container .product-title,
        .category-section-container .product-title a {
            font-size: 0.85rem !important;
            line-height: 1.2 !important;
        }
        
        .category-section-container .product-price {
            font-size: 0.9rem !important;
        }
        
        .category-section-container .product-cat {
            font-size: 0.75rem !important;
        }
        
        .category-section-container .product-cat.meta {
            font-size: 0.7rem !important;
        }
    }
    
    @media (max-width: 480px) {
        .category-section-container {
            padding: 0.75rem !important;
            margin: 0.5rem 0.25rem !important;
        }
        
        .category-section-container.container {
            padding-left: 0.25rem !important;
            padding-right: 0.25rem !important;
        }
        
        .section-title-modern {
            font-size: 1.1rem !important;
        }
        
        .popular-categories-section .section-title {
            font-size: 1.1rem !important;
        }
        
        /* Override inline styles for product images on extra small screens */
        .category-section-container figure.product-media img.product-image,
        .category-section-container .product-media .product-image,
        .category-section-container .product-image {
            height: 140px !important;
            max-height: 140px !important;
        }
        
        .category-section-container .product-body {
            padding: 0.5rem !important;
        }
        
        .category-section-container .product-title,
        .category-section-container .product-title a {
            font-size: 0.8rem !important;
        }
        
        .category-section-container .product-price {
            font-size: 0.85rem !important;
        }
    }
    </style>
        @endif
    @endforeach
    <div class="mb-1"></div><!-- End .mb-1 -->




    <!-- Modern Brands Section -->
    <?php $Brand = DB::table('brands')->get() ?>
    @if(!$Brand->isEmpty())
    <div class="container py-5">
        <div class="section-header text-center mb-4">
            <h2 class="section-title" style="font-size: 2rem; font-weight: 700; color: #333; margin-bottom: 0.5rem;">Shop by Brands</h2>
            <p class="section-subtitle" style="color: #666; font-size: 1rem;">Trusted brands for quality car audio</p>
        </div>
        <div class="modern-brands-carousel owl-carousel mb-5 owl-simple" data-toggle="owl"
            data-owl-options='{
                "nav": false,
                "dots": true,
                "margin": 30,
                "loop": false,
                "responsive": {
                    "0": {
                        "items":2
                    },
                    "420": {
                        "items":3
                    },
                    "600": {
                        "items":4
                    },
                    "900": {
                        "items":5
                    },
                    "1024": {
                        "items":6
                    },
                    "1280": {
                        "items":6,
                        "nav": true,
                        "dots": false
                    }
                }
            }'>
            @foreach($Brand as $brand)
            <a href="{{url('/')}}/products/brand/{{$brand->name}}" class="modern-brand-card">
                <div class="brand-image-wrapper">
                    <img loading="lazy" src="{{url('/')}}/uploads/brands/{{$brand->image}}" alt="{{$brand->name}}" class="brand-image">
                </div>
            </a>
            @endforeach
        </div><!-- End .owl-carousel -->
    </div><!-- End .container -->
    @endif

    <style>
    .modern-newsletter-form {
        display: flex;
        max-width: 600px;
        margin: 0 auto;
    }
    .input-group-modern {
        display: flex;
        width: 100%;
        box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        border-radius: 50px;
        overflow: hidden;
    }
    .btn-modern-subscribe:hover {
        background: #f8f9fa !important;
        transform: scale(1.02);
    }
    .modern-brand-card {
        display: block;
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        text-align: center;
        height: 100%;
    }
    .modern-brand-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(102, 126, 234, 0.2);
    }
    .brand-image-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 80px;
        width: 100%;
        position: relative;
        text-align: center;
    }
    .brand-image-wrapper img,
    .brand-image {
        max-width: 100%;
        max-height: 100%;
        width: auto;
        height: auto;
        object-fit: contain;
        object-position: center center;
        margin: 0 auto;
        display: block;
        opacity: 1;
        transition: all 0.3s ease;
    }
    .modern-brand-card:hover .brand-image {
        opacity: 1;
        transform: scale(1.1);
    }
    @media (max-width: 768px) {
        .modern-newsletter-section {
            padding: 2.5rem 0 !important;
        }
        .newsletter-title {
            font-size: 1.5rem !important;
        }
        .input-group-modern {
            flex-direction: column;
            border-radius: 16px;
        }
        .form-control-modern {
            border-radius: 16px 16px 0 0 !important;
        }
        .btn-modern-subscribe {
            border-radius: 0 0 16px 16px !important;
        }
    }
    </style>

  
    <style>
    .modern-blog-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(102, 126, 234, 0.15);
    }
    .modern-blog-card:hover .entry-media img {
        transform: scale(1.1);
    }
    .modern-blog-card:hover .read-more {
        transform: translateX(5px);
    }
    </style>
</main><!-- End .main -->

<!-- Performance Optimization Styles -->
<style>
/* Global Performance Optimizations */
* {
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

/* Lazy Loading Placeholder */
img[loading="lazy"] {
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: loading 1.5s infinite;
    opacity: 0.7;
    transition: opacity 0.3s ease;
}

img[loading="lazy"].loaded {
    background: none;
    animation: none;
    opacity: 1;
}

@keyframes loading {
    0% { background-position: 200% 0; }
    100% { background-position: -200% 0; }
}

/* Smooth Scrolling */
html {
    scroll-behavior: smooth;
}

/* Optimize Product Cards */
.product {
    will-change: transform;
    backface-visibility: hidden;
}

/* Reduce Layout Shifts */
.cat-card-image,
.banner-image-wrapper,
.brand-image-wrapper {
    aspect-ratio: 1;
}

/* Mobile Optimizations */
@media (max-width: 768px) {
    .modern-cat-card,
    .modern-banner-card,
    .modern-brand-card,
    .modern-blog-card {
        will-change: auto;
    }
    
    /* Reduce animations on mobile for better performance */
    * {
        animation-duration: 0.3s !important;
        transition-duration: 0.3s !important;
    }
}

/* Container Max Width Optimization */
.container {
    max-width: 1200px;
}

/* Override container width on mobile to prevent horizontal scroll */
@media (max-width: 991px) {
    .container {
        max-width: 100% !important;
        width: 100% !important;
    }
}

/* Image Optimization */
img {
    image-rendering: -webkit-optimize-contrast;
    image-rendering: crisp-edges;
}

/* Prevent FOUC */
.modern-cat-card,
.modern-banner-card,
.modern-brand-card,
.modern-blog-card,
.product {
    opacity: 1;
    animation: fadeIn 0.3s ease-in;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle lazy-loaded images
    const lazyImages = document.querySelectorAll('img[loading="lazy"]');
    
    // Function to remove loading animation
    function removeLoadingAnimation(img) {
        if (img.complete && img.naturalHeight !== 0) {
            // Image is already loaded
            img.classList.add('loaded');
        } else {
            // Wait for image to load
            img.addEventListener('load', function() {
                this.classList.add('loaded');
            }, { once: true });
            
            // Handle error case
            img.addEventListener('error', function() {
                this.classList.add('loaded'); // Remove animation even on error
            }, { once: true });
        }
    }
    
    // Process all lazy images
    lazyImages.forEach(function(img) {
        removeLoadingAnimation(img);
    });
    
    // Use Intersection Observer for better performance with lazy loading
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver(function(entries, observer) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    removeLoadingAnimation(img);
                    observer.unobserve(img);
                }
            });
        });
        
        lazyImages.forEach(function(img) {
            imageObserver.observe(img);
        });
    }
    
    // Fallback: Check all images after a short delay
    setTimeout(function() {
        lazyImages.forEach(function(img) {
            if (img.complete && img.naturalHeight !== 0) {
                img.classList.add('loaded');
            }
        });
    }, 100);
});
</script>
@endsection
