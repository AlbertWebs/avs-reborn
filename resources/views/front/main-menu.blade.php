
<div class="header-center">
    <nav class="main-nav">
        <ul class="menu sf-arrows">
            <li class="{{ Request::is('/') ? 'active' : '' }}">
                <a href="{{url('/')}}">Home</a>
            </li>
         
            <li class="{{ Request::is('products/shop-by-category') ? 'active' : '' }}">
                <a href="{{url('/')}}/products/shop-by-category">Shop by Categories</a>
            </li>
            <li class="{{ Request::is('products/shop-by-brand') ? 'active' : '' }}">
                <a href="{{url('/')}}/products/shop-by-brand">By Brands</a>
            </li>
            <li class="{{ Request::is('about-us') ? 'active' : '' }}">
                <a href="{{url('/')}}/about-us">About</a>
            </li>
            <li class="{{ Request::is('products') ? 'active' : '' }}">
                <a href="{{url('/')}}/products">Shop</a>
            </li>
           
            <li class="{{ Request::is('find-us') ? 'active' : '' }}">
                <a href="{{url('/')}}/find-us"> <i class="la la-map-marker"></i> Find Us</a>
            </li>
          
            
        </ul><!-- End .menu -->
    </nav><!-- End .main-nav -->
</div><!-- End .col-lg-9 -->

<style>
    .main-nav .menu li.active > a {
        color: #fff !important;
        border-bottom: 4px solid #fff !important; /* Thick white underline */
        padding-bottom: 4px;
        transition: all 0.3s ease;
    }
    
    /* Ensure the underline doesn't shift the header height on hover/active */
    .main-nav .menu li > a {
        border-bottom: 4px solid transparent;
        transition: all 0.3s ease;
    }
</style>