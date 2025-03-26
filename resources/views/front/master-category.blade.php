<!DOCTYPE html>
<html lang="en">
<head>
    <?php $SiteSettings = DB::table('sitesettings')->get() ?>
    @foreach ($SiteSettings as $Settings)
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    {{-- SEO --}}
    @foreach($Category as $category)
    <meta name="author" content="Designekta Studios">
    <meta name="robots" content="index,follow">
    <meta name="googlebot" content="index,follow">
    <meta name="subject" content="{{$category->cat}} in Kenya - Best Car Audio Systems | Amani Vehicle Sounds">
    <meta name="rating" content="General">
    <meta name="referrer" content="strict-origin-when-cross-origin">
    <meta name="theme-color" content="#66139B">

    <title>{{$category->cat}} in Kenya - Best Car Audio Systems | Amani Vehicle Sounds</title>
    <meta name="description" content="Shop high-quality {{$category->cat}} in Kenya from top brands like Kenwood, Pioneer, Sony, and Android Radios. Enjoy premium sound with Bluetooth, touchscreen, and more.">
    <link rel="canonical" href="https://amanivehiclesounds.co.ke/products/{{$category->slung}}">
    <meta name="keywords" content="{{$category->keywords}} Car Radios Kenya, Best Car Audio, Bluetooth Car Stereo ">

    <!-- Open Graph Meta Tags (For Social Media) -->
    <meta property="og:title" content="{{$category->cat}} in Kenya - Best Car Audio Systems | Amani Vehicle Sounds" />
    <meta property="og:description" content="Shop high-quality {{$category->cat}} in Kenya from top brands like Kenwood, Pioneer, Sony, and Android Radios. Enjoy premium sound with Bluetooth, touchscreen, and more." />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://amanivehiclesounds.co.ke/products/{{$category->slung}}" />
    <meta property="og:image" content="https://amanivehiclesounds.co.ke/uploads/categories/{{$category->image}}" />
    <meta property="og:image:alt" content="High-quality car radios in Kenya from top brands like Kenwood, Pioneer, Sony, and Android Radios." />
    <meta property="og:site_name" content="Amani Vehicle Sounds">
    <meta property="og:locale" content="en_US">
    <meta property="fb:app_id" content="350937289315471" />

    <!-- Twitter Meta Tags -->
    <meta name="twitter:title" content="{{$category->cat}} in Kenya - Best Car Audio Systems | Amani Vehicle Sounds" />
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@amanisounds">
    <meta name="twitter:url" content="https://amanivehiclesounds.co.ke/products/{{$category->slung}}">
    <meta name="twitter:description" content="Find the best car radios in Kenya with features like Bluetooth, touchscreen, and Android OS. Available from Kenwood, Pioneer, Sony, and more." />
    <meta name="twitter:image" content="https://amanivehiclesounds.co.ke/uploads/categories/{{$category->image}}">
    <meta name="twitter:creator" content="@amanisounds">
    <meta name="twitter:image:alt" content="Shop premium {{$category->cat}} in Kenya with Bluetooth, Android OS, and more.">

    <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "CollectionPage",
          "name": "{{$category->cat}} in Kenya - Best Car Audio Systems | Amani Vehicle Sounds",
          "url": "https://amanivehiclesounds.co.ke/products/{{$category->slung}}",
          "description": "Discover the best car radios in Kenya. Shop Kenwood, Pioneer, Sony, and Android Radios with Bluetooth, touchscreen, and premium sound.",
          "image": "https://amanivehiclesounds.co.ke/uploads/categories/{{$category->image}}",
          "publisher": {
            "@type": "Organization",
            "name": "Amani Vehicle Sounds",
            "logo": {
              "@type": "ImageObject",
              "url": "https://amanivehiclesounds.co.ke/uploads/logo/amaniCropped.png"
            }
          },
          "breadcrumb": {
            "@type": "BreadcrumbList",
            "itemListElement": [
              {
                "@type": "ListItem",
                "position": 1,
                "name": "Home",
                "item": "https://amanivehiclesounds.co.ke/"
              },
              {
                "@type": "ListItem",
                "position": 2,
                "name": "Car Radios",
                "item": "https://amanivehiclesounds.co.ke/products/car-radios"
              }
            ]
          }
        }
        </script>


    @endforeach
    {{-- SEO --}}
    @include('front.favicon')
    @include('front.facebook')
    @include('front.tawk')
    @include('front.google')
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" href="{{asset('theme/assets/vendor/line-awesome/line-awesome/line-awesome/css/line-awesome.min.css')}}">
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{asset('theme/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('theme/assets/css/plugins/owl-carousel/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('theme/assets/css/plugins/magnific-popup/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('theme/assets/css/plugins/jquery.countdown.css')}}">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{asset('theme/assets/css/style.css')}}">
    {{--  --}}

    <link rel="stylesheet" href="{{asset('theme/assets/css/plugins/nouislider/nouislider.css')}}">
    {{--  --}}
    <link rel="stylesheet" href="{{asset('theme/assets/css/skins/skin-demo-13.css')}}">
    <link rel="stylesheet" href="{{asset('theme/assets/css/demos/demo-13.css')}}">
     <!--Floating WhatsApp css-->
     <link rel="stylesheet" href="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/floating-wpp.min.css">
</head>

<body>
    <h1 style="display:none">{!!html_entity_decode($category->description)!!}</h1>
<!--Div where the WhatsApp will be rendered-->
<div style="z-index:100000" id="WAButton"></div>
{{--  --}}
    <div class="page-wrapper">
        <header class="header header-10 header-intro-clearance">
            @include('front.top')

            <div class="header-middle">
                <div class="container">
                    <div class="header-left">
                        <button class="mobile-menu-toggler">
                            <span class="sr-only">Toggle mobile menu</span>
                            <i class="icon-bars"></i>
                        </button>

                        <a href="{{url('/')}}" class="logo">
                            <img src="{{url('/')}}/uploads/logo/{{$Settings->logo}}" alt="{{$Settings->sitename}}" width="253" height="62">
                        </a>
                    </div><!-- End .header-left -->

                    @include('front.search')

                    @include('front.shopping-cart')
                </div><!-- End .container -->
            </div><!-- End .header-middle -->

            <div class="header-bottom sticky-header">
                <div class="container">
                    <div class="header-left">
                        <div class="dropdown category-dropdown show is-on" data-visible="false">
                            <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" data-display="static" title="Browse Categories">
                                Browse Categories
                            </a>

                            <div class="dropdown-menu ">
                                <nav class="side-nav">
                                    <ul class="menu-vertical sf-arrows">
                                        <?php $Category = DB::table('category')->limit(11)->get(); ?>
                                        @foreach ($Category as $item)
                                        <li><a href="{{url('/')}}/products/{{$item->slung}}">{{$item->cat}}(<?php echo count($All = DB::table('product')->where('cat',$item->id)->get()); ?>)</a></li>
                                        @endforeach
                                    </ul><!-- End .menu-vertical -->
                                </nav><!-- End .side-nav -->
                            </div><!-- End .dropdown-menu -->
                        </div><!-- End .category-dropdown -->
                    </div><!-- End .col-lg-3 -->
                    @include('front.main-menu')
                    @include('front.discount')
                </div><!-- End .container -->
            </div><!-- End .header-bottom -->
        </header><!-- End .header -->

        @yield('content')

        <footer class="footer footer-2">
            <div class="icon-boxes-container">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-lg-3">
                            <div class="icon-box icon-box-side">
                                <span class="icon-box-icon">
                                    <i class="icon-rocket"></i>
                                </span>

                                <div class="icon-box-content">
                                    <h3 class="icon-box-title">Free Shipping</h3><!-- End .icon-box-title -->
                                    <p>Orders $1000 or more</p>
                                </div><!-- End .icon-box-content -->
                            </div><!-- End .icon-box -->
                        </div><!-- End .col-sm-6 col-lg-3 -->

                        <div class="col-sm-6 col-lg-3">
                            <div class="icon-box icon-box-side">
                                <span class="icon-box-icon">
                                    <i class="icon-rotate-left"></i>
                                </span>

                                <div class="icon-box-content">
                                    <h3 class="icon-box-title">Free Returns</h3><!-- End .icon-box-title -->
                                    <p>Within 5 days</p>
                                </div><!-- End .icon-box-content -->
                            </div><!-- End .icon-box -->
                        </div><!-- End .col-sm-6 col-lg-3 -->

                        <div class="col-sm-6 col-lg-3">
                            <div class="icon-box icon-box-side">
                                <span class="icon-box-icon">
                                    <i class="icon-info-circle"></i>
                                </span>

                                <div class="icon-box-content">
                                    <h3 class="icon-box-title">Get % Off 1 Item</h3><!-- End .icon-box-title -->
                                    <p>When you sign up</p>
                                </div><!-- End .icon-box-content -->
                            </div><!-- End .icon-box -->
                        </div><!-- End .col-sm-6 col-lg-3 -->

                        <div class="col-sm-6 col-lg-3">
                            <div class="icon-box icon-box-side">
                                <span class="icon-box-icon">
                                    <i class="icon-life-ring"></i>
                                </span>

                                <div class="icon-box-content">
                                    <h3 class="icon-box-title">We Support</h3><!-- End .icon-box-title -->
                                    <p>24/7 amazing services</p>
                                </div><!-- End .icon-box-content -->
                            </div><!-- End .icon-box -->
                        </div><!-- End .col-sm-6 col-lg-3 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .icon-boxes-container -->

            <div class="footer-middle border-0">
                <div class="container">
                    @include('front.footer')
                </div><!-- End .container -->
            </div><!-- End .footer-middle -->

            <div class="footer-bottom">
                <div class="container">
                    <p class="footer-copyright">Copyright © <?php echo date('Y') ?> {{$Settings->sitename}}. All Rights Reserved. | Powered By <a href="http://designekta.com">Designekta Studios</a> </p><!-- End .footer-copyright -->


                    <div class="social-icons social-icons-color">
                        <span class="social-label">Social Media</span>
                        <a href="#" class="social-icon social-facebook" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                        <a href="#" class="social-icon social-twitter" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                        <a href="#" class="social-icon social-instagram" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                        <a href="#" class="social-icon social-youtube" title="Youtube" target="_blank"><i class="icon-youtube"></i></a>
                        <a href="#" class="social-icon social-pinterest" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                    </div><!-- End .soial-icons -->
                </div><!-- End .container -->
            </div><!-- End .footer-bottom -->
        </footer><!-- End .footer -->
    </div><!-- End .page-wrapper -->
    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

    <!-- Mobile Menu -->
    <div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

    <div class="mobile-menu-container mobile-menu-light">
        <div class="mobile-menu-wrapper">
            <span class="mobile-menu-close"><i class="icon-close"></i></span>

            @include('front.mobile-search')

            <ul class="nav nav-pills-mobile nav-border-anim" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="mobile-menu-link" data-toggle="tab" href="#mobile-menu-tab" role="tab" aria-controls="mobile-menu-tab" aria-selected="true">Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="mobile-cats-link" data-toggle="tab" href="#mobile-cats-tab" role="tab" aria-controls="mobile-cats-tab" aria-selected="false">Categories</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="mobile-menu-tab" role="tabpanel" aria-labelledby="mobile-menu-link">
                    @include('front.footer-menu')
                </div><!-- .End .tab-pane -->
                <div class="tab-pane fade" id="mobile-cats-tab" role="tabpanel" aria-labelledby="mobile-cats-link">
                    <nav class="mobile-cats-nav">
                        <ul class="mobile-cats-menu">
                            <?php $Category = DB::table('category')->get(); ?>
                            @foreach ($Category as $item)
                            <li><a class="mobile-cats-lead" href="{{url('/')}}/products/{{$item->slung}}">{{$item->cat}}</a></li>
                            @endforeach
                        </ul><!-- End .mobile-cats-menu -->
                    </nav><!-- End .mobile-cats-nav -->
                </div><!-- .End .tab-pane -->
            </div><!-- End .tab-content -->

            <div class="social-icons">
                <a href="{{$Settings->facebook}}" class="social-icon" target="_blank" title="Facebook"><i class="icon-facebook-f"></i></a>
                <a href="{{$Settings->twitter}}" class="social-icon" target="_blank" title="Twitter"><i class="icon-twitter"></i></a>
                <a href="{{$Settings->instagram}}" class="social-icon" target="_blank" title="Instagram"><i class="icon-instagram"></i></a>
                <a href="{{$Settings->youtube}}" class="social-icon" target="_blank" title="Youtube"><i class="icon-youtube"></i></a>
            </div><!-- End .social-icons -->
        </div><!-- End .mobile-menu-wrapper -->
    </div><!-- End .mobile-menu-container -->

    @include('front.sign-in')

    {{-- Newsletter Popup --}}
    {{-- <div class="container newsletter-popup-container mfp-hide" id="newsletter-popup-form">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="row no-gutters bg-white newsletter-popup-content">
                    <div class="col-xl-3-5col col-lg-7 banner-content-wrap">
                        <div class="banner-content text-center">
                            <img src="{{asset('theme/assets/images/popup/newsletter/logo.png')}}" class="logo" alt="logo" width="60" height="15">
                            <h2 class="banner-title">get <span>25<light>%</light></span> off</h2>
                            <p>Subscribe to the Molla eCommerce newsletter to receive timely updates from your favorite products.</p>
                            <form action="#">
                                <div class="input-group input-group-round">
                                    <input type="email" class="form-control form-control-white" placeholder="Your Email Address" aria-label="Email Adress" required>
                                    <div class="input-group-append">
                                        <button class="btn" type="submit"><span>go</span></button>
                                    </div><!-- .End .input-group-append -->
                                </div><!-- .End .input-group -->
                            </form>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="register-policy-2" required>
                                <label class="custom-control-label" for="register-policy-2">Do not show this popup again</label>
                            </div><!-- End .custom-checkbox -->
                        </div>
                    </div>
                    <div class="col-xl-2-5col col-lg-5 ">
                        <img src="{{asset('theme/assets/images/popup/newsletter/img-1.jpg')}}" class="newsletter-img" alt="newsletter">
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Plugins JS File -->
    <script src="{{asset('theme/assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('theme/assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('theme/assets/js/jquery.hoverIntent.min.js')}}"></script>
    <script src="{{asset('theme/assets/js/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('theme/assets/js/superfish.min.js')}}"></script>
    <script src="{{asset('theme/assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('theme/assets/js/bootstrap-input-spinner.js')}}"></script>
    <script src="{{asset('theme/assets/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('theme/assets/js/jquery.plugin.min.js')}}"></script>
    <script src="{{asset('theme/assets/js/jquery.countdown.min.js')}}"></script>

    <!-- Main JS File -->
    <script src="{{asset('theme/assets/js/main.js')}}"></script>
    <script src="{{asset('theme/assets/js/demos/demo-13.js')}}"></script>
     <!--Floating WhatsApp javascript-->
     <script type="text/javascript" src="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/floating-wpp.min.js"></script>

     <script type="text/javascript">
         $(function () {
             $('#WAButton').floatingWhatsApp({
                 phone: '+254794301190', //WhatsApp Business phone number
                 headerTitle: 'Chat with us on WhatsApp!', //Popup Title
                 popupMessage: 'Hello, how can we help you?', //Popup Message
                 message: 'I have just visited *{{url('/')}}*',
                 showPopup: true, //Enables popup display
                 buttonImage: '<img src="{{url('/')}}/uploads/icon/whatsapp.svg" />', //Button Image
                 //headerColor: 'crimson', //Custom header color
                 //backgroundColor: 'crimson', //Custom background button color
                 position: "right" //Position: left | right

             });
         });
     </script>
     <script>
        $('document').ready(function(){
            $('.loading-images').hide();
        });
     </script>
     <script type="text/javascript">
        $(".chb").change(function(){
            $(".chb").prop('checked',false);
            $(this).prop('checked',true);
        });

        $(".ch").change(function(){
            $(".ch").prop('checked',false);
            $(this).prop('checked',true);
        });
    </script>

    <script>
        $("#filter-now").submit(function(stay){
                     stay.preventDefault()
                     //var formdata = $(this).serialize(); // here $(this) refere to the form its submitting
                     $('.loading-images').show();
                     var category = $('.chb:checked').val();
                     var brand = $('.ch:checked').val();
                     $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                     $.ajax({
                        type: 'GET',
                        url: "{{url('/')}}/filter",
                        data: {category:category,brand:brand}, // here $(this) refers to the ajax object not form
                        success: function (data) {
                            $('.spinner').hide();
                            setTimeout(function() {
                                // Redirect
                                // window.open('{{url('/')}}/shopping-cart/checkout/placeOrder','_self')
                            }, 5000);
                            },
                            timeout: 5000
                     });
        });
    </script>
    @include('front.sign')
    @include('front.schema')
</body>
@endforeach


</html>
