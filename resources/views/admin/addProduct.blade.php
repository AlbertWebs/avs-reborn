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
                        
                        <center><h2> Add Product </h2></center>
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
                 

                 <form class="form-horizontal" method="post"  action="{{url('/admin/add_Product')}}" enctype="multipart/form-data">
                    
                 <div class="form-group">
                        <label for="text1" class="control-label col-lg-4">Product Name</label>

                        <div class="col-lg-8">
                            <input id="limiter-text" type="text" id="text1" name="name" value="" placeholder="e.g Studios Website " class="form-control" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="text1" class="control-label col-lg-4">Product Price</label>

                        <div class="col-lg-8">
                            <input type="number" id="text1" name="price" value="" placeholder="e.g 12500" class="form-control" />
                        </div>
                    </div>

                  
                    

                    <div class="form-group">
                        <label for="text1" class="control-label col-lg-4">Product Web Code</label>

                        <div class="col-lg-8">
                            <input type="text" id="text1" name="code" value="" placeholder="e.g REALES2019 " class="form-control" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="limiter" class="control-label col-lg-4">Meta Data</label>

                        <div class="col-lg-8">
                            <textarea id="limiter" name="meta" class="form-control"></textarea>
                            <p class="help-block">Brief Description of the product for SEO</p>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="limiter" class="control-label col-lg-4">Youtube iFrame</label>

                        <div class="col-lg-8">
                            <textarea id="liamiter" name="iframe" class="form-control"></textarea>
                            <p class="help-block">bnfse4NXo0k</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-4">Google Product Category</label>
    
                        <div class="col-lg-8">
                            <select name="google_product_category" data-placeholder="Choose Category" class="form-control chzn-select" tabindex="2">
                              
                               <?php $TheCategoryList = DB::table('g_p_c_s')->get(); ?>
                               @foreach($TheCategoryList as $value)
                                  <option value="{{$value->code}}">{{$value->category}} - {{$value->code}}</option>
                               @endforeach
    
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                    <label class="control-label col-lg-4">Category</label>

                    
                        

                    <div class="col-lg-8">
                        <select name="cat" data-placeholder="Choose Category" class="form-control chzn-select" tabindex="2">
                          
                           <?php $TheCategoryList = DB::table('category')->get(); ?>
                           @foreach($TheCategoryList as $value)
                              <option value="{{$value->id}}">{{$value->cat}}</option>
                           @endforeach

                        </select>
                    </div>
                    </div>

                    <!-- <div class="form-group">
                    <label class="control-label col-lg-4">Sub Category</label>

                    
                        

                    <div class="col-lg-8">
                        <select name="sub_cat" data-placeholder="Choose Sub Category" class="form-control chzn-select" tabindex="2">
                          
                           <?php $TheSubCategoryList = DB::table('sub_category')->get(); ?>
                           @foreach($TheSubCategoryList as $value)
                              <option value="{{$value->id}}">{{$value->name}}</option>
                           @endforeach

                        </select>
                    </div>
                    </div> -->


                    <!-- Brands -->

                    <div class="form-group">
                    <label class="control-label col-lg-4">Brand</label>

                    
                  

                    <div class="col-lg-8">
                        <select name="brand" data-placeholder="Choose Sub Category" class="form-control chzn-select" tabindex="2">
                          
                           
                           <?php $ThebrandList = DB::table('brands')->get(); ?>
                           @foreach($ThebrandList as $brandvalue)
                              <option value="{{$brandvalue->name}}">{{$brandvalue->name}}</option>
                           @endforeach

                        </select>
                    </div>
                    </div>
                    <!-- Brands -->
          
                        {{-- <div class="col-lg-12">
                            <div class="box">
                                <header>
                                    <div class="icons"><i class="icon-th-large"></i></div>
                                    <h5>Product Description</h5>
                                    <ul class="nav pull-right">
                                        <li>
                                            <div class="btn-group">
                                                <a class="accordion-toggle btn btn-xs minimize-box" data-toggle="collapse"
                                                    href="#div-1">
                                                    <i class="icon-minus"></i>
                                                </a>
                                                 <button class="btn btn-danger btn-xs close-box">
                                                    <i
                                                        class="icon-remove"></i>
                                                </button>
                                            </div>
                                        </li>
                                    </ul>
                                </header>
                                <div id="div-1" class="body collapse in">
                                    
                                        <textarea name="content" id="wysihtml5" class="form-control" rows="10"></textarea>

                                    
                                </div>
                            </div>
                        </div> --}}

                        <textarea name="content" id="article_ckeditor" rows="10" cols="80"></textarea>
                           
                        <script src="{{asset('/')}}vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
                        <script>
                            CKEDITOR.replace( 'article_ckeditor' );
                        </script>
                   
                    <center>
                    <div class="form-group col-lg-12">
                    <div class="form-group col-lg-12">
                        <label class="control-label">Thumb</label>
                        <div class="">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="" alt="" /></div>
                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                <div>
                                    <span class="btn btn-file btn-primary"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input name="thumbnail" type="file" /></span>
                                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-lg-12">
                        <label class="control-label">Facebook Pixels</label>
                        <div class="">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="" alt="" /></div>
                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                <div>
                                    <span class="btn btn-file btn-primary"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input name="fb_pixels" type="file" /></span>
                                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                        
                    {{--  --}}
                    <div class="form-group col-lg-4">
                        <label class="control-label">Image One(Main)</label>
                        <div class="">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="" alt="" /></div>
                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                <div>
                                    <span class="btn btn-file btn-primary"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input name="image_one" type="file" /></span>
                                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group col-lg-4">
                        <label class="control-label">Image Two(W-384 H-660)</label>
                        <div class="">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="" alt="" /></div>
                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                <div>
                                    <span class="btn btn-file btn-primary"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input name="image_two" type="file" /></span>
                                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    <div class="form-group col-lg-4">
                        <label class="control-label">Image Three(w = 570 h=200)</label>
                        <div class="">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="" alt="" /></div>
                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                <div>
                                    <span class="btn btn-file btn-primary"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input name="image_three" type="file" /></span>
                                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a>
                                </div>
                            </div>
                        </div>
                    </div>

                   

                    
                    </div>
                    </center>
                    <br><br>
                    <div class="col-lg-12 text-center">
                      <button type="submit" class="btn btn-success"><i class="icon-plus icon-white"></i> Add Product</button>
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