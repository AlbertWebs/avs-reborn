@extends('front.master-brands')
@section('content')
<main class="main">


    <div class="mb-4"></div><!-- End .mb-2 -->

    <div class="container">
        <h2 class="title text-center mb-2">Explore Popular Brands</h2><!-- End .title -->

        <div class="cat-blocks-container">
            <div class="row">
                <?php $Brands = DB::table('brands')->get(); ?>
                @foreach($Brands as $Cat)
                <div class="col-6 col-sm-4 col-lg-2">
                    <a href="{{url('/')}}/products/brand/{{$Cat->slung}}" class="cat-block">
                        <figure>
                            <span>
                                <img style="max-width:131px;" src="{{url('/')}}/uploads/brands/{{$Cat->image}}" alt="{{$Cat->name}}">
                            </span>
                        </figure>

                        <h3 class="cat-block-title">{{$Cat->name}}</h3><!-- End .cat-block-title -->
                    </a>
                </div><!-- End .col-sm-4 col-lg-2 -->
                @endforeach
            </div><!-- End .row -->
        </div><!-- End .cat-blocks-container -->
    </div><!-- End .container -->

    <div class="mb-2"></div><!-- End .mb-2 -->
    <h1 style="font-size:2px; margin:0 auto; color:#fff">Car Audio Shop in Nairobi</h1>
    <?php $Full = DB::table('product')->where('stock','In Stock')->where('offer','1')->limit('10')->inRandomOrder()->get();  ?>
    @if($Full->isEmpty())

    @else
    <div class="container">
        <div class="row">
            @foreach($Full as $full)
            <div class="col-sm-6 col-lg-4 ">
                <div class="banner banner-overlay">
                    <a href="{{url('/')}}/product/{{$full->slung}}">
                        <img src="{{url('/')}}/uploads/product/{{$full->offer_banner}}" alt="{{$full->name}}">
                    </a>

                    <div class="banner-content">
                        {{-- <h4 class="banner-subtitle text-white"><a href="#">Weekend Sale</a></h4> --}}
                        {{-- <h3 class="banner-title text-white"><a href="#">Lighting <br>& Accessories <br><span>25% off</span></a></h3> --}}
                        {{-- <a href="#" class="banner-link">Shop Now <i class="icon-long-arrow-right"></i></a> --}}
                    </div><!-- End .banner-content -->
                </div><!-- End .banner -->
            </div><!-- End .col-lg-3 -->
            @endforeach

        </div><!-- End .row -->
    </div><!-- End .container -->
    @endif

    <div class="mb-3"></div><!-- End .mb-3 -->

</main><!-- End .main -->
@endsection
