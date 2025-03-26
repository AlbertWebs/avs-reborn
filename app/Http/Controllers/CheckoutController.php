<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Redirect;

use Gloudemans\Shoppingcart\Facades\Cart;

use Stevebauman\Location\Facades\Location;

use App\Models\orders;

use App\Models\Coupon;

use App\Models\User;

use App\Models\Invoice;

use App\Models\Subscriber;

use App\Models\Payment;

use Session;

use Hash;

use App\Models\ReplyMessage;

use App\Http\Requests;
use OpenGraph;
use SEOMeta;
use Twitter;

class CheckoutController extends Controller
{

  
    public function index(){
        $keywords = '';
        $SEOSettings = DB::table('seosettings')->get();
        foreach ($SEOSettings as $Settings) {
            SEOMeta::setTitle('Checkout  - ' . $Settings->sitename . ' ');
            SEOMeta::setDescription('Vehicle Sounds Systems in Kenya, Car Sound Systems in Kenya, Car alarm Systems in Kenya' . $Settings->welcome . '');
            SEOMeta::setCanonical('' . $Settings->url . '');
            OpenGraph::setDescription('' . $Settings->welcome . '');
            OpenGraph::setTitle('' . $Settings->sitename . ' - ' . $Settings->welcome . '');
            OpenGraph::setUrl('' . $Settings->url . '');
            OpenGraph::addProperty('type', 'articles');
            Twitter::setTitle('' . $Settings->sitename . ' - ' . $Settings->welcome . '');
            Twitter::setSite('' . $Settings->twitter . '');
        $page_title = 'Checkout';
        $CartItems = Cart::content();
        $SiteSettings = DB::table('sitesettings')->get();
        $page_name = 'Cobfirm'; 
        $keywords = '';
        
        if(Auth::check()){
            // return redirect()->route('cart/checkout/payment','CheckoutController@payment');
            return redirect()->route('payment');
        }
        else{
            
            return view('checkout.index', compact('keywords','CartItems','page_title','SiteSettings','page_name'));
        }
    }
         
        //Perfom a check to ensure that the cart is not empty
    }

    public function process_coupon(Request $request){
        $code = $request->code;
        // Check Coupon Code
        $CouponCodes = DB::table('coupon_codes')->where('code',$code)->get();
        if($CouponCodes->isEmpty()){
            $message = "The coupon code is invalid";
            return $message;
        }else{
            foreach ($CouponCodes as $key => $value) {
                if($value->status == '1'){
                    // Process here

                    // check if user has used this coupon
                    $CouponTable = DB::table('coupons')->where('coupons_code_id',$value->id)->where('user_id',Auth::user()->id)->get();
                    if($CouponTable->isEmpty()){
                        $Coupon = new Coupon;
                        $Coupon->status = '1';
                        $Coupon->coupons_code_id = $value->id;
                        $Coupon->user_id = Auth::user()->id;
                        $Coupon->save();

                        // Take out from Cart
                        $TotalCart = str_replace( ',', '', Cart::total());

                        $CeilTotal = ceil($TotalCart);
                        $Couponvalue = $value->value;
                        $percentage = 100;
                        $discount = ($Couponvalue/$percentage)*$CeilTotal;
                        $NewCartTotal = $CeilTotal - $discount;
                        // Update Cart
                        Session::put('coupon', $discount);
                        Session::put('coupon-code', $code);
                        Session::put('coupon-total', $NewCartTotal);

                        
                        // Update coupon code status
                        $updateDetails = array(
                            'status'=>"0",
                        );
                        DB::table('coupon_codes')->where('code',$code)->update($updateDetails);
                        

                        // End Processsing
                        $message = "The coupon has been applied";
                        return $message;
                    }else{
                        $message = "You have already used that coupon";
                        return $message;
                    }
                    
                }else{
                    $message = "The Coupon code is Invalid";
                    return $message;
                }
            }
        }        
       
    }

