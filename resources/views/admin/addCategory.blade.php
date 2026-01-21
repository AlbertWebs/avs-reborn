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
                                        <i class="icon-plus" style="font-size: 28px;"></i>
                                        Add New Category
                                    </h2>
                                    <p style="margin: 8px 0 0 0; color: rgba(255,255,255,0.9); font-size: 14px;">Create a new product category</p>
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
                            <form class="form-horizontal" method="post" action="{{url('/admin/add_Category')}}" enctype="multipart/form-data">
                                
                                <div class="form-group" style="margin-bottom: 25px;">
                                    <label for="text1" class="control-label col-lg-4" style="font-weight: 600; color: #333; padding-top: 10px;">
                                        Category Name <span style="color: #dc3545;">*</span>
                                    </label>
                                    <div class="col-lg-8">
                                        <input type="text" id="text1" name="name" value="" placeholder="e.g Car Speakers" class="form-control" style="border-radius: 6px; border: 1px solid #ddd; padding: 10px 15px; transition: all 0.3s;" />
                                        <small class="help-block" style="color: #666; margin-top: 5px;">Enter the category name</small>
                                    </div>
                                </div>

                                <div class="form-group" style="margin-bottom: 25px;">
                                    <label for="slung" class="control-label col-lg-4" style="font-weight: 600; color: #333; padding-top: 10px;">
                                        Category Slug
                                    </label>
                                    <div class="col-lg-8">
                                        <input type="text" id="slung" name="slung" value="" placeholder="e.g car-speakers" class="form-control" style="border-radius: 6px; border: 1px solid #ddd; padding: 10px 15px; transition: all 0.3s;" />
                                        <small class="help-block" style="color: #666; margin-top: 5px;"><i class="icon-info-sign"></i> Leave empty to automatically generate from name</small>
                                    </div>
                                </div>

                                <!-- Form Actions -->
                                <div class="row">
                                    <div class="col-lg-12" style="text-align: center; padding-top: 20px; border-top: 2px solid #f0f0f0;">
                                        <button type="submit" class="btn btn-success" style="padding: 12px 40px; font-size: 16px; font-weight: 600; border-radius: 6px; box-shadow: 0 4px 12px rgba(40,167,69,0.3); transition: all 0.3s;">
                                            <i class="icon-plus icon-white"></i> Add Category
                                        </button>
                                        <a href="{{url('/admin/categories')}}" class="btn btn-default" style="padding: 12px 40px; font-size: 16px; font-weight: 600; border-radius: 6px; margin-left: 10px;">
                                            <i class="icon-remove"></i> Cancel
                                        </a>
                                    </div>
                                </div>
                                
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Scripts and Styles Section -->
                <div>
                    <style>
                        .form-control:focus {
                            border-color: #667eea;
                            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
                        }
                        .btn-success:hover {
                            transform: translateY(-2px);
                            box-shadow: 0 6px 16px rgba(40,167,69,0.4) !important;
                        }
                    </style>
                </div>

            </div>
                  <!-- Inner Content Ends Here -->

        </div>
        <!--END PAGE CONTENT -->

         <!-- RIGHT STRIP  SECTION -->
        @include('admin.right')
         <!-- END RIGHT STRIP  SECTION -->
    </div>

@endsection