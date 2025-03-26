@extends('front.master-payments')
@section('content')
  <!-- offer block end  --> 
 <br>
  
  <div id="checkout-step-contain">
    <div class="container">
        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{url('/')}}/shopping-cart">Shopping Cart</a></li>
                    <li class="breadcrumb-item"><a href="{{url('/')}}/shopping-cart">Checkout</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Choose Payment Method</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->
        <br>
        <section class="register_area">
            <div class="container">
                <div class="register_inner">
                    <div class="row">
                        <div class="col-lg-10" style="margin:0px auto;">
                            <div class="order_box_price">
                                <h2 class="reg_title text-center">Your Order #{{$OrderNumberNumber}}</h2>
                                <div class="payment_list">
                                    <div class="price_single_cost">
                                    @foreach($CartItems as $CartItem)
                                      <?php 
                                                      $Products = DB::table('product')->where('id',$CartItem->id)->get();
                                      ?>
                                      @foreach($Products as $Product)
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
                                            $PrepeTotalCart = str_replace( ',', '', $cost );
                                            $FormatTotalCart = round($PrepeTotalCart, 0);
                                            $TotalCart = $FormatTotalCart;
                                        }
                                   
                                        ?>
                                        <h5><strong> {{$Product->name}} <span>KES {{$TotalCart}}</span></strong></h5>
                                      @endforeach
                                        
                                      @endforeach

                                      <h5> Shipping <span>{{$Shipping}} </span></h5>
                                      

                                    
                                      <h5> Shipping Infomation<span> {{Auth::user()->name}}, {{Auth::user()->mobile}}, {{Auth::user()->location}}, {{Auth::user()->town}}  &nbsp; &nbsp; &nbsp;<span id="updateShippingBtn" style="color:#66139B; cursor: pointer;" href="#"><i class="fa fa-pencil"></i>   Edit</span></span></h5>
                                      <center>
                                        @if(Session::has('message'))
                                                    <div class="alert alert-success">{{ Session::get('message') }}</div>
                                        @endif
                                        </center>
                                      <!--  -->
                                      <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                            <form method="post" action="{{url('/')}}/cart/checkout/updateShipping" id="updateShippingForm">
                                                {{csrf_field()}}
                                                <div class="login-form">
                                                    <h4 class="login-title">Edit Delivery address</h4>
                                                    <div class="row">
                                                        <div class="col-md-6 col-12 mb-20">
                                                            <label>Full Name</label>
                                                            <input class="mb-0" type="text" name="name" value="{{Auth::user()->name}}" placeholder="First Name">
                                                        </div>
                                                        <div class="col-md-6 col-12 mb-20">
                                                            <label>Mobile*</label>
                                                            <input class="mb-0" type="mobile" name="mobile" value="{{Auth::user()->mobile}}" placeholder="{{Auth::user()->mobile}}">
                                                        </div>
                                                        <input class="mb-0" name="user_id" value="{{Auth::user()->id}}" type="hidden">
                                                        <div class="col-md-6 col-12 mb-20">
                                                            <label>Town*</label>
                                                            <input class="mb-0" type="text" name="town" value="{{Auth::user()->town}}" placeholder="Wangige">
                                                        </div>
                                                        <div class="col-md-6 col-12 mb-20">
                                                            <label>Location*</label>
                                                            <input class="mb-0" type="text" name="location" value="{{Auth::user()->location}}" placeholder="E.g Umoja Estate, Umoja">
                                                        </div>
                                                        
                                                        <div class="col-12">
                                                            <button type="submit" class="register-button mt-0">Update</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                      <!--  -->
                                      <h3><span class="normal_text">Order Totals</span> <span style="color:#66139B">{{Cart::total()}}</span></h3>
                                      @if(Session::has('campaign'))
                                      <h5> Discount <span> <strong>(-10%)</strong> </span></h5>
                                      @endif
                                      <h3><span class="normal_text">Net Total</span> 
                                          <span style="color:#66139B">KES 
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
                                                    $PrepeTotalCart = str_replace( ',', '', $cost );
                                                    $FormatTotalCart = round($PrepeTotalCart, 0);
                                                    $TotalCart = $FormatTotalCart;
                                                 }
                                                 
                                                 $PrepeTotalCart = str_replace( ',', '', $TotalCart );
                                                 $FormatTotalCart = round($PrepeTotalCart, 0);
                                                 $ShippingFee = $Shipping;
                                                 $TotalCost = $FormatTotalCart+$ShippingFee;
                                                 echo $TotalCost;
                                                
                                             ?>
                                          </span>
                                      </h3>
                                      
                                    </div>
                                   
                                    <div id="accordion" role="tablist" class="price_method">
                                        <div class="card">
                                            <div class="card-header" role="tab" id="headingOne">
                                                <h5 class="mb-0">
                                                    <a data-toggle="collapse" href="#collapseOne" role="button" aria-expanded="true" aria-controls="collapseOne">
                                                    Lipa Na MPESA
                                                    </a>
                                                </h5>
                                            </div>

                                            <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                                <div class="card-body">
                                                <!-- <p>All transactions are secure and encrypted. please view our  <a href="{{url('/privacy')}}">privacy policy.</a></p> -->
                                                    <ol style="color:#333333"> 
                                                        <li>Go to your MPESA menu</li>
                                                        <li>Select Lipa Na MPESA</li>
                                                        <li>Select PayBill</li>
                                                        <?php $SettingsTill = DB::table('sitesettings')->get(); ?>
                                                        @foreach($SettingsTill as $set)
                                                        <li>Enter the Business Number <strong>{{$set->till}}</strong> then OK</li>
                                                        @endforeach
                                                        <!-- Invoice Number -->
                                                        <li>Enter Account Number <strong>{{$InvoiceNumber}}</strong></li>
                                                        <!-- Invoice Number -->
                                                        <li>Enter Amount KSH 
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
                                                                $PrepeTotalCart = str_replace( ',', '', $cost );
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
                                                        <li>Then press ok to confirm</li>
                                                        
                                                        <li>Enter the transaction code below</li>
                                                        <li>Click verify to verify payment</li>
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
                                                              $PrepeTotalCart = str_replace( ',', '', $cost );
                                                              $FormatTotalCart = round($PrepeTotalCart, 0);
                                                              $TotalCart = $FormatTotalCart;
                                                          }

                                                            $PrepeTotalCart = str_replace( ',', '', $TotalCart );
                                                            $FormatTotalCart = round($PrepeTotalCart, 0);
                                                            $ShippingFee = $Shipping;
                                                            $TotalCost = $FormatTotalCart+$ShippingFee;
                                                            echo $TotalCost;
                                                          
                                                        ?>
                                                          <input type="hidden" name="amount" value="{{$TotalCost}}">
                                                          <div class="col-md-6">
                                                              <div class="form-group">
                                                                  <label for="email">Enter Your MPESA Transaction Code <span>*</span></label>
                                                                  <input type="text" name="TransactionID" class="form-control" required placeholder="NJL4E9WJ96" id="email" autocomplete="off">
                                                              </div>
                                                            <div class="pull-left"><button id="veryfyID" class="payment-action" type="submit"> Veryfy Payment &nbsp;<i class="fa fa-arrow-right"></i> </button></div>
                                                          </div>
                                                        </form>

                                                    </ol>
                                                </div>
                                            </div>
                                        </div>
                                       
                                        <div class="card">
                                            <div class="card-header" role="tab" id="headingThree">
                                                <h5 class="mb-0">
                                                    <a class="collapsed" data-toggle="collapse" href="#collapseThree" role="button" aria-expanded="false" aria-controls="collapseThree">
                                                    Cash on Delivery
                                                    </a>
                                                </h5>
                                            </div> 
                                            <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
                                                <div class="card-body">
                                                  <form method="POST" action="{{url('/cart/checkout/placeOrder')}}">
                                                    {{ csrf_field() }}
                                                    <div class="panel-body">
                                                      <!-- <p>All transactions are secure and encrypted, and we neverstor To learn more, please view our  <a href="{{url('/privacy')}}">privacy policy.</a></p>
                                                      <br>
                                                      <div class="radio">
                                                        <label>
                                                          <input type="radio" checked value="option1" id="optionsRadios1" name="optionsRadios">
                                                          Cash On Delivery </label>
                                                      </div> -->
                                                      <!-- <div class="form-group">
                                                        <label for="CommentsOrder">Add Comments About Your Order</label>
                                                        <textarea rows="3" cols="26" name="CommentsOrder" class="form-control" id="CommentsOrder"></textarea>
                                                      </div> -->
                                                      <!-- <div class="form-group clearfix">
                                                        <div class="checkbox">
                                                          <label>
                                                            <input id="termsCheckbox1" type="checkbox" value="">
                                                            I have read and agree to the <a style="color:#66139B" target="new" href="{{url('/terms')}}">Terms &amp; Conditions</a> </label>
                                                        </div>
                                                      </div> -->
                                                      <div class="pull-right"><a class="payment-action" id="actionBtn1" href="{{url('/cart/checkout/placeOrder')}}"> Submit Order &nbsp;<i class="fa fa-arrow-right"></i> </a></div>
                                                    </div>
                                                  </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" role="tab" id="headingfour">
                                                <h5 class="mb-0">
                                                    <a class="collapsed" data-toggle="collapse" href="#collapsefour" role="button" aria-expanded="false" aria-controls="collapsefour">
                                                    paypal
                                                    </a>
                                                </h5>
                                            </div>
                                            <div id="collapsefour" class="collapse" role="tabpanel" aria-labelledby="headingfour" data-parent="#accordion">
                                            <p>*May include additional conversion fee*</p>
                                                <div class="card-body">
                                                    <!-- Shopping Cart -->
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

                                                      
                                                      
                                                      <input type="hidden" name="cancel_return" id="cancel_return" value="{{url('/')}}/cart/checkout/payment" />
                                                      <button  style="cursor:pointer" type="submit"><img src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/cc-badges-ppcmcvdam.png" alt="Pay with PayPal Credit or any major credit card" /></button>
                                                    </form>
                                                    <!-- Shopping Cart -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        
                                </div>
                                <!-- <button type="submit" value="submit" class="btn subs_btn form-control">place order</button> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <br>
        <br>
     
    </div>
  </div>

@endsection