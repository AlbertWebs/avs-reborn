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
                        
                        <center><h2> Account Balance </h2></center>
                        
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
                                    Balance
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>


                                                    <th>No</th>
                                                    
                                                    <th>Transaction Info</th>
                                                    <th>Transaction Date</th>
                                                   
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($MPESA as $value)
                                                <tr class="odd gradeX">

                                                    <td>{{$value->accountBalID}}</td>
                                                    
                                                    <td>

                                                         TransID: {{$value->accountBalID}} <br>

                                                         TransTime: {{$value->BOCompletedTime}} <br>

                                                         Amount Balance:  {{$value->WorkingAccount}} <br>

                                                    </td>
                                                    
                                                    <td>
                                                         Updated At: {{$value->updatedTime}}
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