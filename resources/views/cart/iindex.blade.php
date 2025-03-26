@extends('front.master')
@section('content')
 <!--================Categories Banner Area =================-->
        <section class="solid_banner_area">
            <div class="container">
                <div class="solid_banner_inner">
                    <h3>shopping cart</h3>
                    <ul>
                        <li><a href="{{url('/')}}">Home</a></li>
                        <li><a href="{{url('/cart')}}">Shopping cart</a></li>
                    </ul>
                </div>
            </div>
        </section>  
        <!--================End Categories Banner Area =================-->
        
        <!--================Shopping Cart Area =================-->
        @if($CartItems->isEmpty())
        <section class="shopping_cart_area p_100">
            <div class="container">
                <div class="table-responsive cart_info"> 
          
                  <center><h2>Your Cart Is Empty <i class="fa fa-frown-o"></i></h2>
                    <a id="verifyCoupon" class="btn btn-default update" href="{{url('/products')}}">Our Products</a>
                    <a id="verifyCoupon" class="btn btn-default update" href="{{url('/services')}}">Our Services</a>
                  </center>
                    
                
                </div>
            </div>
        </section>
        @else
        <section class="shopping_cart_area p_100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="cart_product_list">
                            <h3 class="cart_single_title">Your Cart</h3>
                            <div class="table-responsive-md">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">product Detail</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($CartItems as $CartItem)
                                        <?php 
                                                        $Products = DB::table('product')->where('id',$CartItem->id)->get();
                                        ?>
                                        @foreach($Products as $Product)
                                        <tr>
                                            
                                            <td>
                                                <div class="media">
                                                    <div class="d-flex">
                                                        <img  width="100" src="{{url('/')}}/uploads/product/{{$Product->image_one}}" alt="">
                                                    </div>
                                                    <div class="media-body"> 
                                                        <h4><a style="color:#66139B" href="{{url('')}}/classifieds/{{$Product->name}}">{{$Product->name}} </a></h4>
                                                        <span class="size">{{$Product->meta}}</span>
                                                    </div>
                                                </div>
                                                <p>KSH {{$CartItem->total}}</p>
                                            </td>
                                            
                                            <td>

                                            <form action="{{url('/cart/update')}}/{{$CartItem->rowId}}" id="myform_{{$Product->id}}" method="post">
                                                <center>
                                                    <input type="number" size="4" class="input-text qty text" title="Qty" value="{{$CartItem->qty}}" name="qty" min="0" step="1" id="count{{$CartItem->id}}" autocomplete="off">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <center>
                                                      <a style="color:#66139B; cursor: pointer;"  onclick="document.getElementById('myform_{{$Product->id}}').submit()" ><span class="fa fa-undo" ></span> Update</a>
                                                    </center>
                                                    <noscript>
                                                      <input type="submit" value="Submit form!" />
                                                    </noscript>
                                            </form>
                                            <br>
                                            <a style="color:#66139B" href="{{url('/')}}/cart/destroy/{{$CartItem->rowId}}" title="Delete"> <i class="fa fa-trash"></i></a>
                                            </td>
                                            <td><p>KSH {{$CartItem->total}}</p></td>
                                        </tr>
                                    @endforeach
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- <div class="calculate_shoping_area">
                            <h3 class="cart_single_title">Calculate Shoping <span><i class="icon_minus-06"></i></span></h3>
                            <div class="calculate_shop_inner">
                                <form class="calculate_shoping_form row" action="contact_process.php" method="post" id="contactForm" novalidate="novalidate">
                                    <div class="form-group col-lg-12">
                                        <select class="selectpicker">
                                            <option>United State America (USA)</option>
                                            <option>United State America (USA)</option>
                                            <option>United State America (USA)</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <input type="text" class="form-control" id="state" name="state" placeholder="State / Country">
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <input type="text" class="form-control" id="zip" name="zip" placeholder="Postcode / Zip">
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <button type="submit" value="submit" class="btn submit_btn form-control">update totals</button>
                                    </div>
                                </form>
                            </div>
                        </div> -->
                    </div>
                    <div class="col-lg-4">
                        <div class="total_amount_area">
                            <!-- <div class="cupon_box">
                                <h3 class="cart_single_title">Discount Coupon</h3>
                                <div class="cupon_box_inner">
                                    <input type="text" placeholder="Enter your code here">
                                    <button type="submit" class="btn btn-primary subs_btn">Apply Coupon</button>
                                </div>
                            </div> -->
                            <div class="cart_totals">
                                <h3 class="cart_single_title">Cart Totals</h3>
                                <div class="cart_total_inner">
                                    <ul>
                                        <li><a href="#"><span>Subtotal</span><small> {{Cart::total()}}</small></a></li>
                                        <!-- Do the Location Trick Here -->
                                        <li><a href="#"><span>Shipping</span> <small>Free</small></a></li>
                                        <li><a href="#"><span>Totals</span> <small>{{Cart::total()}}</small> </a></li>
                                    </ul>
                                </div>
                                <a href="{{url('/classifieds')}}" type="submit" class="btn btn-primary update_btn">Back</a>
                                <a href="{{url('cart/checkout')}}" type="submit" class="btn btn-primary checkout_btn">proceed to checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================End Shopping Cart Area =================-->
        @endif
@endsection