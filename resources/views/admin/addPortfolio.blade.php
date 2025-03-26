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
                        <center><h2> Add Portfolio </h2></center>
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
                 

                 <form class="form-horizontal" method="post"  action="{{url('/admin/add_Portfolio')}}" enctype="multipart/form-data">
                    
                 <div class="form-group">
                        <label for="text1" class="control-label col-lg-4">Portfolio Name</label>

                        <div class="col-lg-8">
                            <input type="text"  id="limiter-text" name="name" value="" placeholder="e.g Car Audio Installation " class="form-control" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="text1" class="control-label col-lg-4">Client Name</label>

                        <div class="col-lg-8">
                            <input type="text" id="text1" name="client" value="" placeholder="e.g Aol Outdoor Adventures " class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="text1" class="control-label col-lg-4">Link(Leave it Blank if Images will be used)</label>

                        <div class="col-lg-8">
                            <input type="text" id="text1" name="link" value="" placeholder="e.g pgXPalanAMg" class="form-control" />
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="text1" class="control-label col-lg-4">Date</label>

                        <div class="col-lg-8">
                            <input type="date" id="text1" name="date" value="" placeholder="e.g pgXPalanAMg" class="form-control" />
                        </div>
                    </div>
                    

                     <div class="form-group">
                        <label for="text1" class="control-label col-lg-4">Service Rendered</label>
                    <div class="col-lg-8">
                        <select name="service" data-placeholder="Choose a Service" class="form-control chzn-select" tabindex="2">
                          
                           <?php $Service = DB::table('services')->get(); ?>
                           @foreach($Service as $value)
                              <option value="{{$value->id}}">{{$value->title}}</option>
                           @endforeach

                        </select>
                        </div>
                        </div>

                    


                        
                        <textarea name="article_ckeditor" id="article_ckeditor" rows="10" cols="80"></textarea>
                           
                        <script src="{{asset('/')}}vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
                        <script>
                            CKEDITOR.replace( 'article_ckeditor' );
                        </script>



                   
                    <center>
                    <div class="form-group col-lg-12">
                        <div class="form-group col-lg-4">
                            <label class="control-label">Image</label>
                            <div class="">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="#" alt="" /></div>
                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                    <div>
                                        <span class="btn btn-file btn-primary"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input name="image_one" type="file" /></span>
                                        <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-lg-4">
                            <label class="control-label">Image</label>
                            <div class="">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="#" alt="" /></div>
                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                    <div>
                                        <span class="btn btn-file btn-primary"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input name="image_two" type="file" /></span>
                                        <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-lg-4">
                            <label class="control-label">Image</label>
                            <div class="">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="#" alt="" /></div>
                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                    <div>
                                        <span class="btn btn-file btn-primary"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input name="image_three" type="file" /></span>
                                        <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-lg-6">
                            <label class="control-label">Image</label>
                            <div class="">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="#" alt="" /></div>
                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                    <div>
                                        <span class="btn btn-file btn-primary"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input name="image_four" type="file" /></span>
                                        <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-lg-6">
                            <label class="control-label">Image</label>
                            <div class="">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="#" alt="" /></div>
                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                    <div>
                                        <span class="btn btn-file btn-primary"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input name="image_five" type="file" /></span>
                                        <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                 
                    </div>
                    </center>
                    <br><br>
                    <div class="col-lg-12 text-center">
                      <button type="submit" class="btn btn-success"><i class="icon-plus icon-white"></i> Add Portfolio</button>
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