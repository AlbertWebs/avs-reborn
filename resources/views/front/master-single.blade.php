<!DOCTYPE html>
<html lang="en">
<head>
    <?php $SiteSettings = DB::table('sitesettings')->get() ?>
    @foreach ($SiteSettings as $Settings)
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @foreach($Products as $tProduct)

    <meta name="author" content="Designekta Studios">
    <meta name="robots" content="index,follow">
    <meta name="googlebot" content="index,follow"><!-- Google Specific -->
    <meta name="subject" content="{{$tProduct->name}} - Amani Vehicle Sounds - <?php $CategoryList = \App\Models\Category::find($tProduct->cat); echo $CategoryList->cat ?> In Nairobi">
    <meta name="rating" content="General">
    <meta name="referrer" content="strict-origin-when-cross-origin">
    <meta name="theme-color" content="#66139B">


    <title>{{$tProduct->name}} - Amani Vehicle Sounds - <?php $CategoryList = \App\Models\Category::find($tProduct->cat); echo $CategoryList->cat ?> In Nairobi</title>
    <meta name="description" content="{{$tProduct->meta}} Order today">
    <link rel="canonical" href="https://amanivehiclesounds.co.ke/product/{{$tProduct->slung}}">
    <meta name="keywords" content="{{$tProduct->name}}, {{$tProduct->brand}} {{$CategoryList->cat}} in Nairobi, Car Stereo Kenya, Double Din Car Radio, Bluetooth Car Radio, Car Radio with Reverse Camera, Amani Vehicle Sounds Kenya">


    <!-- Open Graph Meta Tags (Facebook & Social Media) -->
    <meta property="og:title" content="{{$tProduct->name}} - Amani Vehicle Sounds - <?php $CategoryList = \App\Models\Category::find($tProduct->cat); echo $CategoryList->cat ?> In Nairobi" />
    <meta property="og:description" content="{{$tProduct->meta}} Order today" />
    <meta property="og:type" content="product" />
    <meta property="og:url" content="https://amanivehiclesounds.co.ke/product/{{$tProduct->slung}}" />
    <meta property="og:image" content="https://amanivehiclesounds.co.ke/uploads/product/{{$tProduct->fb_pixels}}" />
    <meta property="og:site_name" content="Amani Vehicle Sounds">
    <meta property="og:locale" content="en_US">
    <meta property="fb:app_id" content="350937289315471" />
    <meta property="og:id" content="{{$tProduct->id}}" />
    <meta property="product:brand" content="{{$tProduct->brand}}" />
    <meta property="product:availability" content="in stock" />
    <meta property="product:condition" content="new" />
    <meta property="product:price:amount" content="KES {{$tProduct->price}}.00" />
    <meta property="product:price:currency" content="KES" />
    <meta property="product:retailer_item_id" content="{{$tProduct->id}}" />

    <!-- Twitter Meta Tags -->
    <meta name="twitter:title" content="{{$tProduct->name}} - Amani Vehicle Sounds - <?php $CategoryList = \App\Models\Category::find($tProduct->cat); echo $CategoryList->cat ?> In Nairobi" />
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@amanisounds">
    <meta name="twitter:url" content="https://amanivehiclesounds.co.ke/product/{{$tProduct->slung}}">
    <meta name="twitter:description" content="{{$tProduct->meta}} Order today" />
    <meta name="twitter:image" content="https://amanivehiclesounds.co.ke/uploads/product/{{$tProduct->fb_pixels}}">
    <meta name="twitter:creator" content="@amanisounds">
    <meta name="twitter:image:alt" content="KENWOOD DDX419BTM Car Radio">
    @endforeach

        <!-- SEO -->
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
    <h1 style="display:none">{{$tProduct->name}} in {{$tProduct->brand}} Brand, {{$tProduct->meta}}  Order from Amani Vehicle Sounds Today!</h1>
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
    <script src="{{asset('theme/assets/js/jquery.elevateZoom.min.js')}}"></script>
    <script src="{{asset('theme/assets/js/bootstrap-input-spinner.js')}}"></script>
    <script src="{{asset('theme/assets/js/jquery.magnific-popup.min.js')}}"></script>
    <!-- Main JS File -->
    <script src="{{asset('theme/assets/js/main.js')}}"></script>
    {{-- <script src="{{asset('theme/assets/js/demos/demo-13.js')}}"></script> --}}
     <!--Floating WhatsApp javascript-->
     <script type="text/javascript" src="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/floating-wpp.min.js')}}"></script>

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


     {{--  --}}
     <?php $CartItems = Cart::content(); ?>
     @if($CartItems->isEmpty())

     @else
     @foreach($CartItems as $CartItem)
     <script>
        $( document ).ready(function() {
            $('.hide_{{$CartItem->rowId}}').hide();
           //update cart
                $.ajaxSetup({

                    headers: {

                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                    }

                });
                $("#updateQTY_{{$CartItem->rowId}}").submit(function(e){

                    e.preventDefault();

                    $('.hide_{{$CartItem->rowId}}').show();

                    var rowId = $("input[name=rowID_{{$CartItem->rowId}}]").val();

                    var qty = $("input[name=qty_{{$CartItem->rowId}}]").val();

                    $.ajax({

                        type:'POST',

                        url:"{{ route('update.cart') }}",

                        data:{rowId:rowId, qty:qty},

                        success:function(data){

                                $('.hide_{{$CartItem->rowId}}').hide(1000);

                        }

                    });

                });
        });
    </script>
    @endforeach
    @endif
     {{--  --}}

          <!-- Check Mail Exists -->
          <script type="text/javascript">
            function duplicateEmail(element){

                $('#mailChecking').html('Checking...........')
                var email = $(element).val();
                $.ajax({
                    type: "POST",
                    url: '{{url('checkemail')}}',
                    data: {
                            email:email,
                            "_token": "{{ csrf_token() }}",
                        },
                    dataType: "json",
                    success: function(res) {

                        if(res.exists){
                            // Exists
                            $('#mailChecking').hide();
                            $('#mailAvailable').hide();
                            $('#mailExists').html('The Email is already in use by another person')
                        }else{
                            // Available
                            $('#mailChecking').hide();
                            $('#mailExists').hide();

                        }
                    },
                    error: function (jqXHR, exception) {

                    }
                });
            }
          </script>
          <!-- </Check mail Exists -->
          {{--  --}}
          <script>
            $(function () {
                    $('#loading-image').hide();
                    $('#updateShippingForm').hide();
                    $('#verify').on('submit', function (e) {
                            $('#veryfyID').html('Checking......')
                            e.preventDefault();
                            $.ajax({
                            type: 'post',
                            url: '{{url('/')}}/payments/veryfy/mpesa',
                            data: $('#verify').serialize(),
                                    success: function ($results) {
                                        $('#CardNumber').val('')
                                        if($results == 1){
                                            // alert('Verification Was Successfull')
                                            $('#success-alert').html('The Purchase Was Successfull')
                                            $('#veryfyID').html('Successfull')
                                            //Submit The Order
                                            window.open('{{url('/')}}/shopping-cart/checkout/placeOrder','_self')
                                        }else{

                                            $('#veryfyID').html('Error Verifying Transaction. Wrong Transaction Code or Amount <i style="font-size:20px;color:red" class="fa fa-frown-o"></i>')
                                        }
                                    }
                            });

                    });

                    // STK Request Goes Here
                    $( document ).ready(function() {
                        $('.spinner').hide();
                    });
                    $("#stk-submit").submit(function(stay){
                     stay.preventDefault()
                     var formdata = $(this).serialize(); // here $(this) refere to the form its submitting
                     $('.spinner').show();
                     $('.instructions').delay(2000).fadeIn();
                     $.ajax({
                        type: 'POST',
                        url: "{{url('/')}}/api/v1/stk/push",
                        data: formdata, // here $(this) refers to the ajax object not form
                        success: function (data) {
                            $('.spinner').hide();
                            $('.instructions').delay(4000).html('Success...');
                            $('.instructions').delay(1000).html('Redirecting....');
                            setTimeout(function() {
                                // Redirect
                                window.open('{{url('/')}}/shopping-cart/checkout/placeOrder','_self')
                            }, 5000);
                            },
                            timeout: 5000
                     });
                    });





            });
        </script>
          {{--  --}}
          @include('front.sign')
    @include('front.schema')
</body>
@endforeach

</html>
