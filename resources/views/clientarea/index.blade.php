@extends('front.master-dashboard')
@section('content')
<main class="main">
    <div class="page-header text-center" style="background-image: url('{{asset('theme/assets/images/page-header-bg.jpg')}}')">
        <div class="container">
            <h1 class="page-title">My Account<span>{{Auth::user()->name}}</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">My Account</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="dashboard">
            <div class="container">
                <div class="row">
                    <aside class="col-md-4 col-lg-3">
                        <ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="tab-dashboard-link" data-toggle="tab" href="#tab-dashboard" role="tab" aria-controls="tab-dashboard" aria-selected="true">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-orders-link" data-toggle="tab" href="#tab-orders" role="tab" aria-controls="tab-orders" aria-selected="false">Orders</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-downloads-link" data-toggle="tab" href="#tab-downloads" role="tab" aria-controls="tab-downloads" aria-selected="false">Coupons</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-address-link" data-toggle="tab" href="#tab-address" role="tab" aria-controls="tab-address" aria-selected="false">Adresses</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-account-link" data-toggle="tab" href="#tab-account" role="tab" aria-controls="tab-account" aria-selected="false">Account Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-account-password-link" data-toggle="tab" href="#tab-account-password" role="tab" aria-controls="tab-account-password" aria-selected="false">Change Your Password</a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('/')}}/dashboard/logout">Sign Out</a>
                            </li>
                        </ul>
                    </aside><!-- End .col-lg-3 -->

                    <div class="col-md-8 col-lg-9">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab-dashboard" role="tabpanel" aria-labelledby="tab-dashboard-link">
                                <p>Hello <span class="font-weight-normal text-dark">{{Auth::user()->name}}</span> (not <span class="font-weight-normal text-dark">{{Auth::user()->name}}</span>? <a href="{{url('/')}}/dashboard/logout">Log out</a>) 
                                <br>
                                From your account dashboard you can view your <a href="#tab-orders" class="tab-trigger-link link-underline">recent orders</a>, manage your <a href="#tab-address" class="tab-trigger-link">shipping and billing addresses</a>, and <a href="#tab-account" class="tab-trigger-link">edit your password and account details</a>.</p>
                            </div><!-- .End .tab-pane -->

                            <div class="tab-pane fade" id="tab-orders" role="tabpanel" aria-labelledby="tab-orders-link">
                                {{-- Table Here --}}
                                @if($Orders->isEmpty())
                                <p>No order has been made yet.</p>
                                @else
                                <table class="table table-wishlist table-mobile">
                                    <thead>
                                        <tr class="cart_menu">
                                            
                                            <td class="description">Order Description</td>
                                            <td class="price">Total</td>
                                            <td class="total">Status</td>
                                        
                                        
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($Orders as $orders)
                                        <tr>
                                                <td class="cart_price">
                                                <?php $OrderProducts = DB::table('orders_products')->where('orders_id',$orders->id)->get(); ?>
                                                @foreach($OrderProducts as $details)
                                                    <p>Product Name :<?php $products = DB::table('product')->where('id',$details->products_id)->get();  ?>
                                                    @foreach($products as $theProducts)
                                                       {{$theProducts->name}}
                                                    @endforeach
                                                       
                                                    </p>
                                                    <p>Quantity: {{$details->qty}}</p>
                                                    <p>Date: {{$details->created_at}}</p>
                                                @endforeach
                                                </td>
                                            
                                                <td class="cart_price">
                                                <p>Ksh {{$orders->total}}</p>
                                                </td>
                                                
                                                <td class="cart_price">
                                                    <p class="">
                                                    {{$orders->status}}
                                                    </p>
                                                </td>
                                            
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{-- Table here --}}
                                @endif
                                
                                <a href="{{url('/')}}/products/shop-by-category" class="btn btn-outline-primary-2"><span>GO SHOP</span><i class="icon-long-arrow-right"></i></a>
                            </div><!-- .End .tab-pane -->

                            <div class="tab-pane fade" id="tab-downloads" role="tabpanel" aria-labelledby="tab-downloads-link">
                                <p>No coupons available yet.</p>
                                <a href="{{url('/')}}/products/shop-by-category" class="btn btn-outline-primary-2"><span>GO SHOP</span><i class="icon-long-arrow-right"></i></a>
                            </div><!-- .End .tab-pane -->

                            <div class="tab-pane fade" id="tab-address" role="tabpanel" aria-labelledby="tab-address-link">
                                <p>The following addresses will be used on the checkout page by default.</p>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="card card-dashboard">
                                            <div class="card-body">
                                                <h3 class="card-title">Billing Address</h3><!-- End .card-title -->

                                                <p>{{Auth::user()->name}}<br>
                                                   {{Auth::user()->address}}<br>
                                                   {{Auth::user()->location}}<br>
                                                   {{Auth::user()->country}}<br>
                                                   {{Auth::user()->mobile}}<br>
                                                   {{Auth::user()->email}}<br>
                                                <a class="nav-link" id="tab-account-link" data-toggle="tab" href="#tab-account" role="tab" aria-controls="tab-account" aria-selected="false">Edit <i class="icon-edit"></i></a></p>
                                            </div><!-- End .card-body -->
                                        </div><!-- End .card-dashboard -->
                                    </div><!-- End .col-lg-6 -->

                                    <div class="col-lg-6">
                                        <div class="card card-dashboard">
                                            <div class="card-body">
                                                <h3 class="card-title">Shipping Address</h3><!-- End .card-title -->
                                                <p>You are using your address as a shipping address<br>
                                                <a class="nav-link" id="tab-account-link" data-toggle="tab" href="#tab-account" role="tab" aria-controls="tab-account" aria-selected="false">Edit <i class="icon-edit"></i></a></p>
                                            </div><!-- End .card-body -->
                                        </div><!-- End .card-dashboard -->
                                    </div><!-- End .col-lg-6 -->
                                </div><!-- End .row -->
                            </div><!-- .End .tab-pane -->

                            <div class="tab-pane fade" id="tab-account" role="tabpanel" aria-labelledby="tab-account-link">
                                <form method="POST" action="{{url('/')}}/dashboard/update-settings" id="updateSettings">
                                    {{csrf_field()}}
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label> Name *</label>
                                            <input type="text" class="form-control" value="{{Auth::user()->name}}" name="name" required>
                                        </div><!-- End .col-sm-6 -->
                                    </div><!-- End .row -->

                                    <label>Display Name *</label>
                                    <input type="text" class="form-control" value="{{Auth::user()->email}}" readonly required>
                                    <small class="form-text">This will be how your name will be displayed in the account section and in reviews</small>

                                    <label>Email address *</label>
                                    <input type="email" value="{{Auth::user()->email}}" class="form-control" name="email" required>

                                    <label>Country *</label>
                                    <input type="text" value="{{Auth::user()->country}}" class="form-control" name="country" required>

                                    <label>Mobile *</label>
                                    <input type="text" value="{{Auth::user()->mobile}}" class="form-control" name="mobile" required>
                                    <button type="submit" class="btn btn-outline-primary-2">
                                        <span>SAVE CHANGES</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </button>
                                </form>
                            </div><!-- .End .tab-pane -->

                            <div class="tab-pane fade" id="tab-account-password" role="tabpanel" aria-labelledby="tab-account-password-link">
                                <form action="#" id="updateSettings">
                                    <label>Current password (leave blank to leave unchanged)</label>
                                    <input type="password" class="form-control">

                                    <label>New password (leave blank to leave unchanged)</label>
                                    <input type="password" class="form-control">

                                    <label>Confirm new password</label>
                                    <input type="password" class="form-control mb-2">

                                    <button type="submit" class="btn btn-outline-primary-2">
                                        <span>SAVE CHANGES</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </button>
                                </form>
                            </div><!-- .End .tab-pane -->

                        </div>
                    </div><!-- End .col-lg-9 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .dashboard -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
@endsection