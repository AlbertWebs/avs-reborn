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
                        
                        <center><h2> All Payments </h2></center>
                        
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
                                    Payments
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    
                                                    <th>Transaction Info</th>
                                                    
                                                    <th>Action</th>
                                                   
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($Payment as $value)
                                                <tr class="odd gradeX">
                                                    <td>{{$value->transLoID}}</td>
                                                    
                                                    <td>
                                                         TransID: {{$value->TransID}} <br>

                                                         TransTime: {{$value->TransTime}} <br>

                                                         Amount:  {{$value->TransAmount}} <br>

                                                         Name:  {{$value->FirstName}} {{$value->MiddleName}} {{$value->LastName}}<br>

                                                     
                                                    
                                                    </td>
                                                    
                                                    <td>
                                                    <center>
                                                    <a  class="btn btn-success icon-check" onClick="return confirm('Are You Sure You Want to Confirm This Order ')" href="{{url('admin/payments/confirm')}}/{{$value->TransID}}">Confirm</a>
                                                    <br><br>
                                                    <a  class="btn btn-info icon-folder-open" href="{{url('admin/payments/explore')}}/{{$value->transLoID}}">Explore</a>
                                                    <br><br>
                                                    <form id="reversal" method="post">
                                                    <input type="hidden" name="" value="">
                                                    {{ csrf_field() }}
                                                    <button  class="btn btn-danger icon-undo">Reverse</button>
                                                    </form>
                                                    <center>
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