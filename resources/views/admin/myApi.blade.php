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
                        <center><h2> My MPESA API </h2></center>
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

                    
                    <div class="col-lg-6">

                       <div class="panel panel-danger">


                            <div class="panel-body">



                                  <button id="balanceBtn"  type="submit" onclick="" class="btn btn-block btn-success"> My M-PESA Balance </button>



                            </div>

                        </div>



                    </div>

                    <div class="col-lg-3">

                       <div class="panel panel-danger">


                            <div class="panel-body">
                            <!-- Modal -->
                                <button  type="button" onclick="" class="btn btn-block btn-warning" data-toggle="modal"  data-target="#newReg5"> (B2C) </button>
                            <!-- Modal -->
                         
                            </div>

                        </div>



                    </div>
                    <div class="col-lg-3">

                       <div class="panel panel-danger">


                            <div class="panel-body">
                         
                            
                          <!-- Modal -->
                          <button  type="button" onclick="" class="btn btn-block btn-danger" data-toggle="modal"  data-target="#newReg2"> Reverse </button>
                            <!-- Modal -->
                            </div>

                        </div>



                    </div>
                </div>

                <div class="row">

                    <div class="col-lg-12">

                       <div class="panel panel-danger">


                            <div class="panel-body">

                            <button onclick="window.open('{{url('/admin/payments')}}','_self')"  type="button" onclick="" class="btn btn-block btn-default"> M-PESA Payments </button>


                            </div>

                        </div>



                    </div>

                    

                </div>

                <hr>
                <hr>
                <div class="row">

                       

                            <div class="col-lg-4">

                                <div class="panel panel-danger">


                                    <div class="panel-body">

                                        <button  type="button" onclick="window.open('{{url('/admin/reverse')}}','_self')" class="btn btn-block btn-warning" > Reverse(<?php $MPESAA = DB::table('reverse_transaction')->get(); echo count($MPESAA) ?>) </button>


                                    </div>

                                </div>

                            </div>

                            <div class="col-lg-4">

                                <div class="panel panel-danger">


                                    <div class="panel-body">

                                        <button  type="button" onclick="window.open('{{url('/admin/b2c')}}','_self')" class="btn btn-block btn-success"> B2C(<?php $MPESAA = DB::table('b2c_api_response')->get(); echo count($MPESAA) ?>) </button>


                                    </div>

                                </div>

                            </div>

                            <div class="col-lg-4">

                                <div class="panel panel-danger">


                                    <div class="panel-body">

                                        <button  type="button" onclick="window.open('{{url('/admin/balance')}}','_self')" class="btn btn-block btn-info"> Balance(<?php $MPESAA = DB::table('accountbalance')->get(); echo count($MPESAA) ?>) </button>


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
<!-- Online Status -->
<div class="col-lg-12">
    <div class="modal fade" id="newReg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <form role="form" id="lipaStatus" method="post">
            <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="H4"> M-PESA Online Status </h4>
                    </div>
                    <div class="modal-body">

                        {{ csrf_field() }}
                            <div class="form-group">
                                <label>Transaction ID</label>
                                <input class="form-control" />
                                <p class="help-block">NL0000000000</p>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="lipaStatusBtn" class="btn btn-primary">Save changes</button>
                    </div>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- Online Status -->
<!-- Reverse Transaction -->
<div class="col-lg-12">
    <div class="modal fade" id="newReg2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <form role="form" id="Reverse" method="post">
            <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="H4"> M-PESA Reverse Transaction </h4>
                    </div>
                    <div class="modal-body">

                        {{ csrf_field() }}
                            
                            <div class="form-group">
                                <label>Transaction ID</label>
                                <input class="form-control" name="TransactionID" id="AmountQ" />
                                <p class="help-block">NL0000000000</p>
                            </div>
                            <div class="form-group">
                                <label>Receiver Phone Number</label>
                                <input class="form-control" name="PartyA" id="AmountQ" />
                                <p class="help-block">254720000000</p>
                            </div>
                            <div class="form-group">
                                <label>Amount</label>
                                <input class="form-control" name="Amount" id="AmountQ" />
                                <p class="help-block">300</p>
                            </div>

                            <div class="form-group">
                                <label>Remark</label>
                                <input class="form-control" name="Remark"/>
                                <p class="help-block">Out Of Stock</p>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="ReverseBtn" class="btn btn-primary">Reverse Transaction</button>
                    </div>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- Reverse Transaction -->
<!-- B2B -->
<div class="col-lg-12">
    <div class="modal fade" id="newReg3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <form role="form" id="merchant" method="post">
            <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="H4"> B2B Transactions </h4>
                    </div>
                    <div class="modal-body">

                        {{ csrf_field() }}
                            <div class="form-group">
                                <label>Amount</label>
                                <input class="form-control" name="Amount" />
                                <p class="help-block">12500</p>
                            </div>

                            <div class="form-group">
                                <label>PArty B</label>
                                <input class="form-control" name="PartyB"/>
                                <p class="help-block">942527</p>
                            </div>
                            <div class="form-group">
                                <label>AccountReference</label>
                                <input class="form-control" name="Remarks" />
                                <p class="help-block">Salary</p>
                            </div>
                            <div class="form-group">
                                <label>Occation</label>
                                <input class="form-control" name="Occasion" />
                                <p class="help-block">Salary January</p>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="merchantBtn" class="btn btn-primary">Send</button>
                    </div>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- B2B -->
<!-- Transaction Status -->
<div class="col-lg-12">
    <div class="modal fade" id="newReg4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <form role="form" id="status" method="post">
            <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="H4"> Transaction Status </h4>
                    </div>
                    <div class="modal-body">

                        {{ csrf_field() }}
                            <div class="form-group">
                                <label>Transaction ID</label>
                                <input class="form-control" name="TransactionID" />
                                <p class="help-block">NL0000000000</p>
                            </div>
                            <!-- Invoice Number -->
                            <div class="form-group">
                                <div class="col-lg-12">
                                    <select class="form-control" name="Remarks">
                                        <?php $Invoice = DB::table('invoices')->where('status', '0')->get();?>
                                        @foreach($Invoice as $invoice)
                                            <option select="{{$invoice->number}}">{{$invoice->number}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <p class="help-block text-center">Invoice Number</p>
                            </div>

                            <!-- Invoice Number as Remark -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="statusbtn" class="btn btn-primary">Send</button>
                    </div>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- Transaction Status Status -->

<!-- B2C -->
<div class="col-lg-12">
    <div class="modal fade" id="newReg5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <form role="form" id="b2c" method="post">
            <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="H4"> M-PESA Merchant To Custoner(B2C) </h4>
                    </div>
                    <div class="modal-body">

                        {{ csrf_field() }}
                            <div class="form-group">
                                <label>Amount</label>
                                <input class="form-control" name="Amount" />
                                <p class="help-block">12500</p>
                            </div>
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input class="form-control" name="PartyB"/> 
                                <p class="help-block">254723000000</p>
                            </div>
                            <div class="form-group">
                                <label>Remark</label>
                                <input class="form-control" name="Remarks" />
                                <p class="help-block">Salary</p>
                            </div>
                            <div class="form-group">
                                <label>Occation</label>
                                <input class="form-control" name="Occasion" />
                                <p class="help-block">Salary January</p>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="b2cBtn" class="btn btn-primary">Submit</button>
                    </div>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- B2C -->
@endsection

