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
                    <div class="col-lg-12 text-center">
                        <h2> Offer Product </h2>
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
                                    All Products(Add or Remove Featued Product)
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Name</th>
                                                    <th>Category</th>
                                                    <th>Image</th>
                                                    <th>Status</th>
                                                    <th>Change</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($Product as $value)
                                                <tr class="odd gradeX">
                                                    <td>{{$value->id}}</td>
                                                    <td>{{$value->name}}
                                                    <hr>
                                                    Price : {{$value->price}} <br>
                                                    Web Code : {{$value->code}}
                                                    </td>
                                                    <td>
                                                        <?php
                                                            $CatID = $value->cat;
                                                            $TheCategory = DB::table('category')->where('id',$CatID)->get();
                                                            foreach ($TheCategory as $key => $valuee) {
                                                                echo $valuee->cat;
                                                            }
                                                         ?>
                                                    </td>
                                                    <td class="center"><img width="200" height="auto" src="{{url('/')}}/uploads/product/{{$value->image_one}}"></td>
                                                    <?php 
                                                       $status = $value->offer;
                                                       if($status == '1'){
                                                            $status_icon = 'smile';
                                                            $status_text = 'Active';
                                                            $status_color = 'success';
                                                            
                                                       }else{
                                                           $status_icon = 'frown';
                                                           $status_text = 'Inactive';
                                                           $status_color = 'danger';
                                                       }
                                                    ?>
                                                    <td class="center"><a href="#"   class="btn btn-{{$status_color}}"><i class="icon-{{$status_icon}} icon-white"></i> {{$status_text}}</a>
                                                    <br><br>
                                                    @if($status == '1')
                                                    <a href="{{url('/admin/deleteOffer')}}/{{$value->id}}"   class="btn btn-danger"><i class="icon-trash icon-white"></i> Delete Offer</a>
                                                    @endif
                                                    </td>
                                                    <td class="center"><a href="{{url('admin/swapoffer')}}/{{$value->id}}"   class="btn btn-info"><i class="icon-pencil icon-white"></i> Change</a></td>
                                                    
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