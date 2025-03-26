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
     <!-- Page Data -->
     <div class="row">
        <div class="col-lg-12">
          <h2 class="delivery-method tf">Order Riview</h2>
        </div>
        <div class="col-md-12">
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
                  <td ><div class="image"><a href="{{url('')}}/classifieds/{{$Product->code}}"><img alt="img" src="{{url('/')}}/uploads/product/{{$Product->image_one}}"></a></div></td>
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
        </div>
        <div class="col-xs-12 col-sm-12">
          <div class="cart-bottom">
            <div class="box-footer">
              <div class="pull-left"><a href="{{url('cart/checkout/checkout_billing')}}" class="btn btn-default"> <i class="fa fa-arrow-left"></i> &nbsp; Back to Billing Address </a></div>
              <div class="pull-right"> <a class="btn btn-primary btn-small " href="{{url('/cart/checkout/payment')}}"> Proceed to payment &nbsp; <i class="fa fa-check"></i> </a> </div>
            </div>
          </div>
        </div>
      </div>
     <!-- Page Data -->
    </div>
  </div>
@include('checkout.popup')
@endsection