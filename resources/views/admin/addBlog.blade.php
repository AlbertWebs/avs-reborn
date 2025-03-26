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
                        
                        <center><h2> Add Blog Post </h2></center>
                        
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
                 </center>
                     <form class="form-horizontal" method="post"  action="{{url('/admin/add_blog')}}" enctype="multipart/form-data" >
                 
                    

                     <div class="form-group">
                        <label for="text1" class="control-label col-lg-4">Post Title</label>

                        <div class="col-lg-8">
                            <input type="text" id="text1" name="title" value="" placeholder="e.g Juliet Wangui Waraga " class="form-control" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="text1" class="control-label col-lg-4">Link</label>

                        <div class="col-lg-8">
                            <input type="text" id="text1" name="link" value="" placeholder="e.g https://youtube.com/watch/videocode" class="form-control" />
                        </div>
                    </div>

                    <div class="form-group">
                    <label class="control-label col-lg-4">Category</label>

                    
                        

                    <div class="col-lg-8">
                        <select name="cat" data-placeholder="Select Category" class="form-control chzn-select" tabindex="2">
                          
                           <?php $TheCategoryList = DB::table('category')->get(); ?>
                           @foreach($TheCategoryList as $value)
                              <option value="{{$value->id}}">{{$value->cat}}</option>
                           @endforeach

                        </select>
                    </div>
                    </div>

                    <!-- <div class="form-group">
                    <label class="control-label col-lg-4">Remove The Unwanted Tags</label>

                    
                        

                    <div class="col-lg-8">
                    <input name="tags" id="tags" value="@foreach($Category as $value){{$value->cat}},@endforeach" class="form-control" />
                      <p class="help-block">Separate each tag with a comma e.g Adventure,Camp,Travel</p>
                    </div>
                    </div> -->

  

                    
                    

                        <textarea name="content" id="article_ckeditor" rows="10" cols="80"></textarea>
                           
                        <script src="{{asset('/')}}vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
                        <script>
                            CKEDITOR.replace( 'article_ckeditor' );
                        </script>
   
                   
                   

                         
                    
                    
                         <center>
                             <br><br>
                    <div class="form-group col-lg-12">
                        <div class="col-lg-6">
                        <div class="form-group">
                            <label>Thumbnail</label>
                            
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="../assets/img/shopping_cart.png" alt="" /></div>
                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                    <div>
                                        <span class="btn btn-file btn-primary"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name="image_one" /></span>
                                        <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-6">
                        <div class="form-group">
                            <label>featured image</label>
                            
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="../assets/img/shopping_cart.png" alt="" /></div>
                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                    <div>
                                        <span class="btn btn-file btn-primary"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name="image_two" /></span>
                                        <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
</center>
                    
                         
            
                   <center>
                        <div class="form-group">
                           <button class="btn btn-success" type="submit" name="add">Add Blog</button> 
                        </div>
                    </center>
                         
                         <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  
                </form>
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