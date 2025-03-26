@foreach ($Product as $Pro)
{{--  --}}
<!DOCTYPE html>
<html lang="en">
<head>
<?php $SiteSettings = DB::table('sitesettings')->get() ?>
    @foreach ($SiteSettings as $Settings)    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    {{-- SEO --}}
    {!! SEOMeta::generate() !!}
        <?php $ProductC = 1; ?>
        @foreach($Product as $tProduct)
        <meta property="og:description" content="{{$tProduct->name}}">
        <meta property="og:image" content="{{url('/')}}/uploads/product/{{$tProduct->image_one}}" />
        <meta property="fb:app_id" content="350937289315471" />
        <meta property=”og:id” content=”{{$tProduct->id}}” />
            
        @if ($ProductC == 1)
            @break
        @endif
        <?php $ProductC = $ProductC+1; echo $ProductC; ?>
        @endforeach
        {!! OpenGraph::generate() !!}
        {!! Twitter::generate() !!}
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:creator" content="@accessories254" />
        <!-- SEO -->
	@endforeach
</head>
{{--  --}}
<div class="container quickView-container">
	<div class="quickView-content">
		<div class="row">
			<div class="col-lg-7 col-md-6">
				<div class="row">
					<div class="product-left">
						<a href="#one" class="carousel-dot active">
							<img src="{{url('/')}}/uploads/product/{{$Pro->image_one}}">
						</a>
						<a href="#two" class="carousel-dot">
							<img src="{{url('/')}}/uploads/product/{{$Pro->fb_pixels}}">
						</a>
						@if($Pro->image_three == '0' or $Pro->image_three == null)

						@else
						<a href="#three" class="carousel-dot">
							<img src="{{url('/')}}/uploads/product/{{$Pro->image_three}}">
						</a>
						@endif
						@if($Pro->image_two == '0' or $Pro->image_two == null)

						@else
						<a href="#four" class="carousel-dot">
							<img src="{{url('/')}}/uploads/product/{{$Pro->image_two}}">
						</a>
						@endif
					</div>
					<div class="product-right">
						<div class="owl-carousel owl-theme owl-nav-inside owl-light mb-0" data-toggle="owl" data-owl-options='{
	                        "dots": false,
	                        "nav": false, 
	                        "URLhashListener": true,
	                        "responsive": {
	                            "900": {
	                                "nav": true,
	                                "dots": true
	                            }
	                        }
	                    }'>
							<div class="intro-slide" data-hash="one">
	                            <img src="{{url('/')}}/uploads/product/{{$Pro->image_one}}" alt="{{$Pro->name}}">
	                            <a href="{{url('/')}}/fullscreen/{{$Pro->slung}}" class="btn-fullscreen">
                                    <i class="icon-arrows"></i>
                                </a>
		                    </div><!-- End .intro-slide -->

		                    <div class="intro-slide" data-hash="two">
	                            <img src="{{url('/')}}/uploads/product/{{$Pro->image_one}}" alt="{{$Pro->name}}">
	                            <a href="{{url('/')}}/fullscreen/{{$Pro->slung}}" class="btn-fullscreen">
                                    <i class="icon-arrows"></i>
                                </a>
		                    </div><!-- End .intro-slide -->

		                    <div class="intro-slide" data-hash="three">
	                            <img src="{{url('/')}}/uploads/product/{{$Pro->fb_pixels}}" alt="{{$Pro->name}}">
	                            <a href="{{url('/')}}/fullscreen/{{$Pro->slung}}" class="btn-fullscreen">
                                    <i class="icon-arrows"></i>
                                </a>
		                    </div><!-- End .intro-slide -->
							@if($Pro->image_three == '0' or $Pro->image_three == null)

							@else
		                    <div class="intro-slide" data-hash="four">
	                            <img src="{{url('/')}}/uploads/product/{{$Pro->image_three}}" alt="{{$Pro->name}}">
	                            <a href="{{url('/')}}/fullscreen/{{$Pro->slung}}" class="btn-fullscreen">
                                    <i class="icon-arrows"></i>
                                </a>
		                    </div><!-- End .intro-slide -->
							@endif
		                </div>
					</div>
                </div>
			</div>
			<div class="col-lg-5 col-md-6">
				<h2 class="product-title">{{$Pro->name}}</h2>
				<h3 class="product-price">KES {{$Pro->price}}</h3>

                <div class="ratings-container">
                    <div class="ratings">
                        <div class="ratings-val" style="width: 90%;"></div><!-- End .ratings-val -->
                    </div><!-- End .ratings -->
                    <span class="ratings-text">( 2 Reviews )</span>
                </div><!-- End .rating-container -->

                <p class="product-txt">{!! html_entity_decode($Pro->meta, ENT_QUOTES, 'UTF-8') !!}</p>


                

	            
                <div class="details-filter-row details-row-size">
                    <label for="qty">Qty:</label>
                    <div class="product-details-quantity">
                        <input type="number" id="qty" class="form-control" value="1" min="1" max="10" step="1" data-decimals="0" required>
                    </div><!-- End .product-details-quantity -->
                </div><!-- End .details-filter-row -->

                <div class="product-details-action">
                    <div class="details-action-wrapper">
                        <a href="#" class="btn-product btn-wishlist" title="Wishlist"><span>Add to Wishlist</span></a>
                        <a href="#" class="btn-product btn-compare" title="Compare"><span>Add to Compare</span></a>
                    </div><!-- End .details-action-wrapper -->
                    <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                </div>

                <div class="product-details-footer">
                    <div class="product-cat">
                        <span>Category:</span>
						<?php $Category = DB::table('category')->where('id',$Pro->cat)->get(); ?>
						@foreach ($Category as $Cat)
                        <a href="{{url('/products')}}/{{$Cat->slung}}"> {{$Cat->cat}} </a> |
						@endforeach
                        <a href="#">Brand</a>:
                        <a href="{{url('/')}}/products/brand/{{$Pro->brand}}">{{$Pro->brand}}</a>
                    </div><!-- End .product-cat -->

                    <div class="social-icons social-icons-sm">
                        <span class="social-label">Share:</span>
                        <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                        <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                        <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                        <a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>
</html>
@endforeach
