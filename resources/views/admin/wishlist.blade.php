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
                        <h1> Wishlists </h1>
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
                                    Wishlists
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>User Name/User IP</th>
                                                   
                                                    <th>Product</th>
                                              
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($Wishlist as $value)
                                                <tr class="odd gradeX">
                                                    <td>{{$value->id}}</td>
                                                    <td>
                                                   
                                                        <?php $User = DB::table('users')->where('id',$value->user_id)->get(); ?>
                                                        @if($User->isEmpty())
                                                           
                                                            {{$value->user_id}}
                                                            
                                                        @else
                                                            @foreach ($User as $Users)
                                                                {{$Users->name}}
                                                            @endforeach
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <?php $Product = DB::table('product')->where('id',$value->product_id)->get(); ?>
                                                        @foreach ($Product as $Product)
                                                            {{$Product->name}}
                                                        @endforeach
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