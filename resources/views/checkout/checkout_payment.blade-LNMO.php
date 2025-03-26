@extends('front.master')
@section('content')
  <!-- offer block end  --> 
 <br>
  
  <div id="checkout-step-contain">
    <div class="container">
        <div class="breadcrumb-area">
            <div class="container">
                <div class="breadcrumb-content">
                    <ul>
                        <li><a href="{{url('/')}}">Home</a></li>
                        <li><a href="{{url('/cart')}}">Shopping Cart</a></li>
                        <li class="active">Checkout Payment</li>
                    </ul>
                </div>
            </div>
        </div>
        <br>
        <section class="register_area">
            <div class="container">
                <div class="register_inner">
                    <div class="row">
                        <div class="col-lg-10" style="margin:0px auto;">
                            <div class="order_box_price">
                                <h2 class="reg_title text-center">Your Order</h2>
                                <div class="payment_list">
                                    <div class="price_single_cost">
                                    @foreach($CartItems as $CartItem)
                                      <?php 
                                                      $Products = DB::table('product')->where('id',$CartItem->id)->get();
                                      ?>
                                      @foreach($Products as $Product)
                                        <h5><strong> {{$Product->name}} <span>KES {{$CartItem->total}}</span></strong></h5>
                                      @endforeach
                                        
                                      @endforeach

                                      <h5> Shipping <span>{{$Shipping}} </span></h5>
                                      <h3><span class="normal_text">Order Totals</span> <span style="color:#66139B">{{Cart::total()}}</span></h3>
                                      <h3><span class="normal_text">Net Total</span> 
                                          <span style="color:#66139B">KES 
                                             <?php
                                                 $TotalCart = Cart::total();
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
                                                              $TotalCart = Cart::total();
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
                                            <div class="card-header" role="tab" id="headingTwo">
                                                <h5 class="mb-0">
                                                    <a class="collapsed" data-toggle="collapse" href="#collapseTwo" role="button" aria-expanded="false" aria-controls="collapseTwo">
                                                    MPESA Online
                                                    </a>
                                                </h5>
                                            </div>
                                            <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
                                                <div class="card-body"> 
                                                    <ol> 
                                                           
                                                            
                                                            <form method="POST" id="sitoki">
                                                              {{ csrf_field() }}
                                                           
                                                              <div class="col-md-6">
                                                              <div class="form-group">
                                                                  <label style="color:#333333">

                                                                  <?php 
                                                                      $TotalCart = Cart::total();
                                                                      $PrepeTotalCart = str_replace( ',', '', $TotalCart );
                                                                      $FormatTotalCart = round($PrepeTotalCart, 0);
                                                                      $ShippingFee = $Shipping;
                                                                      $TotalCost = $FormatTotalCart+$ShippingFee;
                                                                      
                                                                      
                                                                      
                                                                      ?>

                                                                      
                                                                 
                                                                  
                                                                  <!-- Amount -->
                                                                  <input type="hidden" name="Amount" value="{{$TotalCost}}">  
                                                                  <!-- Reference Number-->
                                                                  <input type="hidden" id="Reff" name="Reff" value="{{$InvoiceNumber}}">
                                                                  <!-- Transaction Description -->
                                                                  <input type="hidden" name="desc" value="">  
                                                                  <!-- <ol style="color:#333333">  -->
                                                                    <li>Enter Your MPESA Phone Number</li>
                                                                    <li>Click on "Pay Now" </li>
                                                                    <li>Enter your MPESA pin then press OK </li>
                                                                  <!-- </ol> -->
                                                                  </lable>
                                                                  <label style="color:#333333" for="email">Enter Your MPESA Phone Number <span>*</span></label>
                                                                  <input name="phone" type="text" class="form-control" placeholder="254720000000" id="phoneNumber" autocomplete="off" required>
                                                                  <p style="font-weight:400">Enter Your Number in the format 254720000000 Without a (+)</p>
                                                              </div>

                                                              

                                                              <div class="pull-left"><button id="sitokiID" class="payment-action"  type="submit"> Pay Now &nbsp;<i class="fa fa-arrow-right"></i> </button></div>
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
                                                      <div class="pull-right"><a class="payment-action id="actionBtn1" href="{{url('/cart/checkout/placeOrder')}}"> Submit Order &nbsp;<i class="fa fa-arrow-right"></i> </a></div>
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
                                                      <?php $RawPrice = $Product->price; $ProcessedRawPrice = $RawPrice + 300; ?>
                                                      <input type="hidden" name="item_name_{{$Count}}" value="{{$Product->name}}">
                                                      <input type="hidden" name="amount_{{$Count}}" value="<?php echo dollar($ProcessedRawPrice) ?>"><?php dollar($ProcessedRawPrice); ?>
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