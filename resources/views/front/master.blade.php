<!DOCTYPE html>
<html lang="en">
<head>
    <?php $SiteSettings = DB::table('sitesettings')->get() ?>
    @foreach ($SiteSettings as $Settings)
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    {{-- SEO --}}
    <meta property="fb:app_id" content="431980657174772" />
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="author" content="Designekta Studios">
    <meta name="robots" content="index,follow">
    <meta name="googlebot" content="index,follow"><!-- Google Specific -->
    <meta name="rating" content="General">
    <meta name="referrer" content="strict-origin-when-cross-origin">
    <meta name="theme-color" content="#66139B">

    <title>Amani Vehicle Sounds | Your Go-To Plug for Car Audio Systems in Nairobi</title>
    <meta name="description" content="Upgrade your driving experience with Nairobi's best car audio systems. Shop premium Android screens, speakers, subwoofers, and alarms at Amani Vehicle Sounds. Expert installation guaranteed.">
    <link rel="canonical" href="https://amanivehiclesounds.com"/>

    <!-- Open Graph Meta Tags (Facebook & Social Media) -->
    <meta property="og:title" content="Amani Vehicle Sounds | Your Go-To Plug for Car Audio Systems" />
    <meta property="og:description" content="Shop premium car audio systems, Android screens, and car accessories in Nairobi. Quality sound, expert installation, and unbeatable prices." />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://amanivehiclesounds.com" />
    <meta property="og:image" content="https://amanivehiclesounds.com/uploads/logo/amaniCropped.png" />
    <meta property="og:site_name" content="Amani Vehicle Sounds">
    <meta property="og:locale" content="en_US">

    <!-- Twitter Meta Tags -->
    <meta name="twitter:title" content="Amani Vehicle Sounds | Your Go-To Plug for Car Audio Systems in Nairobi" />
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@amanisounds">
    <meta name="twitter:url" content="https://amanivehiclesounds.com">
    <meta name="twitter:description" content="Upgrade your driving experience with Nairobi's best car audio systems. Shop premium Android screens, speakers, subwoofers, and alarms at Amani Vehicle Sounds." />
    <meta name="twitter:image" content="https://amanivehiclesounds.com/uploads/logo/amaniCropped.png">

    {{-- SEO --}}
    @include('front.favicon')
    @include('front.facebook')
    @include('front.tawk')
    @include('front.google')

    <link rel="stylesheet" href="{{asset('theme/assets/vendor/line-awesome/line-awesome/line-awesome/css/line-awesome.min.css')}}">
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{asset('theme/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('theme/assets/css/plugins/owl-carousel/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('theme/assets/css/plugins/magnific-popup/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('theme/assets/css/plugins/jquery.countdown.css')}}">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{asset('theme/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('theme/assets/css/skins/skin-demo-13.css')}}">
    <link rel="stylesheet" href="{{asset('theme/assets/css/demos/demo-13.css')}}">
     <!--Floating WhatsApp css-->
     <link rel="stylesheet" href="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/floating-wpp.min.css">
     <script id="mcjs">!function(c,h,i,m,p){m=c.createElement(h),p=c.getElementsByTagName(h)[0],m.async=1,m.src=i,p.parentNode.insertBefore(m,p)}(document,"script","https://chimpstatic.com/mcjs-connected/js/users/5d392d6beb82e88615a2eeb3c/1d603c00fa71af0f58347ff94.js");</script>
</head>

<body>
    <h1 style="display:none">Get the best Car Android Radios, Car Audio Systems, Car Speakers, Car Sound Systems, and Car Stereos in Nairobi. </h1>
<!--Div where the WhatsApp will be rendered-->
<div style="z-index:100000" id="WAButton"></div>
<style>
/* Hide WhatsApp button on mobile devices */
@media (max-width: 991px) {
    #WAButton,
    #WAButton * {
        display: none !important;
        visibility: hidden !important;
        opacity: 0 !important;
    }
}
</style>
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
                        <div class="dropdown category-dropdown" data-visible="false">
                            <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static" title="Browse Categories">
                                Browse Categories
                            </a>

                            <div class="dropdown-menu">
                                <nav class="side-nav">
                                    <ul class="menu-vertical sf-arrows">
                                        <?php $Category = DB::table('category')->orderBy('order', 'asc')->limit(11)->get(); ?>
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

        <footer class="footer footer-2" >
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
    
    <!-- Mobile Bottom Navigation -->
    @include('front.mobile-bottom-nav')

    <!-- Mobile Menu -->
    <div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

    <div class="mobile-menu-container mobile-menu-light">
        <div class="mobile-menu-wrapper">
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
                            <?php $Category = DB::table('category')->orderBy('order', 'asc')->get(); ?>
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
            
            <span class="mobile-menu-close"><i class="icon-close"></i></span>
        </div><!-- End .mobile-menu-wrapper -->
    </div><!-- End .mobile-menu-container -->

     @include('front.sign-in')

    {{-- Newsletter Popup --}}
    <?php $userIP = Request::ip();  $NewsLetter = DB::table('newsletters')->where('user',$userIP)->get(); ?>
    @if($NewsLetter->isEmpty())
    {{-- <div class="container newsletter-popup-container mfp-hide" id="newsletter-popup-form">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="row no-gutters bg-white newsletter-popup-content">
                    <div class="col-xl-3-5col col-lg-7 banner-content-wrap">
                        <div class="banner-content text-center">
                            <img src="{{url('/')}}/uploads/logo/{{$Settings->logo}}" class="logo" alt="logo" width="100" height="65">
                            <h2 class="banner-title">get <span>8<light>%</light></span> off</h2>
                            <p>Subscribe to the Amani Vehicle Sounds newsletter to receive timely updates from your favorite products.</p>
                            <form action="#" id="newsletter-popup">
                                {{csrf_field()}}
                                <div class="input-group input-group-round">
                                    <input type="email" name="user_email" class="form-control form-control-white" placeholder="Your Email Address" aria-label="Email Adress" required>
                                    <input type="email" name="user_email" class="form-control form-control-white" placeholder="Your Email Address" aria-label="Email Adress" required>
                                    <input type="email" name="user_email" class="form-control form-control-white" placeholder="Your Email Address" aria-label="Email Adress" required>
                                    <div class="input-group-append">
                                        <button class="btn" type="submit"><span>go</span> <img class="loading-imagers" width="22" src="{{url('/')}}/uploads/preloaders/loading.gif" alt="Amani vehicle Sound Loading"></button>
                                    </div><!-- .End .input-group-append -->

                                </div><!-- .End .input-group -->
                                <span id="newsletter-span"></span>
                            </form>
                            <div class="custom-control custom-checkbox">
                                <input name="do-not" type="checkbox" class="custom-control-input" id="register-policy-2" required>
                                <label class="custom-control-label" for="register-policy-2">Do not show this popup again</label>
                            </div><!-- End .custom-checkbox -->
                        </div>
                    </div>
                    <div class="col-xl-2-5col col-lg-5 ">
                        <img src="{{url('/')}}/uploads/banners/car-audio-system-500x500.jpg" class="newsletter-img" alt="newsletter">
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    @endif

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


    @include('front.newsletter')
    @include('front.sign')
    @include('front.schema')
    
    <style>
    /* Hide WhatsApp button on mobile devices */
    @media (max-width: 991px) {
        #WAButton,
        #WAButton * {
            display: none !important;
            visibility: hidden !important;
            opacity: 0 !important;
        }
        
        /* Hide Compare button on mobile */
        .compare-dropdown {
            display: none !important;
        }
    }
    
    /* Enhanced Mobile Menu UX/UI */
    @media (max-width: 991px) {
        /* Mobile Menu Container - Modern Design */
        .mobile-menu-container {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%) !important;
            box-shadow: 4px 0 24px rgba(0, 0, 0, 0.15) !important;
            width: 100% !important;
            max-width: 320px !important;
        }
        
        .mobile-menu-wrapper {
            padding: 0 !important;
            position: relative !important;
        }
        
        /* Close Button - Enhanced - Positioned below social icons */
        .mobile-menu-close {
            width: 44px !important;
            height: 44px !important;
            margin: 1.5rem auto 0 !important;
            background: rgba(102, 19, 155, 0.1) !important;
            border-radius: 12px !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            color: rgb(102, 19, 155) !important;
            font-size: 1.8rem !important;
            position: relative !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            cursor: pointer !important;
        }
        
        /* Ensure mobile-menu-wrapper creates stacking context */
        .mobile-menu-wrapper {
            position: relative !important;
            z-index: 1 !important;
        }
        
        .mobile-menu-close:hover,
        .mobile-menu-close:active {
            background: rgb(102, 19, 155) !important;
            color: white !important;
            transform: rotate(90deg) scale(1.1) !important;
        }
        
        /* Search Form - Modern Design - Positioned below close button */
        .mobile-search {
            margin: 4.5rem 1.25rem 1.5rem !important;
            display: flex !important;
            gap: 0.5rem !important;
            background: white !important;
            border-radius: 16px !important;
            padding: 0.5rem !important;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08) !important;
            border: 2px solid rgba(102, 19, 155, 0.1) !important;
            transition: all 0.3s ease !important;
            position: relative !important;
            z-index: 0 !important;
        }
        
        .mobile-search:focus-within {
            border-color: rgb(102, 19, 155) !important;
            box-shadow: 0 4px 16px rgba(102, 19, 155, 0.15) !important;
        }
        
        .mobile-search .form-control {
            border: none !important;
            padding: 0.75rem 1rem !important;
            font-size: 1rem !important;
            background: transparent !important;
            flex: 1 !important;
        }
        
        .mobile-search .form-control:focus {
            outline: none !important;
            box-shadow: none !important;
        }
        
        .mobile-search .btn {
            padding: 0.75rem 1.25rem !important;
            border-radius: 12px !important;
            background: linear-gradient(135deg, rgb(102, 19, 155) 0%, rgb(82, 15, 125) 100%) !important;
            border: none !important;
            color: white !important;
            font-size: 1.1rem !important;
            transition: all 0.3s ease !important;
            min-width: 50px !important;
        }
        
        .mobile-search .btn:hover,
        .mobile-search .btn:active {
            transform: scale(1.05) !important;
            box-shadow: 0 4px 12px rgba(102, 19, 155, 0.3) !important;
        }
        
        /* Tab Navigation - Enhanced */
        .nav-pills-mobile {
            margin: 0 1.25rem 1.5rem !important;
            border-bottom: 2px solid rgba(102, 19, 155, 0.1) !important;
            border-radius: 0 !important;
        }
        
        .nav-pills-mobile .nav-link {
            padding: 1rem 1.5rem !important;
            font-size: 1rem !important;
            font-weight: 600 !important;
            color: #6c757d !important;
            border-bottom: 3px solid transparent !important;
            transition: all 0.3s ease !important;
            text-transform: none !important;
            letter-spacing: 0.3px !important;
        }
        
        .nav-pills-mobile .nav-link.active,
        .nav-pills-mobile .nav-link:hover {
            color: rgb(102, 19, 155) !important;
            border-bottom-color: rgb(102, 19, 155) !important;
            background: rgba(102, 19, 155, 0.05) !important;
        }
        
        /* Menu Items - Enhanced */
        .mobile-menu {
            padding: 0 !important;
            margin: 0 1.25rem !important;
        }
        
        .mobile-menu li {
            margin-bottom: 0.5rem !important;
        }
        
        .mobile-menu li a {
            display: block !important;
            padding: 1rem 1.25rem !important;
            color: #333 !important;
            font-size: 1.05rem !important;
            font-weight: 500 !important;
            border-radius: 12px !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            position: relative !important;
            overflow: hidden !important;
        }
        
        .mobile-menu li a::before {
            content: '' !important;
            position: absolute !important;
            left: 0 !important;
            top: 0 !important;
            bottom: 0 !important;
            width: 4px !important;
            background: rgb(102, 19, 155) !important;
            transform: scaleY(0) !important;
            transition: transform 0.3s ease !important;
        }
        
        .mobile-menu li.active a,
        .mobile-menu li a:hover {
            background: linear-gradient(90deg, rgba(102, 19, 155, 0.1) 0%, rgba(102, 19, 155, 0.05) 100%) !important;
            color: rgb(102, 19, 155) !important;
            padding-left: 1.5rem !important;
            transform: translateX(4px) !important;
        }
        
        .mobile-menu li.active a::before,
        .mobile-menu li a:hover::before {
            transform: scaleY(1) !important;
        }
        
        /* Categories Menu - Enhanced */
        .mobile-cats-menu {
            padding: 0 !important;
            margin: 0 1.25rem !important;
        }
        
        .mobile-cats-menu li {
            margin-bottom: 0.5rem !important;
        }
        
        .mobile-cats-menu li a {
            display: flex !important;
            align-items: center !important;
            padding: 1rem 1.25rem !important;
            color: #333 !important;
            font-size: 1.05rem !important;
            font-weight: 500 !important;
            border-radius: 12px !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            position: relative !important;
            background: white !important;
            border: 1px solid rgba(0, 0, 0, 0.05) !important;
        }
        
        .mobile-cats-menu li a::after {
            content: '\f105' !important;
            font-family: 'Font Awesome 5 Free' !important;
            font-weight: 900 !important;
            position: absolute !important;
            right: 1.25rem !important;
            color: #ccc !important;
            transition: all 0.3s ease !important;
        }
        
        .mobile-cats-menu li a.mobile-cats-lead {
            font-weight: 600 !important;
        }
        
        .mobile-cats-menu li a:hover,
        .mobile-cats-menu li a:active {
            background: linear-gradient(90deg, rgba(102, 19, 155, 0.1) 0%, rgba(102, 19, 155, 0.05) 100%) !important;
            color: rgb(102, 19, 155) !important;
            border-color: rgba(102, 19, 155, 0.2) !important;
            transform: translateX(4px) !important;
            box-shadow: 0 2px 8px rgba(102, 19, 155, 0.1) !important;
        }
        
        .mobile-cats-menu li a:hover::after,
        .mobile-cats-menu li a:active::after {
            color: rgb(102, 19, 155) !important;
            transform: translateX(4px) !important;
        }
        
        /* Social Icons - Enhanced */
        .mobile-menu-wrapper .social-icons {
            margin-top: 2rem !important;
            padding: 1.5rem 1.25rem 0 !important;
            border-top: 1px solid rgba(0, 0, 0, 0.08) !important;
            display: flex !important;
            justify-content: center !important;
            gap: 1rem !important;
        }
        
        .mobile-menu-wrapper .social-icon {
            width: 44px !important;
            height: 44px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            border-radius: 12px !important;
            background: rgba(102, 19, 155, 0.1) !important;
            color: rgb(102, 19, 155) !important;
            font-size: 1.2rem !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            border: none !important;
        }
        
        .mobile-menu-wrapper .social-icon:hover,
        .mobile-menu-wrapper .social-icon:active {
            background: rgb(102, 19, 155) !important;
            color: white !important;
            transform: translateY(-2px) scale(1.1) !important;
            box-shadow: 0 4px 12px rgba(102, 19, 155, 0.3) !important;
        }
        
        /* Tab Content Animation */
        .tab-content {
            animation: fadeInUp 0.3s ease-out !important;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Smooth Menu Slide Animation */
        .mobile-menu-container {
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1) !important;
        }
        
        /* Overlay Enhancement */
        .mobile-menu-overlay {
            background: rgba(0, 0, 0, 0.5) !important;
            backdrop-filter: blur(4px) !important;
            -webkit-backdrop-filter: blur(4px) !important;
        }
    }
    </style>
    
    <script>
    // Enhanced Mobile Menu UX
    document.addEventListener('DOMContentLoaded', function() {
        // Add smooth animations to menu items
        const menuItems = document.querySelectorAll('.mobile-menu li a, .mobile-cats-menu li a');
        
        menuItems.forEach((item, index) => {
            item.style.opacity = '0';
            item.style.transform = 'translateX(-10px)';
            item.style.transition = `all 0.3s ease ${index * 0.05}s`;
            
            setTimeout(() => {
                item.style.opacity = '1';
                item.style.transform = 'translateX(0)';
            }, 100);
        });
        
        // Enhanced search input focus
        const mobileSearch = document.getElementById('mobile-search');
        if (mobileSearch) {
            mobileSearch.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
            });
            
            mobileSearch.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        }
        
        // Add ripple effect to menu items
        menuItems.forEach(item => {
            item.addEventListener('click', function(e) {
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                ripple.style.position = 'absolute';
                ripple.style.borderRadius = '50%';
                ripple.style.background = 'rgba(102, 19, 155, 0.2)';
                ripple.style.transform = 'scale(0)';
                ripple.style.animation = 'rippleMenu 0.6s ease-out';
                ripple.style.pointerEvents = 'none';
                ripple.style.zIndex = '1';
                
                this.style.position = 'relative';
                this.style.overflow = 'hidden';
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });
        
        // Enhanced tab switching animation
        const tabLinks = document.querySelectorAll('.nav-pills-mobile .nav-link');
        tabLinks.forEach(link => {
            link.addEventListener('click', function() {
                const tabContent = document.querySelector('.tab-content');
                if (tabContent) {
                    tabContent.style.opacity = '0';
                    tabContent.style.transform = 'translateY(10px)';
                    
                    setTimeout(() => {
                        tabContent.style.opacity = '1';
                        tabContent.style.transform = 'translateY(0)';
                    }, 150);
                }
            });
        });
    });
    
    // Ripple animation for menu
    const menuRippleStyle = document.createElement('style');
    menuRippleStyle.textContent = `
        @keyframes rippleMenu {
            to {
                transform: scale(2);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(menuRippleStyle);
    </script>
</body>
@endforeach

</html>
