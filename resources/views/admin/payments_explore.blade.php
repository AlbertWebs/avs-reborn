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
                                Payment Details
                            
                            </div>

                            <div class="panel-body">
                            @foreach($Payments as $payment)
                            <center>
                                <strong>Transaction Type :</strong> {{$payment->TransactionType}} <br>
                                <strong>Transaction ID :</strong> {{$payment->TransID}} <br>
                                <strong>Transaction Time :</strong> {{$payment->TransTime}} <br>
                                <strong>Transaction Amount :</strong> {{$payment->TransAmount}} <br>
                                <strong>Transaction Short Code :</strong> {{$payment->BusinessShortCode}} <br>
                                <strong>Transaction Reference Number :</strong> {{$payment->BillRefNumber}} <br>
                                <strong>Transaction Invoice Number :</strong> {{$payment->InvoiceNumber}} <br>
                                <strong>Transaction Account Balance :</strong> {{$payment->OrgAccountBalance}} <br>
                                <strong>Transaction Third Party TransID :</strong> {{$payment->ThirdPartyTransID}} <br>
                                <strong>Transaction User Phone Number :</strong> {{$payment->MSISDN}} <br>
                                <strong>Transaction FirstName :</strong> {{$payment->FirstName}} <br>
                                <strong>Transaction MiddleName :</strong> {{$payment->MiddleName}} <br>
                                <strong>Transaction LastName :</strong> {{$payment->LastName}} <br>
                                <strong>Transaction lastUpdate :</strong> {{$payment->lastUpdate}} <br>


                                <hr />
                              
                                <a onClick="return confirm('Are You Sure You Want To Reverse This Transaction ')" href="{{url('admin/payments/reverse')}}/{{$payment->TransID}}" class="btn btn-danger btn-sm"><span class="icon-undo"></span> Reverse Payment</a>
                                <a onClick="return confirm('Are You Sure You Want to Confirm This Order ')" href="{{url('admin/payments/confirm')}}/{{$payment->TransID}}" class="btn btn-success btn-sm"><span class="icon-check"></span> Confirm Order</a>
                                
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