    public function remove_coupon($code){
        $updateDetails = array(
            'status'=>"1",
        );
        DB::table('coupon_codes')->where('code',$code)->update($updateDetails);

        // Remove from coupojn table
        $Coupon = DB::table('coupon_codes')->where('code',$code)->get();
        foreach($Coupon as $coup){
            DB::table('coupons')->where('coupons_code_id',$coup->id)->delete();
        }
        return "Done";

    }

 

    public function payment(){
        // Check For Empty Carts
        $cart = Cart::count();
       
        if($cart == 0){
            // Redirect To Cart
            return redirect()->route('payment');
        }else{
            // $ip = \Request::ip();
            $ip = '154.76.108.131';

            $data = \Location::get($ip);
            // Get The Delivery Charge
            $AreaCode =  $data->areaCode;
            if($AreaCode == '30'){
                $Shipping = 300;
            }else{
                $Shipping = 400;
            }

            // Shipping session 
            session()->put('Shipping', $Shipping);
        

            // Create an invoice, Mail and Register
            if(Session::has('Invoice')){
                $InvoiceNumber = session()->get('Invoice');
                $OrderNumberNumber = session()->get('Order');
            }else{
                // Create Invoice
                $MPESA = DB::table('invoices')->orderBy('id','DESC')->Limit('1')->get();
                $count_mpesa = count($MPESA);
                if($count_mpesa == 0){
                    $InvoiceNumber = 'AVS001';
                    $OrderNumberNumber = 'AVS001';
                }else{
                    foreach($MPESA as $mpesa){
                        $LastID = $mpesa->id;
                        $Next = $LastID+1;
                        $InvoiceNumber = "AVS0".$Next;
                        $OrderNumberNumber = "AVS10".$Next;
                        // Create Session
                        session()->put('Order', $OrderNumberNumber);
                        session()->put('Invoice', $InvoiceNumber);
                        }
                }
            }
            
            if(Session::has('coupon-total')){
                $totalWithCoupon = Session::get('coupon-total');
                // AmountVariables
                if(Session::has('campaign')){
                    $cost = Cart::total();
                    $percentage = 10;
                    $PrepeTotalCart = str_replace( ',', '', $totalWithCoupon);
                    $FormatTotalCart = round($PrepeTotalCart, 0);
                    $discount = ($percentage / 100) * $FormatTotalCart;
                    $TotalCart = ($FormatTotalCart - $discount);
                    $ShippingFee = $Shipping;
                    $TotalCost = $TotalCart+$Shipping;
                }
                else{
                    $TotalCart = Cart::total();
                    $PrepeTotalCart = str_replace( ',', '', $TotalCart );
                    $FormatTotalCart = round($PrepeTotalCart, 0);
                    $ShippingFee = $Shipping;
                    $TotalCost = $FormatTotalCart+$ShippingFee;
                }

            }else{
                // AmountVariables
                if(Session::has('campaign')){
                    $cost = Cart::total();
                    $percentage = 10;
                    $PrepeTotalCart = str_replace( ',', '', $cost );
                    $FormatTotalCart = round($PrepeTotalCart, 0);
                    $discount = ($percentage / 100) * $FormatTotalCart;
                    $TotalCart = ($FormatTotalCart - $discount);
                    $ShippingFee = $Shipping;
                    $TotalCost = $TotalCart+$Shipping;
                }
                else{
                    $TotalCart = Cart::total();
                    $PrepeTotalCart = str_replace( ',', '', $TotalCart );
                    $FormatTotalCart = round($PrepeTotalCart, 0);
                    $ShippingFee = $Shipping;
                    $TotalCost = $FormatTotalCart+$ShippingFee;
                }
                // 
            }
            
            
            if(Session::has('Invoice')){

            }else{
                $CheckInvoice = DB::table('invoices')->where('number',$InvoiceNumber)->where('status','0')->where('user_id',Auth::user()->id)->get();
                $CountCheckInvoice = count($CheckInvoice);
                if($CountCheckInvoice == 0){
                     // Record Invoice
                     $Invoice = new Invoice;
                     $Invoice->number = $InvoiceNumber;
                     $Invoice->shipping = $Shipping;
                     $Invoice->products = serialize(Cart::Content());
                     $Invoice->user_id = Auth::user()->id;
                     $Invoice->amount = $TotalCost;
                     $Invoice->save();
                     // Mail Invoice
                     $email = Auth::user()->email;
                     $name = Auth::user()->name;
                    //  ReplyMessage::mailclientinvoice($email,$name,$InvoiceNumber,$ShippingFee,$TotalCost);
               
                }else{
                    // The Invoice already Exists
                   
                }
            }
            session()->put('TotalCost', $TotalCost);
            //Go to payments page     
            $keywords = '';
            $SEOSettings = DB::table('seosettings')->get();
            foreach ($SEOSettings as $Settings) {
                SEOMeta::setTitle('Choose Payment Methods  - ' . $Settings->sitename . ' ');
                SEOMeta::setDescription('Vehicle Sounds Systems in Kenya, Car Sound Systems in Kenya, Car alarm Systems in Kenya' . $Settings->welcome . '');
                SEOMeta::setCanonical('' . $Settings->url . '');
                OpenGraph::setDescription('' . $Settings->welcome . '');
                OpenGraph::setTitle('' . $Settings->sitename . ' - ' . $Settings->welcome . ''); 
                OpenGraph::setUrl('' . $Settings->url . '');
                OpenGraph::addProperty('type', 'articles');
                Twitter::setTitle('' . $Settings->sitename . ' - ' . $Settings->welcome . '');
                Twitter::setSite('' . $Settings->twitter . '');
                $page_title = 'Select Payment Method';
                $page_name = 'Cobfirm';
                $CartItems = Cart::content();
                $SiteSettings = DB::table('sitesettings')->get();
                $email = Auth::user()->email;
                $User = DB::table('users')->where('email',$email)->get();
                return view('checkout.checkout_payment', compact('InvoiceNumber','OrderNumberNumber','keywords','Shipping','CartItems','page_title','SiteSettings','page_name'));
            }
        }
    }

