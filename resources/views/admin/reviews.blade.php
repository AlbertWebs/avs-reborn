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
                        
                        <center><h2> All Reviews </h2></center>
                        
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
                                    All Revies
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Author</th>
                                                    <th>Email</th>
                                                    <th>Reviews</th>
                                                    <th>Status</th>
                                                    <th>Approve</th>
                                                    <th>Decline</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($Review as $value)
                                                <tr class="odd gradeX">
                                                    <td>{{$value->id}}</td>
                                                    <td>{{$value->author}}</td>
                                                    <td>{{$value->email}}</td>
                                                    <td>{{$value->content}}</td>
                                                    <td>
                                                    <?php 
                                                        $Status = $value->status;
                                                        if($Status==0){
                                                            $StatusPrint = 'Unapproved';
                                                        }else{
                                                            $StatusPrint = 'Approved';
                                                        }
                                                        echo $StatusPrint;
                                                    ?>
                                                   
                                                    </td>
                                                   
                                                
                                                   
                                                    <td class="center"><a onclick="return confirm('Approving this Comment Automatically Sends It to the Websites Front-End, Do You Wish to Continue')" href="{{url('/admin')}}/approve/{{$value->id}}"   class="btn btn-info"><i class="icon-check icon-white"></i> Approve</a></td>
                                                    <td class="center"><a onclick="return confirm('Are You Sure You Want To Delete This Comment? You Cannot Undo After This Action')" href="{{url('/admin')}}/decline/{{$value->id}}"   class="btn btn-danger"><i class="icon-trash icon-white"></i> Del</a></td>
                                                  
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