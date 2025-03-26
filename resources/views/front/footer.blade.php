<div class="row">
    <div class="col-sm-12 col-lg-6">
        <div class="widget widget-about">
            <img src="{{asset('uploads/logo/logofooter.png')}}" class="footer-logo" alt="{{$Settings->sitename}}" width="353" height="62">
         
            <div class="widget-about-info">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <span class="widget-about-title">Got Question? Call us 24/7</span>
                        <a href="tel:{{$Settings->mobile_one}}">{{$Settings->mobile_one_display}}</a>
                    </div><!-- End .col-sm-6 -->
                    <div class="col-sm-6 col-md-8">
                        <span class="widget-about-title">Payment Method</span>
                        <figure class="footer-payments">
                            <img src="{{asset('theme/assets/images/payments.png')}}" alt="Payment methods" width="272" height="20">
                        </figure><!-- End .footer-payments -->
                    </div><!-- End .col-sm-6 -->
                </div><!-- End .row -->
            </div><!-- End .widget-about-info -->
        </div><!-- End .widget about-widget -->
    </div><!-- End .col-sm-12 col-lg-3 -->

    <div class="col-sm-4 col-lg-2">
        <div class="widget">
            <h4 class="widget-title">Information</h4><!-- End .widget-title -->

            <ul class="widget-list">
                <li><a href="{{url('/privacy-policy')}}">Privacy Policy</a></li>
                <li><a href="{{url('/copyright')}}">Copyright</a></li>
                <li><a href="{{url('/delivery')}}">Delivery</a></li>
                <li><a href="{{url('/terms-and-conditions')}}">Terms & Conditions</a></li>
            </ul><!-- End .widget-list -->
        </div><!-- End .widget -->
    </div><!-- End .col-sm-4 col-lg-3 -->

    <div class="col-sm-4 col-lg-2">
        <div class="widget">
            <h4 class="widget-title">Customer Service</h4><!-- End .widget-title -->

            <ul class="widget-list">
                <li><a href="#">Home</a></li>
                <li><a href="{{url('/')}}">About Us</a></li>
                <li><a href="{{url('/products')}}">Products</a></li>
                <li><a href="{{url('/our-portfolio')}}">Our Portfolio</a></li>
            </ul><!-- End .widget-list -->
        </div><!-- End .widget -->
    </div><!-- End .col-sm-4 col-lg-3 -->

    <div class="col-sm-4 col-lg-2">
        <div class="widget">
            <h4 class="widget-title">My Account</h4><!-- End .widget-title -->

            <ul class="widget-list">
             
                <li><a href="{{url('/')}}/shopping-cart">View Cart</a></li>
                <li><a href="{{url('/')}}/shopping-cart/wishlist">My Wishlist</a></li>
                <li><a href="{{url('/')}}/dashboard">Track My Order</a></li>
                <li><a href="{{url('/')}}/find-us">Help</a></li>
            </ul><!-- End .widget-list -->
        </div><!-- End .widget -->
    </div><!-- End .col-sm-64 col-lg-3 -->
</div><!-- End .row -->