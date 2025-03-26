@extends('front.master')
@section('content')
  <!-- offer block end  --> 
 <br><br>
  
  <div id="checkout-step-contain"> 
    <div class="container">
      <div class="account-content checkout-staps">
         <div class="staps">
           @include('checkout.breadcrumb')
          </div>
      </div>
      @if(Auth::user()->location == 'Nairobi' or Auth::user()->location == 'nairobi')
      <div class="row">
        <div class="col-lg-12">
          <h2 class="delivery-method tf"> Choose your Payment method </h2>
        </div>
        <div class="col-xs-12 col-sm-12">
          <div class="paymentBox">
            <div class="accordion">
              <div class="accordion-section"> <a href="#accordion-1" class="accordion-section-title active"> Cash on Delivery</a>
                <div id="accordion-1" class="accordion-section-content open" style="display: block;">
                  <div class="panel-collapse collapse in" id="collapseOne">
                  <form method="POST" action="{{url('/cart/checkout/placeOrder')}}">
                    {{ csrf_field() }}
                    <div class="panel-body">
                      <p>All transactions are secure and encrypted, and we neverstor To learn more, please view our  <a href="{{url('/privacy')}}">privacy policy.</a></p>
                      <br>
                      <div class="radio">
                        <label>
                          <input type="radio" checked value="option1" id="optionsRadios1" name="optionsRadios">
                          Cash On Delivery </label>
                      </div>
                      <!-- <div class="form-group">
                        <label for="CommentsOrder">Add Comments About Your Order</label>
                        <textarea rows="3" cols="26" name="CommentsOrder" class="form-control" id="CommentsOrder"></textarea>
                      </div> -->
                      <div class="form-group clearfix">
                        <div class="checkbox">
                          <label>
                            <input id="termsCheckbox1" type="checkbox" value="">
                            I have read and agree to the <a target="new" href="{{url('/terms')}}">Terms &amp; Conditions</a> </label>
                        </div>
                      </div>
                      <div class="pull-right"><button class="btn btn-large btn-primary" id="actionBtn1" href="{{url('/')}}"> Submit Order &nbsp;<i class="fa fa-arrow-right"></i> </button></div>
                    </div>
                  </form>
                  </div>
                </div>
                <!--end .accordion-section-content--> 
              </div>
              
              <div class="accordion-section"> <a href="#accordion-2" class="accordion-section-title">Checkout With MPESA</a>
                <div style="display: none;" class="accordion-section-content " id="accordion-2">
                  <div class="panel-body col-lg-6">
                    <p>All transactions are secure and encrypted. please view our  <a href="{{url('/privacy')}}">privacy policy.</a></p>
                    <ol> 
                        <li>Go to your MPESA menu</li>
                        <li>Select Lipa Na MPESA</li>
                        <li>Select Buy goods and services</li>
                        <?php $SettingsTill = DB::table('sitesettings')->get(); ?>
                        @foreach($SettingsTill as $set)
                        <li>Enter the till number {{$set->till}} then OK</li>
                        @endforeach
                        <li>Enter Amount KSH {{Cart::total()}}</li>
                        <li>Then press ok to confirm</li>
                        <li>Wait For Our Call</li>
                        <!-- <li>Enter the transaction code below</li>
                        <li>Click verify to verify payment</li> -->


                    </ol>
                    <form method="POST" action="{{url('/cart/checkout/placeOrder')}}">
                    {{ csrf_field() }}
                    <div class="creditCard">
                        
                        <input type="text" name="code" autocomplete="off" placeholder="Transaction Code" id="CardNumber">
                      </div>
                      <div class="pull-right"><button id="veryfyIDD" class="btn btn-large btn-primary" type="submit"> Complete Order &nbsp;<i class="fa fa-arrow-right"></i> </button></div>
                    </form>
                    <br>
                    <!-- <form id="verify">
                    {{ csrf_field() }}
                    <div class=" open">
                      <div class="creditCard">
                        <label for="CardNumber">Transacrion Code</label><br>
                        <br><p id="fail-alert" class="alert-danger text-center"></p>
                        <p id="success-alert" class="alert-success text-center"></p>
                        <input type="text" name="TransactionID" placeholder="MVGS784HGHD" id="CardNumber">
                        
                        
                      </div>
                      
                     
                    </div>
                    <div class="pull-right"><button id="veryfyID" class="btn btn-large btn-primary" type="submit"> Verify &nbsp;<i class="fa fa-arrow-right"></i> </button></div>
                    
                    </form> -->
                  </div>
                  <div class="col-lg-6">
                  <?php $SettingsTill = DB::table('sitesettings')->get(); ?>
                  @foreach($SettingsTill as $set)
                  <img src="{{url('/')}}/uploads/logo/{{$set->till_image}}" alt="TIll Number" title="post" class="img-responsive">
                  @endforeach
                  </div>
                </div>
                <!--end .accordion-section-content--> 
              </div>
              <!--end .accordion-section--> 
            </div>
          </div>
        </div>
      </div>
      @else
      <div class="row">
        <div class="col-lg-12">
          <h2 class="delivery-method tf"> Payment </h2>
        </div>
        <div class="col-xs-12 col-sm-12">
          <div class="paymentBox">
            <div class="accordion">
              
              
              <div class="accordion-section"> <a href="#accordion-1" class="accordion-section-title active">Checkout With MPESA</a>
                <div style="display: block;" class="accordion-section-content open" id="accordion-1">
                <div class="panel-body col-lg-6">
                    <p>All transactions are secure and encrypted. please view our  <a href="{{url('/privacy')}}">privacy policy.</a></p>
                    <ol> 
                        <li>Go to your MPESA menu</li>
                        <li>Select Lipa Na MPESA</li>
                        <li>Select Buy goods and services</li>
                        <?php $SettingsTill = DB::table('sitesettings')->get(); ?>
                        @foreach($SettingsTill as $set)
                        <li>Enter the till number {{$set->till}} then OK</li>
                        @endforeach
                        <li>Enter Amount KSH {{Cart::total()}}</li>
                        <li>Then press ok to confirm</li>
                        <li>Enter the Transaction Code Below</li>
                        <!-- <li>Enter the transaction code below</li>
                        <li>Click verify to verify payment</li> -->


                    </ol>
                    <form method="POST" action="{{url('/cart/checkout/placeOrder')}}">
                    {{ csrf_field() }}
                    <div class="creditCard">
                        
                        <input type="text" name="code" autocomplete="off" placeholder="Transaction Code" id="CardNumber">
                      </div>
                      <div class="pull-right"><button id="veryfyIDD" class="btn btn-large btn-primary" type="submit"> Complete Order &nbsp;<i class="fa fa-arrow-right"></i> </button></div>
                    </form>
                    <br>
                    <!-- <form id="verify">
                    {{ csrf_field() }}
                    <div class=" open">
                      <div class="creditCard">
                        <label for="CardNumber">Transacrion Code</label><br>
                        <br><p id="fail-alert" class="alert-danger text-center"></p>
                        <p id="success-alert" class="alert-success text-center"></p>
                        <input type="text" name="TransactionID" placeholder="MVGS784HGHD" id="CardNumber">
                        
                        
                      </div>
                      
                     
                    </div>
                    <div class="pull-right"><button id="veryfyID" class="btn btn-large btn-primary" type="submit"> Verify &nbsp;<i class="fa fa-arrow-right"></i> </button></div>
                    
                    </form> -->
                  </div>
                  <div class="col-lg-6">
                  <?php $SettingsTill = DB::table('sitesettings')->get(); ?>
                  @foreach($SettingsTill as $set)
                  <img src="{{url('/')}}/uploads/logo/{{$set->till_image}}" alt="TIll Number" title="post" class="img-responsive">
                  @endforeach
                  </div>
                </div>
                <!--end .accordion-section-content--> 
              </div>
              <!--end .accordion-section--> 

              <div class="accordion-section"> <a href="#accordion-2" class="accordion-section-title active"> Cash on Delivery</a>
                  <center>Please Note That Cash On Delivery is Not available For Your Location</center>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endif
     
    </div>
  </div>
 @include('checkout.popup')
@endsection