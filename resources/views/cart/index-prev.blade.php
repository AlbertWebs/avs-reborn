@extends('front.master')
@section('content')
<br><br>
@if($CartItems->isEmpty())	

	<!-- <section style="padding-top:100px" id="cart_items">
		<div class="container">
			
			<div class="table-responsive cart_info">
			
				<center><h2>Your Cart Is Empty <i class="fa fa-frown-o"></i></h2>
				<a id="verifyCoupon" class="btn btn-default update" href="{{url('/products')}}">Our Products</a>
				<a id="verifyCoupon" class="btn btn-default update" href="{{url('/services')}}">Our Services</a>
			</center>
				
			
			</div>
		</div>
	</section>  -->
  <section class="emty_cart_area p_100">
      <div class="container">
          <div class="emty_cart_inner">
              <i class="icon-handbag icons"></i>
              <h3>Your Cart is Empty</h3>
              <h4>back to <a href="{{url('/classifieds')}}">shopping</a></h4>
          </div>
      </div>
  </section>
  <!--/#cart_items-->
@else

<div id="cart-page-contain">
    <div class="container">
      <div class="row">
        <div class="col-md-9 col-xs-12"> 
          <!-- left block Start  -->
          <div class="cart-content table-responsive">
            <table class="cart-table table-responsive" style="width:100%">
              <tbody class="weighty-font">
                <tr class="Cartproduct carttableheader">
                  <td style="width:15%"> Product</td>
                  <td style="width:45%">Details</td>
                  <td style="width:10%">Quantity</td>
                  
                  <td style="width:15%">Total</td>
                  <td class="delete" style="width:10%">&nbsp;</td>
                </tr>
                @foreach($CartItems as $CartItem)
                <?php 
                                $Products = DB::table('product')->where('id',$CartItem->id)->get();
                ?>
                @foreach($Products as $Product)
                <tr class="Cartproduct">
                  <td ><div class="image"><a href="{{url('')}}/classifieds/{{$Product->code}}"><img alt="img" width="100" src="{{url('/')}}/uploads/product/{{$Product->image_one}}"></a></div></td>
                  <td><div class="product-name">
                      <h4><a style="color:#66139B;" href="{{url('')}}/classifieds/{{$Product->code}}">{{$Product->name}} </a></h4>
                    </div>
                    <span class="size">{{$Product->meta}}</span>
                    <div class="price"><span>KSH {{$Product->price}}</span></div></td>
                  <td class="product-quantity"><div class="quantity">
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
                    </div></td>
                  
                  <td class="price">KSH {{$CartItem->total}}</td>
                  <td class="delete"><a style="color:#66139B" href="{{url('/')}}/cart/destroy/{{$CartItem->rowId}}" title="Delete"> <i class="fa fa-trash "></i></a></td>
                </tr>
                @endforeach
                @endforeach
              
              </tbody>
            </table>
          </div>
          <div class="cart-bottom">
            <div class="box-footer">
              <div class="pull-left"><a style="background-color:#66139B;  color:#ffffff;" class="btn btn-default" href="{{url('/classifieds')}}"> <i class="fa fa-arrow-left"></i> &nbsp; Continue shopping </a></div>
              <div class="pull-right">
                <!-- <a class="btn btn-default" style="background-color:#66139B;  color:#ffffff;" href="{{url('cart/checkout')}}"><i class="fa fa-long-arrow-right"></i> &nbsp; Proceed </a> -->
              </div>
            </div>
          </div>
          <!-- left block end  --> 
        </div>
        <div class="col-md-3 col-xs-12"> 
          <!-- right block Start  -->
          <div id="right">
            <div class="sidebar-block">
              <div class="sidebar-widget">
                <div class="sidebar-title weighty-font">
                  <h4>Cart Summary</h4>
                </div>
                <div id="order-detail-content" class="title-toggle table-block">
                  <div class="carttable">
                    <table class="table" id="cart-summary">
                      <tbody>
                        <tr>
                          <td class="weighty-font">Total products</td>
                          <td class="price">KSH {{Cart::subtotal()}}</td>
                        </tr>
                        <tr>
                          <td class="weighty-font">Shipping</td>
                          <td class="price"><span class="success"><a style="color:#66139B;" href="{{url('/shipping-policy')}}" target="new"> May include a small fee</a></span></td>
                        </tr>
                       
                        <tr>
                          <td class="weighty-font">Total tax</td>
                          <td id="total-tax" class="price">KSH KSH {{Cart::tax()}}</td>
                        </tr>
                        <tr>
                          <td class="weighty-font"> Total</td>
                          <td id="total-price">KSH {{Cart::total()}}</td>
                        </tr>
                        <tr>
                          <td colspan="2"><div class="input-append couponForm">
                          <!-- <form>
                              <input type="text" placeholder="Gift or Coupon code" id="appendedInputButton">
                              <button type="button" class="col-lg-4 btn btn-success">Apply!</button>
                          </form> -->
                            </div></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="checkout"> <a style="background-color:#66139B;  color:#ffffff;" href="{{url('/cart/checkout')}}" title="checkout" class="btn btn-default ">Proceed to checkout</a> </div>
            </div>
          </div>
          <!-- left block end  --> 
        </div>
      </div>
    </div>
  </div>
				
@endif

<script type="text/javascript">
            
            @foreach($CartItems as $cartItem)
            
            var count{{$cartItem->id}} = 1;
            var countE1{{$cartItem->id}} = document.getElementById("count{{$cartItem->id}}");
            
            
            function plus_{{$cartItem -> id}}(){
                
                count{{$cartItem->id}}++;
                countE1{{$cartItem->id}}.value = count{{$cartItem->id}};
                
            }
            function minus_{{$cartItem -> id}}(){
                
                
                if (count{{$cartItem->id}} > 1){
                    count{{$cartItem->id}}--;
                    countE1{{$cartItem->id}}.value = count{{$cartItem->id}};
                    
                }
            }
            @endforeach
            </script>

@endsection