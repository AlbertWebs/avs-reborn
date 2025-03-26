<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart; //introduces the cart lib
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
// use Request;
use Illuminate\Support\Facades\Auth;
use Bhavinjr\Wishlist\Facades\Wishlist;
use Illuminate\Support\Facades\Redirect;
use LamaLama\Wishlist\HasWishlists;
use Session;
use App\Models\Product;
use OpenGraph;
use SEOMeta;
use Twitter;
class CartController extends Controller
{
    public function index(){
        //Perfom a check to ensure that the cart is not empty
        $SEOSettings = DB::table('seosettings')->get();
        foreach ($SEOSettings as $Settings) {
            SEOMeta::setTitle('Your Cart  - ' . $Settings->sitename . ' ');
            SEOMeta::setDescription('Vehicle Sounds Systems in Kenya, Car Sound Systems in Kenya, Car alarm Systems in Kenya' . $Settings->welcome . '');
            SEOMeta::setCanonical('' . $Settings->url . '');
            OpenGraph::setDescription('' . $Settings->welcome . '');
            OpenGraph::setTitle('' . $Settings->sitename . ' - ' . $Settings->welcome . '');
            OpenGraph::setUrl('' . $Settings->url . '');
            OpenGraph::addProperty('type', 'articles');
            Twitter::setTitle('' . $Settings->sitename . ' - ' . $Settings->welcome . '');
            Twitter::setSite('' . $Settings->twitter . '');
        $page_title = 'Your Cart';
        $SiteSettings = DB::table('sitesettings')->get();
        $CartItems = Cart::content();
        $page_name = 'Your Cart';
        $keywords = 'Amani Vehicle Sounds';
        
        return view('cart.index', compact('keywords','page_name','CartItems','page_title','SiteSettings'));
        }
    }

    
    public function wishlist(){
        //Perfom a check to ensure that the cart is not empty
        $SEOSettings = DB::table('seosettings')->get();
        foreach ($SEOSettings as $Settings) {
            SEOMeta::setTitle('Your WishList  - ' . $Settings->sitename . ' ');
            SEOMeta::setDescription('Vehicle Sounds Systems in Kenya, Car Sound Systems in Kenya, Car alarm Systems in Kenya' . $Settings->welcome . '');
            SEOMeta::setCanonical('' . $Settings->url . '');
            OpenGraph::setDescription('' . $Settings->welcome . '');
            OpenGraph::setTitle('' . $Settings->sitename . ' - ' . $Settings->welcome . '');
            OpenGraph::setUrl('' . $Settings->url . '');
            OpenGraph::addProperty('type', 'articles');
            Twitter::setTitle('' . $Settings->sitename . ' - ' . $Settings->welcome . '');
            Twitter::setSite('' . $Settings->twitter . '');
        $page_title = 'Your Cart';
        $SiteSettings = DB::table('sitesettings')->get();
        if(Auth::user()){
            $user_id = Auth::user()->id;
        }else{
            $user_id = \Request::ip();
        }
      
        $CartItems = Wishlist::getUserWishlist($user_id);
        $page_name = 'Your Cart';
        $keywords = 'Amani Vehicle Sounds';
        
        return view('cart.wishlist', compact('keywords','page_name','CartItems','page_title','SiteSettings'));
        }
    }

    public function compare(){
        //Perfom a check to ensure that the cart is not empty
        $CountCompare = Cart::instance('wishlist')->count();
        $SEOSettings = DB::table('seosettings')->get();
        foreach ($SEOSettings as $Settings) {
            SEOMeta::setTitle('Compare Products  - ' . $Settings->sitename . ' ');
            SEOMeta::setDescription('Vehicle Sounds Systems in Kenya, Car Sound Systems in Kenya, Car alarm Systems in Kenya' . $Settings->welcome . '');
            SEOMeta::setCanonical('' . $Settings->url . '');
            OpenGraph::setDescription('' . $Settings->welcome . '');
            OpenGraph::setTitle('' . $Settings->sitename . ' - ' . $Settings->welcome . '');
            OpenGraph::setUrl('' . $Settings->url . '');
            OpenGraph::addProperty('type', 'articles');
            Twitter::setTitle('' . $Settings->sitename . ' - ' . $Settings->welcome . '');
            Twitter::setSite('' . $Settings->twitter . '');
        $page_title = 'Compare Products';
        $SiteSettings = DB::table('sitesettings')->get();
        
        $page_name = 'Compare Products';
        $keywords = 'Amani Vehicle Sounds';
        
        
        return view('cart.compare', compact('keywords','page_name','page_title','SiteSettings','CountCompare'));
        }
    }

    public function addCompare($id){
        //Count Compare
        $CountCompare = Cart::instance('wishlist')->count();
       
        if($CountCompare > 1){
            // Rediect to Compare
            return redirect()->action('CartController@compare');
        }else{
            $product = Product::find($id); //This gets product by id
            
            $CountComparee = Cart::instance('wishlist')->content();
            // Check if is empty
            if($CountCompare < 1){
                Cart::instance('wishlist')->add($id, $product->name, 1, $product->price);
                return Redirect::back();
            }else{
                foreach($CountComparee as $comp){
                
                    if($id == $comp->id){
                            // Redirect to Compare
                            return redirect()->action('CartController@compare');
                    }else{
                            Cart::instance('wishlist')->add($id, $product->name, 1, $product->price);
                            return redirect()->action('CartController@compare');
                    }
                }
            }
                
            
            
            
        }


            
    }
    
    
    public function addCart($id){
        $product = Product::find($id); //This gets product by id
         Cart::add($id, $product->name, 1,$product->price);
         
         return Redirect::back();
    }

