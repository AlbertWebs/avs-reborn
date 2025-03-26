@extends('front.master-pages')
@section('content')
@foreach($Products as $Pro)
<main class="main">
  

    <div class="page-content">
        <figure class="entry-media">
            {{-- <img src="{{url('/')}}/uploads/portfolio/{{$Pro->image_one}}" alt="image desc"> --}}
        </figure><!-- End .entry-media -->
        <div class="container">
            <article class="entry single-entry entry-fullwidth">
                <div class="row">
                    <div class="col-lg-11">
                        <div class="entry-body">
                           

                            <h2 class="entry-title entry-title-big">
                                {{$Pro->title}}
                            </h2><!-- End .entry-title -->

                            <div class="entry-cats">
                                in <a href="#"><?php $Service = DB::table('services')->where('id',$Pro->service)->get() ?>@foreach($Service as $ser) {{$ser->title}} @endforeach</a>
                            </div><!-- End .entry-cats -->
                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                <img src="{{url('/')}}/uploads/portfolio/{{$Pro->image_one}}" alt="image">
                                </div>

                                <div class="col-lg-6 col-md-12">
                                    <img src="{{url('/')}}/uploads/portfolio/{{$Pro->image_two}}" alt="image">
                                </div>
                            </div>

                            <div class="entry-content editor-content">
                                <p>  {!!html_entity_decode($Pro->content)!!}</p>

                                <div class="pb-1"></div><!-- End .pb-1 -->
                                {{-- <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                    <img src="{{url('/')}}/uploads/portfolio/{{$Pro->image_one}}" alt="image">
                                    </div>

                                    <div class="col-lg-6 col-md-12">
                                        <img src="{{url('/')}}/uploads/portfolio/{{$Pro->image_two}}" alt="image">
                                    </div>
                                </div> --}}

                                <div class="pb-1"></div><!-- End .pb-1 -->

                               
                            </div><!-- End .entry-content -->

                            
                        </div><!-- End .entry-body -->
                    </div><!-- End .col-lg-11 -->

                    <div class="col-lg-1 order-lg-first mb-2 mb-lg-0">
                        <div class="sticky-content">
                            <div class="social-icons social-icons-colored social-icons-vertical">
                                <span class="social-label">SHARE:</span>
                                <a href="#" class="social-icon social-facebook" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                <a href="#" class="social-icon social-twitter" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                <a href="#" class="social-icon social-pinterest" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                                <a href="#" class="social-icon social-linkedin" title="Linkedin" target="_blank"><i class="icon-linkedin"></i></a>
                            </div><!-- End .soial-icons -->
                        </div><!-- End .sticky-content -->
                    </div><!-- End .col-lg-1 -->
                </div><!-- End .row -->

               
            </article><!-- End .entry -->

      

            <div class="related-posts">
                <h3 class="title">Related Works</h3><!-- End .title -->
                
                <div class="owl-carousel owl-simple" data-toggle="owl" 
                    data-owl-options='{
                        "nav": true, 
                        "dots": true,
                        "margin": 20,
                        "loop": true,
                        "responsive": {
                            "0": {
                                "items":1
                            },
                            "480": {
                                "items":2
                            },
                            "768": {
                                "items":3
                            },
                            "992": {
                                "items":4
                            }
                        }
                    }'>

                    <?php $Portfolio = DB::table('portfolio')->where('service',$Pro->service)->get(); ?>
                    @foreach($Portfolio as $folio)
                    <article class="entry entry-grid">
                        <figure class="entry-media">
                            <a href="{{url('/')}}/our-portfolio/{{$folio->id}}">
                                <img src="{{url('/')}}/uploads/portfolio/{{$folio->image_one}}" alt="image desc">
                            </a>
                        </figure><!-- End .entry-media -->

                        <div class="entry-body">
                            

                            <h2 class="entry-title">
                                <a href="{{url('/')}}/our-portfolio/{{$folio->id}}">{{$folio->title}}</a>
                            </h2><!-- End .entry-title -->

                          
                        </div><!-- End .entry-body -->
                    </article><!-- End .entry -->
                    @endforeach

                </div><!-- End .owl-carousel -->
            </div><!-- End .related-posts -->

         
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
@endforeach
@endsection