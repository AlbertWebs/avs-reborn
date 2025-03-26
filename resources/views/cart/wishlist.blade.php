@extends('front.master-pages')
@section('content')
<main class="main">
    <div class="page-header text-center" style="background-image: url('{{asset('theme/assets/images/page-header-bg.jpg')}}')">
        <div class="container">
            <h1 class="page-title">Wishlist<span>Shop</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}/">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">Wishlist</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <table class="table table-wishlist table-mobile">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Stock Status</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if(Auth::check())

                            <?php $UserID = Auth::user()->id; ?>
                            <?php
                            
                                $WishList = \javcorreia\Wishlist\Facades\Wishlist::getUserWishList($UserID);    
                            ?>
                            @foreach($WishList as $CartItem)
                            <?php
                            $ProductsForCart = DB::table('product')->where('id', $CartItem->id)->get();
                            ?>
                            @foreach($ProductsForCart as $Product)
                            <tr>
                                <td class="product-col">
                                    <div class="product">
                                        <figure class="product-media">
                                            <a href="{{url('/')}}/product/{{$Product->slung}}">
                                                <img src="{{url('/')}}/uploads/product/{{$Product->image_one}}" alt="{{$Product->name}}">
                                            </a>
                                        </figure>

                                        <h3 class="product-title">
                                            <a href="{{url('/')}}/product/{{$Product->slung}}">{{$Product->name}}</a>
                                        </h3><!-- End .product-title -->
                                    </div><!-- End .product -->
                                </td>
                                <td class="price-col">KES {{$Product->price}}</td>
                                @if($Product->stock == 'In Stock')
                                    <td class="stock-col"><span class="in-stock">In stock</span></td>
                                @else
                                <td class="stock-col"><span class="out-of-stock">Out of stock</span></td>
                                @endif
                                @if($Product->stock == 'In Stock')
                                    <td class="action-col">
                                        <a href="{{url('/')}}/shopping-cart/add-to-cart/{{$Product->id}}" class="btn btn-block btn-outline-primary-2"><i class="icon-cart-plus"></i>Add to Cart</a>
                                    </td>
                                @else 
                                    <td class="action-col">
                                        <button class="btn btn-block btn-outline-primary-2 disabled">Out of Stock</button>
                                    </td>
                                @endif
                                
                                <td class="remove-col"><a href="{{url('/')}}/wishlist/remove-from-wishlist/{{$CartItem->item_id}}" class="btn-remove"><i class="icon-close"></i></a></td>
                            </tr>
                            @endforeach
                            @endforeach
                    @else
                            <?php $UserIP = \Request::ip();  ?>
                            <?php
                            
                                $WishList = \javcorreia\Wishlist\Facades\Wishlist::getUserWishList($UserIP,'session');    
                            ?>
                            @foreach($WishList as $CartItem)
                            <?php
                            $ProductsForCart = DB::table('product')->where('id', $CartItem->id)->get();
                            ?>
                            @foreach($ProductsForCart as $Product)
                            <tr>
                                <td class="product-col">
                                    <div class="product">
                                        <figure class="product-media">
                                            <a href="{{url('/')}}/product/{{$Product->slung}}">
                                                <img src="{{url('/')}}/uploads/product/{{$Product->image_one}}" alt="{{$Product->name}}">
                                            </a>
                                        </figure>

                                        <h3 class="product-title">
                                            <a href="{{url('/')}}/product/{{$Product->slung}}">{{$Product->name}}</a>
                                        </h3><!-- End .product-title -->
                                    </div><!-- End .product -->
                                </td>
                                <td class="price-col">KES {{$Product->price}}</td>
                                @if($Product->stock == 'In Stock')
                                <td class="stock-col"><span class="in-stock">In stock</span></td>
                                @else
                                <td class="stock-col"><span class="out-of-stock">Out of stock</span></td>
                                @endif
                                @if($Product->stock == 'In Stock')
                                <td class="action-col">
                                    <a href="{{url('/')}}/shopping-cart/add-to-cart/{{$Product->id}}" class="btn btn-block btn-outline-primary-2"><i class="icon-cart-plus"></i>Add to Cart</a>
                                </td>
                                @else 
                                <td class="action-col">
                                    <button class="btn btn-block btn-outline-primary-2 disabled">Out of Stock</button>
                                </td>
                                @endif
                                
                                <td class="remove-col"><a href="{{url('/')}}/wishlist/remove-from-wishlist/{{$CartItem->item_id}}" class="btn-remove"><i class="icon-close"></i></a></td>
                            </tr>
                            @endforeach
                            @endforeach
                    @endif
                </tbody>
            </table><!-- End .table table-wishlist -->
            @foreach ($SiteSettings as $Settings)
            <div class="wishlist-share">
                <div class="social-icons social-icons-sm mb-2">
                    <label class="social-label">Check Us On:</label>
                    <a href="{{$Settings->facebook}}" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                    <a href="{{$Settings->twitter}}" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                    <a href="{{$Settings->instagram}}" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                    <a href="{{$Settings->youtube}}" class="social-icon" title="Youtube" target="_blank"><i class="icon-youtube"></i></a>
                    <a href="{{$Settings->linkedin}}" class="social-icon" title="Linkedin" target="_blank"><i class="icon-linkedin"></i></a>
                </div><!-- End .soial-icons -->
            </div><!-- End .wishlist-share -->
            @endforeach
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
@endsection