    public function payments(){
        // Check For Empty Carts
        $cart = Cart::count();
       
        if($cart == 0){
            // Redirect To Cart
            return redirect()->route('payment');
        }else{
            $ip = \Request::ip();
            // $ip = '154.76.108.131';
         

            $data = \Location::get($ip);
            // Get The Delivery Charge
            $AreaCode =  $data->areaCode;
            if($AreaCode == '30'){
                $Shipping = 300;
                $location = "Nairobi";
            }else{
                $Shipping = 400;
                $location = "Mombasa";
            }

            // echo $location;
            // echo $ip;
            // die();

            // Shipping session 
            session()->put('Shipping', $Shipping);
        

            // Create an invoice, Mail and Register
            if(Session::has('Invoice')){
                $InvoiceNumber = session()->get('Invoice');
                $OrderNumberNumber = session()->get('Order');
            }else{
                // Create Invoice
                $MPESA = DB::table('invoices')->orderBy('id','DESC')->Limit('1')->get();
                $count_mpesa = count($MPESA);
                if($count_mpesa == 0){
                    $InvoiceNumber = 'AVS001';
                    $OrderNumberNumber = 'AVS001';
                }else{
                    foreach($MPESA as $mpesa){
                        $LastID = $mpesa->id;
                        $Next = $LastID+1;
                        $InvoiceNumber = "AVS0".$Next;
                        $OrderNumberNumber = "AVS10".$Next;
                        // Create Session
                        session()->put('Order', $OrderNumberNumber);
                        session()->put('Invoice', $InvoiceNumber);
                        }
                }
            }
            
            if(Session::has('coupon-total')){
                $totalWithCoupon = Session::get('coupon-total');
                // AmountVariables
                if(Session::has('campaign')){
                    $cost = Cart::total();
                    $percentage = 10;
                    $PrepeTotalCart = str_replace( ',', '', $totalWithCoupon);
                    $FormatTotalCart = round($PrepeTotalCart, 0);
                    $discount = ($percentage / 100) * $FormatTotalCart;
                    $TotalCart = ($FormatTotalCart - $discount);
                    $ShippingFee = $Shipping;
                    $TotalCost = $TotalCart+$Shipping;
                }
                else{
                    $TotalCart = Cart::total();
                    $PrepeTotalCart = str_replace( ',', '', $TotalCart );
                    $FormatTotalCart = round($PrepeTotalCart, 0);
                    $ShippingFee = $Shipping;
                    $TotalCost = $FormatTotalCart+$ShippingFee;
                }

            }else{
                // AmountVariables
                if(Session::has('campaign')){
                    $cost = Cart::total();
                    $percentage = 10;
                    $PrepeTotalCart = str_replace( ',', '', $cost );
                    $FormatTotalCart = round($PrepeTotalCart, 0);
                    $discount = ($percentage / 100) * $FormatTotalCart;
                    $TotalCart = ($FormatTotalCart - $discount);
                    $ShippingFee = $Shipping;
                    $TotalCost = $TotalCart+$Shipping;
                }
                else{
                    $TotalCart = Cart::total();
                    $PrepeTotalCart = str_replace( ',', '', $TotalCart );
                    $FormatTotalCart = round($PrepeTotalCart, 0);
                    $ShippingFee = $Shipping;
                    $TotalCost = $FormatTotalCart+$ShippingFee;
                }
                // 
            }
            
            
            if(Session::has('Invoice')){

            }else{
                $CheckInvoice = DB::table('invoices')->where('number',$InvoiceNumber)->where('status','0')->where('user_id',Auth::user()->id)->get();
                $CountCheckInvoice = count($CheckInvoice);
                if($CountCheckInvoice == 0){
                     // Record Invoice
                     $Invoice = new Invoice;
                     $Invoice->number = $InvoiceNumber;
                     $Invoice->shipping = $Shipping;
                     $Invoice->products = serialize(Cart::Content());
                     $Invoice->user_id = Auth::user()->id;
                     $Invoice->amount = $TotalCost;
                     $Invoice->save();
                     // Mail Invoice
                     $email = Auth::user()->email;
                     $name = Auth::user()->name;
                    //  ReplyMessage::mailclientinvoice($email,$name,$InvoiceNumber,$ShippingFee,$TotalCost);
               
                }else{
                    // The Invoice already Exists
                   
                }
            }
            session()->put('TotalCost', $TotalCost);
            //Go to payments page     
            $keywords = '';
            $SEOSettings = DB::table('seosettings')->get();
            foreach ($SEOSettings as $Settings) {
                SEOMeta::setTitle('Choose Payment Methods  - ' . $Settings->sitename . ' ');
                SEOMeta::setDescription('Vehicle Sounds Systems in Kenya, Car Sound Systems in Kenya, Car alarm Systems in Kenya' . $Settings->welcome . '');
                SEOMeta::setCanonical('' . $Settings->url . '');
                OpenGraph::setDescription('' . $Settings->welcome . '');
                OpenGraph::setTitle('' . $Settings->sitename . ' - ' . $Settings->welcome . ''); 
                OpenGraph::setUrl('' . $Settings->url . '');
                OpenGraph::addProperty('type', 'articles');
                Twitter::setTitle('' . $Settings->sitename . ' - ' . $Settings->welcome . '');
                Twitter::setSite('' . $Settings->twitter . '');
                $page_title = 'Select Payment Method';
                $page_name = 'Cobfirm';
                $CartItems = Cart::content();
                $SiteSettings = DB::table('sitesettings')->get();
                $email = Auth::user()->email;
                $User = DB::table('users')->where('email',$email)->get();
                return view('checkout.checkout_payment_last', compact('location','InvoiceNumber','OrderNumberNumber','keywords','Shipping','CartItems','page_title','SiteSettings','page_name'));
            }
        }
    }

    