    public function addWishlist($id,$user){
        Wishlist::add($id, $user);
        return Redirect::back();
    }

   

    public function removeWishlist($id,$user){
        // Wishlist::remove(2);
        Wishlist::removeByProduct($id, $user);
        return Redirect::back();
    }

    

    

    

    public function addCarts($id){ 
        $product = Product::find($id); //This gets product by id
         Cart::add($id, $product->name, 1,$product->price);
         
        //  Redirect To Cart page
        return redirect()->action('CartController@index');

    }


    public function addToTheCart(Request $request){ 
     
        $id = $request->id;
        $qty = $request->qty;
        $product = Product::find($id); //This gets product by id
         Cart::add($id, $product->name, $qty,$product->price);

        //  Redirect To Cart page
        return redirect()->action('CartController@index');

    }

    

    

    public function addCartPost(Request $request, $id){
        $product = Product::find($id); //This gets product by id
        $qty = $request->qty;
         Cart::add($id, $product->name, $qty,$product->price);
         
         return Redirect::back();
    }

    
    

//     public function addCart($id){
//         $product = Pricing::find($id); //This gets product by id
//         Cart::add($id, $product->service, 1,$product->price);
//         $page_title = 'Your Cart';
//         $SiteSettings = DB::table('sitesettings')->get();
//         $CartItems = Cart::content();
        
//         return view('cart.index', compact('CartItems','page_title','SiteSettings'));
//    }
 
    public function addItem($id){
         $product = Product::find($id); //This gets product by id
         Cart::add($id, $product->name, 1,$product->price);
          $res =  Cart::content();
          $count = Cart::count();
          $Total = Cart::subtotal();
          return json_encode(array($count, $Total));
          return back();
    }
    public function destroy($id){
        
        Cart::remove($id);
        return back(); //redirects back to cart
     }

    public function destroyCompare($id){
        
        
        Cart::instance('wishlist')->remove($id);
        return back(); //redirects back to cart
     }
     
     
     public function update(Request $request){ 
         $rowID = $request->rowId;
         $qty = $request->qty;
    
         Cart::update($rowID,$request->qty);
         $results = "Your Cart has Been Updated";
         return $results;
     }

     public function veryfy(Request $request, $id, $rowId){
         $cart = Cart::count();
            if($cart>1){
                Session::flash('message-fail', "Use coupons and gifts if you have only one item in your "); 
                return Redirect::back();
            }else{
                $coupons = $request->coupons;
                $gifts = $request->gifts;
                if($coupons == '' AND $gifts == ''){
                    Session::flash('message-fail', "Invalid inputs");
                    return Redirect::back();
                }
                //Check the Coupons
                if($coupons != '' AND $gifts == ''){
                    //coupons is set
                    $Coupons = DB::table('coupons')->where('type','coupons')->where('status','0')->where('code',$coupons)->get();
                    //Counting
                    $CounterCoupons = count($Coupons);
                    if($CounterCoupons > 0){
                        foreach($Coupons as $value){
                            $PriceOFF = $value->price;
                            $CouponID = $value->id;
                            //Get Cart Price
                            $cartItems = Cart::content();
                            foreach($cartItems as $cartPrice){
                                $cartPriceVar = $cartPrice->price;
                                $newPrice = $cartPriceVar - $PriceOFF;
                                
                                //Updating the Cart
                                    $item = Cart::get($rowId);
                                    

                                    Cart::update(
                                        $rowId, [
                                        
                                        'price' => $newPrice, 
                                        
                                    ]);
                                    
                            }

                        }
                        
                        Session::put('discount', $PriceOFF);
                        Session::flash('message-coupon-success', "Your Coupon Code has been verified");
                        return Redirect::back();

                    }else{
                        Session::flash('message-fail', "The Coupon Code Entered Is Not Valid");
                        return Redirect::back();
                    }
                    
                }
                if($gifts != '' AND $coupons == ''){
                    //gifts is set
                    $Gifts = DB::table('coupons')->where('type','gifts')->where('status','0')->where('code',$gifts)->get();
                    $CounterGifts = count($Gifts);
                    if($CounterGifts > 0){
                        foreach($Gifts as $value){
                            $PriceOFF = $value->price;
                            $CouponID = $value->id;
                            //Get Cart Price
                            $cartItems = Cart::content();
                            foreach($cartItems as $cartPrice){
                                $cartPriceVar = $cartPrice->price;
                                $newPrice = $cartPriceVar - $PriceOFF;
                                
                                //Updating the Cart
                                    $item = Cart::get($rowId);
                                    

                                    Cart::update(
                                        $rowId, [
                                        
                                        'price' => $newPrice, 
                                        
                                    ]);
                                    
                            }

                        }
                        $updateDetails = array('status'=>1);
                        DB::table('coupons')->where('id',$CouponID)->update($updateDetails);
                        Session::put('discount', $PriceOFF);
                        Session::flash('message-gift-success', "Your Gift Code has been verified");
                        return Redirect::back();
                    }else{
                    Session::flash('message-fail', "The Gift Code Entered Is Not Valid");
                    return Redirect::back();
                    }
                }
                if($gifts != '' AND $coupons != ''){
                    //  Both have been set
                    Session::flash('message-fail', "Please use either coupon or gift codes at a time");
                    return Redirect::back();
                }
                //Update Cart \

                //Redirect Back to the main page
                
            }
        }
}