<div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="checkout-stap <?php if($page_title=="Checkout"){echo "active";}else{ echo "";} ?>">
                  <div class="title"> <span class="stap">1 </span><a href="{{url('/cart/checkout')}}">Billing Address</a></div>
                </div>
              </div>

              <!-- <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="checkout-stap <?php if($page_title=="Confirm"){echo "active";}else{ echo "";} ?>">
                  <div class="title"><span class="stap">2 </span><a href="{{url('/cart/checkout/order')}}">Order Summary</a></div>
                </div>
              </div> -->
              
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="checkout-stap <?php if($page_title=="Payment"){echo "active";}else{ echo "";} ?>">
                  <div class="title"><span class="stap">2 </span><a href="{{url('/cart/checkout/payment')}}">Payment</a></div>
                </div>
              </div>
            
            </div>