    public function shipping_method(){
        $page_name = 'Cobfirm';
        $email = Auth::user()->email;
        $User = DB::table('users')->where('email',$email)->get();
        $page_title = 'Checkout';
        $CartItems = Cart::content();
        $SiteSettings = DB::table('sitesettings')->get();
        return view('checkout.shipping_method', compact('CartItems','page_title','SiteSettings','page_name'));
    }

    public function checkout_billing(){
        $keywords = '';
        $SEOSettings = DB::table('seosettings')->get();
        foreach ($SEOSettings as $Settings) {
            SEOMeta::setTitle('Checkout  - ' . $Settings->sitename . ' ');
            SEOMeta::setDescription('Vehicle Sounds Systems in Kenya, Car Sound Systems in Kenya, Car alarm Systems in Kenya' . $Settings->welcome . '');
            SEOMeta::setCanonical('' . $Settings->url . '');
            OpenGraph::setDescription('' . $Settings->welcome . '');
            OpenGraph::setTitle('' . $Settings->sitename . ' - ' . $Settings->welcome . '');
            OpenGraph::setUrl('' . $Settings->url . '');
            OpenGraph::addProperty('type', 'articles');
            Twitter::setTitle('' . $Settings->sitename . ' - ' . $Settings->welcome . '');
            Twitter::setSite('' . $Settings->twitter . '');
        $page_name = 'Cobfirm';
        $page_title = 'Checkout';
        if(Auth::check()){
            $email = Auth::user()->email;
            $User = DB::table('users')->where('email',$email)->get();
            return view('checkout.checkout_billing', compact('keywords','CartItems','page_title','SiteSettings','page_name'));
        }
        else{
            
            return view('checkout.index', compact('keywords','CartItems','page_title','SiteSettings','page_name'));
        }
    }
    }

