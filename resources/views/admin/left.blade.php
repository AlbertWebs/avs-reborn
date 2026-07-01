<div id="left" style="background: white; box-shadow: 2px 0 10px rgba(0,0,0,0.1);">
    <!-- User Profile Section -->
    <div class="user-profile-section" style="padding: 25px 20px; border-bottom: 1px solid #e9ecef; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
        <?php $SiteSettings = DB::table('sitesettings')->first(); ?>
        <a class="user-link" href="{{ url('/admin/editAdmin/' . (DB::table('admins')->where('email', Auth::user()->email)->value('id') ?? Auth::user()->id)) }}" style="display: flex; align-items: center; text-decoration: none; color: white; transition: all 0.3s;">
            <div style="position: relative; margin-right: 15px; display: flex; align-items: center; justify-content: center;">
                @if($SiteSettings && $SiteSettings->logo)
                    <img width="60" height="60" alt="Logo" 
                         src="{{url('/')}}/uploads/logo/{{$SiteSettings->logo}}" 
                         style="border: 3px solid rgba(255,255,255,0.3); box-shadow: 0 4px 8px rgba(0,0,0,0.2); border-radius: 8px; object-fit: contain; background: white; padding: 5px;" 
                         onerror="this.src='{{url('/')}}/admins_theme/assets/img/logo.png'; this.style.borderRadius='8px';" />
                @else
                    <img width="60" height="60" alt="Logo" 
                         src="{{url('/')}}/admins_theme/assets/img/logo.png" 
                         style="border: 3px solid rgba(255,255,255,0.3); box-shadow: 0 4px 8px rgba(0,0,0,0.2); border-radius: 8px; object-fit: contain; background: white; padding: 5px;" />
                @endif
                <span style="position: absolute; bottom: 0; right: 0; width: 14px; height: 14px; background: #4ade80; border: 2px solid white; border-radius: 50%; display: block;"></span>
            </div>
            <div style="flex: 1;">
                <h5 style="margin: 0; font-weight: 600; font-size: 16px; color: white;">{{Auth::user()->name}}</h5>
                <small style="color: rgba(255,255,255,0.9); font-size: 12px; display: flex; align-items: center; gap: 5px;">
                    <span style="width: 8px; height: 8px; background: #4ade80; border-radius: 50%; display: inline-block;"></span>
                    Online
                </small>
            </div>
        </a>
    </div>

    <!-- Navigation Menu -->
    <ul id="menu" class="collapse" style="list-style: none; padding: 0; margin: 0;">
        
        <!-- Dashboard -->
        <li class="menu-item {{ Request::is('admin') && !Request::is('admin/*') ? 'active' : '' }}" style="margin: 5px 10px;">
            <a href="{{url('/admin')}}" style="display: flex; align-items: center; padding: 12px 15px; color: #333; text-decoration: none; border-radius: 8px; transition: all 0.3s; font-size: 14px; font-weight: 600;">
                <i class="icon-home" style="width: 24px; font-size: 18px; margin-right: 12px; color: #667eea;"></i>
                <span style="flex: 1; font-weight: 600;">Dashboard</span>
            </a>
        </li>

        <!-- Quick Actions Section -->
        <li style="margin: 15px 10px 5px; padding: 0 15px;">
            <small style="color: #999; font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">Quick Actions</small>
        </li>

        <li class="menu-item" style="margin: 5px 10px;">
            <a href="{{url('admin/addProduct')}}" style="display: flex; align-items: center; padding: 12px 15px; color: #333; text-decoration: none; border-radius: 8px; transition: all 0.3s; font-size: 14px; font-weight: 600;">
                <i class="icon-plus" style="width: 24px; font-size: 16px; margin-right: 12px; color: #667eea;"></i>
                <i class="icon-file" style="width: 20px; font-size: 14px; margin-right: 8px; color: #667eea;"></i>
                <span style="font-weight: 600;">Add Product</span>
            </a>
        </li>

        <li class="menu-item" style="margin: 5px 10px;">
            <a href="{{url('admin/addCategory')}}" style="display: flex; align-items: center; padding: 12px 15px; color: #333; text-decoration: none; border-radius: 8px; transition: all 0.3s; font-size: 14px; font-weight: 600;">
                <i class="icon-plus" style="width: 24px; font-size: 16px; margin-right: 12px; color: #667eea;"></i>
                <i class="icon-folder-open" style="width: 20px; font-size: 14px; margin-right: 8px; color: #667eea;"></i>
                <span style="font-weight: 600;">Add Category</span>
            </a>
        </li>

        <li class="menu-item" style="margin: 5px 10px;">
            <a href="{{url('admin/addBrand')}}" style="display: flex; align-items: center; padding: 12px 15px; color: #333; text-decoration: none; border-radius: 8px; transition: all 0.3s; font-size: 14px; font-weight: 600;">
                <i class="icon-plus" style="width: 24px; font-size: 16px; margin-right: 12px; color: #667eea;"></i>
                <i class="icon-wrench" style="width: 20px; font-size: 14px; margin-right: 8px; color: #667eea;"></i>
                <span style="font-weight: 600;">Add Brand</span>
            </a>
        </li>

        <li class="menu-item" style="margin: 5px 10px;">
            <a href="{{url('admin/addSlider')}}" style="display: flex; align-items: center; padding: 12px 15px; color: #333; text-decoration: none; border-radius: 8px; transition: all 0.3s; font-size: 14px; font-weight: 600;">
                <i class="icon-plus" style="width: 24px; font-size: 16px; margin-right: 12px; color: #667eea;"></i>
                <i class="icon-film" style="width: 20px; font-size: 14px; margin-right: 8px; color: #667eea;"></i>
                <span style="font-weight: 600;">Add Slider</span>
            </a>
        </li>

        <li class="menu-item" style="margin: 5px 10px;">
            <a href="{{url('admin/addBlog')}}" style="display: flex; align-items: center; padding: 12px 15px; color: #333; text-decoration: none; border-radius: 8px; transition: all 0.3s; font-size: 14px; font-weight: 600;">
                <i class="icon-plus" style="width: 24px; font-size: 16px; margin-right: 12px; color: #667eea;"></i>
                <i class="icon-file-text" style="width: 20px; font-size: 14px; margin-right: 8px; color: #667eea;"></i>
                <span style="font-weight: 600;">Add Blog</span>
            </a>
        </li>

        <li class="menu-item" style="margin: 5px 10px;">
            <a href="{{url('admin/addService')}}" style="display: flex; align-items: center; padding: 12px 15px; color: #333; text-decoration: none; border-radius: 8px; transition: all 0.3s; font-size: 14px; font-weight: 600;">
                <i class="icon-plus" style="width: 24px; font-size: 16px; margin-right: 12px; color: #667eea;"></i>
                <i class="icon-wrench" style="width: 20px; font-size: 14px; margin-right: 8px; color: #667eea;"></i>
                <span style="font-weight: 600;">Add Service</span>
            </a>
        </li>

        <li class="menu-item" style="margin: 5px 10px;">
            <a href="{{url('admin/addAdmin')}}" style="display: flex; align-items: center; padding: 12px 15px; color: #333; text-decoration: none; border-radius: 8px; transition: all 0.3s; font-size: 14px; font-weight: 600;">
                <i class="icon-plus" style="width: 24px; font-size: 16px; margin-right: 12px; color: #667eea;"></i>
                <i class="icon-user-md" style="width: 20px; font-size: 14px; margin-right: 8px; color: #667eea;"></i>
                <span style="font-weight: 600;">Add Admin</span>
            </a>
        </li>

        <!-- Content Management Section -->
        <li style="margin: 20px 10px 5px; padding: 0 15px;">
            <small style="color: #999; font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">Content</small>
        </li>

        <li class="menu-item" style="margin: 5px 10px;">
            <a href="{{url('admin/addTag')}}" style="display: flex; align-items: center; padding: 12px 15px; color: #333; text-decoration: none; border-radius: 8px; transition: all 0.3s; font-size: 14px; font-weight: 600;">
                <i class="icon-tag" style="width: 24px; font-size: 16px; margin-right: 12px; color: #667eea;"></i>
                <span style="font-weight: 600;">Add Tags</span>
            </a>
        </li>

        <li class="menu-item" style="margin: 5px 10px;">
            <a href="{{url('admin/addCategoryBanners')}}" style="display: flex; align-items: center; padding: 12px 15px; color: #333; text-decoration: none; border-radius: 8px; transition: all 0.3s; font-size: 14px; font-weight: 600;">
                <i class="icon-picture" style="width: 24px; font-size: 16px; margin-right: 12px; color: #667eea;"></i>
                <span style="font-weight: 600;">Category Banners</span>
            </a>
        </li>

        <li class="menu-item" style="margin: 5px 10px;">
            <a href="{{url('admin/subCategories')}}" style="display: flex; align-items: center; padding: 12px 15px; color: #333; text-decoration: none; border-radius: 8px; transition: all 0.3s; font-size: 14px; font-weight: 600;">
                <i class="icon-road" style="width: 24px; font-size: 16px; margin-right: 12px; color: #667eea;"></i>
                <span style="font-weight: 600;">Car Models</span>
            </a>
        </li>

        <li class="menu-item" style="margin: 5px 10px;">
            <a href="{{url('admin/addSubCategory')}}" style="display: flex; align-items: center; padding: 12px 15px; color: #333; text-decoration: none; border-radius: 8px; transition: all 0.3s; font-size: 14px; font-weight: 600;">
                <i class="icon-plus" style="width: 24px; font-size: 16px; margin-right: 12px; color: #667eea;"></i>
                <span style="font-weight: 600;">Add Car Model</span>
            </a>
        </li>

        <li class="menu-item" style="margin: 5px 10px;">
            <a href="{{url('admin/addCoupon')}}" style="display: flex; align-items: center; padding: 12px 15px; color: #333; text-decoration: none; border-radius: 8px; transition: all 0.3s; font-size: 14px; font-weight: 600;">
                <i class="icon-ticket" style="width: 24px; font-size: 16px; margin-right: 12px; color: #667eea;"></i>
                <span style="font-weight: 600;">Add Coupon</span>
            </a>
        </li>

        <li class="menu-item" style="margin: 5px 10px;">
            <a href="{{url('admin/addTestimonial')}}" style="display: flex; align-items: center; padding: 12px 15px; color: #333; text-decoration: none; border-radius: 8px; transition: all 0.3s; font-size: 14px; font-weight: 600;">
                <i class="icon-thumbs-up-alt" style="width: 24px; font-size: 16px; margin-right: 12px; color: #667eea;"></i>
                <span style="font-weight: 600;">Add Testimonial</span>
            </a>
        </li>

        <li class="menu-item" style="margin: 5px 10px;">
            <a href="{{url('admin/addPortfolio')}}" style="display: flex; align-items: center; padding: 12px 15px; color: #333; text-decoration: none; border-radius: 8px; transition: all 0.3s; font-size: 14px; font-weight: 600;">
                <i class="icon-briefcase" style="width: 24px; font-size: 16px; margin-right: 12px; color: #667eea;"></i>
                <span style="font-weight: 600;">Add Portfolio</span>
            </a>
        </li>

        <!-- Pages Dropdown -->
        <li class="panel menu-item" style="margin: 5px 10px;">
            <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#error-nav" style="display: flex; align-items: center; padding: 12px 15px; color: #333; text-decoration: none; border-radius: 8px; transition: all 0.3s; font-size: 14px; font-weight: 600;">
                <i class="icon-folder-open" style="width: 24px; font-size: 16px; margin-right: 12px; color: #667eea;"></i>
                <span style="flex: 1; font-weight: 600;">Pages</span>
                <span class="badge" style="background: #667eea; color: white; margin-right: 8px;">6</span>
                <i class="icon-angle-left" style="font-size: 14px; color: #667eea;"></i>
            </a>
            <ul class="collapse" id="error-nav" style="list-style: none; padding: 5px 0 5px 30px; margin: 0;">
                <li style="margin: 3px 0;">
                    <a href="{{url('/admin/about')}}" style="display: flex; align-items: center; padding: 8px 15px; color: #555; text-decoration: none; border-radius: 6px; transition: all 0.3s; font-size: 13px; font-weight: 600;">
                        <i class="icon-angle-right" style="width: 16px; font-size: 12px; margin-right: 8px; color: #667eea;"></i>
                        <span style="font-weight: 600;">About</span>
                    </a>
                </li>
                <li style="margin: 3px 0;">
                    <a href="{{url('/admin/delivery')}}" style="display: flex; align-items: center; padding: 8px 15px; color: #555; text-decoration: none; border-radius: 6px; transition: all 0.3s; font-size: 13px; font-weight: 600;">
                        <i class="icon-angle-right" style="width: 16px; font-size: 12px; margin-right: 8px; color: #667eea;"></i>
                        <span style="font-weight: 600;">Delivery Terms</span>
                    </a>
                </li>
                <li style="margin: 3px 0;">
                    <a href="{{url('/admin/privacy')}}" style="display: flex; align-items: center; padding: 8px 15px; color: #555; text-decoration: none; border-radius: 6px; transition: all 0.3s; font-size: 13px; font-weight: 600;">
                        <i class="icon-angle-right" style="width: 16px; font-size: 12px; margin-right: 8px; color: #667eea;"></i>
                        <span style="font-weight: 600;">Privacy</span>
                    </a>
                </li>
                <li style="margin: 3px 0;">
                    <a href="{{url('/admin/terms')}}" style="display: flex; align-items: center; padding: 8px 15px; color: #555; text-decoration: none; border-radius: 6px; transition: all 0.3s; font-size: 13px; font-weight: 600;">
                        <i class="icon-angle-right" style="width: 16px; font-size: 12px; margin-right: 8px; color: #667eea;"></i>
                        <span style="font-weight: 600;">Terms</span>
                    </a>
                </li>
                <li style="margin: 3px 0;">
                    <a href="{{url('/admin/copyright')}}" style="display: flex; align-items: center; padding: 8px 15px; color: #555; text-decoration: none; border-radius: 6px; transition: all 0.3s; font-size: 13px; font-weight: 600;">
                        <i class="icon-angle-right" style="width: 16px; font-size: 12px; margin-right: 8px; color: #667eea;"></i>
                        <span style="font-weight: 600;">Copyright</span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Settings Section -->
        <li style="margin: 20px 10px 5px; padding: 0 15px;">
            <small style="color: #999; font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">Settings</small>
        </li>

        <li class="menu-item" style="margin: 5px 10px;">
            <a href="{{url('admin/sitesettings')}}" style="display: flex; align-items: center; padding: 12px 15px; color: #333; text-decoration: none; border-radius: 8px; transition: all 0.3s; font-size: 14px; font-weight: 600;">
                <i class="icon-cog" style="width: 24px; font-size: 16px; margin-right: 12px; color: #667eea;"></i>
                <span style="font-weight: 600;">Site Settings</span>
            </a>
        </li>

        <li class="menu-item" style="margin: 5px 10px;">
            <a href="{{url('admin/seosettings')}}" style="display: flex; align-items: center; padding: 12px 15px; color: #333; text-decoration: none; border-radius: 8px; transition: all 0.3s; font-size: 14px; font-weight: 600;">
                <i class="icon-search" style="width: 24px; font-size: 16px; margin-right: 12px; color: #667eea;"></i>
                <span style="font-weight: 600;">SEO Settings</span>
            </a>
        </li>

        <!-- Logout -->
        <li class="menu-item" style="margin: 20px 10px 5px;">
            <a href="{{url('admin/logout')}}" style="display: flex; align-items: center; padding: 12px 15px; color: white; text-decoration: none; border-radius: 8px; transition: all 0.3s; font-size: 14px; background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%); font-weight: 600;">
                <i class="icon-signout" style="width: 24px; font-size: 16px; margin-right: 12px;"></i>
                <span style="font-weight: 600;">Log Out</span>
            </a>
        </li>

    </ul>

    <style>
        #left .menu-item a:hover {
            background: #f8f9fa !important;
            transform: translateX(5px);
        }
        #left .menu-item.active > a {
            background: #f0f4ff !important;
            border-left: 3px solid #667eea;
            color: #667eea !important;
        }
        #left .user-link:hover {
            opacity: 0.9;
        }
        #left .collapse li a:hover {
            background: #f8f9fa !important;
        }
    </style>
</div>
