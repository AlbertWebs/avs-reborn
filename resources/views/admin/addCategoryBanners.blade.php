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
                        
                        <center><h2> Add Category Banners </h2></center>
                        
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
               
                  <!-- Inner Content Here -->
                 
            <div class="inner">
                

              <div class="row">
               <center>
                 @if(Session::has('message'))
							   <div class="alert alert-success">{{ Session::get('message') }}</div>
				@endif

                @if(Session::has('messageError'))
							   <div class="alert alert-danger">{{ Session::get('messageError') }}</div>
				@endif
                 </center>
                 

                 <form class="form-horizontal" method="post"  action="{{url('/admin/add_CategoryBanners')}}" enctype="multipart/form-data">
                    
                    <div class="form-group">
                        <label for="text1" class="control-label col-lg-2">Title</label>

                        <div class="col-lg-10">
                            <input type="text" id="text1" name="title" value="" placeholder="e.g Get Started " class="form-control" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Category ID</label>
    
                        
                      
    
                        <div class="col-lg-10">
                            <select name="category_id" data-placeholder="Choose Product in Banner" class="form-control chzn-select" tabindex="2">
                              
                               
                               <?php $ThebrandList = DB::table('category')->get(); ?>
                               @foreach($ThebrandList as $brandvalue)
                                  <option value="{{$brandvalue->id}}">{{$brandvalue->cat}}</option>
                               @endforeach
    
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Product</label>
    
                        
                      
    
                        <div class="col-lg-10">
                            <select name="product_id" data-placeholder="Choose Product in Banner" class="form-control chzn-select" tabindex="2">
                              
                               <option value="">Choose Product</option>
                               <?php $ThebrandList = DB::table('product')->get(); ?>
                               @foreach($ThebrandList as $brandvalue)
                                  <option value="{{$brandvalue->id}}">{{$brandvalue->name}}</option>
                               @endforeach
    
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Grid</label>
                        <div class="col-lg-10">
                            <select name="format" data-placeholder="Choose Product in Banner" class="form-control chzn-select" tabindex="2">
                              
                                  <option value="1">One Grid</option>
                                  <option value="2">Two Grids</option>
                                  <option value="3">Three Grids</option>
    
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2">Offer Description</label>
                        <div class="form-group col-lg-10">
                        <textarea name="content" id="article_ckeditor" rows="10" cols="80"></textarea>
                        </div>
                    </div>
                           
                    <script src="{{asset('/')}}vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
                    <script>
                        CKEDITOR.replace( 'article_ckeditor' );
                    </script>

                    <center>
                        <br><br>
                    <div class="form-group col-lg-12">
                    <div class="col-lg-12">
                    <div class="form-group">
                    <label>Thumbnail 367 by 260(3 grid & 2 Grid)  - 1920 by 512(One Grid)</label>
                    
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="#" alt="" /></div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                            <div>
                                <span class="btn btn-file btn-primary"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name="image" /></span>
                                <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a>
                            </div>
                        </div>
                    </div>
                    </div>

                    
                    </div>
                    </center>

          
                        
                   
                   
                    <br><br>
                    <div class="col-lg-12 text-center">
                      <button type="submit" class="btn btn-success"><i class="icon-plus icon-white"></i> Add Category</button>
                    </div>
                    
                    
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    
                <form>
              </div>

            </div>
                  <!-- Inner Content Ends Here -->



                
            </div>

        </div>
        <!--END PAGE CONTENT -->

         <!-- RIGHT STRIP  SECTION -->
        @include('admin.right')
         <!-- END RIGHT STRIP  SECTION -->
    </div>

@endsection