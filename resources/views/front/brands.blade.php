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









    <div class="cta cta-horizontal cta-horizontal-box bg-primary">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-2xl-5col">
                    <h3 class="cta-title text-white">Join Our Newsletter</h3><!-- End .cta-title -->
                    <p class="cta-desc text-white">Subcribe to get information about products and coupons</p><!-- End .cta-desc -->
                </div><!-- End .col-lg-5 -->

                <div class="col-3xl-5col">
                    <form action="#">
                        <div class="input-group">
                            <input type="email" class="form-control form-control-white" placeholder="Enter your Email Address" aria-label="Email Adress" required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-white-2" type="submit"><span>Subscribe</span><i class="icon-long-arrow-right"></i></button>
                            </div><!-- .End .input-group-append -->
                        </div><!-- .End .input-group -->
                    </form>
                </div><!-- End .col-lg-7 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .cta -->

    <div class="blog-posts bg-light pt-4 pb-7">
        <div class="container">
            <h2 class="title">From Our Blog</h2><!-- End .title-lg text-center -->

            <div class="owl-carousel owl-simple" data-toggle="owl"
                data-owl-options='{
                    "nav": false,
                    "dots": true,
                    "items": 3,
                    "margin": 20,
                    "loop": false,
                    "responsive": {
                        "0": {
                            "items":1
                        },
                        "600": {
                            "items":2
                        },
                        "992": {
                            "items":3
                        },
                        "1280": {
                            "items":3,
                            "nav": true,
                            "dots": false
                        }
                    }
                }'>
                <?php $Blogs = DB::table('blogs')->orderBy('id','DESC')->limit('5')->get(); ?>
                @foreach ($Blogs as $item)
                <article class="entry">
                    <figure class="entry-media">
                        <a href="{{$item->link}}">
                            <img src="{{url('/')}}/uploads/blog/{{$item->image_one}}" alt="{{$item->title}}">
                        </a>
                    </figure><!-- End .entry-media -->

                    <div class="entry-body">
                        <div class="entry-meta">
                            <a href="#">
                                <?php
                                    $RawDate = $item->created_at;
                                    $FormatDate = strtotime($RawDate);
                                    $Month = date('M',$FormatDate);
                                    $Date = date('D',$FormatDate);
                                    $date = date('d',$FormatDate);
                                    $Year = date('Y',$FormatDate);
                                ?>
                                {{$Month}} {{$date}}, {{$Year}}
                            </a> &nbsp; | &nbsp;
                            <?php echo count($Comments = DB::table('comments')->where('blog_id',$item->id)->get()); ?> Comments
                        </div><!-- End .entry-meta -->

                        <h3 class="entry-title">
                            <a  target="new" href="{{$item->link}}">{{$item->title}}</a>
                        </h3><!-- End .entry-title -->

                        <div class="entry-content">
                            {{-- <p>{{$item->meta}}...</p> --}}
                            <a target="new" href="{{$item->link}}" class="read-more">Read More</a>
                        </div><!-- End .entry-content -->
                    </div><!-- End .entry-body -->
                </article><!-- End .entry -->
                @endforeach
            </div><!-- End .owl-carousel -->
        </div><!-- End .container -->
    </div><!-- End .blog-posts -->
</main><!-- End .main -->
@endsection
