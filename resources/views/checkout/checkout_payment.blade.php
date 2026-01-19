@extends('front.master-payments')
@section('content')

<style>
/* Modern Checkout Page Styles */
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

.modern-billing-card {
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

.modern-billing-card h2 {
    font-size: 1.75rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 3px solid #667eea;
    display: flex;
    align-items: center;
    gap: 10px;
}

.modern-billing-card h2::before {
    content: '📝';
    font-size: 1.5rem;
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

.modern-form-group label span {
    color: #f5576c;
}

.modern-form-group input,
.modern-form-group textarea {
    width: 100%;
    padding: 1rem 1.25rem;
    border: 2px solid #e0e0e0;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s ease;
    outline: none;
    font-family: inherit;
}

.modern-form-group input:focus,
.modern-form-group textarea:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.modern-form-group input[readonly] {
    background: #f8f9fa;
    cursor: not-allowed;
}

.modern-order-summary {
    background: white;
    border-radius: 24px;
    padding: 2.5rem;
    box-shadow: 0 12px 40px rgba(0,0,0,0.1);
    position: sticky;
    top: 20px;
    animation: fadeInUp 0.6s ease-out 0.2s both;
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
    margin-top: 1.5rem;
}

.modern-btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
}

.modern-btn-primary:active {
    transform: translateY(0);
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
    margin-top: 1rem;
}

.modern-btn-secondary:hover {
    background: #667eea;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
}

.spinner {
    display: none;
    margin: 1rem auto;
}

#saved {
    display: none;
    margin-top: 1rem;
    font-weight: 600;
    color: #28a745;
}

@media (max-width: 991px) {
    .modern-checkout-header h1 {
        font-size: 1.75rem;
    }
    
    .modern-billing-card,
    .modern-order-summary {
        padding: 1.5rem;
    }
    
    .modern-order-summary {
        position: relative;
        top: 0;
        margin-top: 2rem;
    }
}
</style>

<main class="main" style="background: #f8f9fa; min-height: 100vh;">
    <!-- Modern Header -->
    <div class="modern-checkout-header">
        		<div class="container">
            <h1>🛒 Checkout</h1>
            <p>Complete your billing information</p>
            
            <nav aria-label="breadcrumb" class="modern-breadcrumb">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/')}}/shopping-cart">Cart</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                    </ol>
                </div>
            </nav>
        </div>
    </div>

            <div class="page-content">
            	<div class="checkout">
	                <div class="container">
                <form action="{{route('checkout.submit.order')}}" method="POST" id="updateSettings">
                            {{csrf_field()}}
		                	<div class="row">
                        <!-- Billing Details Form -->
                        <div class="col-lg-8">
                            <div class="modern-billing-card">
                                <h2>Billing Details</h2>
                                
		                				<div class="row">
                                    <div class="col-md-6">
                                        <div class="modern-form-group">
                                            <label>First Name <span>*</span></label>
		                						<input value="{{Auth::user()->name}}" type="text" name="name" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="modern-form-group">
		                						<label>Country</label>
                                            <input value="{{Auth::user()->country ?? 'Kenya'}}" name="country" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                        <div class="row">
                                    <div class="col-md-6">
                                        <div class="modern-form-group">
                                            <label>City / County <span>*</span></label>
                                            <input type="text" value="{{Auth::user()->location}}" name="location" class="form-control" placeholder="e.g. Nairobi, Kajiado" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="modern-form-group">
                                            <label>Street Address <span>*</span></label>
	            						        <input type="text" value="{{Auth::user()->address}}" name="address" class="form-control" placeholder="House number and Street name" required>
                                        </div>
                                    </div>
                                </div>

                                        <div class="row">
                                    <div class="col-md-6">
                                        <div class="modern-form-group">
                                            <label>Email Address <span>*</span></label>
	        							        <input type="email" value="{{Auth::user()->email}}" name="email" class="form-control" readonly required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="modern-form-group">
                                            <label>Mobile Number <span>*</span></label>
                                            <input type="text" value="{{Auth::user()->mobile}}" name="mobile" class="form-control" placeholder="e.g. 254712345678" required>
                                        </div>
                                    </div>
                                            </div>
	            						
                                <div class="modern-form-group">
                                    <label>Order Notes (Optional)</label>
	        							<textarea class="form-control" cols="30" rows="4" name="notes" placeholder="Notes about your order, e.g. special notes for delivery"></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Order Summary Sidebar -->
                        <div class="col-lg-4">
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
                                                        
                                <button type="submit" class="modern-btn-primary">
                                    <i class="icon-check"></i> Place Order Now
                                                            </button>
                                                           
                                <center>
                                    <img class="spinner text-center" width="25" src="{{asset('uploads/preloaders/loading.gif')}}" alt="">
                                </center>
                                
                                <div id="saved" class="text-success text-center">✓ Successful! Redirecting......</div>
                                
                                <a href="{{url('/')}}/dashboard" class="modern-btn-secondary">
                                    <i class="icon-user"></i> My Account
                                </a>
                            </div>
                        </div>
                                                            </div>
                                                        </form>
										            </div>
										        </div>
                                                            </div>
</main>

<script>
$(document).ready(function() {
    $('#updateSettings').on('submit', function(e) {
        // Show loading spinner
        $('.spinner').show();
        $('#saved').hide();
        
        // Form will submit normally, no need to prevent default
        // The server will handle order creation and redirect
    });
});
</script>

@endsection
