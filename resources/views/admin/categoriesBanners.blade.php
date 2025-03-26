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
                        
                        <center><h2> Categories Banners </h2></center>
                        
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
                                    Categories
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Name</th>
                                                    
                                                    <th>Image</th>
                                                    <th>Del</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($Category as $value)
                                                <tr class="odd gradeX">
                                                    <td>{{$value->id}}</td>
                                                    <td>{{$value->title}}<br><hr>{{$value->format}} Grid<br><hr><?php $Category = DB::table('category')->where('id',$value->category_id)->get(); ?> @foreach($Category as $Cat) {{$Cat->cat}} @endforeach</td>
                                                    <td class="center"> <img style="max-width:200px; width:100%;" src="{{url('/')}}/uploads/CategoryBanners/{{$value->banner}}"> </td>
                                                    <td class="center"><a href="{{url('/admin')}}/editCategoriesBanners/{{$value->id}}"   class="btn btn-info"><i class="icon-pencil icon-white"></i> Edit</a><br><br><a onclick="return confirm('Deleting this May affect Tables that depend on this item, Are you sure you want to continue')" href="{{url('/admin')}}/deleteCategoryBanners/{{$value->id}}"   class="btn btn-danger"><i class="icon-trash icon-white"></i> Del</a></td>
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