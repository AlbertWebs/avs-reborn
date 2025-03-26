@extends('front.master-pages')
@section('content')
@foreach ($SiteSettings as $Settings)
<main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">Find Us <span>{{$Settings->location}}</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                {{-- <li class="breadcrumb-item"><a href="#">Pages</a></li> --}}
                <li class="breadcrumb-item active" aria-current="page">Find Us</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div id="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d249.30100549775818!2d36.8278346!3d-1.2842642!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x677ac7d99a0ff352!2sAmani+Vehicle+Sounds+%26+Accessories!5e0!3m2!1sen!2ske!4v1557146026043!5m2!1sen!2ske" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
                       
        </div><!-- End #map -->
        <br><br>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="contact-box text-center">
                        <h3>Office</h3>

                        <address>{{$Settings->location}} <br>{{$Settings->address}}</address>
                    </div><!-- End .contact-box -->
                </div><!-- End .col-md-4 -->

                <div class="col-md-4">
                    <div class="contact-box text-center">
                        <h3>Start a Conversation</h3>

                        <div><a href="mailto:#{{$Settings->email}}">{{$Settings->email}}</a></div>
                        <div><a href="tel:{{$Settings->mobile_one}}">{{$Settings->mobile_one_display}}</a>, <a href="tel:{{$Settings->mobile_two}}">{{$Settings->mobile_two_display}}</a></div>
                    </div><!-- End .contact-box -->
                </div><!-- End .col-md-4 -->

                <div class="col-md-4">
                    <div class="contact-box text-center">
                        <h3>Social</h3>

                        <div class="social-icons social-icons-color justify-content-center">
                            <a href="{{$Settings->facebook}}" class="social-icon social-facebook" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                            <a href="{{$Settings->twitter}}" class="social-icon social-twitter" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                            <a href="{{$Settings->instagram}}" class="social-icon social-instagram" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                            <a href="{{$Settings->youtube}}" class="social-icon social-youtube" title="Youtube" target="_blank"><i class="icon-youtube"></i></a>
                            {{-- <a href="#" class="social-icon social-pinterest" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a> --}}
                        </div><!-- End .soial-icons -->
                    </div><!-- End .contact-box -->
                </div><!-- End .col-md-4 -->
            </div><!-- End .row -->

            <hr class="mt-3 mb-5 mt-md-1">
            <div class="touch-container row justify-content-center">
                <div class="col-md-9 col-lg-7">
                    <div class="text-center">
                    <h2 class="title mb-1">Why Choose Us</h2><!-- End .title mb-2 -->
                    <p class="lead text-primary">
                        {!!html_entity_decode($Settings->welcome)!!}
                    </p><!-- End .lead text-primary -->
                    </div><!-- End .text-center -->

                </div><!-- End .col-md-9 col-lg-7 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->   
@endforeach

@endsection