    public function checkout_confirm(){
        $keywords = '';
        $SEOSettings = DB::table('seosettings')->get();
        foreach ($SEOSettings as $Settings) {
            SEOMeta::setTitle('Checkout  - ' . $Settings->sitename . ' ');
            SEOMeta::setDescription('Vehicle Sounds Systems in Kenya, Car Sound Systems in Kenya, Car alarm Systems in Kenya' . $Settings->welcome . '');
            SEOMeta::setCanonical('' . $Settings->url . '');
            OpenGraph::setDescription('' . $Settings->welcome . '');
            OpenGraph::setTitle('' . $Settings->sitename . ' - ' . $Settings->welcome . '');
            OpenGraph::setUrl('' . $Settings->url . '');
            OpenGraph::addProperty('type', 'articles');
            Twitter::setTitle('' . $Settings->sitename . ' - ' . $Settings->welcome . '');
            Twitter::setSite('' . $Settings->twitter . '');
        $page_title = 'Confirm';
        $page_name = 'Cobfirm';
        $CartItems = Cart::content();
        $SiteSettings = DB::table('sitesettings')->get();
        $email = Auth::user()->email;
        $User = DB::table('users')->where('email',$email)->get();
        return view('checkout.checkout_confirm', compact('keywords','CartItems','page_title','SiteSettings','page_name'));
        }
    }
    
    public function placeOrder(Request $request){

            // Mail Invoice
            $email = Auth::user()->email;
            $name = Auth::user()->name;
           
            Orders::createOrder();
            //destroy cart
            
            $page_title = 'Thank you!';
            $name = Auth::user()->name;
            $email = Auth::user()->email;
            $phone = Auth::user()->mobile;
            $service = 'Order';
            $pricee = Cart::content();
            foreach ($pricee as $key => $value) {
                $price = $value->price;
            
            $budget = 'Order';
            $content = 'Order';

            $InvoiceNumber = session()->get('Invoice');
            $OrderNumberNumber = session()->get('Order');
            $ShippingFee = session()->get('Shipping');
            $TotalCost = session()->get('TotalCost');;
            ReplyMessage::mailclient($email,$name,$InvoiceNumber,$ShippingFee,$TotalCost);
            // ReplyMessage::mailmerchantCOD($email,$name,$phone,$value->price,$value->name);
            ReplyMessage::mailmerchant($email,$name,$phone);
    
            Cart::destroy();
            // Destrony Invoice & Order Sessions
            session()->forget('Invoice');
            session()->forget('Order');
            session()->forget('Shipping');
            session()->forget('TotalCost');

            /**Load The Thank You Page */
            $SEOSettings = DB::table('seosettings')->get();
            foreach($SEOSettings as $Settings){
            SEOMeta::setTitle('Thanks You For Your Order'.$Settings->sitename.' - Orders');
            SEOMeta::setDescription(''.$Settings->welcome.'');
            SEOMeta::setCanonical(''.$Settings->url.'/clientarea/thankyou');

            OpenGraph::setDescription(''.$Settings->welcome.''); 
            OpenGraph::setTitle(''.$Settings->sitename.' - '.$Settings->welcome.'');
            OpenGraph::setUrl(''.$Settings->url.'/clientarea/thanksyou');
            OpenGraph::addProperty('type', 'articles');
            
            
            Twitter::setTitle(''.$Settings->sitename.' - '.$Settings->welcome.'');
            Twitter::setSite(''.$Settings->twitter.'');
            $id = Auth::user()->id;
            $page_name = '';
            $page_title = '';
            $keywords = 'Amani Vehicle Sounds';
        
            $page_title = 'Thank You for your order';
            Session::forget('coupon');
            Session::forget('coupon-code');
            Session::forget('coupon-total');

   
            return view('dashboard.thankyou',compact('page_title','page_name','page_title','keywords'));

            /** Load The Thank You Page */
            }
    }
}
    

