
<div class="header-center">
    <nav class="main-nav">
        <ul class="menu sf-arrows">
            <li class="megamenu-container active">
                <a href="{{url('/')}}">Home</a>
            </li>
         
            <li>
                <a href="{{url('/')}}/products/shop-by-category">Categories</a>
            </li>
            <li>
                <a href="{{url('/')}}/products/shop-by-brand">Brands</a>
            </li>
            <li class="megamenu-container">
                <a href="{{url('/')}}/about-us">About</a>
            </li>
            <li>
                <a href="{{url('/')}}/products">Shop</a>
            </li>
            <li class="" style="display:none">
                <a href="#" class="sf-with-ul">Tags</a>

                <ul style="display: none;">
                    <?php $Tags = DB::table('tags')->get(); ?>
                    @foreach ($Tags as $tags)
                    <li><a href="{{url('/')}}/product-tags/{{$tags->slung}}">{{$tags->title}}</a></li>
                    @endforeach
                   
                </ul>
            </li>
            <li>
                <a href="{{url('/')}}/knowledge-base">Blogs</a>
            </li>
            <li>
                <a href="{{url('/')}}/find-us"> <i class="la la-map-marker"></i> Find Us</a>
            </li>
          
            
        </ul><!-- End .menu -->
    </nav><!-- End .main-nav -->
</div><!-- End .col-lg-9 -->