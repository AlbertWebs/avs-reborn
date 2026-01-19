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
                <!--BLOCK SECTION -->
                 <div class="row">
                    <div class="col-lg-12">
                        @include('admin.panel')
                    </div>
                </div>
                  <!--END BLOCK SECTION -->

                <!-- Improved Header -->
                <div class="row" style="margin-bottom: 30px;">
                    <div class="col-lg-12">
                        <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 25px 30px; border-radius: 10px; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <div>
                                    <h2 style="margin: 0; color: white; font-weight: 600; display: flex; align-items: center; gap: 12px;">
                                        <i class="icon-edit" style="font-size: 28px;"></i>
                                        Edit Category
                                    </h2>
                                    <p style="margin: 8px 0 0 0; color: rgba(255,255,255,0.9); font-size: 14px;">{{$Category->cat}}</p>
                                </div>
                                <a href="{{url('/admin/categories')}}" class="btn" style="background: rgba(255,255,255,0.2); color: white; border: 1px solid rgba(255,255,255,0.3); padding: 10px 20px; border-radius: 6px; transition: all 0.3s;">
                                    <i class="icon-arrow-left"></i> Back to Categories
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Alerts -->
                <div class="row">
                    <div class="col-lg-12">
                        @if(Session::has('message'))
                            <div class="alert alert-success" style="border-radius: 8px; border-left: 4px solid #28a745; box-shadow: 0 2px 8px rgba(40,167,69,0.2);">
                                <i class="icon-ok"></i> {{ Session::get('message') }}
                            </div>
                        @endif

                        @if(Session::has('messageError'))
                            <div class="alert alert-danger" style="border-radius: 8px; border-left: 4px solid #dc3545; box-shadow: 0 2px 8px rgba(220,53,69,0.2);">
                                <i class="icon-remove"></i> {{ Session::get('messageError') }}
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Form Card -->
                <div class="row">
                    <div class="col-lg-12">
                        <div style="background: white; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); padding: 30px; margin-bottom: 20px;">
                            <form class="form-horizontal" method="post" action="{{url('/admin/edit_Category')}}/{{$Category->id}}" enctype="multipart/form-data">
                                
                                <!-- Basic Information Section -->
                                <div style="border-bottom: 2px solid #f0f0f0; padding-bottom: 25px; margin-bottom: 30px;">
                                    <h3 style="color: #667eea; font-weight: 600; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                                        <i class="icon-info-sign"></i> Basic Information
                                    </h3>
                                    
                                    <div class="form-group" style="margin-bottom: 20px;">
                                        <label for="text1" class="control-label col-lg-4" style="font-weight: 600; color: #333; padding-top: 10px;">
                                            Category Name <span style="color: #dc3545;">*</span>
                                        </label>
                                        <div class="col-lg-8">
                                            <input type="text" id="text1" name="name" value="{{$Category->cat}}" placeholder="e.g Car Speakers" class="form-control" style="border-radius: 6px; border: 1px solid #ddd; padding: 10px 15px; transition: all 0.3s;" />
                                        </div>
                                    </div>

                                    <div class="form-group" style="margin-bottom: 20px;">
                                        <label for="limiter" class="control-label col-lg-4" style="font-weight: 600; color: #333; padding-top: 10px;">
                                            Meta Keywords
                                        </label>
                                        <div class="col-lg-8">
                                            <textarea name="keywords" class="form-control" rows="3" style="border-radius: 6px; border: 1px solid #ddd; padding: 10px 15px; resize: vertical;">{{$Category->keywords}}</textarea>
                                            <small class="help-block" style="color: #666; margin-top: 5px;"><i class="icon-info-sign"></i> SEO keywords for this category</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Description Section -->
                                <div style="border-bottom: 2px solid #f0f0f0; padding-bottom: 25px; margin-bottom: 30px;">
                                    <h3 style="color: #667eea; font-weight: 600; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                                        <i class="icon-file-text"></i> Description
                                    </h3>
                                    
                                    <div class="form-group" style="margin-bottom: 20px;">
                                        <label class="control-label col-lg-4" style="font-weight: 600; color: #333; padding-top: 10px;">
                                            Category Description
                                        </label>
                                        <div class="col-lg-8">
                                            <textarea name="content" id="wysihtml5" class="form-control" rows="8" style="border-radius: 6px; border: 1px solid #ddd; padding: 10px 15px;">{{$Category->description}}</textarea>
                                            <small class="help-block" style="color: #666; margin-top: 5px;">Detailed description of this category</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Image Section -->
                                <div style="border-bottom: 2px solid #f0f0f0; padding-bottom: 25px; margin-bottom: 30px;">
                                    <h3 style="color: #667eea; font-weight: 600; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                                        <i class="icon-picture"></i> Category Image
                                    </h3>
                                    
                                    <div class="row">
                                        <div class="col-lg-6" style="margin: 0 auto;">
                                            <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; border: 2px dashed #ddd; text-align: center;">
                                                <label class="control-label" style="font-weight: 600; color: #333; display: block; margin-bottom: 15px;">
                                                    <i class="icon-picture"></i> Category Banner
                                                </label>
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                    <div class="fileupload-new thumbnail" style="width: 100%; height: 200px; background: white; border-radius: 6px; overflow: hidden; border: 1px solid #ddd;">
                                                        <img src="{{url('/')}}/uploads/categories/{{$Category->image}}" alt="" style="width: 100%; height: 100%; object-fit: cover;" />
                                                    </div>
                                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 100%; max-height: 200px; border-radius: 6px; overflow: hidden;"></div>
                                                    <div style="margin-top: 15px;">
                                                        <span class="btn btn-file btn-primary" style="border-radius: 6px; padding: 8px 20px;">
                                                            <span class="fileupload-new"><i class="icon-upload"></i> Select Image</span>
                                                            <span class="fileupload-exists"><i class="icon-edit"></i> Change</span>
                                                            <input name="image" type="file" />
                                                        </span>
                                                        <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload" style="border-radius: 6px; padding: 8px 15px; margin-left: 5px;">
                                                            <i class="icon-trash"></i> Remove
                                                        </a>
                                                    </div>
                                                    <small style="display: block; margin-top: 10px; color: #666;">Recommended: 870x200px</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Form Actions -->
                                <div class="row">
                                    <div class="col-lg-12" style="text-align: center; padding-top: 20px; border-top: 2px solid #f0f0f0;">
                                        <button type="submit" class="btn btn-success" style="padding: 12px 40px; font-size: 16px; font-weight: 600; border-radius: 6px; box-shadow: 0 4px 12px rgba(40,167,69,0.3); transition: all 0.3s;">
                                            <i class="icon-check icon-white"></i> Save Changes
                                        </button>
                                        <a href="{{url('/admin/categories')}}" class="btn btn-default" style="padding: 12px 40px; font-size: 16px; font-weight: 600; border-radius: 6px; margin-left: 10px;">
                                            <i class="icon-remove"></i> Cancel
                                        </a>
                                    </div>
                                </div>
                                
                                <input type="hidden" name="image_cheat" value="{{$Category->image}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </form>
                        </div>
                    </div>
                </div>

                <style>
                    .form-control:focus {
                        border-color: #667eea;
                        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
                    }
                    .btn-success:hover {
                        transform: translateY(-2px);
                        box-shadow: 0 6px 16px rgba(40,167,69,0.4) !important;
                    }
                    .fileupload .thumbnail img {
                        border-radius: 6px;
                    }
                </style>
                  <!-- Inner Content Ends Here -->



                
            </div>

        </div>
        <!--END PAGE CONTENT -->

         <!-- RIGHT STRIP  SECTION -->
         @include('admin.right')
         <!-- END RIGHT STRIP  SECTION -->
    </div>

@endsection
