@extends('front.master-pages')
@section('content')
 <!--================Categories Banner Area =================-->
 <?php
    $compare = session()->get('compare', []);
    $count = count($compare);  
 ?>
 @if($count == 0)
<section class="emty_cart_area p_100">
    <div class="container">
        <div class="emty_cart_inner">
            <i class="icon-handbag icons"></i>
            <h3>Your Compare List is Empty</h3>
            <h4>back to <a href="{{url('/products')}}/shop-by-categories">shopping</a></h4>
        </div>
    </div>
</section>
@else

 <main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container d-flex align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Products</a></li>
                <li class="breadcrumb-item active" aria-current="page">Compare Products</li>
            </ol>

            
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <br><br>

    <div class="page-content">
        <div class="container">
            <div class="product-details-top mb-2">
                <div class="row">
                    @if(session('compare'))
                    @foreach(session('compare') as $id => $details)
                    <?php $Product = DB::table('product')->where('id',$details['id'])->get(); ?>
                    @foreach($Product as $Pro)
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <div class="product-details product-details-centered">
                            <h1 class="product-title">{{$Pro->name}}</h1><!-- End .product-title -->

                          

                            <div class="product-price">
                                KES {{$Pro->price}}
                            </div><!-- End .product-price -->

                            <div class="product-content">
                                <p> {!!html_entity_decode($Pro->meta)!!}</p>
                            </div><!-- End .product-content -->


                            <div class="product-details-action">
                                <div class="details-action-col">
                                    <a href="{{url('/')}}/shopping-cart/add-to-cart/{{$Pro->id}}" class="btn-product btn-cart"><span>add to cart</span></a>
                                </div><!-- End .details-action-col -->

                            </div><!-- End .product-details-action -->
                        </div><!-- End .product-details -->
                        {{--  --}}
                        <div class="product-details-tab">
                            <ul class="nav nav-pills justify-content-center" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab" role="tab" aria-controls="product-desc-tab" aria-selected="true">Description</a>
                                </li>
                            
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel" aria-labelledby="product-desc-link">
                                    <div class="product-desc-content">
                                        <h3>Product Information</h3>
                                        <p>{!!html_entity_decode($Pro->content)!!}</p>
                                    </div><!-- End .product-desc-content -->
                                </div><!-- .End .tab-pane -->
                            </div><!-- End .tab-content -->
                        </div><!-- End .product-details-tab -->
                        {{--  --}}
                    </div><!-- End .col-md-6 -->
                    @endforeach
                    @endforeach
                    @endif
                </div><!-- End .row -->
            </div><!-- End .product-details-top -->

            {{--  --}}

            {{--  --}}
        </div><!-- End .container -->
    </div><!-- End .page-content -->
 </main><!-- End .main -->

@endif
  


       
   
       
@endsection