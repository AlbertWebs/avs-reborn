<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use DB;
use OpenGraph;
use SEOMeta;
use Twitter;

class CompareController extends Controller
{
    public function index(){
        //Perfom a check to ensure that the cart is not empty
        $SEOSettings = DB::table('seosettings')->get();
        foreach ($SEOSettings as $Settings) {
            SEOMeta::setTitle('Compare Products  - ' . $Settings->sitename . ' ');
            SEOMeta::setDescription('Vehicle Sounds Systems in Kenya, Car Sound Systems in Kenya, Car alarm Systems in Kenya' . $Settings->welcome . '');
            SEOMeta::setCanonical('' . $Settings->url . '/compare');
            OpenGraph::setDescription('' . $Settings->welcome . '');
            OpenGraph::setTitle('' . $Settings->sitename . ' - ' . $Settings->welcome . '');
            OpenGraph::setUrl('' . $Settings->url . '/compare');
            OpenGraph::addProperty('type', 'articles');
            Twitter::setTitle('' . $Settings->sitename . ' - ' . $Settings->welcome . '');
            Twitter::setSite('' . $Settings->twitter . '');
        $page_title = 'Your Cart';
        $SiteSettings = DB::table('sitesettings')->get();
        $page_name = 'Your Cart';
        $keywords = 'Amani Vehicle Sounds';
        
        return view('cart.compare', compact('keywords','page_name','page_title','SiteSettings'));
        }
    }

    public function addCompare($id)
    {
        $product = Product::findOrFail($id);
          
        $compare = session()->get('compare', []);
        $count = count($compare);  
        if($count>=2){

        }else{
            if(isset($compare[$id])) {
                // $compare[$id]['quantity']++;
            } else {
                $compare[$id] = [
                    "id" => $product->id,
                    "name" => $product->name,
                    "slung" => $product->slung,
                    "price" => $product->price,
                ];
            }
        }
        
          
        session()->put('compare', $compare);
        return redirect()->back()->with('success', 'Product added to compare successfully!');
    }

    public function destroy(Request $request)
    {
        if($request->id) {
            $compare = session()->get('compare');
            if(isset($compare[$request->id])) {
                unset($compare[$request->id]);
                session()->put('compare', $compare);
            }
            session()->flash('success', 'Product removed successfully');
        }
        return Redirect::back();
    }

    public function clear()
    {
        session()->forget('compare');
        return Redirect::back();
    }
}
