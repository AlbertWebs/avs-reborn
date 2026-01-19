@extends('front.master-payments')
@section('content')

<style>
/* Modern Checkout Payment Page Styles */
.modern-checkout-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 3rem 0 2rem;
    margin-bottom: 2rem;
    position: relative;
    overflow: hidden;
}

.modern-checkout-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="100" height="100" patternUnits="userSpaceOnUse"><path d="M 100 0 L 0 0 0 100" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100%" height="100%" fill="url(%23grid)"/></svg>');
    opacity: 0.3;
}

.modern-checkout-header .container {
    position: relative;
    z-index: 1;
}

.modern-checkout-header h1 {
    color: white;
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    text-shadow: 0 2px 10px rgba(0,0,0,0.2);
}

.modern-checkout-header p {
    color: rgba(255,255,255,0.9);
    font-size: 1.1rem;
    margin: 0;
}

.modern-breadcrumb {
    background: #66139B;
    padding: 1rem 1.5rem;
    margin-top: 1rem;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(102, 19, 155, 0.3);
}

.modern-breadcrumb .breadcrumb {
    margin: 0;
    background: transparent;
    padding: 0;
}

.modern-breadcrumb .breadcrumb-item a {
    color: white;
    text-decoration: none;
    transition: all 0.3s ease;
    font-weight: 500;
}

.modern-breadcrumb .breadcrumb-item a:hover {
    color: rgba(255,255,255,0.8);
    text-decoration: underline;
}

.modern-breadcrumb .breadcrumb-item.active {
    color: white;
    font-weight: 600;
}

.modern-breadcrumb .breadcrumb-item + .breadcrumb-item::before {
    content: "›";
    color: rgba(255,255,255,0.7);
    padding: 0 0.75rem;
    font-weight: 600;
}

.modern-coupon-section {
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    border-radius: 20px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 8px 24px rgba(0,0,0,0.1);
    text-align: center;
}

.modern-coupon-section label {
    display: block;
    font-size: 1.1rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 1rem;
}

.modern-coupon-section .coupon-input-group {
    display: flex;
    gap: 10px;
    max-width: 500px;
    margin: 0 auto;
}

.modern-coupon-section input {
    flex: 1;
    padding: 1rem 1.5rem;
    border: 2px solid #e0e0e0;
    border-radius: 50px;
    font-size: 1rem;
    outline: none;
    transition: all 0.3s ease;
}

.modern-coupon-section input:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.modern-coupon-section button {
    padding: 1rem 2rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    border-radius: 50px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.modern-coupon-section button:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
}