    public function placeOrderGet(Request $request){
            // Mail Invoice
            $email = Auth::user()->email;
            $name = Auth::user()->name;
           
            Orders::createOrder();
            //destroy cart
            
            $page_title = 'Thank you!';
            $name = Auth::user()->name;
            $email = Auth::user()->email;
            $phone = Auth::user()->mobile;
            $service = 'Order';
            $pricee = Cart::content();
            foreach ($pricee as $key => $value) {
                $price = $value->price;
            
            $budget = 'Order';
            $content = 'Order';

            $InvoiceNumber = session()->get('Invoice');
            $OrderNumberNumber = session()->get('Order');
            $ShippingFee = session()->get('Shipping');
            $TotalCost = session()->get('TotalCost');;
            ReplyMessage::mailclient($email,$name,$InvoiceNumber,$ShippingFee,$TotalCost);
            // ReplyMessage::mailmerchantCOD($email,$name,$phone,$value->price,$value->name);
            ReplyMessage::mailmerchant($email,$name,$phone);
    
            Cart::destroy();
            // Destrony Invoice & Order Sessions
            session()->forget('Invoice');
            session()->forget('Order');
            session()->forget('Shipping');
            session()->forget('TotalCost');

            /**Load The Thank You Page */
            $SEOSettings = DB::table('seosettings')->get();
            foreach($SEOSettings as $Settings){
            SEOMeta::setTitle('Thanks You For Your Order'.$Settings->sitename.' - Orders');
            SEOMeta::setDescription(''.$Settings->welcome.'');
            SEOMeta::setCanonical(''.$Settings->url.'/clientarea/thankyou');

            OpenGraph::setDescription(''.$Settings->welcome.''); 
            OpenGraph::setTitle(''.$Settings->sitename.' - '.$Settings->welcome.'');
            OpenGraph::setUrl(''.$Settings->url.'/clientarea/thanksyou');
            OpenGraph::addProperty('type', 'articles');
            
            
            Twitter::setTitle(''.$Settings->sitename.' - '.$Settings->welcome.'');
            Twitter::setSite(''.$Settings->twitter.'');
            $id = Auth::user()->id;
            $page_name = '';
            $page_title = '';
            $keywords = 'Amani Vehicle Sounds';
        
            $page_title = 'Thank You for your order';
            Session::forget('coupon');
            Session::forget('coupon-code');
            Session::forget('coupon-total');
            return view('dashboard.thankyou',compact('page_title','page_name','page_title','keywords'));

            /** Load The Thank You Page */
            }
    }
    }

