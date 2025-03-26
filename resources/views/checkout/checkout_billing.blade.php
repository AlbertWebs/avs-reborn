@extends('front.master')
@section('content') 
  
  
  <div style="padding-top:100px;" id="checkout-step-contain">
    <div class="container">
      <div class="account-content checkout-staps">
        <div class="account-content checkout-staps">
          <div class="staps">
            @include('checkout.breadcrumb')
          </div>
        </div>
        <form class="billing-info"  method="POST" action="{{url('/cart/checkout/save-user-data')}}">
          <div class="products-order checkout billing-information">
            <div class="checkbox">
              <label>
                <input class="addresses-toggle" type="checkbox" data-target="#my-billing-addresses" data-toggle="collapse" value="">
                Use My Saved Addresses</label>
            </div>
            <div class="collapse" id="my-billing-addresses">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <tbody>
                    <tr>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Address</th>
                      <th>Phone</th>
                     
                      <th></th>
                    </tr>
                    <tr>
                      <td>{{Auth::user()->name}}</td>
                      <td>{{Auth::user()->email}}</td>
                      <td>{{Auth::user()->address}}</td>
                      <td>{{Auth::user()->mobile}}</td>
                      
                      <td><a href="{{url('cart/checkout/payment')}}" class="btn btn-primary btn-sm">Select</a></td>
                    </tr>
                   
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row">
            
              <input type="hidden" value="{{ csrf_token() }}" name="_token">
              <div class="col-md-6 col-sm-6">
                <div class="input-group">
                  <input value="{{Auth::user()->name}}" type="text" name="name" required placeholder="First Name *" class="form-control">
                </div>
               
              </div>
              <div class="col-md-6 col-sm-6">
                <div class="input-group">
                  <input readonly value="{{Auth::user()->email}}" name="email" type="email" required placeholder="E-mail *" class="form-control">
                </div>
              
               
              </div>
             
              
              
            </div>

            <div class="row">
              <div class="col-md-3 col-sm-6">
                <div class="input-group">
                  <input value="{{Auth::user()->mobile}}" type="text" name="phone" required placeholder="phone *" class="form-control" required>
                </div>
               
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="input-group">
                  <input value="{{Auth::user()->address}}" type="text" name="address" required placeholder="Address *" class="form-control" required>
                </div>
              
               
              </div>

              <div class="col-md-3 col-sm-6">
                <div class="input-group">
                  <input value="{{Auth::user()->location}}" type="text" name="location" required placeholder="Eg County e.g Kajiado *" class="form-control" required>
                </div>
              
               
              </div>

              <div class="col-md-3 col-sm-6">
                <div class="input-group">
                  <input value="{{Auth::user()->town}}" type="text" name="town" required placeholder="Eg Town e.g Rongai *" class="form-control" required>
                </div>
              
               
              </div>
             
              
              
            </div>
            
              
              <div class="col-md-12 col-sm-12">
                <!-- <div class="input-group">
                  <textarea  placeholder="Additional information" id="textarea_message" name="message" class="form-control"></textarea>
                </div> -->
              </div>
              <div style="padding-bottom:100px;" class="col-md-12 col-sm-12"> <button type="submit" class="btn btn-primary pull-right " href="{{url('/cart/checkout/shipping_method')}}">Proceed</button> </div>
          </form>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@include('checkout.popup')
@endsection