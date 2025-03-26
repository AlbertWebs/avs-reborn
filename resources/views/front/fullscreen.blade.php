
<div class="fullscreen-container bg-white">
	<div class="quickView-content container">
		<div class="row justify-content-center">
			<div class="product-fullscreen col-md-10 text-center">
                <p class="mb-1"><span class="curidx">1</span> / 4</p>
				<div class="owl-carousel owl-theme owl-nav-inside owl-light mb-0" data-toggle="owl" data-owl-options='{
                    "dots": true,
                    "nav": false, 
                    "URLhashListener": true,
                    "responsive": {
                        "1200": {
                            "nav": true,
                            "dots": false
                        }
                    }
                }'>
                @foreach($Product as $Pro)
					<div class="intro-slide" data-hash="one">
                        <img src="{{url('/')}}/uploads/product/{{$Pro->thumbnail}}" alt="{{$Pro->name}}">
                    </div><!-- End .intro-slide -->

                    <div class="intro-slide" data-hash="two">
                        <img src="{{url('/')}}/uploads/product/{{$Pro->image_one}}" alt="Image Desc">
                    </div><!-- End .intro-slide -->

                    <div class="intro-slide" data-hash="three">
                        <img src="{{url('/')}}/uploads/product/{{$Pro->fb_pixels}}" alt="Image Desc">
                    </div><!-- End .intro-slide -->
                    @if($Pro->image_three == '0' or $Pro->image_three == null)

                    @else
                    <div class="intro-slide" data-hash="four">
                        <img src="{{url('/')}}/uploads/product/{{$Pro->image_three}}" alt="Image Desc">
                    </div><!-- End .intro-slide -->
                    @endif
                @endforeach
                </div>

                <div class="carousel-dots">
					<a href="#one" class="carousel-dot active">
						<img src="{{url('/')}}/uploads/product/{{$Pro->thumbnail}}">
					</a>
					<a href="#two" class="carousel-dot">
						<img src="{{url('/')}}/uploads/product/{{$Pro->image_one}}">
					</a>
					<a href="#three" class="carousel-dot">
						<img src="{{url('/')}}/uploads/product/{{$Pro->fb_pixels}}">
					</a>
                    @if($Pro->image_three == '0' or $Pro->image_three == null)

                    @else
					<a href="#four" class="carousel-dot">
						<img src="{{url('/')}}/uploads/product/{{$Pro->image_three}}">
					</a>
                    @endif
                </div>

			</div>
		</div>
	</div>
</div>