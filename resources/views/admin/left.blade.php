<div id="left" >
            <div class="media user-media well-small">
                <a class="user-link" href="{{url('/admin')}}/editAdmin/{{Auth::user()->id}}">
                    <img width="64" height="64" class="media-object img-thumbnail user-img" alt="{{Auth::user()->name}}" src="{{url('/')}}/uploads/users/{{Auth::user()->image}}" />
                </a>
                <br />
                <div class="media-body">
                    <h5 class="media-heading"><small><b> {{Auth::user()->name}}</b></small> </h5>
                    <ul class="list-unstyled user-info">
                        
                        <li>
                             <a href="{{url('/admin')}}/editAdmin/{{Auth::user()->id}}" class="btn btn-success btn-xs btn-circle" style="width: 10px;height: 12px;"></a> Online
                           
                        </li>
                       
                    </ul>
                </div>
                <br />
            </div>

            <ul id="menu" class="collapse">

                
                <li class="panel active">
                    <a href="{{url('/admin')}}" >
                        <i class="icon-home"></i> Dashboard
	   
                       
                    </a>                   
                </li>


                <li><a href="{{url('admin/addSlider')}}"><i class="icon-plus"></i>  <i class="icon-film"></i> Add Slider </a></li>
                <li><a href="{{url('admin/addAdmin')}}"><i class="icon-plus"></i>  <i class="icon-user-md"></i> Add Admin </a></li>
                <li><a href="{{url('admin/addProduct')}}"><i class="icon-plus"></i>  <i class="icon-user-md"></i> Add Product </a></li>
                <li><a href="{{url('admin/addTag')}}"><i class="icon-plus"></i>  <i class="icon-user-md"></i> Add Tags </a></li>
                <li><a href="{{url('admin/addService')}}"><i class="icon-plus"></i>  <i class="icon-user-md"></i> Add Services </a></li>
                <li><a href="{{url('admin/addBlog')}}"><i class="icon-plus"></i>  <i class="icon-user-md"></i> Add Blog </a></li>
                <li><a href="{{url('admin/addCoupon')}}"><i class="icon-plus"></i>  <i class="icon-user-md"></i> Add Coupon </a></li>
                
                <li><a href="{{url('admin/addCategory')}}"><i class="icon-plus"></i>  <i class="icon-user-md"></i> Add Category </a></li>
                <li><a href="{{url('admin/addSubCategory')}}"><i class="icon-plus"></i>  <i class="icon-user-md"></i> Add Sub Category </a></li>
                <li><a href="{{url('admin/addCategoryBanners')}}"><i class="icon-plus"></i>  <i class="icon-user-md"></i> Add Category Banner </a></li>
                <li><a href="{{url('admin/addBrand')}}"><i class="icon-plus"></i>  <i class="icon-wrench"></i> Add Brand </a></li>
                
                
                <li><a href="{{url('admin/addTestimonial')}}"><i class="icon-plus"></i>  <i class="icon-thumbs-up-alt"></i> Add Testimonial </a></li>
                <li><a href="{{url('admin/addPortfolio')}}"><i class="icon-plus"></i>  <i class="icon-thumbs-up-alt"></i> Add Portfolio </a></li>
                <li class="panel">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#error-nav">
                        <i class="icon-folder-open"></i>  Pages
	   
                        <span class="pull-right">
                            <i class="icon-angle-left"></i>
                        </span>
                          &nbsp; <span class="label label-success">6</span>&nbsp;
                    </a>
                    <ul class="collapse" id="error-nav">
                        <li><a href="{{url('/admin/about')}}"><i class="icon-angle-right"></i> About  </a></li>
                        <li><a href="{{url('/admin/delivery')}}"><i class="icon-angle-right"></i> Delivery Terms  </a></li>
                        <li><a href="{{url('/admin/privacy')}}"><i class="icon-angle-right"></i> Privacy  </a></li>
                        <li><a href="{{url('/admin/terms')}}"><i class="icon-angle-right"></i> Terms  </a></li>
                        <li><a href="{{url('/admin/copyright')}}"><i class="icon-angle-right"></i> Copyright  </a></li>
                        
                    </ul>
                </li>
                
       
                <li><a href="{{url('admin/sitesettings')}}"><i class="icon-cog"></i> Site Settings </a></li>
                <li><a href="{{url('admin/seosettings')}}"><i class="icon-cog"></i> SEO Settings </a></li>
                <li><a href="{{url('admin/logout')}}"><i class="icon-signin"></i> Log Out </a></li>
              

           

              

            </ul>

        </div>