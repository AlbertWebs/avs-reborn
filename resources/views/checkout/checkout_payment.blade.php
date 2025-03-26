@extends('front.master-payments')
@section('content')
  <!-- offer block end  --> 
 <br>
  

        {{--  --}}
        <main class="main">
        	<div class="page-header text-center" style="background-image: url('{{asset('theme/assets/images/page-header-bg.jpg')}}')">
        		<div class="container">
        			<h1 class="page-title">Checkout<span>Shop</span></h1>
        		</div><!-- End .container -->
        	</div><!-- End .page-header -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/')}}/shopping-cart">Shopping Cart</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/')}}/shopping-cart">Checkout</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Choose Payment Method</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
            	<div class="checkout">
	                <div class="container">
            		
                        <p id="coupon-processing" style="color:#66139B; font-weight:600;">Processing....</p>
                        {{-- <p id="remove-coupon" style="color:#66139B; font-weight:600;"><a href="">Remove</a></p> --}}
            			<form action="#" id="updateSettings">
                            {{csrf_field()}}
		                	<div class="row">
		                		<div class="col-lg-9">
		                			<h2 class="checkout-title">Billing Details</h2><!-- End .checkout-title -->
		                				<div class="row">
		                					<div class="col-sm-6">
		                						<label>First Name *</label>
		                						<input value="{{Auth::user()->name}}" type="text" name="name" class="form-control" required>
		                					</div><!-- End .col-sm-6 -->
                                            <div class="col-sm-6">
		                						<label>Country</label>
		                						<input value="{{Auth::user()->country}}" name="country" type="text" class="form-control">
		                					</div><!-- End .col-sm-6 -->
		                				</div><!-- End .row -->

                                        <div class="row">
                                            <div class="col-sm-6">
		                						<label>*City</label>
		                						<input type="text" value="{{Auth::user()->location}}" name="location" class="form-control" placeholder="Appartments, suite, unit etc ..." >
		                					</div><!-- End .col-sm-6 -->
		                					<div class="col-sm-6">
		                						<label>Street address *</label>
	            						        <input type="text" value="{{Auth::user()->address}}" name="address" class="form-control" placeholder="House number and Street name" required>
		                					</div><!-- End .col-sm-6 -->
                                           
		                				</div><!-- End .row -->

                                        <div class="row">
		                					<div class="col-sm-6">
		                						<label>Email address *</label>
	        							        <input type="email" value="{{Auth::user()->email}}" name="email" class="form-control" readonly required>
		                					</div><!-- End .col-sm-6 -->
                                            <div class="col-sm-6">
                                                <label>Mobile *</label>
                                                <input type="text" value="{{Auth::user()->mobile}}" name="mobile" class="form-control" required>
                                            </div>
		                				</div><!-- End .row -->
	            						
                                        <label>Order notes (optional)</label>
	        							<textarea class="form-control" cols="30" rows="4" name="notes" placeholder="Notes about your order, e.g. special notes for delivery"></textarea>
	            						
	            					
	                					
		                		</div><!-- End .col-lg-9 -->
                                @if(Session::has('coupon'))
                                <aside class="col-lg-3">
		                			<div class="summary">
		                				<h3 class="summary-title">Your Order #{{$OrderNumberNumber}}</h3><!-- End .summary-title -->

		                				<table class="table table-summary">
		                					<thead>
		                						<tr>
		                							<th>Product</th>
		                							<th>Total</th>
		                						</tr>
		                					</thead>

		                					<tbody>
                                                @foreach($CartItems as $CartItem)
                                                <?php 
                                                                $Products = DB::table('product')->where('id',$CartItem->id)->get();
                                                ?>
                                                @foreach($Products as $Product)
		                						<tr>
		                							<td><a href="{{url('/')}}/product/{{$Product->slung}}">{{$Product->name}} <strong>x</strong> {{$CartItem->qty}}</a></td>
		                							<td>KES {{$CartItem->price}}</td>
		                						</tr>
                                                @endforeach
                                                @endforeach

		                						
		                						<tr class="summary-subtotal">
		                							<td>Subtotal:</td>
		                							<td>{{Cart::subtotal()}}</td>
		                						</tr><!-- End .summary-subtotal -->
		                						<tr>
		                							<td>Shipping:</td>
		                							<td>KES {{$Shipping}}</td>
		                						</tr>
                                                <tr>
		                							<td>Coupon Discount:</td>
		                							<td>KES {{ Session::get('coupon')}}</td>
		                						</tr>
                                            
		                						<tr class="summary-total">
		                							<td>Total:</td>
		                							<td>KES
                                                        <?php 
                                                          //remove comma   
                                                          $Subtotal = Cart::subtotal();
                                                          $WithCoupon = Session::get('coupon-total');
                                                          $PrepSubtotal = str_replace(',', '', $WithCoupon);
                                                          $WholeSubtotal = ceil($PrepSubtotal);
                                                          $TheTotal = $WholeSubtotal + $Shipping;
                                                          echo $TheTotal;
                                                        ?>
                                                        
                                                     </td>
		                						</tr><!-- End .summary-total -->
		                					</tbody>
		                				</table><!-- End .table table-summary -->

		                				<div class="accordion-summary" id="accordion-payment">
										    <div class="card">
										        <div class="card-header" id="heading-1">
										            <h2 class="card-title">
										                <a role="button" data-toggle="collapse" href="#collapse-1" aria-expanded="true" aria-controls="collapse-1">
										                    M-PESA PayBill
										                </a>
										            </h2>
										        </div><!-- End .card-header -->
										        <div id="collapse-1" class="collapse" aria-labelledby="heading-1" data-parent="#accordion-payment">
										            <div class="card-body">
										                {{--  --}}
                                                        <p>
                                                        <ul style="color:#333333"> 
                                                            <li style="border-bottom:1px solid #666666">Go to your MPESA menu</li>
                                                            <li style="border-bottom:1px solid #666666">Select Lipa Na MPESA</li>
                                                            <li style="border-bottom:1px solid #666666">Select PayBill</li>
                                                            <?php $SettingsTill = DB::table('sitesettings')->get(); ?>
                                                            @foreach($SettingsTill as $set)
                                                            <li style="border-bottom:1px solid #666666">Enter the Business Number <strong>{{$set->till}}</strong> </li>
                                                            @endforeach
                                                            <!-- Invoice Number -->
                                                            <li style="border-bottom:1px solid #666666">Enter Account Number <strong>{{$InvoiceNumber}}</strong></li>
                                                            <!-- Invoice Number -->
                                                            <li style="border-bottom:1px solid #666666">Enter Amount KSH 
                                                              <strong>
                                                              <?php
                                                                if(Session::has('campaign')){
                                                                    $cost = Cart::total();
                                                                    $percentage = 10;
                                                                    $PrepeTotalCart = str_replace( ',', '', $cost );
                                                                    $FormatTotalCart = round($PrepeTotalCart, 0);
                                                                    $discount = ($percentage / 100) * $FormatTotalCart;
                                                                    $TotalCart = ($FormatTotalCart - $discount);
                                                                }else{
                                                                    $cost = Cart::total();
                                                                    $percentage = 10;
                                                                    $WithCoupon = Session::get('coupon-total');
                                                                    $PrepeTotalCart = str_replace( ',', '', $WithCoupon );
                                                                    $FormatTotalCart = round($PrepeTotalCart, 0);
                                                                    $TotalCart = $FormatTotalCart;
                                                                }
    
                                                                  $PrepeTotalCart = str_replace( ',', '', $TotalCart );
                                                                  $FormatTotalCart = round($PrepeTotalCart, 0);
                                                                  $ShippingFee = $Shipping;
                                                                  $TotalCost = $FormatTotalCart+$ShippingFee;
                                                                  echo $TotalCost;
                                                                
                                                              ?>
                                                              </strong>
                                                            </li>
                                                            <li style="border-bottom:1px solid #666666">Then press ok to confirm</li>
                                                            <li style="border-bottom:1px solid #666666">Enter the transaction code below</li>
                                                            <li style="border-bottom:1px solid #666666">Click verify to verify payment</li>
                                                            <form method="POST" action="#" id="verify">
                                                              {{ csrf_field() }}
                                                              <input type="hidden" name="invoice" value="{{$InvoiceNumber}}">
                                                                    <?php
                                                                        if(Session::has('campaign')){
                                                                            $cost = Cart::total();
                                                                            $percentage = 10;
                                                                            $PrepeTotalCart = str_replace( ',', '', $cost );
                                                                            $FormatTotalCart = round($PrepeTotalCart, 0);
                                                                            $discount = ($percentage / 100) * $FormatTotalCart;
                                                                            $TotalCart = ($FormatTotalCart - $discount);
                                                                        }else{
                                                                            $cost = Cart::total();
                                                                            $percentage = 10;
                                                                            $WithCoupon = Session::get('coupon-total');
                                                                            $PrepeTotalCart = str_replace( ',', '', $WithCoupon );
                                                                            $FormatTotalCart = round($PrepeTotalCart, 0);
                                                                            $TotalCart = $FormatTotalCart;
                                                                        }
            
                                                                        $PrepeTotalCart = str_replace( ',', '', $TotalCart );
                                                                        $FormatTotalCart = round($PrepeTotalCart, 0);
                                                                        $ShippingFee = $Shipping;
                                                                        $TotalCost = $FormatTotalCart+$ShippingFee;
                                                                        
                                                                    
                                                                    ?>
                                                              <input type="hidden" name="amount" value="{{$TotalCost}}">
                                                              <div class="col-md-12">
                                                                  <div class="form-group">
                                                                      <p for="email">Enter Your MPESA Transaction Code <span>*</span></p>
                                                                      <input type="text" name="TransactionID" class="form-control" required placeholder="NJL4E9WJ96" id="email" autocomplete="off">
                                                                  </div>
                                                                <div class="pull-left"><button id="veryfyID" class="btn btn-outline-primary-2 btn-order btn-block" type="submit"> Veryfy Payment &nbsp;<i class="fa fa-arrow-right"></i> </button></div>
                                                              </div>
                                                            </form>
    
                                                        </ul>
                                                        </p>
                                                        {{--  --}}
										            </div><!-- End .card-body -->
										        </div><!-- End .collapse -->
										    </div><!-- End .card -->

										    {{-- <div class="card">
										        <div class="card-header" id="heading-2">
										            <h2 class="card-title">
										                <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-2" aria-expanded="false" aria-controls="collapse-2">
										                    Lipa na M-Pesa online
										                </a>
										            </h2>
										        </div>
										        <div id="collapse-2" class="collapse" aria-labelledby="heading-2" data-parent="#accordion-payment">
										            <div class="card-body">
										                
                                                        <form method="POST"  id="stk-submit">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="invoice" value="{{$InvoiceNumber}}">
                                                                  <?php
                                                                      if(Session::has('campaign')){
                                                                          $cost = Cart::total();
                                                                          $percentage = 10;
                                                                          $PrepeTotalCart = str_replace( ',', '', $cost );
                                                                          $FormatTotalCart = round($PrepeTotalCart, 0);
                                                                          $discount = ($percentage / 100) * $FormatTotalCart;
                                                                          $TotalCart = ($FormatTotalCart - $discount);
                                                                      }else{
                                                                          $cost = Cart::total();
                                                                          $WithCoupon = Session::get('coupon-total');
                                                                          $percentage = 10;
                                                                          $PrepeTotalCart = str_replace( ',', '', $WithCoupon );
                                                                          $FormatTotalCart = round($PrepeTotalCart, 0);
                                                                          $TotalCart = $FormatTotalCart;
                                                                      }
          
                                                                      $PrepeTotalCart = str_replace( ',', '', $TotalCart );
                                                                      $FormatTotalCart = round($PrepeTotalCart, 0);
                                                                      $ShippingFee = $Shipping;
                                                                      $TotalCost = $FormatTotalCart+$ShippingFee;
                                                                      
                                                                  
                                                                  ?>
                                                            <input type="hidden" name="amount" value="{{$TotalCost}}">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <p for="email">Enter Your MPESA Phone Number <span>*</span></p>
                                                                    
                                                                    <input type="hidden" value="{{$TotalCost}}" name="Amount">
                                                                    <input type="hidden" value="{{Auth::user()->id}}" name="user_id">
                                                                    <input type="text" value="{{Auth::user()->mobile}}" name="phone_number" class="form-control" required placeholder="254723000000" id="email" autocomplete="off">
                                                                </div>
                                                        
                                                            <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">
                                                                <span class="btn-text">Pay {{$TotalCost}} Now</span>
                                                                
                                                                 &nbsp; <img class="spinner" width="15" src="{{asset('uploads/preloaders/loading.gif')}}" alt="">
                                                            </button>
                                                           
                                                            </div>
                                                        </form>
                                                   
										            </div>
										        </div>
										    </div> --}}

										    <div class="card">
										        <div class="card-header" id="heading-3">
										            <h2 class="card-title">
										                <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-3" aria-expanded="false" aria-controls="collapse-3">
										                    Cash on delivery
										                </a>
										            </h2>
										        </div><!-- End .card-header -->
										        <div id="collapse-3" class="collapse" aria-labelledby="heading-3" data-parent="#accordion-payment">
										            <div class="card-body">
                                                        <form method="POST" action="{{url('/shopping-cart/checkout/placeOrder')}}" id="verify">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="invoice" value="{{$InvoiceNumber}}">
                                                                  <?php
                                                                      if(Session::has('campaign')){
                                                                          $cost = Cart::total();
                                                                          $percentage = 10;
                                                                          $PrepeTotalCart = str_replace( ',', '', $cost );
                                                                          $FormatTotalCart = round($PrepeTotalCart, 0);
                                                                          $discount = ($percentage / 100) * $FormatTotalCart;
                                                                          $TotalCart = ($FormatTotalCart - $discount);
                                                                      }else{
                                                                          $cost = Cart::total();
                                                                          $percentage = 10;
                                                                          $WithCoupon = Session::get('coupon-total');
                                                                          $PrepeTotalCart = str_replace( ',', '', $WithCoupon );
                                                                          $FormatTotalCart = round($PrepeTotalCart, 0);
                                                                          $TotalCart = $FormatTotalCart;
                                                                      }
          
                                                                      $PrepeTotalCart = str_replace( ',', '', $TotalCart );
                                                                      $FormatTotalCart = round($PrepeTotalCart, 0);
                                                                      $ShippingFee = $Shipping;
                                                                      $TotalCost = $FormatTotalCart+$ShippingFee;
                                                                      
                                                                  
                                                                  ?>
                                                            <input type="hidden" name="amount" value="{{$TotalCost}}">
                                                            <div class="col-md-12">
                                                                {{-- <div class="form-group">
                                                                    <textarea class="form-control" cols="30" rows="4" placeholder="Notes about your order, e.g. special notes for delivery" spellcheck="false"></textarea>
                                                                </div> --}}
                                                            {{--  --}}
                                                            <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">
                                                                <span class="btn-text">Place Order Now</span>
                                                                <span class="btn-hover-text">Proceed to Chekout</span>
                                                            </button>
                                                            {{--  --}}
                                                            </div>
                                                        </form>
										            </div><!-- End .card-body -->
										        </div><!-- End .collapse -->
										    </div><!-- End .card -->

										    <div class="card">
										        <div class="card-header" id="heading-4">
										            <h2 class="card-title">
										                <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-4" aria-expanded="false" aria-controls="collapse-4">
										                    PayPal <small class="float-right paypal-link">Conversion charges may apply</small>
										                </a>
										            </h2>
										        </div><!-- End .card-header -->
										        <div id="collapse-4" class="collapse" aria-labelledby="heading-4" data-parent="#accordion-payment">
										            <div class="card-body">
										                {{--  --}}
                                                        <form id="ShowPaypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
                                                            <input type="hidden" name="cmd" value="_cart">
                                                            <input type="hidden" name="upload" value="1">
                                                            <?php $SiteSettings = DB::table('sitesettings')->get(); ?>
                                                            @foreach($SiteSettings as $Sett)
                                                            <input type="hidden" name="business" value="{{$Sett->paypal}}">
                                                            @endforeach
                                                            <!-- Collect Data -->
                                                            <?php $Count = 1; ?>
                                                            @foreach($CartItems as $CartItem)
                                                            <?php 
                                                                $Products = DB::table('product')->where('id',$CartItem->id)->get();
                                                            ?>
                                                            @foreach($Products as $Product)
                                                            <?php 
                                                                  $RawPrice = $Product->price;
                                                                  $dollarPrice = dollar($Product->price);
                                                                  $PaypalCont = 0.029;
                                                                  $paypalCut = $PaypalCont*$dollarPrice;
                                                                  $PaypalToatal = $paypalCut+$dollarPrice;
                                                                  
                                                             ?>
                                                            <input type="hidden" name="item_name_{{$Count}}" value="{{$Product->name}}">
                                                            <input type="hidden" name="amount_{{$Count}}" value="<?php echo $PaypalToatal; ?>"><?php $PaypalToatal; ?>
                                                            <input type="hidden" name="quantity_{{$Count}}" value="{{$CartItem->qty}}">
                                                            <input type="hidden" name="shipping_{{$Count}}" value="<?php echo dollar($Shipping) ?>">
                                                            @endforeach
                                                            <?php $Count = $Count+1;  ?>
                                                            @endforeach
      
                                                            
                                                            
                                                            <input type="hidden" name="cancel_return" id="cancel_return" value="{{url('/')}}/shopping-cart/checkout/payment" />
                                                            <button  style="cursor:pointer" type="submit"><img src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/cc-badges-ppcmcvdam.png" alt="Pay with PayPal Credit or any major credit card" /></button>
                                                          </form>
                                                        {{--  --}}
										            </div><!-- End .card-body -->
										        </div><!-- End .collapse -->
										    </div><!-- End .card -->

										    
										</div><!-- End .accordion -->

		                				<a href="{{url('/')}}/dashboard" type="submit" class="btn btn-outline-primary-2 btn-order btn-block">
		                					<span class="btn-text"><i class="icon-user"></i> My Account</span>
		                					<span class="btn-hover-text">Proceed to My Account</span>
                                            
                                        </a>
		                			</div><!-- End .summary -->
		                		</aside><!-- End .col-lg-3 -->
                                @else
		                		<aside class="col-lg-3">
		                			<div class="summary">
		                				<h3 class="summary-title">Your Order #{{$OrderNumberNumber}}</h3><!-- End .summary-title -->

		                				<table class="table table-summary">
		                					<thead>
		                						<tr>
		                							<th>Product</th>
		                							<th>Total</th>
		                						</tr>
		                					</thead>

		                					<tbody>
                                                @foreach($CartItems as $CartItem)
                                                <?php 
                                                                $Products = DB::table('product')->where('id',$CartItem->id)->get();
                                                ?>
                                                @foreach($Products as $Product)
		                						<tr>
		                							<td><a href="{{url('/')}}/product/{{$Product->slung}}">{{$Product->name}} <strong>x</strong> {{$CartItem->qty}}</a></td>
		                							<td>KES {{$CartItem->price}}</td>
		                						</tr>
                                                @endforeach
                                                @endforeach

		                						
		                						<tr class="summary-subtotal">
		                							<td>Subtotal:</td>
		                							<td>{{Cart::subtotal()}}</td>
		                						</tr><!-- End .summary-subtotal -->
		                						<tr>
		                							<td>Shipping:</td>
		                							<td>KES {{$Shipping}}</td>
		                						</tr>
		                						<tr class="summary-total">
		                							<td>Total:</td>
		                							<td>KES
                                                        <?php 
                                                          //remove comma   
                                                          $Subtotal = Cart::subtotal();
                                                          $PrepSubtotal = str_replace(',', '', $Subtotal);
                                                          $WholeSubtotal = ceil($PrepSubtotal);
                                                          $TheTotal = $WholeSubtotal + $Shipping;
                                                          echo $TheTotal;
                                                        ?>
                                                     </td>
		                						</tr><!-- End .summary-total -->
		                					</tbody>
		                				</table><!-- End .table table-summary -->

		                				
                                        <button  type="submit" class="btn btn-outline-primary-2 btn-order btn-block">
		                					<span class="btn-text"> Save and Proceed <i class="icon-arrow-right"></i> </span>
		                					<span class="btn-hover-text">Proceed to Place Order</span>
                                        </button>
                                        <center><img class="spinner text-center" width="25" src="{{asset('uploads/preloaders/loading.gif')}}" alt=""></center>
                                        <div id="saved" class="text-success text-center">Successful! Redirecting......</div>

		                				
		                			</div><!-- End .summary -->
		                		</aside><!-- End .col-lg-3 -->
                                @endif
		                	</div><!-- End .row -->
            			</form>
	                </div><!-- End .container -->
                </div><!-- End .checkout -->
            </div><!-- End .page-content -->
        </main><!-- End .main -->
        {{--  --}}
     


@endsection