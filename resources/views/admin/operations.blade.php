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
                        <center><h2> Operations </h2></center>

                        <center>
                            @if(Session::has('message'))
                                          <div class="alert alert-success">{{ Session::get('message') }}</div>
                           @endif
           
                           @if(Session::has('messageError'))
                                          <div class="alert alert-danger">{{ Session::get('messageError') }}</div>
                           @endif
                            </center>
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

                    {{-- <div class="col-lg-6">

                        <div class="panel panel-danger">
 
 
                             <div class="panel-body">
                             <!-- Modal -->
                                 <a href="{{url('/')}}/admin/addProductToFacebookPixel" class="btn btn-block btn-warning" > Update Pixels </a>
                             <!-- Modal -->
                          
                             </div>
 
                         </div>
 
 
 
                    </div>  --}}
                    
                    <div class="col-lg-6">

                       <div class="panel panel-danger">


                            <div class="panel-body">


                                  <a href="{{url('/')}}/admin/addProductToFacebookPixel" type="submit" onclick="" class="btn btn-block btn-success"> Generate Excel & Export</a>


                            </div>

                        </div>


                    </div>

                    <div class="col-lg-6">

                        <div class="panel panel-danger">
 
 
                             <div class="panel-body">
 
                             <a target="new"  href="{{url('/')}}/sitemap" class="btn btn-block btn-default"> Generate Site Maps </a>
 
 
                             </div>
 
                         </div>
 
 
 
                     </div>
                 
                    {{-- <div class="col-lg-3">

                       <div class="panel panel-danger">


                            <div class="panel-body">
                         
                            
                  
                          <a  type="button" href="{{url('/')}}/admin/emptyProductToFacebookPixel" class="btn btn-block btn-danger"> Empty Pixels </a>
                        
                            </div>

                        </div>



                    </div> --}}
                </div>

                {{-- <div class="row">

                    <div class="col-lg-12">

                       <div class="panel panel-danger">


                            <div class="panel-body">

                            <a target="new"  href="{{url('/')}}/sitemap" class="btn btn-block btn-default"> Generate Site Maps </a>


                            </div>

                        </div>



                    </div>

                    

                </div> --}}

     


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

