@extends('front.master-pages')
@section('content')
@foreach ($SiteSettings as $Settings)
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active" aria-current="page">About us</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->
    <div class="container">
        <div class="page-header page-header-big text-center" style="background-image: url('{{asset('uploads/slider/AVS-BANNER-2.png')}}')">
            <h1 class="page-title text-white"> <span class="text-white">Who we are</span></h1>
        </div><!-- End .page-header -->
    </div><!-- End .container -->

    <div class="page-content pb-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-3 mb-lg-0 text-center" style="margin: 0 auto;">
                    <h2 class="title">About Us</h2><!-- End .title -->
                    <p>
                        @foreach($About as $about)
              
                
                            {!!html_entity_decode($about->content)!!}

                        
                        @endforeach    
                    </p>
                </div><!-- End .col-lg-6 -->
               
            </div><!-- End .row -->

            <div class="mb-5"></div><!-- End .mb-4 -->
        </div><!-- End .container -->
        {{--  --}}

        <div class="bg-light-2 pt-6 pb-5 mb-6 mb-lg-8">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 mb-3 mb-lg-0">
                        <h2 class="title">Who We Are</h2><!-- End .title -->
                        <p class="lead text-primary mb-3">Amani Vehicle Sounds aims to improve your Car audio system by Installing quality car radios, car subwoofers, Car Amplifiers, car midrange Speakers, Alarms & Trackers.</p><!-- End .lead text-primary -->
                        <p class="mb-2 lead" style="color:#000000">
                                 {{--  --}}
                                 We offer onsite(Home/office) Installation services and delivery across East Africa. See less
                                 With Our Car Tracking Systems,you get and enjoy the following;<br>
                                 Stop/Start the car through SMS<br>
                                 Android app/SMS/computer tracking<br>
                                 Receive anti-theft SMS alert.<br>
                                 Get real time location of your Vehicle.eg Uhuru Highway,Nairobi Kenya,speed 65kph.<br>
                                 Set maximum speed for the vehicle through SMS.<br>
                                 Get over speed alert through SMS.<br>
                                 Geo-Fencing.<br>
                                 voice surveillance system(listen to conversation in your vehicle on your phone)<br>
                                 {{--  --}}
                        </p>

                        <a href="{{url('/')}}/blog-posts" class="btn btn-sm btn-minwidth btn-outline-primary-2">
                            <span>VIEW OUR NEWS</span>
                            <i class="icon-long-arrow-right"></i>
                        </a>
                    </div><!-- End .col-lg-5 -->

                    <div class="col-lg-6 offset-lg-1">
                        <div class="about-images">
                            <?php $Services = DB::table('services')->where('id','1')->get(); ?>
                            @foreach($Services as $Ser)
                            <img src="{{url('/')}}/uploads/services/{{$Ser->image_one}}" alt="{{$Ser->title}}" class="about-img-front">
                            @endforeach
                            <?php $Services = DB::table('services')->where('id','1')->get(); ?>
                            @foreach($Services as $Ser)
                            {{-- <img src="{{url('/')}}/uploads/services/{{$Ser->image_one}}" alt="{{$Ser->title}}" class="about-img-back"> --}}
                            @endforeach
                        </div><!-- End .about-images -->
                    </div><!-- End .col-lg-6 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .bg-light-2 pt-6 pb-6 -->

        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="brands-text">
                        <h2 class="title">The world's premium car audio systems brands in one place.</h2><!-- End .title -->
                        <?php $Category = DB::table('category')->limit('8')->get(); ?>
                        @foreach ($Category as $item)
                        <h4>#{{$item->cat}}</h4>
                        @endforeach
                        <p></p>
                    </div><!-- End .brands-text -->
                </div><!-- End .col-lg-5 -->
                <div class="col-lg-7">
                    <div class="brands-display">
                        <div class="row justify-content-center">
                            <?php $Brand = DB::table('brands')->get() ?>
                            @foreach($Brand as $brand)
                            <div class="col-6 col-sm-4">
                                <a href="{{url('/')}}/products/brand/{{$brand->name}}" class="brand">
                                    <img src="{{url('/')}}/uploads/brands/{{$brand->image}}" alt="{{$brand->name}}">
                                </a>
                            </div><!-- End .col-sm-4 -->
                            @endforeach
                        </div><!-- End .row -->
                    </div><!-- End .brands-display -->
                </div><!-- End .col-lg-7 -->
            </div><!-- End .row -->

            <hr class="mt-4 mb-6">

        </div><!-- End .container -->

        <div class="mb-2"></div><!-- End .mb-2 -->

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
    </div><!-- End .page-content -->
</main><!-- End .main -->
@endforeach

@endsection