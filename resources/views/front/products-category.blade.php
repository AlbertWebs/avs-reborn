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
            @include('front.tool')

            @if(!empty($isAndroidByModel) && isset($SubCategories) && count($SubCategories) > 0)
            <div class="car-model-filter-panel">
                <h4>Shop by Car Model</h4>
                <div class="car-model-filter-list">
                    <a href="{{ url('/products/' . ($Category[0]->slung ?? '')) }}" class="car-model-filter-item {{ empty($selectedSubCategory) ? 'active' : '' }}">
                        All Models
                    </a>
                    @foreach($SubCategories as $subCategory)
                        <a href="{{ url('/products/' . ($Category[0]->slung ?? '') . '/model/' . ($subCategory->slung ?? $subCategory->id)) }}"
                           class="car-model-filter-item {{ !empty($selectedSubCategory) && (int)$selectedSubCategory->id === (int)$subCategory->id ? 'active' : '' }}">
                            {{$subCategory->name}}
                        </a>
                    @endforeach
                </div>
            </div>
            @endif

            <div class="products">
                <div class="row">
                    @foreach($Products as $item)
                    <div class="col-6 col-md-4 col-lg-4 col-xl-3" style="margin-bottom: 1.5rem;">
                        <div class="product" style="background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.08); transition: all 0.3s ease; height: 100%;">
                            <figure class="product-media" style="position: relative; overflow: hidden;">
                                @if($item->stock == "Out of Stock")
                                <span class="product-label label-out" style="position: absolute; top: 10px; left: 10px; z-index: 2; background: #f5576c; color: white; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.75rem; font-weight: 600;">Out of Stock</span>
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
                                    <span class="product-label label-out" style="position: absolute; top: 10px; right: 10px; z-index: 2; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; padding: 0.5rem 0.75rem; border-radius: 20px; font-size: 0.85rem; font-weight: 700; box-shadow: 0 4px 12px rgba(245, 87, 108, 0.3);"><strong>{{$Difference}}% Off</strong></span>
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
                                @if(!empty($item->sub_cat))
                                    @php
                                        $productSubCategory = DB::table('sub_category')->where('id', $item->sub_cat)->first();
                                    @endphp
                                    @if($productSubCategory)
                                    <div class="product-cat" style="margin-top: 0.25rem;">
                                        <a href="{{ url('/products/' . ($Category[0]->slung ?? '') . '/model/' . ($productSubCategory->slung ?? $productSubCategory->id)) }}">
                                            {{$productSubCategory->name}}
                                        </a>
                                    </div>
                                    @endif
                                @endif
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
                                
                                <div class="product-cat meta">
                                    <a href="{{url('/product')}}/{{$item->slung}}"> {{$item->meta}} </a>
                                </div>
                                <!-- End .product-cat -->
                                
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->
                    </div><!-- End .col-sm-6 col-lg-4 col-xl-3 -->
                    @endforeach
                </div><!-- End .row -->

                <nav aria-label="Page navigation">
                    <?php echo $Products ?>
                </nav>
                <!-- End .load-more-container -->
            </div><!-- End .products -->

            <div class="sidebar-filter-overlay"></div><!-- End .sidebar-filter-overlay -->
            @include('front.filter')
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->

<style>
/* Product Cards Spacing on Category Page */
.products .row {
    margin-left: -0.75rem;
    margin-right: -0.75rem;
}

.products .row > [class*="col-"] {
    padding-left: 0.75rem;
    padding-right: 0.75rem;
}

.car-model-filter-panel {
    background: #fff;
    border: 1px solid #ececec;
    border-radius: 12px;
    padding: 1rem;
    margin-bottom: 1.25rem;
}

.car-model-filter-panel h4 {
    margin-bottom: 0.75rem;
    font-size: 1.4rem;
}

.car-model-filter-list {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.car-model-filter-item {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.45rem 0.9rem;
    border-radius: 999px;
    border: 1px solid #d9d9d9;
    color: #333;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s ease;
}

.car-model-filter-item:hover {
    border-color: #cc9966;
    color: #cc9966;
}

.car-model-filter-item.active {
    background: #cc9966;
    border-color: #cc9966;
    color: #fff;
}

@media (max-width: 768px) {
    .products .row > [class*="col-"] {
        margin-bottom: 1rem;
    }
}

@media (max-width: 576px) {
    .products .row {
        margin-left: -0.5rem;
        margin-right: -0.5rem;
    }
    
    .products .row > [class*="col-"] {
        padding-left: 0.5rem;
        padding-right: 0.5rem;
        margin-bottom: 1rem;
    }
}
</style>
@endsection
