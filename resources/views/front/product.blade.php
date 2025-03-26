@extends('front.master-single')
@section('content')
@foreach($Products as $Product)
<?php $SiteSettings = DB::table('sitesettings')->get();?>
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
                        <div class="product-gallery product-gallery-vertical">
                            <div class="row">
                                <figure class="product-main-image">
                                    <img id="product-zoom" src="{{url('/')}}/uploads/product/{{$Product->image_one}}" data-zoom-image="{{url('/')}}/uploads/product/{{$Product->image_one}}" alt="{{$Product->name}}">

                                    <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                        <i class="icon-arrows"></i>
                                    </a>
                                </figure><!-- End .product-main-image -->

                                <div id="product-zoom-gallery" class="product-image-gallery">
                                    <a class="product-gallery-item active" href="#" data-image="{{url('/')}}/uploads/product/{{$Product->image_one}}" data-zoom-image="{{url('/')}}/uploads/product/{{$Product->image_one}}">
                                        <img src="{{url('/')}}/uploads/product/{{$Product->image_one}}" alt="{{$Product->name}}">
                                    </a>

                                    <a class="product-gallery-item" href="#" data-image="{{url('/')}}/uploads/product/{{$Product->fb_pixels}}" data-zoom-image="{{url('/')}}/uploads/product/{{$Product->fb_pixels}}">
                                        <img src="{{url('/')}}/uploads/product/{{$Product->fb_pixels}}" alt="{{$Product->name}}">
                                    </a>

                                    @if($Product->image_three == '0' or $Product->image_three == null)

                                    @else
                                    <a class="product-gallery-item" href="#" data-image="{{url('/')}}/uploads/product/{{$Product->image_three}}" data-zoom-image="{{url('/')}}/uploads/product/{{$Product->image_three}}">
                                        <img src="{{url('/')}}/uploads/product/{{$Product->image_three}}" alt="{{$Product->name}}">
                                    </a>
                                    @endif

                                    @if($Product->image_two == '0' or $Product->image_two == null)

                                    @else
                                    <a class="product-gallery-item" href="#" data-image="{{url('/')}}/uploads/product/{{$Product->image_two}}" data-zoom-image="{{url('/')}}/uploads/product/{{$Product->image_two}}">
                                        <img src="{{url('/')}}/uploads/product/{{$Product->image_two}}" alt="{{$Product->name}}">
                                    </a>
                                    @endif
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
                                <a href="{{url('/')}}/shopping-cart/add-to-cart/{{$Product->id}}" class="btn-product btn-cart"><span>add to cart</span></a>

                                <a href="{{url('/')}}/wishlist/add-to-wishlist/{{$Product->id}}" class="btn-product btn-cart" title="Wishlist"><span>Add to Wishlist</span></a>
                                <a href="{{url('/')}}/compare/add-to-compare/{{$Product->id}}" class="btn-product btn-cart" title="Compare"><span>Add to Compare</span></a>

                                <div class="details-action-wrapper" style="visibility: hidden;">
                                    <a href="#" class="btn-product btn-cart" title="Wishlist"><span>Add to Wishlist</span></a>
                                    <a href="#" class="btn-product btn-cart" title="Compare"><span>Add to Compare</span></a>
                                </div><!-- End .details-action-wrapper -->
                                
                                <?php
                                            //prepare data to send
                                            $dataObj = new stdClass();
                                            $dataObj->ek_access_token = base64_encode("AVS.F7ETM1BK1619708873ZB19PSN");
                                            $dataObj->ek_access_type = "api_access";
                                            $dataObj->ek_redirect_url = "https://amanivehiclesounds.co.ke/api/escrow-callback";
                                            $dataObj->ek_item_unique_identifier = $Product->id;
                                            $dataObj->ek_item_title = $Product->name;
                                            $dataObj->ek_seller_email = $Settings->email;
                                            $dataObj->ek_seller_phone = $Settings->mobile;
                                            $dataObj->ek_item_cost = $Product->price;
                                            $dataObj->ek_item_currency = "KES";
                                        
                                            $encodedData = urlencode(json_encode($dataObj));
                                            
                                        ?>

                                        <form style="margin-top:10px;" class="cart-quantity"  action="https://escrowkenya.com/api/v1/orders/start_view" method="POST">
                                            <input type="hidden" name="payload" value="<?php echo $encodedData; ?>">
                                            <button class="btn-product btn-cart" type="submit" class="escrow">Buy with Escrow</button>
                                        </form>
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
@endforeach
@endforeach
@endsection