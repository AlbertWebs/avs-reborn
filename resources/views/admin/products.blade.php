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
                        
                        <center><h2> All Product </h2></center>
                        
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
                                    All Products
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Name</th>
                                                     <!--<th>Category</th> -->
                                                    <!--<th>Image</th>-->
                                                    <th>Action</th>
                                            
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($Product as $value)
                                                <tr class="odd gradeX">
                                                    <td>{{$value->id}}</td>
                                                    <td>{{$value->name}}
                                                    Category:
                                                        <?php
                                                            $CatID = $value->cat;
                                                            $TheCategory = DB::table('category')->where('id',$CatID)->get();
                                                            foreach ($TheCategory as $key => $valuee) {
                                                                echo $valuee->cat;
                                                            }
                                                        ?>
                                                    <br>
                                                    Price : {{$value->price}} <br>
                                                    Web Code : {{$value->code}}<br>
                                                    Brand:{{$value->brand}}
                                                    <hr>
                                                    Trending: @if($value->trending == 1)Active
                                                              @else Inactive
                                                              @endif
                                                    &nbsp; <a onclick="return confirm('Swap Product Tredning Status')" href="{{url('/admin')}}/swapTrending/{{$value->id}}"   class="btn btn-info"><i class="icon-exchange icon-white"></i> Swap Trending</a>
                                                    <hr>
                                                    Featured:@if($value->featured == 1)Active
                                                              @else Inactive
                                                              @endif

                                                    &nbsp;<a onclick="return confirm('Swap Product Featured Status')" href="{{url('/admin')}}/swapFeatured/{{$value->id}}"   class="btn btn-success"><i class="icon-exchange icon-white"></i> Swap Featured</a>

                                                    <hr>
                                                    Slider:@if($value->slider == 1)Active
                                                              @else Inactive
                                                              @endif
                                                    &nbsp;<a onclick="return confirm('Swap Product Slider Status')" href="{{url('/admin')}}/swapSlider/{{$value->id}}"   class="btn btn-default"><i class="icon-exchange icon-white"></i> Swap Slider</a>

                                                    </td>
                                                   
                                                   {{-- <!--<td class="center"><img style="max-width:200px; width:100%;" src="{{url('/')}}/uploads/product/{{$value->thumbnail}}"></td>--> --}}
                                                    <td class="center">
                                                    <center>
                                                       @if($value->full == 1)
                                                       <a href="{{url('/admin')}}/swap_full/{{$value->id}}"   class="btn btn-success"><i class="icon-exchange icon-white"></i> Combo:Active </a>
                                                       @else
                                                       <a href="{{url('/admin')}}/swap_full/{{$value->id}}"   class="btn btn-danger"><i class="icon-exchange icon-white"></i> Combo:InActive </a>
                                                       @endif
                                                       <br><br>
                                                       <a href="{{url('/admin')}}/editProduct/{{$value->id}}"   class="btn btn-info"><i class="icon-pencil icon-white"></i> Edit</a><br><br><a href="{{url('/admin')}}/editProductDetails/{{$value->id}}"   class="btn btn-info"><i class="icon-pencil icon-white"></i> Edit Details</a><br><br><a href="#"   class="btn btn-success" data-toggle="modal" data-target="#buttonedModal_{{$value->id}}"><i class="icon-link icon-white"></i> Get Link </a><br><br><a onclick="return confirm('Do you want to delete this product?')" href="{{url('/admin')}}/deleteProduct/{{$value->id}}"   class="btn btn-danger"><i class="icon-trash icon-white"></i> Del</a></center></td>
                                                    <!-- <td class="center"></td> -->
                                                  
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
@foreach($Product as $value)
<!-- Modal links  -->
<div class="col-lg-12">
                        <div class="modal fade" id="buttonedModal_{{$value->id}}" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="H1">{{$value->name}}</h4>
                                        </div>
                                        <div class="modal-body">
                                            <input style="width:100%" type="url" value="{{url('/product')}}/{{$value->slung}}">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
<!-- </Modal Links -->
@endforeach
@endsection