.modern-order-summary {
    background: white;
    border-radius: 24px;
    padding: 2.5rem;
    box-shadow: 0 12px 40px rgba(0,0,0,0.1);
    margin-bottom: 2rem;
    animation: fadeInUp 0.6s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.modern-order-summary h3 {
    font-size: 1.75rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 3px solid #667eea;
    display: flex;
    align-items: center;
    gap: 10px;
}

.modern-order-summary h3::before {
    content: '🛒';
    font-size: 1.5rem;
}

.modern-order-table {
    width: 100%;
    margin-bottom: 1.5rem;
}

.modern-order-table thead {
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    border-radius: 12px;
}

.modern-order-table th {
    padding: 1rem;
    font-weight: 600;
    color: #333;
    text-align: left;
    font-size: 0.95rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.modern-order-table td {
    padding: 1rem;
    border-bottom: 1px solid #f0f0f0;
    color: #666;
}

.modern-order-table tbody tr:last-child td {
    border-bottom: none;
}

.modern-order-table .product-link {
    color: #667eea;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

.modern-order-table .product-link:hover {
    color: #764ba2;
    text-decoration: underline;
}

.modern-order-totals {
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    border-radius: 16px;
    padding: 1.5rem;
    margin-top: 1.5rem;
}

.modern-order-totals .total-row {
    display: flex;
    justify-content: space-between;
    padding: 0.75rem 0;
    font-size: 1rem;
    color: #666;
}

.modern-order-totals .total-row.subtotal {
    border-bottom: 1px solid #e0e0e0;
}

.modern-order-totals .total-row.final-total {
    font-size: 1.5rem;
    font-weight: 700;
    color: #667eea;
    margin-top: 0.5rem;
    padding-top: 1rem;
    border-top: 2px solid #667eea;
}

.modern-payment-methods {
    margin-top: 2rem;
}

.modern-payment-card {
    background: white;
    border-radius: 16px;
    margin-bottom: 1rem;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    overflow: hidden;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.modern-payment-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 24px rgba(102, 126, 234, 0.15);
    border-color: #667eea;
}

.modern-payment-card .card-header {
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    padding: 1.25rem 1.5rem;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
}

.modern-payment-card .card-header:hover {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.modern-payment-card .card-header:hover .card-title a {
    color: white;
}

.modern-payment-card .card-title {
    margin: 0;
    font-size: 1.2rem;
    font-weight: 600;
}

.modern-payment-card .card-title a {
    color: #333;
    text-decoration: none;
    display: flex;
    align-items: center;
    justify-content: space-between;
    transition: color 0.3s ease;
}

.modern-payment-card .card-title a::after {
    content: '▼';
    font-size: 0.8rem;
    transition: transform 0.3s ease;
}

.modern-payment-card .card-title a[aria-expanded="true"]::after {
    transform: rotate(180deg);
}

.modern-payment-card .card-body {
    padding: 2rem;
}

.modern-payment-steps {
    list-style: none;
    padding: 0;
    margin: 0 0 2rem 0;
}

.modern-payment-steps li {
    padding: 1rem;
    margin-bottom: 0.75rem;
    background: #f8f9fa;
    border-left: 4px solid #667eea;
    border-radius: 8px;
    font-size: 0.95rem;
    color: #333;
    transition: all 0.3s ease;
}

.modern-payment-steps li:hover {
    background: #f0f0f0;
    transform: translateX(5px);
}

.modern-payment-steps li strong {
    color: #667eea;
    font-weight: 700;
}

.modern-form-group {
    margin-bottom: 1.5rem;
}

.modern-form-group label {
    display: block;
    font-weight: 600;
    color: #333;
    margin-bottom: 0.5rem;
    font-size: 0.95rem;
}

.modern-form-group input {
    width: 100%;
    padding: 1rem 1.25rem;
    border: 2px solid #e0e0e0;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s ease;
    outline: none;
}

.modern-form-group input:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.modern-btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    padding: 1rem 2rem;
    border-radius: 50px;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.modern-btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
}

.modern-btn-secondary {
    background: white;
    color: #667eea;
    border: 2px solid #667eea;
    padding: 1rem 2rem;
    border-radius: 50px;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    width: 100%;
    text-decoration: none;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.modern-btn-secondary:hover {
    background: #667eea;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
}

.payment-icon {
    font-size: 1.5rem;
    margin-right: 10px;
}

@media (max-width: 768px) {
    .modern-checkout-header h1 {
        font-size: 1.75rem;
    }
    
    .modern-order-summary {
        padding: 1.5rem;
    }
    
    .modern-coupon-section .coupon-input-group {
        flex-direction: column;
    }
    
    .modern-payment-card .card-body {
        padding: 1.5rem;
    }
}
</style>

<main class="main" style="background: #f8f9fa; min-height: 100vh;">
    <!-- Modern Header -->
    <div class="modern-checkout-header">
        <div class="container">
            <h1>💳 Choose Payment Method</h1>
            <p>Complete your order securely</p>
            
            <nav aria-label="breadcrumb" class="modern-breadcrumb">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/')}}/shopping-cart">Cart</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Payment</li>
                    </ol>
                </div>
            </nav>
        </div>
    </div>

    <div class="page-content">
        <div class="checkout">
            <div class="container">
                <!-- Modern Coupon Section -->
                <div class="modern-coupon-section">
                    <form action="#" method="POST" id="submit-coupon">
                        @csrf
                        <label for="checkout-discount-input">
                            <i class="icon-tag"></i> Have a coupon code?
                        </label>
                        <div class="coupon-input-group">
                            <input autocomplete="off" type="text" name="code" class="form-control" required id="checkout-discount-input" placeholder="Enter coupon code">
                            <button type="submit">Apply</button>
                        </div>
                    </form>
                    <p id="coupon-processing" style="color:#667eea; font-weight:600; margin-top:1rem; display:none;">Processing...</p>
                </div>
            	
                @if(Session::has('coupon'))
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-xl-7">
                        <!-- Modern Order Summary -->
                        <div class="modern-order-summary">
                            <h3>Your Order #{{$OrderNumberNumber}}</h3>
                            
                            <table class="modern-order-table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th style="text-align: right;">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($CartItems as $CartItem)
                                    <?php 
                                        $Products = DB::table('product')->where('id',$CartItem->id)->get();
                                    ?>
                                    @foreach($Products as $Product)
                                    <tr>
                                        <td>
                                            <a href="{{url('/')}}/product/{{$Product->slung}}" class="product-link">
                                                {{$Product->name}} <strong>x {{$CartItem->qty}}</strong>
                                            </a>
                                        </td>
                                        <td style="text-align: right; font-weight: 600;">KES {{number_format($CartItem->price, 0)}}</td>
                                    </tr>
                                    @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                            
                            <div class="modern-order-totals">
                                <div class="total-row subtotal">
                                    <span>Subtotal:</span>
                                    <span style="font-weight: 600;">{{Cart::subtotal()}}</span>
                                </div>
                                <div class="total-row">
                                    <span>Shipping:</span>
                                    <span style="font-weight: 600;">KES {{number_format($Shipping, 0)}}</span>
                                </div>
                                @if(Session::has('coupon'))
                                <div class="total-row" style="color: #f5576c;">
                                    <span>Coupon Discount:</span>
                                    <span style="font-weight: 600;">- KES {{number_format(Session::get('coupon'), 0)}}</span>
                                </div>
                                @endif
                                <div class="total-row final-total">
                                    <span>Total:</span>
                                    <span>KES 
                                        <?php 
                                            if(Session::has('coupon')){
                                                $Subtotal = Cart::subtotal();
                                                $WithCoupon = Session::get('coupon-total');
                                                $PrepSubtotal = str_replace(',', '', $WithCoupon);
                                                $WholeSubtotal = ceil($PrepSubtotal);
                                                $TheTotal = $WholeSubtotal + $Shipping;
                                                echo number_format($TheTotal, 0);
                                            } else {
                                                $Subtotal = Cart::subtotal();
                                                $PrepSubtotal = str_replace(',', '', $Subtotal);
                                                $WholeSubtotal = ceil($PrepSubtotal);
                                                $TheTotal = $WholeSubtotal + $Shipping;
                                                echo number_format($TheTotal, 0);
                                            }
                                        ?>
                                    </span>
                                </div>
                            </div>

                            <!-- Modern Payment Methods -->
                            <div class="modern-payment-methods">
                                <div class="accordion-summary" id="accordion-payment">
                                    <!-- M-PESA PayBill -->
                                    <div class="modern-payment-card card">
                                        <div class="card-header" id="heading-1" data-toggle="collapse" data-target="#collapse-1" aria-expanded="true" aria-controls="collapse-1">
                                            <h2 class="card-title">
                                                <a role="button" href="#collapse-1" aria-expanded="true" aria-controls="collapse-1">
                                                    <span><span class="payment-icon">📱</span> M-PESA PayBill</span>
                                                </a>
                                            </h2>
                                        </div>
                                        <div id="collapse-1" class="collapse show" aria-labelledby="heading-1" data-parent="#accordion-payment">
                                            <div class="card-body">
                                                <ul class="modern-payment-steps">
                                                    <li>Go to your <strong>MPESA</strong> menu</li>
                                                    <li>Select <strong>Lipa Na MPESA</strong></li>
                                                    <li>Select <strong>PayBill</strong></li>
                                                    <?php $SettingsTill = DB::table('sitesettings')->get(); ?>
                                                    @foreach($SettingsTill as $set)
                                                    <li>Enter the Business Number <strong>{{$set->till}}</strong></li>
                                                    @endforeach
                                                    <li>Enter Account Number <strong>{{$InvoiceNumber}}</strong></li>
                                                    <li>Enter Amount KSH <strong>
                                                        <?php
                                                            if(Session::has('campaign')){
                                                                $cost = Cart::total();
                                                                $percentage = 10;
                                                                $PrepeTotalCart = str_replace( ',', '', $cost );
                                                                $FormatTotalCart = round($PrepeTotalCart, 0);
                                                                $discount = ($percentage / 100) * $FormatTotalCart;
                                                                $TotalCart = ($FormatTotalCart - $discount);
                                                            }else{
                                                                $cost = Cart::total();
                                                                $percentage = 10;
                                                                $WithCoupon = Session::get('coupon-total');
                                                                $PrepeTotalCart = str_replace( ',', '', $WithCoupon );
                                                                $FormatTotalCart = round($PrepeTotalCart, 0);
                                                                $TotalCart = $FormatTotalCart;
                                                            }
                                                            $PrepeTotalCart = str_replace( ',', '', $TotalCart );
                                                            $FormatTotalCart = round($PrepeTotalCart, 0);
                                                            $ShippingFee = $Shipping;
                                                            $TotalCost = $FormatTotalCart+$ShippingFee;
                                                            echo number_format($TotalCost, 0);
                                                        ?>
                                                    </strong></li>
                                                    <li>Then press <strong>OK</strong> to confirm</li>
                                                    <li>Enter the transaction code below</li>
                                                </ul>
                                                
                                                <form method="POST" action="#" id="verify">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="invoice" value="{{$InvoiceNumber}}">
                                                    <?php
                                                        if(Session::has('campaign')){
                                                            $cost = Cart::total();
                                                            $percentage = 10;
                                                            $PrepeTotalCart = str_replace( ',', '', $cost );
                                                            $FormatTotalCart = round($PrepeTotalCart, 0);
                                                            $discount = ($percentage / 100) * $FormatTotalCart;
                                                            $TotalCart = ($FormatTotalCart - $discount);
                                                        }else{
                                                            $cost = Cart::total();
                                                            $percentage = 10;
                                                            $WithCoupon = Session::get('coupon-total');
                                                            $PrepeTotalCart = str_replace( ',', '', $WithCoupon );
                                                            $FormatTotalCart = round($PrepeTotalCart, 0);
                                                            $TotalCart = $FormatTotalCart;
                                                        }
                                                        $PrepeTotalCart = str_replace( ',', '', $TotalCart );
                                                        $FormatTotalCart = round($PrepeTotalCart, 0);
                                                        $ShippingFee = $Shipping;
                                                        $TotalCost = $FormatTotalCart+$ShippingFee;
                                                    ?>
                                                    <input type="hidden" name="amount" value="{{$TotalCost}}">
                                                    <div class="modern-form-group">
                                                        <label for="transaction-code">Enter Your MPESA Transaction Code <span style="color: #f5576c;">*</span></label>
                                                        <input type="text" name="TransactionID" id="transaction-code" required placeholder="e.g. NJL4E9WJ96" autocomplete="off">
                                                    </div>
                                                    <button id="veryfyID" class="modern-btn-primary" type="submit">
                                                        <i class="icon-check"></i> Verify Payment
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

										    {{-- <div class="card">
										        <div class="card-header" id="heading-2">
										            <h2 class="card-title">
										                <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-2" aria-expanded="false" aria-controls="collapse-2">
										                    Lipa na M-Pesa online
										                </a>
										            </h2>
										        </div>
										        <div id="collapse-2" class="collapse" aria-labelledby="heading-2" data-parent="#accordion-payment">
										            <div class="card-body">
										                
                                                        <form method="POST"  id="stk-submit">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="invoice" value="{{$InvoiceNumber}}">
                                                                  <?php
                                                                      if(Session::has('campaign')){
                                                                          $cost = Cart::total();
                                                                          $percentage = 10;
                                                                          $PrepeTotalCart = str_replace( ',', '', $cost );
                                                                          $FormatTotalCart = round($PrepeTotalCart, 0);
                                                                          $discount = ($percentage / 100) * $FormatTotalCart;
                                                                          $TotalCart = ($FormatTotalCart - $discount);
                                                                      }else{
                                                                          $cost = Cart::total();
                                                                          $WithCoupon = Session::get('coupon-total');
                                                                          $percentage = 10;
                                                                          $PrepeTotalCart = str_replace( ',', '', $WithCoupon );
                                                                          $FormatTotalCart = round($PrepeTotalCart, 0);
                                                                          $TotalCart = $FormatTotalCart;
                                                                      }
          
                                                                      $PrepeTotalCart = str_replace( ',', '', $TotalCart );
                                                                      $FormatTotalCart = round($PrepeTotalCart, 0);
                                                                      $ShippingFee = $Shipping;
                                                                      $TotalCost = $FormatTotalCart+$ShippingFee;
                                                                      
                                                                  
                                                                  ?>
                                                            <input type="hidden" name="amount" value="{{$TotalCost}}">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <p for="email">Enter Your MPESA Phone Number <span>*</span></p>
                                                                    
                                                                    <input type="hidden" value="{{$TotalCost}}" name="Amount">
                                                                    <input type="hidden" value="{{Auth::user()->id}}" name="user_id">
                                                                    <input type="text" value="{{Auth::user()->mobile}}" name="phone_number" class="form-control" required placeholder="254723000000" id="email" autocomplete="off">
                                                                </div>
                                                        
                                                            <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">
                                                                <span class="btn-text">Pay {{$TotalCost}} Now</span>
                                                                
                                                                 &nbsp; <img class="spinner" width="15" src="{{asset('uploads/preloaders/loading.gif')}}" alt="">
                                                            </button>
                                                           
                                                            </div>
                                                        </form>
                                                   
										            </div>
										        </div>
										    </div> --}}

                                    <!-- Cash on Delivery (Nairobi Only) -->
                                    @if($location == 'Nairobi')
                                    <div class="modern-payment-card card">
                                        <div class="card-header" id="heading-3" data-toggle="collapse" data-target="#collapse-3" aria-expanded="false" aria-controls="collapse-3">
                                            <h2 class="card-title">
                                                <a class="collapsed" role="button" href="#collapse-3" aria-expanded="false" aria-controls="collapse-3">
                                                    <span><span class="payment-icon">💰</span> Cash on Delivery</span>
                                                </a>
                                            </h2>
                                        </div>
                                        <div id="collapse-3" class="collapse" aria-labelledby="heading-3" data-parent="#accordion-payment">
                                            <div class="card-body">
                                                <p style="color: #666; margin-bottom: 1.5rem;">Pay when you receive your order. Available for Nairobi deliveries only.</p>
                                                <form method="POST" action="{{url('/shopping-cart/checkout/placeOrder')}}" id="verify">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="invoice" value="{{$InvoiceNumber}}">
                                                    <?php
                                                        if(Session::has('campaign')){
                                                            $cost = Cart::total();
                                                            $percentage = 10;
                                                            $PrepeTotalCart = str_replace( ',', '', $cost );
                                                            $FormatTotalCart = round($PrepeTotalCart, 0);
                                                            $discount = ($percentage / 100) * $FormatTotalCart;
                                                            $TotalCart = ($FormatTotalCart - $discount);
                                                        }else{
                                                            $cost = Cart::total();
                                                            $percentage = 10;
                                                            $WithCoupon = Session::get('coupon-total');
                                                            $PrepeTotalCart = str_replace( ',', '', $WithCoupon );
                                                            $FormatTotalCart = round($PrepeTotalCart, 0);
                                                            $TotalCart = $FormatTotalCart;
                                                        }
                                                        $PrepeTotalCart = str_replace( ',', '', $TotalCart );
                                                        $FormatTotalCart = round($PrepeTotalCart, 0);
                                                        $ShippingFee = $Shipping;
                                                        $TotalCost = $FormatTotalCart+$ShippingFee;
                                                    ?>
                                                    <input type="hidden" name="amount" value="{{$TotalCost}}">
                                                    <button type="submit" class="modern-btn-primary">
                                                        <i class="icon-check"></i> Place Order Now
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    <!-- PayPal -->
                                    <div class="modern-payment-card card">
                                        <div class="card-header" id="heading-4" data-toggle="collapse" data-target="#collapse-4" aria-expanded="false" aria-controls="collapse-4">
                                            <h2 class="card-title">
                                                <a class="collapsed" role="button" href="#collapse-4" aria-expanded="false" aria-controls="collapse-4">
                                                    <span><span class="payment-icon">💳</span> PayPal <small style="font-size: 0.85rem; color: #666; font-weight: 400;">(Conversion charges may apply)</small></span>
                                                </a>
                                            </h2>
                                        </div>
                                        <div id="collapse-4" class="collapse" aria-labelledby="heading-4" data-parent="#accordion-payment">
                                            <div class="card-body">
                                                <form id="ShowPaypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
                                                    <input type="hidden" name="cmd" value="_cart">
                                                    <input type="hidden" name="upload" value="1">
                                                    <?php $SiteSettings = DB::table('sitesettings')->get(); ?>
                                                    @foreach($SiteSettings as $Sett)
                                                    <input type="hidden" name="business" value="{{$Sett->paypal}}">
                                                    @endforeach
                                                    <?php $Count = 1; ?>
                                                    @foreach($CartItems as $CartItem)
                                                    <?php 
                                                        $Products = DB::table('product')->where('id',$CartItem->id)->get();
                                                    ?>
                                                    @foreach($Products as $Product)
                                                    <?php 
                                                        $RawPrice = $Product->price;
                                                        $dollarPrice = dollar($Product->price);
                                                        $PaypalCont = 0.029;
                                                        $paypalCut = $PaypalCont*$dollarPrice;
                                                        $PaypalToatal = $paypalCut+$dollarPrice;
                                                    ?>
                                                    <input type="hidden" name="item_name_{{$Count}}" value="{{$Product->name}}">
                                                    <input type="hidden" name="amount_{{$Count}}" value="<?php echo $PaypalToatal; ?>">
                                                    <input type="hidden" name="quantity_{{$Count}}" value="{{$CartItem->qty}}">
                                                    <input type="hidden" name="shipping_{{$Count}}" value="<?php echo dollar($Shipping) ?>">
                                                    @endforeach
                                                    <?php $Count = $Count+1;  ?>
                                                    @endforeach
                                                    <input type="hidden" name="cancel_return" id="cancel_return" value="{{url('/')}}/shopping-cart/checkout/payment" />
                                                    <button style="cursor:pointer; border: none; background: transparent; padding: 0;" type="submit">
                                                        <img src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/cc-badges-ppcmcvdam.png" alt="Pay with PayPal Credit or any major credit card" style="max-width: 100%; height: auto;" />
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- My Account Button -->
                                <a href="{{url('/')}}/dashboard" class="modern-btn-secondary" style="margin-top: 1.5rem;">
                                    <i class="icon-user"></i> My Account
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <!-- Order Summary Without Coupon -->
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-xl-7">
                        <div class="modern-order-summary">
                            <h3>Your Order #{{$OrderNumberNumber}}</h3>
                            
                            <table class="modern-order-table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th style="text-align: right;">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($CartItems as $CartItem)
                                    <?php 
                                        $Products = DB::table('product')->where('id',$CartItem->id)->get();
                                    ?>
                                    @foreach($Products as $Product)
                                    <tr>
                                        <td>
                                            <a href="{{url('/')}}/product/{{$Product->slung}}" class="product-link">
                                                {{$Product->name}} <strong>x {{$CartItem->qty}}</strong>
                                            </a>
                                        </td>
                                        <td style="text-align: right; font-weight: 600;">KES {{number_format($CartItem->price, 0)}}</td>
                                    </tr>
                                    @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                            
                            <div class="modern-order-totals">
                                <div class="total-row subtotal">
                                    <span>Subtotal:</span>
                                    <span style="font-weight: 600;">{{Cart::subtotal()}}</span>
                                </div>
                                <div class="total-row">
                                    <span>Shipping:</span>
                                    <span style="font-weight: 600;">KES {{number_format($Shipping, 0)}}</span>
                                </div>
                                <div class="total-row final-total">
                                    <span>Total:</span>
                                    <span>KES 
                                        <?php 
                                            $Subtotal = Cart::subtotal();
                                            $PrepSubtotal = str_replace(',', '', $Subtotal);
                                            $WholeSubtotal = ceil($PrepSubtotal);
                                            $TheTotal = $WholeSubtotal + $Shipping;
                                            echo number_format($TheTotal, 0);
                                        ?>
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Payment Methods -->
                            <div class="modern-payment-methods">
                                <div class="accordion-summary" id="accordion-payment">
                                    <!-- M-PESA PayBill -->
                                    <div class="modern-payment-card card">
                                        <div class="card-header" id="heading-1" data-toggle="collapse" data-target="#collapse-1" aria-expanded="true" aria-controls="collapse-1">
                                            <h2 class="card-title">
                                                <a role="button" href="#collapse-1" aria-expanded="true" aria-controls="collapse-1">
                                                    <span><span class="payment-icon">📱</span> M-PESA PayBill</span>
                                                </a>
                                            </h2>
                                        </div>
                                        <div id="collapse-1" class="collapse show" aria-labelledby="heading-1" data-parent="#accordion-payment">
                                            <div class="card-body">
                                                <ul class="modern-payment-steps">
                                                    <li>Go to your <strong>MPESA</strong> menu</li>
                                                    <li>Select <strong>Lipa Na MPESA</strong></li>
                                                    <li>Select <strong>PayBill</strong></li>
                                                    <?php $SettingsTill = DB::table('sitesettings')->get(); ?>
                                                    @foreach($SettingsTill as $set)
                                                    <li>Enter the Business Number <strong>{{$set->till}}</strong></li>
                                                    @endforeach
                                                    <li>Enter Account Number <strong>{{$InvoiceNumber}}</strong></li>
                                                    <li>Enter Amount KSH <strong>
                                                        <?php
                                                            if(Session::has('campaign')){
                                                                $cost = Cart::total();
                                                                $percentage = 10;
                                                                $PrepeTotalCart = str_replace( ',', '', $cost );
                                                                $FormatTotalCart = round($PrepeTotalCart, 0);
                                                                $discount = ($percentage / 100) * $FormatTotalCart;
                                                                $TotalCart = ($FormatTotalCart - $discount);
                                                            }else{
                                                                $cost = Cart::total();
                                                                $percentage = 10;
                                                                $PrepeTotalCart = str_replace( ',', '', $cost );
                                                                $FormatTotalCart = round($PrepeTotalCart, 0);
                                                                $TotalCart = $FormatTotalCart;
                                                            }
                                                            $PrepeTotalCart = str_replace( ',', '', $TotalCart );
                                                            $FormatTotalCart = round($PrepeTotalCart, 0);
                                                            $ShippingFee = $Shipping;
                                                            $TotalCost = $FormatTotalCart+$ShippingFee;
                                                            echo number_format($TotalCost, 0);
                                                        ?>
                                                    </strong></li>
                                                    <li>Then press <strong>OK</strong> to confirm</li>
                                                    <li>Enter the transaction code below</li>
                                                </ul>
                                                
                                                <form method="POST" action="#" id="verify">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="invoice" value="{{$InvoiceNumber}}">
                                                    <?php
                                                        if(Session::has('campaign')){
                                                            $cost = Cart::total();
                                                            $percentage = 10;
                                                            $PrepeTotalCart = str_replace( ',', '', $cost );
                                                            $FormatTotalCart = round($PrepeTotalCart, 0);
                                                            $discount = ($percentage / 100) * $FormatTotalCart;
                                                            $TotalCart = ($FormatTotalCart - $discount);
                                                        }else{
                                                            $cost = Cart::total();
                                                            $percentage = 10;
                                                            $PrepeTotalCart = str_replace( ',', '', $cost );
                                                            $FormatTotalCart = round($PrepeTotalCart, 0);
                                                            $TotalCart = $FormatTotalCart;
                                                        }
                                                        $PrepeTotalCart = str_replace( ',', '', $TotalCart );
                                                        $FormatTotalCart = round($PrepeTotalCart, 0);
                                                        $ShippingFee = $Shipping;
                                                        $TotalCost = $FormatTotalCart+$ShippingFee;
                                                    ?>
                                                    <input type="hidden" name="amount" value="{{$TotalCost}}">
                                                    <div class="modern-form-group">
                                                        <label for="transaction-code-2">Enter Your MPESA Transaction Code <span style="color: #f5576c;">*</span></label>
                                                        <input type="text" name="TransactionID" id="transaction-code-2" required placeholder="e.g. NJL4E9WJ96" autocomplete="off">
                                                    </div>
                                                    <button id="veryfyID" class="modern-btn-primary" type="submit">
                                                        <i class="icon-check"></i> Verify Payment
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- My Account Button -->
                                <a href="{{url('/')}}/dashboard" class="modern-btn-secondary" style="margin-top: 1.5rem;">
                                    <i class="icon-user"></i> My Account
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</main>

@endsection