    public function placeOrderGetAjaxNow(Request $request){
        //  Place Order
        Orders::createOrder();
        Cart::destroy();
        /**Load The Thank You Page */
        $SEOSettings = DB::table('seosettings')->get();
        foreach($SEOSettings as $Settings){
        SEOMeta::setTitle('Thanks You For Your Order - '.$Settings->sitename.' - Orders');
        SEOMeta::setDescription(''.$Settings->welcome.'');
        SEOMeta::setCanonical(''.$Settings->url.'/clientarea/thankyou');

        OpenGraph::setDescription(''.$Settings->welcome.''); 
        OpenGraph::setTitle(''.$Settings->sitename.' - '.$Settings->welcome.'');
        OpenGraph::setUrl(''.$Settings->url.'/clientarea/thanksyou');
        OpenGraph::addProperty('type', 'articles');
        
        
        Twitter::setTitle(''.$Settings->sitename.' - '.$Settings->welcome.'');
        Twitter::setSite(''.$Settings->twitter.'');
        $id = Auth::user()->id;
        $page_name = '';
        $page_title = '';
        $keywords = 'Amani Vehicle Sounds';
       
        $page_title = 'Thank You for your purchase';
        Session::forget('coupon');
        Session::forget('coupon-code');
        Session::forget('coupon-total');
        return view('clientarea.thankyou',compact('page_title','page_name','page_title','keywords'));

        /** Load The Thank You Page */
        }
    }

    public function checkout_payment(Request $request){
        $keywords = '';
        $SEOSettings = DB::table('seosettings')->get();
        foreach ($SEOSettings as $Settings) {
            SEOMeta::setTitle('Payments  - ' . $Settings->sitename . ' ');
            SEOMeta::setDescription('Vehicle Sounds Systems in Kenya, Car Sound Systems in Kenya, Car alarm Systems in Kenya' . $Settings->welcome . '');
            SEOMeta::setCanonical('' . $Settings->url . '');
            OpenGraph::setDescription('' . $Settings->welcome . '');
            OpenGraph::setTitle('' . $Settings->sitename . ' - ' . $Settings->welcome . '');
            OpenGraph::setUrl('' . $Settings->url . '');
            OpenGraph::addProperty('type', 'articles');
            Twitter::setTitle('' . $Settings->sitename . ' - ' . $Settings->welcome . '');
            Twitter::setSite('' . $Settings->twitter . '');
        $page_title = 'Checkout';
        $description = 
        //Insert to orders table
        $orders = new orders;
        $orders->user_id = Auth::user()->id;
        $orders->total = Cart::total();
        $orders->description = $description;
        $orders->save();
        $cartItems = Cart::content();
        $SiteSettings = DB::table('sitesettings')->get();
        return view('front.checkout_payment', compact('keywords','cartItems','SiteSettings','page_title'));
        }
    }

    public function formvalidate(Request $request)
   {
        $page_title = 'Checkout';
        $password_confirm = $request->password_confirm;
        $password_inSecured = $request->password;
        $name = $request->name;
        $email = $request->email;
        $mobile = $request->mobile;
        //Checking if Session is active
        if(Auth::check()){
            //redirect back to complete checkout
            $CartItems = Cart::content();
            return Redirect::back();
           
        }else{
             //check pasword matching
             if($password_inSecured == $password_confirm){
                //register new user
                $User = new User;
                $User->name = $name;
                $User->email = $email;
                $User->mobile = $mobile;
                $User->password = Hash::make($password_inSecured);
                $User->save();
                //Login the user
                
                $user = User::where('email','=',$email)->first();
                Auth::loginUsingId($user->id, TRUE);

                

                return Redirect::back();
             }else{
                Session::flash('message', "Passwords Did Not Match");
                return Redirect::back();
             }
          
        }

     } 
    public function create(Request $request){
        $name = $request->name;
        $email = $request->email;
        $password_confirm = $request->password_confirm;
        $password = $request->password;
        
        $User = DB::table('users')->where('email',$email)->get();
        $Check = count($User);
        if($password == $password_confirm){
            if($Check == 0){
                // create user
                $password_inSecured = $request->password;
                //harshing password Here
                $password = Hash::make($password_inSecured);
                $User = new User;
                $User->name = $request->name;
                $User->email = $request->email;
                $User->location = $request->location;
                $User->mobile = $request->mobile;
              
                $User->password = $password;
                $User->save(); 
                
                if($request->newsletter == 'on'){
                    // Add to Mailling List
                    $email = $request->email;
                    $Subscriber = new Subscriber;
                    $Subscriber->email = $email;
                    $Subscriber->save();
                }
               

                // Notify Client
                ReplyMessage::messageClient($email,$request->name);


                $user = User::where('email','=',$email)->first();
                Auth::loginUsingId($user->id, TRUE);
                // Redirect
                return Redirect::back();
            }else{
                Session::flash('message_error', "That email is already in use by another person");
                return Redirect::back();
            }
        }else{
            Session::flash('message_error', "Password Did Not Match!");
            // Return with form Data
            return Redirect::back()->withInput($request->input());
        }
            
        
    }

    

