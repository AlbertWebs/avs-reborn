<div id="right" style="background: #f8f9fa; padding: 20px; border-left: 1px solid #e9ecef;">
    
    <!-- Statistics Card -->
    <div class="stats-card" style="background: white; border-radius: 12px; padding: 20px; margin-bottom: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
        <h5 style="margin: 0 0 15px 0; color: #333; font-weight: 600; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px;">Quick Stats</h5>
        <ul class="list-unstyled" style="margin: 0; padding: 0;">
            <li style="display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-bottom: 1px solid #f0f0f0;">
                <span style="color: #666; font-size: 13px; font-weight: 600;">Admins</span>
                <span style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 4px 12px; border-radius: 20px; font-weight: 600; font-size: 13px;">
                    <?php $Admins = DB::table('admins')->get(); $Count = count($Admins); echo $Count ?>
                </span>
            </li>
            <li style="display: flex; justify-content: space-between; align-items: center; padding: 10px 0;">
                <span style="color: #666; font-size: 13px; font-weight: 600;">Users</span>
                <span style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; padding: 4px 12px; border-radius: 20px; font-weight: 600; font-size: 13px;">
                    <?php $Users = DB::table('users')->get(); $Count = count($Users); echo $Count ?>
                </span>
            </li>
                </ul>
            </div>

    <!-- Quick Actions Card -->
    <div class="quick-actions-card" style="background: white; border-radius: 12px; padding: 20px; margin-bottom: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
        <h5 style="margin: 0 0 15px 0; color: #333; font-weight: 600; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px;">Quick Actions</h5>
        
        <div style="display: grid; grid-template-columns: 1fr; gap: 10px;">
            <!-- Products & Sales -->
            <button type="button" onclick="window.open('{{url('/admin/Products_offer')}}','_self')" 
                    style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border: none; color: white; padding: 12px 15px; border-radius: 8px; font-weight: 600; font-size: 13px; cursor: pointer; transition: all 0.3s; text-align: left; display: flex; align-items: center; gap: 10px;">
                <i class="icon-gift"></i>
                <span style="font-weight: 600;">Special Offers</span>
            </button>

            <button type="button" onclick="window.open('{{url('/admin/searches')}}','_self')" 
                    style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border: none; color: white; padding: 12px 15px; border-radius: 8px; font-weight: 600; font-size: 13px; cursor: pointer; transition: all 0.3s; text-align: left; display: flex; align-items: center; gap: 10px;">
                <i class="icon-search"></i>
                <span style="font-weight: 600;">Searched Keywords</span>
            </button>

       

            <button type="button" title="Use This To Load All Products without Images" onclick="window.open('{{url('/admin/Products-lte')}}','_self')" 
                    style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); border: none; color: white; padding: 12px 15px; border-radius: 8px; font-weight: 600; font-size: 13px; cursor: pointer; transition: all 0.3s; text-align: left; display: flex; align-items: center; gap: 10px;">
                <i class="icon-list"></i>
                <span style="font-weight: 600;">Products LTE</span>
            </button>

            <!-- Payments -->
            <button type="button" onclick="window.open('{{url('/admin/myApi')}}','_self')" 
                    style="background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%); border: none; color: white; padding: 12px 15px; border-radius: 8px; font-weight: 600; font-size: 13px; cursor: pointer; transition: all 0.3s; text-align: left; display: flex; align-items: center; gap: 10px;">
                <i class="icon-money"></i>
                <span style="font-weight: 600;">M-PESA</span>
            </button>

            <button type="button" onclick="window.open('{{url('/admin/coupons')}}','_self')" 
                    style="background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%); border: none; color: #333; padding: 12px 15px; border-radius: 8px; font-weight: 600; font-size: 13px; cursor: pointer; transition: all 0.3s; text-align: left; display: flex; align-items: center; gap: 10px;">
                <i class="icon-ticket"></i>
                <span style="font-weight: 600;">Coupons</span>
            </button>

            <button type="button" onclick="window.open('{{url('/admin/operations')}}','_self')" 
                    style="background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%); border: none; color: #333; padding: 12px 15px; border-radius: 8px; font-weight: 600; font-size: 13px; cursor: pointer; transition: all 0.3s; text-align: left; display: flex; align-items: center; gap: 10px;">
                <i class="icon-cog"></i>
                <span style="font-weight: 600;">Operations</span>
            </button>

            <button type="button" onclick="window.open('{{url('/admin/invoices')}}','_self')" 
                    style="background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%); border: none; color: #333; padding: 12px 15px; border-radius: 8px; font-weight: 600; font-size: 13px; cursor: pointer; transition: all 0.3s; text-align: left; display: flex; align-items: center; gap: 10px;">
                <i class="icon-file"></i>
                <span style="font-weight: 600;">Invoices</span>
            </button>

            <!-- Content Management -->
            <button type="button" onclick="window.open('{{url('/admin/categories')}}','_self')" 
                    style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border: none; color: white; padding: 12px 15px; border-radius: 8px; font-weight: 600; font-size: 13px; cursor: pointer; transition: all 0.3s; text-align: left; display: flex; align-items: center; gap: 10px;">
                <i class="icon-folder-open"></i>
                <span style="font-weight: 600;">Categories</span>
            </button>

            <button type="button" onclick="window.open('{{url('/admin/brands')}}','_self')" 
                    style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); border: none; color: white; padding: 12px 15px; border-radius: 8px; font-weight: 600; font-size: 13px; cursor: pointer; transition: all 0.3s; text-align: left; display: flex; align-items: center; gap: 10px;">
                <i class="icon-wrench"></i>
                <span style="font-weight: 600;">Brands</span>
            </button>

            <button type="button" onclick="window.open('{{url('/admin/services')}}','_self')" 
                    style="background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%); border: none; color: white; padding: 12px 15px; border-radius: 8px; font-weight: 600; font-size: 13px; cursor: pointer; transition: all 0.3s; text-align: left; display: flex; align-items: center; gap: 10px;">
                <i class="icon-wrench"></i>
                <span style="font-weight: 600;">Services</span>
            </button>

            <button type="button" onclick="window.open('{{url('/admin/blog')}}','_self')" 
                    style="background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%); border: none; color: #333; padding: 12px 15px; border-radius: 8px; font-weight: 600; font-size: 13px; cursor: pointer; transition: all 0.3s; text-align: left; display: flex; align-items: center; gap: 10px;">
                <i class="icon-file-text"></i>
                <span style="font-weight: 600;">Blog</span>
            </button>

            <button type="button" onclick="window.open('{{url('/admin/testimonials')}}','_self')" 
                    style="background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%); border: none; color: #333; padding: 12px 15px; border-radius: 8px; font-weight: 600; font-size: 13px; cursor: pointer; transition: all 0.3s; text-align: left; display: flex; align-items: center; gap: 10px;">
                <i class="icon-thumbs-up-alt"></i>
                <span style="font-weight: 600;">Testimonials</span>
            </button>

            <button type="button" onclick="window.open('{{url('/admin/portfolio')}}','_self')" 
                    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; color: white; padding: 12px 15px; border-radius: 8px; font-weight: 600; font-size: 13px; cursor: pointer; transition: all 0.3s; text-align: left; display: flex; align-items: center; gap: 10px;">
                <i class="icon-briefcase"></i>
                <span style="font-weight: 600;">Portfolio</span>
            </button>

            <button type="button" onclick="window.open('{{url('/admin/Products_offer')}}','_self')" 
                    style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border: none; color: white; padding: 12px 15px; border-radius: 8px; font-weight: 600; font-size: 13px; cursor: pointer; transition: all 0.3s; text-align: left; display: flex; align-items: center; gap: 10px;">
                <i class="icon-gift"></i>
                <span style="font-weight: 600;">Offers</span>
            </button>

            <!-- Users -->
            <button type="button" onclick="window.open('{{url('/admin/users')}}','_self')" 
                    style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border: none; color: white; padding: 12px 15px; border-radius: 8px; font-weight: 600; font-size: 13px; cursor: pointer; transition: all 0.3s; text-align: left; display: flex; align-items: center; gap: 10px;">
                <i class="icon-user"></i>
                <span style="font-weight: 600;">Users</span>
            </button>
        </div>
    </div>

    <style>
        #right button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        #right button:active {
            transform: translateY(0);
        }
    </style>
</div>
