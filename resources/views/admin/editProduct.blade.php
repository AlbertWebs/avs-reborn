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
                                        Edit Product
                                    </h2>
                                    <p style="margin: 8px 0 0 0; color: rgba(255,255,255,0.9); font-size: 14px;">{{$Product->name}}</p>
                                </div>
                                <a href="{{url('/admin/products')}}" class="btn" style="background: rgba(255,255,255,0.2); color: white; border: 1px solid rgba(255,255,255,0.3); padding: 10px 20px; border-radius: 6px; transition: all 0.3s;">
                                    <i class="icon-arrow-left"></i> Back to Products
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
                            <form id="productForm" class="form-horizontal" method="post" action="{{url('/admin/edit_Product')}}/{{$Product->id}}" enctype="multipart/form-data">

                                <!-- Basic Information Section -->
                                <div style="border-bottom: 2px solid #f0f0f0; padding-bottom: 25px; margin-bottom: 30px;">
                                    <h3 style="color: #667eea; font-weight: 600; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                                        <i class="icon-info-sign"></i> Basic Information
                                    </h3>
                                    
                                    <div class="form-group" style="margin-bottom: 20px;">
                                        <label for="text1" class="control-label col-lg-4" style="font-weight: 600; color: #333; padding-top: 10px;">
                                            Product Name <span style="color: #dc3545;">*</span>
                                        </label>
                                        <div class="col-lg-8">
                                            <input autocomplete="off" id="limiter-text" type="text" id="text1" name="name" value="{{$Product->name}}" placeholder="e.g Sony XS-162ES 6.5\" 2-Way Car Speakers" class="form-control" style="border-radius: 6px; border: 1px solid #ddd; padding: 10px 15px; transition: all 0.3s;" />
                                        </div>
                                    </div>

                                    <div class="form-group" style="margin-bottom: 20px;">
                                        <label for="text1" class="control-label col-lg-4" style="font-weight: 600; color: #333; padding-top: 10px;">
                                            Product Price (KES) <span style="color: #dc3545;">*</span>
                                        </label>
                                        <div class="col-lg-8">
                                            <div class="input-group" style="display: flex;">
                                                <span class="input-group-addon" style="background: #f8f9fa; border: 1px solid #ddd; border-right: none; border-radius: 6px 0 0 6px; padding: 10px 15px;">KES</span>
                                                <input type="text" name="price" value="{{$Product->price}}" placeholder="{{$Product->price}}" class="form-control" style="border-radius: 0 6px 6px 0; border-left: none; padding: 10px 15px;" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group" style="margin-bottom: 20px;">
                                        <label for="text1" class="control-label col-lg-4" style="font-weight: 600; color: #333; padding-top: 10px;">
                                            Product Code
                                        </label>
                                        <div class="col-lg-8">
                                            <input type="text" id="text1" name="code" value="{{$Product->code}}" placeholder="e.g AASAA" class="form-control" style="border-radius: 6px; border: 1px solid #ddd; padding: 10px 15px;" />
                                            <small class="help-block" style="color: #666; margin-top: 5px;">Unique product identifier</small>
                                        </div>
                                    </div>

                                    <div class="form-group" style="margin-bottom: 20px;">
                                        <label for="limiter" class="control-label col-lg-4" style="font-weight: 600; color: #333; padding-top: 10px;">
                                            Meta Description
                                        </label>
                                        <div class="col-lg-8">
                                            <textarea id="limiter" name="meta" class="form-control" rows="3" style="border-radius: 6px; border: 1px solid #ddd; padding: 10px 15px; resize: vertical;">{{$Product->meta}}</textarea>
                                            <small class="help-block" style="color: #666; margin-top: 5px;"><i class="icon-info-sign"></i> Brief description for SEO (150-160 characters recommended)</small>
                                        </div>
                                    </div>

                                    <div class="form-group" style="margin-bottom: 20px;">
                                        <label for="limiter" class="control-label col-lg-4" style="font-weight: 600; color: #333; padding-top: 10px;">
                                            YouTube Video ID
                                        </label>
                                        <div class="col-lg-8">
                                            <div class="input-group">
                                                <span class="input-group-addon" style="background: #f8f9fa; border: 1px solid #ddd; border-right: none; border-radius: 6px 0 0 6px; padding: 10px 15px;">youtube.com/watch?v=</span>
                                                <input type="text" id="liamiter" name="iframe" value="{{$Product->iframe}}" class="form-control" placeholder="bnfse4NXo0k" style="border-radius: 0 6px 6px 0; border-left: none; padding: 10px 15px;" />
                                            </div>
                                            <small class="help-block" style="color: #666; margin-top: 5px;">Enter only the video ID (e.g., bnfse4NXo0k)</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Category & Brand Section -->
                                <div style="border-bottom: 2px solid #f0f0f0; padding-bottom: 25px; margin-bottom: 30px;">
                                    <h3 style="color: #667eea; font-weight: 600; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                                        <i class="icon-tags"></i> Category & Brand
                                    </h3>


                                    <div class="form-group" style="margin-bottom: 20px;">
                                        <label class="control-label col-lg-4" style="font-weight: 600; color: #333; padding-top: 10px;">
                                            Category <span style="color: #dc3545;">*</span>
                                        </label>
                                        <?php
                                            $CatID = $Product->cat;
                                            $TheCategory = DB::table('category')->where('id',$CatID)->get();
                                        ?>
                                        <div class="col-lg-8">
                                            <select name="cat" data-placeholder="Choose Category" class="form-control chzn-select" tabindex="2" style="border-radius: 6px; border: 1px solid #ddd; padding: 10px 15px;">
                                                <option selected="selected" value="{{$Product->cat}}">@foreach($TheCategory as $valuee){{$valuee->cat}} @endforeach</option>
                                                <?php $TheCategoryList = DB::table('category')->get(); ?>
                                                @foreach($TheCategoryList as $value)
                                                    <option value="{{$value->id}}">{{$value->cat}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group" style="margin-bottom: 20px;">
                                        <label class="control-label col-lg-4" style="font-weight: 600; color: #333; padding-top: 10px;">
                                            Google Product Category
                                        </label>
                                        <?php
                                            $CatID = $Product->google_product_category;
                                            $TheCategory = DB::table('g_p_c_s')->where('code',$CatID)->get();
                                        ?>
                                        <div class="col-lg-8">
                                            <select name="google_product_category" data-placeholder="Choose Google Category" class="form-control chzn-select" tabindex="2" style="border-radius: 6px; border: 1px solid #ddd; padding: 10px 15px;">
                                                <option selected value="{{$Product->google_product_category}}">@foreach($TheCategory as $valuee){{$valuee->category}} - {{$valuee->code}} @endforeach</option>
                                                <?php $TheCategoryList = DB::table('g_p_c_s')->get(); ?>
                                                @foreach($TheCategoryList as $value)
                                                    <option value="{{$value->code}}">{{$value->category}} - {{$value->code}}</option>
                                                @endforeach
                                            </select>
                                            <small class="help-block" style="color: #666; margin-top: 5px;">For Google Shopping integration</small>
                                        </div>
                                    </div>

                                    <div class="form-group" style="margin-bottom: 20px;">
                                        <label class="control-label col-lg-4" style="font-weight: 600; color: #333; padding-top: 10px;">
                                            Brand
                                        </label>
                                        <div class="col-lg-8">
                                            <select name="brand" data-placeholder="Choose Brand" class="form-control chzn-select" tabindex="2" style="border-radius: 6px; border: 1px solid #ddd; padding: 10px 15px;">
                                                <option selected="selected" value="{{$Product->brand}}">{{$Product->brand}}</option>
                                                <?php $ThebrandList = DB::table('brands')->get(); ?>
                                                @foreach($ThebrandList as $brandvalue)
                                                    <option value="{{$brandvalue->name}}">{{$brandvalue->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group" style="margin-bottom: 20px;">
                                        <label class="control-label col-lg-4" style="font-weight: 600; color: #333; padding-top: 10px;">
                                            Tag
                                        </label>
                                        <?php
                                            $TagID = $Product->tag;
                                            $TheCategory = DB::table('tags')->where('id',$TagID)->get();
                                        ?>
                                        <div class="col-lg-8">
                                            <select name="tag" data-placeholder="Choose tag" class="form-control chzn-select" tabindex="2" style="border-radius: 6px; border: 1px solid #ddd; padding: 10px 15px;">
                                                <option selected="selected" value="{{$Product->tag}}">@foreach($TheCategory as $valuee){{$valuee->title}} @endforeach</option>
                                                <?php $TheCategoryList = DB::table('tags')->get(); ?>
                                                @foreach($TheCategoryList as $value)
                                                    <option value="{{$value->id}}">{{$value->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group" style="margin-bottom: 20px;">
                                        <label class="control-label col-lg-4" style="font-weight: 600; color: #333; padding-top: 10px;">
                                            Replaced With
                                        </label>
                                        <?php
                                            $replacedvalue = $Product->replaced;
                                        ?>
                                        <div class="col-lg-8">
                                            <select name="replaced" data-placeholder="Replaced With" class="form-control chzn-select" tabindex="2" style="border-radius: 6px; border: 1px solid #ddd; padding: 10px 15px;">
                                                @if($replacedvalue == 0)
                                                    <option selected="selected" value="0">None</option>
                                                @else
                                                    <?php $ProductID = app\Models\Product::find($replacedvalue) ?>
                                                    <option selected="selected" value="{{$replacedvalue}}">{{$ProductID->name ?? 'Unknown'}}</option>
                                                @endif
                                                <?php $TheCategoryList = DB::table('product')->get(); ?>
                                                @foreach($TheCategoryList as $value)
                                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Stock Control Section -->
                                <div style="border-bottom: 2px solid #f0f0f0; padding-bottom: 25px; margin-bottom: 30px;">
                                    <h3 style="color: #667eea; font-weight: 600; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                                        <i class="icon-check"></i> Stock Status
                                    </h3>

                    <!-- <div class="form-group">
                    <label class="control-label col-lg-4">Sub Category</label>


                    <?php
                            $CatID = $Product->sub_cat;
                            $TheCategory = DB::table('sub_category')->where('id',$CatID)->get();

                    ?>

                    <div class="col-lg-8">
                        <select name="sub_cat" data-placeholder="Choose Sub Category" class="form-control chzn-select" tabindex="2">
                           <option selected="selected" value="{{$Product->sub_cat}}">@foreach($TheCategory as $valuee){{$valuee->name}} @endforeach</option>
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
                           <option selected="selected" value="{{$Product->brand}}">{{$Product->brand}}</option>

                           <?php $ThebrandList = DB::table('brands')->get(); ?>
                           @foreach($ThebrandList as $brandvalue)
                              <option value="{{$brandvalue->name}}">{{$brandvalue->name}}</option>
                           @endforeach

                        </select>
                    </div>
                    </div>
                    <!-- Brands -->

                                    <div class="form-group" style="margin-bottom: 20px;">
                                        <label class="control-label col-lg-4" style="font-weight: 600; color: #333; padding-top: 10px;">
                                            Stock Status
                                        </label>
                                        <div class="col-lg-8">
                                            <div class="make-switch" data-on="success" data-off="danger" style="margin-top: 8px;">
                                                <?php
                                                   $Stock = $Product->stock;
                                                   if($Stock == 'In Stock'){
                                                       $stockValue = 'checked';
                                                   }else{
                                                       $stockValue = '';
                                                   }
                                                ?>
                                                <input name="stock" type="checkbox" {{$stockValue}} />
                                            </div>
                                            <small class="help-block" style="color: #666; margin-top: 5px;">Toggle to set product availability</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Product Description Section -->
                                <div style="border-bottom: 2px solid #f0f0f0; padding-bottom: 25px; margin-bottom: 30px;">
                                    <h3 style="color: #667eea; font-weight: 600; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                                        <i class="icon-file-text"></i> Product Description
                                    </h3>
{{--
                        <div class="col-lg-12">
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

                                        <textarea name="content" id="wysihtml5" class="form-control" rows="10">{{$Product->content}}</textarea>


                                </div>
                            </div>
                        </div> --}}


                                    <div class="form-group" style="margin-bottom: 20px;">
                                        <label class="control-label col-lg-4" style="font-weight: 600; color: #333; padding-top: 10px;">
                                            Description <span style="color: #dc3545;">*</span>
                                        </label>
                                        <div class="col-lg-8">
                                            <textarea name="content" id="wysihtml5" class="form-control" rows="10">{{$Product->content}}</textarea>
                                            <small class="help-block" style="color: #666; margin-top: 5px;">Detailed product description and specifications</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Product Images Section -->
                                <div style="border-bottom: 2px solid #f0f0f0; padding-bottom: 25px; margin-bottom: 30px;">
                                    <h3 style="color: #667eea; font-weight: 600; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                                        <i class="icon-picture"></i> Product Images
                                    </h3>
                                    <div class="row">
                                        <!-- Thumbnail -->
                                        <div class="col-lg-4" style="margin-bottom: 25px;">
                                            <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; border: 2px dashed #ddd; text-align: center;">
                                                <label class="control-label" style="font-weight: 600; color: #333; display: block; margin-bottom: 15px;">
                                                    <i class="icon-picture"></i> Thumbnail
                                                </label>
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                    <div class="fileupload-new thumbnail" style="width: 100%; height: 180px; background: white; border-radius: 6px; overflow: hidden; border: 1px solid #ddd;">
                                                        <img src="{{url('/')}}/uploads/product/{{$Product->thumbnail}}" alt="" style="width: 100%; height: 100%; object-fit: cover;" />
                                                    </div>
                                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 100%; max-height: 180px; border-radius: 6px; overflow: hidden;"></div>
                                                    <div style="margin-top: 15px;">
                                                        <span class="btn btn-file btn-primary" style="border-radius: 6px; padding: 8px 20px;">
                                                            <span class="fileupload-new"><i class="icon-upload"></i> Select Image</span>
                                                            <span class="fileupload-exists"><i class="icon-edit"></i> Change</span>
                                                            <input name="thumbnail" type="file" />
                                                        </span>
                                                        <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload" style="border-radius: 6px; padding: 8px 15px; margin-left: 5px;">
                                                            <i class="icon-trash"></i> Remove
                                                        </a>
                                                    </div>
                                                    <small style="display: block; margin-top: 10px; color: #666;">Recommended: 250x250px</small>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Facebook Pixels -->
                                        <div class="col-lg-4" style="margin-bottom: 25px;">
                                            <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; border: 2px dashed #ddd; text-align: center;">
                                                <label class="control-label" style="font-weight: 600; color: #333; display: block; margin-bottom: 15px;">
                                                    <i class="icon-picture"></i> Facebook Pixel
                                                </label>
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                    <div class="fileupload-new thumbnail" style="width: 100%; height: 180px; background: white; border-radius: 6px; overflow: hidden; border: 1px solid #ddd;">
                                                        <img src="{{url('/')}}/uploads/product/{{$Product->fb_pixels}}" alt="" style="width: 100%; height: 100%; object-fit: cover;" />
                                                    </div>
                                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 100%; max-height: 180px; border-radius: 6px; overflow: hidden;"></div>
                                                    <div style="margin-top: 15px;">
                                                        <span class="btn btn-file btn-primary" style="border-radius: 6px; padding: 8px 20px;">
                                                            <span class="fileupload-new"><i class="icon-upload"></i> Select Image</span>
                                                            <span class="fileupload-exists"><i class="icon-edit"></i> Change</span>
                                                            <input name="fb_pixels" type="file" />
                                                        </span>
                                                        <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload" style="border-radius: 6px; padding: 8px 15px; margin-left: 5px;">
                                                            <i class="icon-trash"></i> Remove
                                                        </a>
                                                    </div>
                                                    <small style="display: block; margin-top: 10px; color: #666;">Recommended: 1000x1000px</small>
                                                </div>
                                            </div>
                                        </div>

                                        @include('admin.partials.product-image-dropzone', ['product' => $Product])
                                    </div>
                                </div>

                                <!-- Form Actions -->
                                <div class="row">
                                    <div class="col-lg-12" style="text-align: center; padding-top: 20px; border-top: 2px solid #f0f0f0;">
                                        <button type="submit" class="btn btn-success" style="padding: 12px 40px; font-size: 16px; font-weight: 600; border-radius: 6px; box-shadow: 0 4px 12px rgba(40,167,69,0.3); transition: all 0.3s;">
                                            <i class="icon-check icon-white"></i> Save Changes
                                        </button>
                                        <a href="{{url('/admin/products')}}" class="btn btn-default" style="padding: 12px 40px; font-size: 16px; font-weight: 600; border-radius: 6px; margin-left: 10px;">
                                            <i class="icon-remove"></i> Cancel
                                        </a>
                                    </div>
                                </div>

                                <input type="hidden" name="fb_pixels_cheat" value="{{$Product->fb_pixels}}">
                                <input type="hidden" name="thumbnail_cheat" value="{{$Product->thumbnail}}">
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
                        .btn-primary {
                            background: #667eea;
                            border-color: #667eea;
                        }
                        .btn-primary:hover {
                            background: #5568d3;
                            border-color: #5568d3;
                            transform: translateY(-2px);
                            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
                        }
                        .btn-success:hover {
                            transform: translateY(-2px);
                            box-shadow: 0 6px 16px rgba(40,167,69,0.4) !important;
                        }
                        .fileupload .thumbnail img {
                            border-radius: 6px;
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