    public function login(Request $request){
        
        $email = $request->email;
        $password = $request->password; 
        $userdata = array(
            'email'     => $email,
            'password'  => $password
        );
        // Authenticate
        if (Auth::attempt($userdata)) {

            $user = User::where('email','=',$email)->first();
            Auth::loginUsingId($user->id, TRUE);
            return Redirect::back();
            
    
        } else {        
    
            Session::flash('message_error', "Wrong Username Or Password");
            return Redirect::back();
    
        }

    }

    
    public function updateShipping(Request $request){
        $id = Auth::user()->id;
       

            
            $updateDetails = array(
                'name'=>$request->name,
                'town'=>$request->town,
                'location'=>$request->location,
                'mobile'=>$request->mobile,
 
            
            );
           
            DB::table('users')->where('id',$id)->update($updateDetails);

            Session::flash('message', "Delivery Address Updated!");
            return Redirect::back();
    
    }
    public function save(Request $request){
        $id = Auth::user()->id;
       
        $CartItems = Cart::content();
        if($request->email == Auth::user()->email ){
            
            $updateDetails = array(
                'name'=>$request->name,
                'address'=>$request->address,
                'location'=>$request->location,
                'mobile'=>$request->phone,
                'town'=>$request->town,
            
            );
           
            DB::table('users')->where('id',$id)->update($updateDetails);

            $page_name ='Shipping Method';
            $page_title ='Confirm';
            $keywords='Amani Vehicle Sounds';

            return redirect()->action('CheckoutController@checkout_confirm');
        }else{
            $updateDetails = array(
                'name'=>$request->name,
                'email'=>$request->email,
                'address'=>$request->address,
                'location'=>$request->location,
                'mobile'=>$request->phone,
                'town'=>$request->town,
            
            );
            DB::table('users')->where('id',$id)->update($updateDetails);
            $page_name ='Shipping Method';
            $page_title ='Confirm';
            $keywords='Amani Vehicle Sounds';
            // return redirect()->route('cart/checkout/order','CheckoutController@checkout_confirm');
            return redirect()->action('CheckoutController@checkout_confirm',[$param]);
        }
    }

    public function c2b(){
        $mpesa= new \Safaricom\Mpesa\Mpesa();

        $b2bTransaction=$mpesa->c2b($ShortCode, $CommandID, $Amount, $Msisdn, $BillRefNumber );
    }

    public function stk(){
        $mpesa= new \Safaricom\Mpesa\Mpesa();
       
          $BusinessShortCode = "174379";
          $TransactionType = 'CustomerPayBillOnline';
          $Timestamp = date('YmdHis'); 
          $PartyA = '254723014032';
          $PhoneNumber = '254723014032';
          $CallbackURL = 'https://amanivehiclesounds.co.ke/payments/callback_url.php';
          $AccountReference = 'Designekta Studios';
          $TransactionDesc = 'Designekta Studios';
          $LipaNaMpesaPasskey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
          $Password = base64_encode($BusinessShortCode.$Passkey.$Timestamp);
          $Amount = '1';
          $PartyB = '254723014032';
          $$Remarks = '';
 
        $stkPushSimulation=$mpesa->STKPushSimulation($BusinessShortCode, $LipaNaMpesaPasskey, $TransactionType, $Amount, $PartyA, $PartyB, $PhoneNumber, $CallBackURL, $AccountReference, $TransactionDesc, $Remarks);
    }
}