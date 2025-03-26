<div id="right">

            
            <div class="well well-small">
                <ul class="list-unstyled">
                    <li>Admin &nbsp; : <span><?php $Admins = DB::table('admins')->get(); $Count = count($Admins); echo $Count ?></span></li>
                    <li>Users &nbsp; : <span><?php $Users = DB::table('users')->get(); $Count = count($Users); echo $Count ?></span></li>
                    <li>Subscribers &nbsp; : <span><?php $Subscribers = DB::table('subscribers')->get(); $Count = count($Subscribers); echo $Count ?></span></li>
                    
                </ul>
            </div>
            <div class="well well-small">
                <button type="button" onclick="window.open('{{url('/admin/version')}}','_self')" class="btn btn-block"> Version Control </button>
                <button type="button" onclick="window.open('{{url('/admin/Products_offer')}}','_self')" class="btn btn-success btn-block"> Special Offers </button>
                <button type="button" onclick="window.open('{{url('/admin/searches')}}','_self')" class="btn btn-success btn-block"> Searched Keywords </button>
                <button type="button" onclick="window.open('{{url('/admin/categoriesBanners')}}','_self')" class="btn btn-success btn-block"> Category Banners </button>
                <button type="button" title="Use This To Load All Products without Images" onclick="window.open('{{url('/admin/Products-lte')}}','_self')" class="btn btn-success btn-block"> Products LTE </button>
                <!-- <button type="button" onclick="window.open('{{url('/admin/special_offer')}}','_self')" class="btn btn-success btn-block"> Special Offer </button> -->
                <button type="button" onclick="window.open('{{url('/admin/myApi')}}','_self')" class="btn btn-danger btn-block"> M-PESA </button>
                <button type="button" onclick="window.open('{{url('/admin/coupons')}}','_self')" class="btn btn-danger btn-block"> Coupons </button>
                <button type="button" onclick="window.open('{{url('/admin/operations')}}','_self')" class="btn btn-danger btn-block"> Operations </button>
                <button type="button" onclick="window.open('{{url('/admin/invoices')}}','_self')" class="btn btn-danger btn-block"> Invoices </button>
                <button type="button" onclick="window.open('{{url('/admin/banner')}}','_self')" class="btn btn-primary btn-block"> Banners</button>
                <button type="button" onclick="window.open('{{url('/admin/videos')}}','_self')" class="btn btn-primary btn-block"> Videos </button>
                {{-- <button type="button" onclick="window.open('{{url('/admin/gpc')}}','_self')" class="btn btn-warning btn-block"> GPC</button> --}}
                <button type="button" onclick="window.open('{{url('/admin/categories')}}','_self')" class="btn btn-warning btn-block"> Categories</button>
                <button type="button" onclick="window.open('{{url('/admin/tags')}}','_self')" class="btn btn-success btn-block"> Tags </button>
                <button type="button" onclick="window.open('{{url('/admin/brands')}}','_self')" class="btn btn-warning btn-block"> Brands</button>
                <button type="button" onclick="window.open('{{url('/admin/services')}}','_self')" class="btn btn-warning btn-block"> Services</button>
                <button type="button" onclick="window.open('{{url('/admin/blog')}}','_self')" class="btn btn-success btn-block"> Blog </button>
                <button type="button" onclick="window.open('{{url('/admin/subCategories')}}','_self')" class="btn btn-warning btn-block"> Sub Categories</button>
    
                <button type="button" onclick="window.open('{{url('/admin/testimonials')}}','_self')" class="btn btn-success btn-block"> Testimonials </button>
                <button type="button" onclick="window.open('{{url('/admin/portfolio')}}','_self')" class="btn btn-success btn-block"> Portfolio </button>
                <button type="button" onclick="window.open('{{url('/admin/Products_offer')}}','_self')" class="btn btn-success btn-block"> Offers </button>

                
                <button type="button" onclick="window.open('{{url('/admin/notifications')}}','_self')" class="btn btn-danger btn-block"> Notifications </button>
                <button type="button" onclick="window.open('{{url('/admin/subscribers')}}','_self')" class="btn btn-danger btn-block"> subscribers </button>
                <button type="button" onclick="window.open('{{url('/admin/users')}}','_self')" class="btn btn-success btn-block"> Users </button>
                <button type="button" onclick="window.open('{{url('/admin/updates')}}','_self')" class="btn btn-inverse btn-block"> Updates </button>
               
            </div>
            
          
            
         

        </div>