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
                        
                        <center><h2> Lipa Na MPESA Online </h2></center>
                        
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
                                    Lipa Na MPESA Online
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    
                                                    <th>Transaction Info</th>
                                                    
                                                    <th>Status</th>
                                                   
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($MPESA as $value)
                                                <tr class="odd gradeX">
                                                    <td>{{$value->lnmoID}}</td>
                                                    
                                                    <td>
                                                         TransID: {{$value->MpesaReceiptNumber}} <br>

                                                         TransTime: {{$value->TransactionDate}} <br>

                                                         Amount:  {{$value->Amount}} <br>

                                                         Name:  {{$value->PhoneNumber}} <br>

                                                     
                                                    
                                                    </td>
                                                    
                                                    <td>
                                                    <br><br>
                                                    <center>
                                                    @if($value->status == 0)
                                                        <a  class="btn btn-info icon-check text-center" onClick="return confirm('Are You Sure You Want to Approve The Payment ')" href="{{url('admin/lnmo/confirm')}}/{{$value->lnmoID}}">Approve</a>
                                                    @else
                                                        <a  class="btn btn-success icon-check text-center" onClick="return confirm('These Payment Has Been Aproved')">Approved</a>
                                                    @endif
                                                    </center>
                                                    </td>
                                                  
                                                </tr>
                                            @endforeach
                                                
                                            </tbody>
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