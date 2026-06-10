<div class="header-right">
    <div class="header-dropdown-link">
        @if(Auth::check())

           <?php $UserID = Auth::user()->id; ?>
           <a href="{{url('/wishlist')}}" class="wishlist-link">
            <i class="icon-heart-o"></i>
            <span class="wishlist-count">0</span>
            {{-- <span class="wishlist-count"><?php $CountWishList = Wishlist::count($UserID); echo $CountWishList; ?></span> --}}
            <span class="wishlist-txt">Wishlist</span>
        </a>
        @else
        <?php
            // Get User IP
            $UserIP = \Request::ip();
        ?>
        <a href="{{url('/wishlist')}}" class="wishlist-link">
            <i class="icon-heart-o"></i>
            <span class="wishlist-count">0</span>
            {{-- <span class="wishlist-count"><?php $CountWishList = Wishlist::count($UserIP, 'session'); echo $CountWishList; ?></span> --}}
            <span class="wishlist-txt">Wishlist</span>
        </a>
        @endif
        <?php
            $CartItems = Cart::content();
        ?>
        <div class="dropdown cart-dropdown">
            <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                <i class="icon-shopping-cart"></i>
                <span class="cart-count">{{ Cart::count() }}</span>
                <span class="cart-txt">Cart</span>
            </a>

            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-cart-products">
                    @foreach($CartItems as $CartItem)
                    <?php
                    $ProductsForCart = DB::table('product')->where('id', $CartItem->id)->get();
                    ?>
                    @foreach($ProductsForCart as $Product)
                    <div class="product">
                        <div class="product-cart-details">
                            <h4 class="product-title">
                                <a href="{{url('/')}}/product/{{$Product->slung}}">{{$Product->name}}</a>
                            </h4>

                            <span class="cart-product-info">
                                <span class="cart-product-qty">{{$CartItem->qty}}</span>
                                x KES{{$Product->price}}
                            </span>
                        </div><!-- End .product-cart-details -->

                        <figure class="product-image-container">
                            <a href="{{url('/')}}/product/{{$Product->slung}}" class="product-image">
                                <img src="{{url('/')}}/uploads/product/{{$Product->image_one}}" alt="{{$Product->name}}">
                            </a>
                        </figure>
                        <a href="{{url('/')}}/shopping-cart/remove-from-cart/{{$CartItem->rowId}}" class="btn-remove" title="Remove Product"><i class="icon-close"></i></a>
                    </div><!-- End .product -->
                    @endforeach
                    @endforeach
                </div><!-- End .cart-product -->
                @if(Session::has('coupon'))
                <div class="dropdown-cart-total">
                    <span>Coupon</span>

                    <span class="cart-total-price">KES{{ Session::get('coupon')}}</span>
                </div><!-- End .dropdown-cart-total -->
                @endif

                @if(Session::has('coupon'))
                <div class="dropdown-cart-total">
                    <span>Subtotal</span>

                    <span class="cart-total-price">KES{{Cart::subtotal()}}</span>
                </div><!-- End .dropdown-cart-total -->
                <div class="dropdown-cart-total">
                    <span>Total</span>

                    <span class="cart-total-price">KES{{ Session::get('coupon-total')}}</span>
                </div><!-- End .dropdown-cart-total -->
                @else
                <div class="dropdown-cart-total">
                    <span>Total</span>

                    <span class="cart-total-price">KES{{Cart::subtotal()}}</span>
                </div><!-- End .dropdown-cart-total -->
                @endif

                <div class="dropdown-cart-action">
                    <a href="{{url('/shopping-cart')}}" class="btn btn-primary">View Cart</a>
                    <a href="{{url('/shopping-cart')}}/checkout" class="btn btn-outline-primary-2"><span>Checkout</span><i class="icon-long-arrow-right"></i></a>
                </div><!-- End .dropdown-cart-total -->
            </div><!-- End .dropdown-menu -->
        </div><!-- End .cart-dropdown -->
    </div>
</div><!-- End .header-right -->
