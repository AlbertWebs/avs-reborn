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
                        
                        <center><h2> Invoices </h2></center>
                        
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
                 
                 <!-- COMMENT AND NOTIFICATION  SECTION -->
                   <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Invoices
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Number</th>
                                                    <th>Content</th>
                                                    <th>Approve</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($Invoice as $value)
                                                <tr class="odd gradeX">
                                                    <td>{{$value->id}}</td>
                                                    <td>{{$value->number}}</td>
                                                    <td>
                                                         Amount:{{$value->amount}}<br>
                                                         Shipping:{{$value->shipping}}<br>
                                                         Cart:<br>
                                                         <?php $Cart = unserialize($value->products); ?>
                                                         @foreach($Cart as $cart)
                                                          Product Name: {{$cart->name}}<br>
                                                          Price: {{$cart->price}}<br>
                                                          Quoantity: {{$cart->qty}}<br>
                                                         @endforeach
                                                         User:<br>
                                                         <?php $UserName = DB::table('users')->where('id',$value->user_id)->get() ?>
                                                         @foreach($UserName as $User)
                                                          Name: {{$User->name}}<br>
                                                          Email:{{$User->email}}
                                                         @endforeach

                                                    </td>
                                                    <td class="center">
                                                        @if($value->status == 0)
                                                        <a onClick="return confirm('You cannot approve this process, Do you wish to continue?')" href="{{url('/admin')}}/approveInvoice/{{$value->id}}"  class="btn btn-info"><i class="icon-smile-o icon-white"></i> Approve </a></td>
                                                        @else
                                                        <a onClick="return confirm('This invoice has already been approved')" href="#"  class="btn btn-success"><i class="icon-check icon-white"></i> Approved </a></td>
                                                        @endif
                                                    <td class="center"><a onclick="return confirm('Delete This Invoice?')" href="{{url('/admin')}}/deleteInvoice/{{$value->id}}"   class="btn btn-danger"><i class="icon-trash icon-white"></i> Del</a></td>
                                                </tr>
                                            @endforeach
                                                
                                            </tbody>
                                            <!-- <center><a class="btn btn-info icon-plus" href="{{url('admin/addTerms')}}">Add Term</a></center> -->
                                        </table>
                                    </div>
                                
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