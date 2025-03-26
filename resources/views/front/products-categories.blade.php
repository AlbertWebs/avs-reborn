@extends('front.master-category')
@section('content')
<main class="main">
    <div class="page-header text-center" style="background-image: url('{{asset('theme/assets/images/page-header-bg.jpg')}}')">
        <div class="container">
            <h1 class="page-title">{{$page_name}}<span>Amani Vehicle Sounds</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item"><a href="{{url('/')}}/products/shop-by-category">Categories</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$page_name}}</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            {{-- @include('front.tool') --}}

            <div class="products">
                <div class="row">
                    @foreach($Products as $item)
                    <div class="col-6 col-md-4 col-lg-4 col-xl-3">
                        <div class="product">
                            <figure class="product-media">
                                @if($item->stock == "Out of Stock")
                                <span class="product-label label-out">Out of Stock</span>
                                @endif
                                @if($item->offer == 1)
                                    <?php
                                        $OldPrice = $item->price_raw;
                                        if($OldPrice == null || $OldPrice == "0"){
                                            $OldPrice = $item->price;
                                        }
                                        $NewPrice = $item->price;
                                        $Change = ($NewPrice*100)/$OldPrice;
                                        $Change = ceil($Change);

                                        $Difference = 100-$Change;
                                    ?>
                                    <span class="product-label label-out"><strong>{{$Difference}}% Off</strong></span>
                                @endif
                                {{-- <span class="product-label label-new">New</span> --}}
                                @if($item->offer == 1)
                                <a href="{{url('/')}}/product/{{$item->slung}}">
                                    <img style="max-width:217px !important;" src="{{url('/')}}/uploads/product/{{$item->offer_banner}}" alt="{{$item->name}}" class="product-image">
                                </a>
                                @else
                                <a href="{{url('/')}}/product/{{$item->slung}}">
                                    <img style="max-width:217px !important;" src="{{url('/')}}/uploads/product/{{$item->thumbnail}}" alt="{{$item->name}}" class="product-image">
                                </a>

                                @endif

                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                                    <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
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

                                {{-- <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 90%;"></div><!-- End .ratings-val -->
                                    </div>
                                    <span class="ratings-text">( 12 Reviews )</span>
                                </div> --}}
                                <!-- End .rating-container -->
                                {{--  --}}
                                {{-- <div class="product-cat">
                                    <a href="{{url('/product')}}/{{$item->slung}}"> {{$item->meta}} </a>
                                </div> --}}
                                <!-- End .product-cat -->
                                {{--  --}}
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->
                    </div><!-- End .col-sm-6 col-lg-4 col-xl-3 -->
                    @endforeach
                </div><!-- End .row -->


                <!-- End .load-more-container -->
            </div><!-- End .products -->

            <div class="sidebar-filter-overlay"></div><!-- End .sidebar-filter-overlay -->
            @include('front.filter')
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
@endsection
