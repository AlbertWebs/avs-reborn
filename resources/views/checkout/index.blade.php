@extends('front.master-payments')
@section('content')
  <!-- offer block end  --> 
  <br><br>
  
  <div id="blog-page-contain">
    <div class="container">
      <div class="row">
      <center>
       @if(Session::has('message'))
        <div class="alert alert-success">{{ Session::get('message') }}</div>
       @endif
       @if(Session::has('message_error'))
        <div class="alert alert-danger">{{ Session::get('message_error') }}</div>
       @endif
       </center>
        <div class="col-lg-12 col-md-12  col-sm-12 Authentication">
          <!-- <h2 class="Authentication-title tf"> Authentication</h2> -->
          <div class="row">
            <div class="col-xs-12 col-sm-6 ">
              <h4 class="block-title-2"> Create an account </h4>
              <form class="account-creat" method="POST" action="{{url('shopping-cart/checkout/create-user')}}">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                  <input type="text" name="name" placeholder="Enter name" id="exampleInputName" value="{{ old('name') }}" class="form-control" required>
                </div>
                <div class="form-group">
                  <input type="text" value="{{ old('town') }}" name="town" placeholder="Enter Town" id="InputEmail1" class="form-control" required>
                </div>
                <div class="form-group">
                  <input type="text" value="{{ old('location') }}" name="location" placeholder="e.g Umoja Peacok Stage" id="InputEmail1" class="form-control" required>
                </div>
                <div class="form-group">
                  <input type="text" value="{{ old('mobile') }}" name="mobile" placeholder="eg 254723000000 (Without +)" id="InputEmail1" class="form-control" required>
                </div>
                <!-- Check Email -->
                <div id="mailChecking" class="alert-info"></div>
                <div id="mailExists" class="alert-danger"></div>
                <div id="mailAvailable" class="alert-success"></div>

                <div class="form-group">
                  <input type="email" onblur="duplicateEmail(this)" id="checkEmail" value="{{ old('email') }}" name="email" placeholder="Enter email" id="InputEmail1" class="form-control" required>
                </div>
                <!-- </Check Email -->
                <div class="form-group">
                  <input type="password" name="password" placeholder="Password" id="InputPassword1" class="form-control" required>
                </div>
                <div class="form-group">
                  <input type="password" name="password_confirm" placeholder="Password confirm" id="InputPassword2" class="form-control" required>
                </div>
                <div class="col-md-12">
                    <div class="checkout-form-list create-acc">
                        <input id="cbox" type="checkbox" name="newsletter">
                        <label>I want to receive newsletters with best deals and offers</label>
                    </div>
                </div>
                 <div class="form-group">
                     <div class="col-lg-12 col-md-12" id="TheCapcha">
                        <div class="g-recaptcha" data-sitekey="6Ld1MOEZAAAAAFA0hpFQ4DKf0Si330YkpOpKtrH1" data-callback="correctCaptcha"></div>
                        <script type="text/javascript" src="https://www.google.com/recaptcha/api.js?hl=en"></script>
                    </div>
                    </div>
                
                <br><br>
               <div class="clearfix"></div>
                    <div class="col-md-12">
                      <button style="background-color:#66139B; border: 0px; cursor:pointer; text-align:center" class="btn btn-primary text-center" type="submit"><i class="fa fa-user"></i> Create an account</button>
                    </div>
                <br><br>
              </form>
            </div>
            <div class="col-xs-12 col-sm-6 ">
              <h4 class="block-title-2"><span>Already registered?</span></h4>
              <form class="registered" action="{{url('shopping-cart/checkout/login')}}" method="POST">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                  <input type="email" name="email" placeholder="Enter email" id="InputEmail2" class="form-control" value="{{ old('email') }}" required>
                </div>
                <div class="form-group">
                  <input type="password" name="password" placeholder="Password" id="InputPassword2" class="form-control"  required>
                </div>
                
                
                     <div class="form-group">
                     <div class="col-lg-12 col-md-12" id="TheCapcha">
                        <div class="g-recaptcha" data-sitekey="6Ld1MOEZAAAAAFA0hpFQ4DKf0Si330YkpOpKtrH1" data-callback="correctCaptcha"></div>
                        <script type="text/javascript" src="https://www.google.com/recaptcha/api.js?hl=en"></script>
                    </div>
                    </div>
                
                <br><br>
                <div class="clearfix"></div>
                <div class="clearfix"></div>
                <div class="clearfix"></div>
                
                <div class="col-md-12">
                    <div class="checkout-form-list create-acc">
                        <input id="cbox" type="checkbox" name="remember" value="1">
                        <label>Remember me</label>
                    </div>
                </div>
                <div class="forgot-password">
                  <p><a style="color:#66139B; cursor:pointer;" href="{{url('/clientarea')}}" title="Recover your forgotten password">Forgot your password? </a></p>
                </div>
                                <div class="clearfix"></div>
                <div class="col-md-12">
                   <button style="background-color:#66139B; cursor:pointer;" class="btn btn-primary" type="submit"><i class="fa fa-sign-in"></i> Sign In</button>
                </div>
              </form>
            </div>
            
        </div>
      </div>
    </div>
  </div>
  <br>
<!--@include('checkout.popup')-->
@endsection