<div class="header-top">
    <div class="container">
        <div class="header-left">
            <a href="tel:{{$Settings->mobile_one}}"><i class="icon-phone"></i>Call: {{$Settings->mobile_one_display}}</a> &nbsp; | &nbsp;
            <a href="tel:{{$Settings->mobile_two}}"><i class="icon-phone"></i>Call: {{$Settings->mobile_two_display}}</a>
        </div><!-- End .header-left -->

        <div class="header-right">

            <ul class="top-menu">
                <li>
                    <a href="#">More</a>
                    <ul>
                        <li>
                            <div>
                                <a href="#mailto:{{$Settings->email}}"> <i class="icon-envelope"></i> {{$Settings->email}}</a>

                            </div><!-- End .header-dropdown -->
                        </li>
                        <li>
                            <div>
                                <a href="{{url('/')}}/find-us"> <i class="icon-map-marker"></i> {{$Settings->location}}</a>

                            </div><!-- End .header-dropdown -->
                        </li>
                        <li class="login">
                            @if(Auth::check())
                            <a href="{{url('/')}}/dashboard"><i class="icon-user"></i> {{Auth::user()->name}}</a>
                            @else
                            <a href="#signin-modal" data-toggle="modal">Sign in / Sign up</a>
                            @endif
                        </li>
                    </ul>
                </li>
            </ul><!-- End .top-menu -->
        </div><!-- End .header-right -->
    </div><!-- End .container -->
</div><!-- End .header-top -->
