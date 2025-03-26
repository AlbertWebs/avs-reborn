@extends('front.master-pages')
@section('content')

            
          
            @if($CartItems->isEmpty())
            <section class="emty_cart_area p_100">
                <div class="container">
                    <div class="emty_cart_inner">
                        <i class="icon-handbag icons"></i>
                        <h3>Your Cart is Empty</h3>
                        <h4>back to <a href="{{url('/products')}}/shop-by-category">shopping</a></h4>
                    </div>
                </div>
            </section>
              <!--/#cart_items-->
            @else
            {{--  --}}
            <main class="main">
                <div class="page-header text-center" style="background-image: url('{{asset('theme/assets/images/page-header-bg.jpg')}}')">
                    <div class="container">
                        <h1 class="page-title">Shopping Cart<span>Shop</span></h1>
                    </div><!-- End .container -->
                </div><!-- End .page-header -->
                <nav aria-label="breadcrumb" class="breadcrumb-nav">
                    <div class="container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{url('/products')}}/shop-by-category">Shop</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
                        </ol>
                    </div><!-- End .container -->
                </nav><!-- End .breadcrumb-nav -->
    
                <div class="page-content">
                    <div class="cart">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-9">
                                    <table class="table table-cart table-mobile">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                                <th></th>
                                            </tr>
                                        </thead>
    
                                        <tbody>
                                            @foreach($CartItems as $CartItem)
                                            <?php 
                                                            $Products = DB::table('product')->where('id',$CartItem->id)->get();
                                            ?>
                                            @foreach($Products as $Product)
                                            <tr>
                                                <td class="product-col">
                                                    <div class="product">
                                                        <figure class="product-media">
                                                            <a href="{{url('')}}/product/{{$Product->slung}}">
                                                                <img src="{{url('/')}}/uploads/product/{{$Product->image_one}}" alt="{{$Product->name}}" alt="Product image">
                                                            </a>
                                                        </figure>
    
                                                        <h3 class="product-title">
                                                            <a href="{{url('')}}/product/{{$Product->slung}}">{{$Product->name}}</a>
                                                        </h3><!-- End .product-title -->
                                                    </div><!-- End .product -->
                                                </td>
                                                <td class="price-col">KES {{$Product->price}}</td>
                                                <td class="quantity-col">
                                                    <form id="updateQTY_{{$CartItem->rowId}}">
                                                        @csrf
                                                        <input type="hidden" name="rowID_{{$CartItem->rowId}}" value="{{$CartItem->rowId}}">
                                                        <div class="cart-product-quantity">
                                                            <input name="qty_{{$CartItem->rowId}}" type="number" class="form-control" value="{{$CartItem->qty}}" min="1" max="10" step="1" data-decimals="0" required> 
                                                            
                                                        </div><!-- End .cart-product-quantity -->
                                                        <button style="border:0;" type="submit" class="btn-outline-dark-2"><span>Update</span><i class="icon-refresh"></i></button>
                                                        <br><br>
                                                        <span class="hide_{{$CartItem->rowId}}">Updating...</span>
                                                    </form>
                                                </td>
                                                <td class="total-col"><small><strong> {{$CartItem->total}}</strong></small></td>
                                                <td class="remove-col"><a href="{{url('/')}}/shopping-cart/remove-from-cart/{{$CartItem->rowId}}" class="btn-remove"><i class="icon-close"></i></a></td>
                                            </tr>
                                            @endforeach
                                            @endforeach
                                          
                                        </tbody>
                                    </table><!-- End .table table-wishlist -->
    
                                    <div class="cart-bottom">
                                        @if(Auth::user())
                                        <div class="cart-discount">
                                            <form action="#"  method="POST" id="submit-coupon">
                                                <div class="input-group">
                                                    <input type="text" name="code" class="form-control" required placeholder="coupon code">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-primary-2" type="submit"><i class="icon-long-arrow-right"></i></button>
                                                    </div><!-- .End .input-group-append -->
                                                </div><!-- End .input-group -->
                                            </form>
                                            <br>
                                            <p id="coupon-processing" style="color:#66139B; font-weight:600;">Processing....</p>
                                            
                                        </div><!-- End .cart-discount -->
                                        

                                        @endif
    
                                        <a href="{{url('/')}}/wishlist/" class="btn btn-outline-dark-2"><span>Go To WishList</span><i class="icon-heart"></i></a>
                                    </div><!-- End .cart-bottom -->
                                </div><!-- End .col-lg-9 -->
                                <aside class="col-lg-3">
                                    <div class="summary summary-cart">
                                        <h3 class="summary-title">Cart Summary</h3><!-- End .summary-title -->
    
                                        <table class="table table-summary">
                                            <tbody>
                                                <tr class="summary-subtotal">
                                                    <td>Subtotal:</td>
                                                    <td>KES {{Cart::subtotal()}}</td>
                                                </tr><!-- End .summary-subtotal -->
                                                <tr class="summary-shipping">
                                                    <td>Summary:</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                @foreach($CartItems as $CartItem)
                                                <?php 
                                                                $Products = DB::table('product')->where('id',$CartItem->id)->get();
                                                ?>
                                                @foreach($Products as $Product)
                                                <tr class="summary-shipping-row" style="border-bottom:1px solid">
                                                    <td>
                                                        <div class="">
                                                            <label class="custom-control-label" for="free-shipping">{{$Product->name}} x {{$CartItem->qty}}</label>
                                                        </div><!-- End .custom-control -->
                                                    </td>
                                                    <td>KES {{$Product->price}}</td>
                                                </tr><!-- End .summary-shipping-row -->
                                                @endforeach
                                                @endforeach
    
                                                <tr class="summary-shipping-estimate">
                                                    <td>Estimate for Your Country<br> <a href="{{url('/')}}/dashboard">Change address</a></td>
                                                    <td>&nbsp;</td>
                                                </tr><!-- End .summary-shipping-estimate -->
    
                                                <tr class="summary-total">
                                                    <td>Total:</td>
                                                    <td>{{Cart::total()}}</td>
                                                </tr><!-- End .summary-total -->
                                            </tbody>
                                        </table><!-- End .table table-summary -->
    
                                        <a href="{{url('/')}}/shopping-cart/checkout" class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO CHECKOUT</a>
                                    </div><!-- End .summary -->
    
                                    <a href="{{url('/')}}/products/shop-by-category" class="btn btn-outline-dark-2 btn-block mb-3"><span>CONTINUE SHOPPING</span><i class="icon-refresh"></i></a>
                                </aside><!-- End .col-lg-3 -->
                            </div><!-- End .row -->
                        </div><!-- End .container -->
                    </div><!-- End .cart -->
                </div><!-- End .page-content -->
            </main><!-- End .main -->
            {{--  --}}
            @endif

          
@endsection