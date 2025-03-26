<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Request;
use App\Models\Product;
use App\Models\User;
use DB;
use javcorreia\Wishlist\Facades\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Session;
use OpenGraph;
use SEOMeta;
use Twitter;

class WishListController extends Controller
{
    public function index(){
        //Perfom a check to ensure that the cart is not empty
        $SEOSettings = DB::table('seosettings')->get();
        foreach ($SEOSettings as $Settings) {
            SEOMeta::setTitle('Your Wishlist  - ' . $Settings->sitename . ' ');
            SEOMeta::setDescription('Vehicle Sounds Systems in Kenya, Car Sound Systems in Kenya, Car alarm Systems in Kenya' . $Settings->welcome . '');
            SEOMeta::setCanonical('' . $Settings->url . '/wishlist');
            OpenGraph::setDescription('' . $Settings->welcome . '');
            OpenGraph::setTitle('' . $Settings->sitename . ' - ' . $Settings->welcome . '');
            OpenGraph::setUrl('' . $Settings->url . '/wishlist');
            OpenGraph::addProperty('type', 'articles');
            Twitter::setTitle('' . $Settings->sitename . ' - ' . $Settings->welcome . '');
            Twitter::setSite('' . $Settings->twitter . '');
        $page_title = 'Your Wishlist';
        $SiteSettings = DB::table('sitesettings')->get();
        $page_name = 'Your Cart';
        $keywords = 'Amani Vehicle Sounds Wishlist';
        
        return view('cart.wishlist', compact('keywords','page_name','page_title','SiteSettings'));
        }
    }


    public function addWish($ProductID){
        $UserIP = Request::ip();
        if(Auth::check()) {
            $UserId = Auth::User()->id;
            Wishlist::add($ProductID, $UserId);
        }else{
            $UserIP = Request::ip();
            Wishlist::add($ProductID, $UserIP, 'session');
        }
        // Return something
        return Redirect::back();
    }

    public function destroy($ProductID){
        $UserIP = Request::ip();
        if(Auth::check()) {
            $UserId = Auth::User()->id;
            DB::table('wishlist')->where('user_id',$UserId)->where('item_id',$ProductID)->delete();
        }else{
            DB::table('wishlist')->where('session_id',$UserIP)->where('item_id',$ProductID)->delete();
        }
        // Return something
        return Redirect::back();
    }

}
