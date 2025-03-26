@extends('admin.master')

@section('content')
<div id="wrap" >
        

        <!-- HEADER SECTION -->
        @include('admin.top')
        <!-- END HEADER SECTION -->



        <!-- MENU SECTION -->
        @include('admin.left')
        <!--END MENU SECTION -->



        <!--PAGE CONTENT -->
        <div id="content">
             
            <div class="inner" style="min-height: 700px;">
                <div class="row">
                    <div class="col-lg-12">
                        <center><h2> Admin Dashboard </h2></center>
                    </div>
                </div>
                  <hr />
                 <!--BLOCK SECTION -->
                 <div class="row">
                    <div class="col-lg-12">
                        @include('admin.panel')

                    </div>

                </div>
                  <!--END BLOCK SECTION -->
                <hr />
                   <!-- CHART & CHAT  SECTION -->
              
                 <!--END CHAT & CHAT SECTION -->
                 <!-- COMMENT AND NOTIFICATION  SECTION -->
                <div class="row">
                    <div class="col-lg-12">

                        <div class="chat-panel panel panel-success">
                            <div class="panel-heading">
                                <i class="icon-money"></i>
                                Order
                            
                            </div>

                            <div class="panel-body">
                            @foreach($Order as $value)
                            <center>
                                
                                <?php $OrderProduct = DB::table('orders_products')->where('orders_id',$value->id)->get(); ?>
                                @foreach($OrderProduct as $Product)
                                <strong>Quantity :</strong> {{$Product->qty}} <br>
                                <strong>Product :</strong>  
                                  <?php $Products = DB::table('product')->where('id',$Product->products_id)->get(); ?>
                                  @foreach($Products as $theProduct)
                                     {{$theProduct->name}}

                                  
                                 <br>
                                 <strong>Unit Price :</strong> {{$theProduct->price}} <br>
                                 <strong>Order Placed :</strong> On: {{date('D', strtotime($value->created_at))}}-{{date('d', strtotime($value->created_at))}}, {{date('M', strtotime($value->created_at))}}, {{date('Y', strtotime($value->created_at))}} At:<?php $CurrentTime  =  date('H', strtotime($value->created_at)); $ThisTime = $CurrentTime+3; echo $ThisTime ?>:{{date('i', strtotime($value->created_at))}}:{{date('s', strtotime($value->created_at))}}<br>
                                 @endforeach
                                 <hr>
                                 @endforeach

                                <h3>User Info:</h3>
                                <?php $User = DB::table('users')->where('id',$value->user_id)->get() ?>
                                    @foreach($User as $user)
                                    
                                        <strong>Name :</strong> {{$user->name}} <br>
                                        <strong>Email :</strong> {{$user->email}} <br>
                                        <strong>Location :</strong> {{$user->location}} <br>
                                        <strong>address :</strong> {{$user->address}} <br>
                                        <strong>Town :</strong> {{$user->town}} <br>
                                        <strong>Mobile :</strong> {{$user->mobile}} <br>
                                
                                    @endforeach
                                

 
                                <hr />
                                <strong>Total Cost :</strong> {{$value->total}} <br>
                              
                                @if($value->status == 'pending')
                                <a href="{{url('/admin')}}/swapOrder/{{$value->id}}"  class="btn btn-success"><i class="icon-check icon-white"></i> Mark Confirm </a>
                                @else
                                <a href="{{url('/admin')}}/swapOrder/{{$value->id}}"  class="btn btn-info"><i class="icon-close icon-white"></i> Mark Pending </a>
                                @endif
                                
                            </center>
                            @endforeach
                            </div>

                            

                        </div>


                    </div>
                    
                </div>

                     
                <!-- END COMMENT AND NOTIFICATION  SECTION -->
                



                
            </div>

        </div>
        <!--END PAGE CONTENT -->

         <!-- RIGHT STRIP  SECTION -->
         @include('admin.right')
         <!-- END RIGHT STRIP  SECTION -->
    </div>

@endsection