<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use OpenGraph;
use SEOMeta;
use App\Models\User;
use App\Models\ReplyMessage;
use App\Models\Subscriber;
use Hash;
use Twitter;
use App\Models\Privacy;
use App\Models\CouponCode;
use App\Models\Search;
use App\Models\Term;
use App\Models\Delivery;
use Illuminate\Support\Facades\Auth;
use Newsletter;
use App\Models\Newsletters;
use Illuminate\Support\Str;
use Carbon\Carbon;
class HomeController extends Controller
{
    public function index()
    {
        $SEOSettings = DB::table('seosettings')->get();
        foreach ($SEOSettings as $Settings) {
            SEOMeta::setTitle(' ' . $Settings->sitename . ' - ' . $Settings->intro . '');
            SEOMeta::setDescription('Vehicle Sounds Systems in Kenya, Vehicle Accessories in kenya, Car Sound Systems in Kenya, Car alarm Systems in Kenya,   ,in car Accessories  ,car stereo  ,car subwoofer  ,car stereo installation nairobi  , car audio shop
            ,car stereo shop  ,powered speakers  ,underseat subwoofer  ,car speakers  ,car amplifiers' . $Settings->welcome . '');
            SEOMeta::setCanonical('' . $Settings->url . '');
            OpenGraph::setDescription('' . $Settings->welcome . '');
            OpenGraph::setTitle('' . $Settings->sitename . ' - ' . $Settings->welcome . '');
            OpenGraph::setUrl('' . $Settings->url . '');
            OpenGraph::addProperty('type', 'website');
            Twitter::setTitle('' . $Settings->sitename. '');
            Twitter::setSite('@amanisounds');


            $page_name = 'Home1';
            $page_title = 'Car Radio, Car Stereo - Amani Vehicle Sounds';

            $keywords = 'Car Sound Systems, Car Alarm Systems, Car Surveillance Systems,   ,in car Accessories  ,car stereo  ,car subwoofer  ,car stereo installation nairobi  , car audio shop
            ,car stereo shop  ,powered speakers  ,underseat subwoofer  ,car speakers  ,car amplifiers';


            return view('front.index', compact('keywords','page_title'));
        }
    }

    public function all()
    {
        Session::forget('Category');
        $SEOSettings = DB::table('seosettings')->get();
        foreach ($SEOSettings as $Settings) {
            SEOMeta::setTitle('Products | ' . $Settings->sitename .'');
            SEOMeta::setDescription('Pioneer Car Speakers, Sony Car Speakers, Kenwood Car speakers, Kenwood speakers, Sony Speakers' . $Settings->welcome . '');
            SEOMeta::setCanonical('' . $Settings->url . '/products');
            OpenGraph::setDescription('' . $Settings->welcome . '');
            OpenGraph::setTitle('' . $Settings->sitename . ' - ' . $Settings->welcome . '');
            OpenGraph::setUrl('' . $Settings->url . '/products');
            OpenGraph::addProperty('type', 'website');
            Twitter::setTitle('' . $Settings->sitename. '');
            Twitter::setSite('@amanisounds');
            $page_name = 'Products';
            $Copyright = DB::table('copyright')->get();
            $page_title = 'Products';
            $search_results ='';
            $search_results_category = '';
            $Products = DB::table('product')->OrderBy('id','DESC')->paginate(64);
            $keywords = 'Sony Car Tweeters, Sony Car Ampifires, Kenwood Car Speakers, Kenwood Car Subwoofers, Sony car Subwoofers';
            return view('front.products', compact('keywords','page_title', 'Products', 'page_name', 'search_results', 'search_results_category'));
        }
    }

    public function special_offers()
    {
        Session::forget('Category');
        $SEOSettings = DB::table('seosettings')->get();
        foreach ($SEOSettings as $Settings) {
            SEOMeta::setTitle('Products | ' . $Settings->sitename .'');
            SEOMeta::setDescription('Pioneer Car Speakers, Sony Car Speakers, Kenwood Car speakers, Kenwood speakers, Sony Speakers' . $Settings->welcome . '');
            SEOMeta::setCanonical('' . $Settings->url . '/products');
            OpenGraph::setDescription('' . $Settings->welcome . '');
            OpenGraph::setTitle('' . $Settings->sitename . ' - ' . $Settings->welcome . '');
            OpenGraph::setUrl('' . $Settings->url . '/products');
            OpenGraph::addProperty('type', 'website');
            Twitter::setTitle('' . $Settings->sitename. '');
            Twitter::setSite('@amanisounds');
            $page_name = 'Products';
            $Copyright = DB::table('copyright')->get();
            $page_title = 'Products';
            $search_results ='';
            $search_results_category = '';
            $Products = DB::table('product')->OrderBy('id','DESC')->where('offer','1')->paginate(64);
            $keywords = 'Sony Car Tweeters, Sony Car Ampifires, Kenwood Car Speakers, Kenwood Car Subwoofers, Sony car Subwoofers';
            return view('front.products', compact('keywords','page_title', 'Products', 'page_name', 'search_results', 'search_results_category'));
        }
    }





    public function product_category($category){
        Session::forget('Category');
        $Category = DB::table('category')->where('slung',$category)->get();

            foreach ($Category as $key => $value) {
                $page_name = $value->cat;
                $SEOSettings = DB::table('seosettings')->get();
                foreach ($SEOSettings as $Settings) {
                    SEOMeta::setTitle(' '.$value->cat.'  | ' . $Settings->sitename .'');
                    SEOMeta::setDescription(''.$value->cat.' '.$value->keywords.'');
                    SEOMeta::setCanonical('' . $Settings->url . '/products/'.$category.'');
                    OpenGraph::setDescription('' . $value->cat . '');
                    OpenGraph::setTitle('' . $value->cat . '');
                    OpenGraph::setUrl('' . $Settings->url . '/products/'.$category.'');
                    OpenGraph::addProperty('type', 'website');
                    Twitter::setTitle('' . $Settings->sitename. '');
                    Twitter::setSite('@amanisounds');
                    // Set Session Here
                    Session::put('Category', $page_name);
                    $page_title = 'Products';
                    $search_results ='';
                    $search_results_category = '';
                    $keywords = "$page_name, $value->keywords";
                    // infinite Scroll
                    $Products = DB::table('product')->where('cat',$value->id)->paginate(24);
                    return view('front.products-category', compact('keywords','page_title', 'Products', 'page_name','search_results','search_results_category','Category'));
            }
        }



    }

    public function products_discounts($category){
        Session::forget('Category');
        $Category = DB::table('category')->where('slung',$category)->get();
            foreach ($Category as $key => $value) {
                $page_name = $value->cat;
                $SEOSettings = DB::table('seosettings')->get();
                foreach ($SEOSettings as $Settings) {
                    SEOMeta::setTitle(' '.$value->cat.'  | ' . $Settings->sitename .'');
                    SEOMeta::setDescription(''.$value->cat.' '.$value->keywords.'');
                    SEOMeta::setCanonical('' . $Settings->url . '/products/'.$category.'');
                    OpenGraph::setDescription('' . $value->cat . '');
                    OpenGraph::setTitle('' . $value->cat . '');
                    OpenGraph::setUrl('' . $Settings->url . '/products/'.$category.'');
                    OpenGraph::addProperty('type', 'website');
                    Twitter::setTitle('' . $Settings->sitename. '');
                    Twitter::setSite('@amanisounds');
                    // Set Session Here
                    Session::put('Category', $page_name);
                    $page_title = 'Products';
                    $search_results ='';
                    $search_results_category = '';
                    $keywords = "$page_name, $value->keywords";
                    // infinite Scroll
                    $Products = DB::table('product')->where('cat',$value->id)->orderBy('offer','DESC')->get();
                    return view('front.products-categories', compact('keywords','page_title', 'Products', 'page_name','search_results','search_results_category'));
            }
        }
    }

    public function brands($category){

        $Brand = DB::table('brands')->where('slung',$category)->get();


            foreach ($Brand as $key => $value) {
                $page_name = $value->name;
                $SEOSettings = DB::table('seosettings')->get();
                foreach ($SEOSettings as $Settings) {
                    SEOMeta::setTitle('' . $value->name . ' Vehicle Accessories In Nairobi');
                    SEOMeta::setDescription(''.$value->name.' Vehicle Accessories In Nairobi');
                    SEOMeta::setCanonical('' . $Settings->url . '/products/'.$category.'');
                    OpenGraph::setDescription('' . $value->name . '');
                    OpenGraph::setTitle('' . $value->name . ' Vehicle Accessories In Nairobi');
                    OpenGraph::setUrl('' . $Settings->url . '/products/'.$category.'');
                    OpenGraph::addProperty('type', 'website');
                    Twitter::setTitle('' . $Settings->sitename. '');
                    Twitter::setSite('@amanisounds');
                    // Set Session Here

                    $page_title = 'Products';
                    $search_results ='';
                    $search_results_category = '';
                    $keywords = "$page_name Vehicle Accessories in Kenya";
                    // infinite Scroll
                    $Products = DB::table('product')->where('brand',$value->name)->paginate(24);
                    return view('front.products-brands', compact('keywords','page_title', 'Products', 'page_name','search_results','search_results_category','Brand'));
            }
        }



    }

    public function changeCode(){
        $Products = DB::table('product')->where('code','AND001')->get();
        foreach($Products as $products){
            $updateDetails = array('tag'=>'4', 'brand'=>'Android Radios');
            DB::table('product')->where('id',$products->id)->update($updateDetails);
        }
        return "Done";
    }



    public function categories(){
        Session::forget('Category');
        $SEOSettings = DB::table('seosettings')->get();
        foreach ($SEOSettings as $Settings) {
            SEOMeta::setTitle('Shop by Category  | ' . $Settings->sitename .'');
            SEOMeta::setDescription('Shop by Category | Car Sound Systems, Car Alarm Systems, Car Surveillance Systems');
            SEOMeta::setCanonical('' . $Settings->url . '/products/categories');
            OpenGraph::setDescription('Shop by Category | Car Sound Systems, Car Alarm Systems, Car Surveillance Systems');
            OpenGraph::setTitle('Shop by Category');
            OpenGraph::setUrl('' . $Settings->url . '/products/categories');
            OpenGraph::addProperty('type', 'website');
            Twitter::setTitle('' . $Settings->sitename. '');
            Twitter::setSite('@amanisounds');
            // Set Session Here
            $page_name = "Shop By Category";
            Session::put('Category', $page_name);
            $page_title = 'Products';

            $keywords = 'Car Sound Systems, Car Alarm Systems, Car Surveillance Systems,   ,in car Accessories  ,car stereo  ,car subwoofer  ,car stereo installation nairobi  , car audio shop
            ,car stereo shop  ,powered speakers  ,underseat subwoofer  ,car speakers  ,car amplifiers';

            // infinite Scroll

            return view('front.categories', compact('keywords','page_title','page_name'));
    }

    }

    public function brand(){
        Session::forget('Brand');
        $SEOSettings = DB::table('seosettings')->get();
        foreach ($SEOSettings as $Settings) {
            SEOMeta::setTitle('Shop by Brand  | ' . $Settings->sitename .'');
            SEOMeta::setDescription('Shop by Brand | Car Sound Systems, Car Alarm Systems, Car Surveillance Systems');
            SEOMeta::setCanonical('' . $Settings->url . '/products/brand');
            OpenGraph::setDescription('Shop by Brand | Car Sound Systems, Car Alarm Systems, Car Surveillance Systems');
            OpenGraph::setTitle('Shop by Brand');
            OpenGraph::setUrl('' . $Settings->url . '/products/brand');
            OpenGraph::addProperty('type', 'website');
            Twitter::setTitle('' . $Settings->sitename. '');
            Twitter::setSite('@amanisounds');
            // Set Session Here
            $page_name = "Shop By Brand";
            Session::put('Brand', $page_name);
            $page_title = 'Products';

            $keywords = 'Car Sound Systems, Car Alarm Systems, Car Surveillance Systems,   ,in car Accessories  ,car stereo  ,car subwoofer  ,car stereo installation nairobi  , car audio shop
            ,car stereo shop  ,powered speakers  ,underseat subwoofer  ,car speakers  ,car amplifiers';

            // infinite Scroll

            return view('front.brands', compact('keywords','page_title','page_name'));
    }

    }

    public function popup($slung){
        $Product =  DB::table('product')->where('slung',$slung)->get();
        return view('front.popup',compact('Product'));
    }

    public function fullscreen($slung){
        $Product =  DB::table('product')->where('slung',$slung)->get();
        return view('front.fullscreen',compact('Product'));
    }

    public function contact()
    {
        $SEOSettings = DB::table('seosettings')->get();
        foreach ($SEOSettings as $Settings) {
            SEOMeta::setTitle('Contact Us | ' . $Settings->sitename . '');
            SEOMeta::setDescription('Amani Vehicle Sounds, Contact Vehicles Speakers in Kenya, Car Bass Speakers');
            SEOMeta::setCanonical('' . $Settings->url . '/contact-us');

            OpenGraph::setDescription('' . $Settings->welcome . '');
            OpenGraph::setTitle('' . $Settings->sitename . ' - ' . $Settings->welcome . '');
            OpenGraph::setUrl('' . $Settings->url . '/contact-us');
            OpenGraph::addProperty('type', 'website');

            Twitter::setTitle('' . $Settings->sitename. '');
            Twitter::setSite('@amanisounds');
            $page_name = 'Contact';
            $page_title = 'Contact Us';
            $SiteSettings = DB::table('sitesettings')->get();
            $keywords = 'Vehicle Sound Systems, Vehicle Alarm Systems, Vehicle Surveillance Systems';
            return view('front.contact', compact('page_title', 'SiteSettings', 'page_name','keywords'));
        }
    }

    public function about()
    {
        $SEOSettings = DB::table('seosettings')->get();

        foreach ($SEOSettings as $Settings) {
            SEOMeta::setTitle('About Us | ' . $Settings->sitename . '');
            SEOMeta::setDescription('Amani Vehicle Sounds, Amani Car Sound Systems  Car Speakers systems. Pioneer Car stereo, Speakers for sale in kenya ');
            SEOMeta::setCanonical('' . $Settings->url . '/about-us');
            OpenGraph::setDescription('' . $Settings->welcome . '');
            OpenGraph::setTitle('' . $Settings->sitename . ' - ' . $Settings->welcome . '');
            OpenGraph::setUrl('' . $Settings->url . '/about-us');
            OpenGraph::addProperty('type', 'website');
            Twitter::setTitle('' . $Settings->sitename. '');
            Twitter::setSite('@amanisounds');

            $About = DB::table('about')->get();
            $SiteSettings = DB::table('sitesettings')->get();
            $Services = DB::table('services')->inRandomOrder()->paginate(2);
            $page_title = 'About Us';
            $Testimonial = DB::table('testimonial')->inRandomOrder()->paginate(3);
            $page_name = 'About';
            $keywords = 'Car Music in kenya, Vehicle Alarm Systems in kenya';
            return view('front.about', compact('keywords','Testimonial', 'page_title', 'page_name', 'Services', 'SiteSettings', 'About'));
        }
    }

    public function search(Request $request)
            {
            if($request->search == null or $request->search == ''){
                $output = '';
                return Response($output);
            }else
                $url = url('/product-tags/');
                if($request->ajax())
                {
                $output="";
                $products=DB::table('tags')->where('title','LIKE','%'.$request->search."%")->paginate(10);
                if($products)
                {
                foreach ($products as $key => $product) {
                $output.='<tr>'.

                '<td style="padding:10px 10px 10px 10px;"><a style="color:#66139B; visibility:visible;" href="'.$url.'/'.$product->slung.'"><b>'.$product->title.'</b></a></td>'.

                '</tr>';
                }
                return Response($output);
                    }
                    }
     }

     public function product_tags($slung){

        $Category = DB::table('tags')->where('slung',$slung)->get();
            foreach ($Category as $key => $value) {
                $page_name = $value->title;
                $SEOSettings = DB::table('seosettings')->get();
                foreach ($SEOSettings as $Settings) {
                    SEOMeta::setTitle(' '.$value->title.'  | ' . $Settings->sitename .'');
                    SEOMeta::setDescription(''.$value->title.' '.$value->keywords.'');
                    SEOMeta::setCanonical('' . $Settings->url . '/product-tags/'.$slung.'');
                    OpenGraph::setDescription('' . $value->title . '');
                    OpenGraph::setTitle('' . $value->title . '');
                    OpenGraph::setUrl('' . $Settings->url . '/product-tags/'.$slung.'');
                    OpenGraph::addProperty('type', 'website');
                    Twitter::setTitle('' . $Settings->sitename. '');
                    Twitter::setSite('@amanisounds');
                    // Set Session Here

                    // End Session Here
                    $page_name = $value->title;

                    $page_title = 'Products';
                    $search_results ='';
                    $search_results_category = '';
                    $keywords = "$value->title, $value->keywords";
                    $Products = DB::table('product')->where('tag',$value->id)->paginate(20);
                    return view('front.tags', compact('Category','keywords','page_title', 'Products', 'page_name','search_results','search_results_category'));
            }
        }
    }

    public function product_single($title){
        Session::forget('Category');
        $SEOSettings = DB::table('seosettings')->get();
        $Products = DB::table('product')->where('slung',$title)->get();
        foreach ($Products as $key => $value) {
            foreach ($SEOSettings as $Settings) {
                SEOMeta::setTitle(' '.$value->name.' | ' . $Settings->sitename .'');
                SEOMeta::setDescription(''.$value->meta.'');
                SEOMeta::setCanonical('' . $Settings->url . '/product/'.$title.'');
                OpenGraph::setDescription(''.$value->meta.'');
                OpenGraph::setTitle(' '.$value->name.' | ' . $Settings->sitename .'');
                OpenGraph::setUrl('' . $Settings->url . '/product/'.$title.'');
                OpenGraph::addProperty('type', 'product.item');
                Twitter::setTitle('' . $Settings->sitename. '');
                Twitter::setSite('@amanisounds');
                $page_name = 'details';
                $Copyright = DB::table('copyright')->get();
                $page_title = $title;
                $Products = DB::table('product')->where('slung',$title)->get();
                $keywords = $value->name;
                return view('front.product', compact('keywords','page_title', 'Products', 'page_name'));
            }
        }


    }


    public function terms()
    {
        $SEOSettings = DB::table('seosettings')->get();
        foreach ($SEOSettings as $Settings) {
            SEOMeta::setTitle('Terms and Conditions | ' . $Settings->sitename . '  ');
            SEOMeta::setDescription('Amani Vehicle Sounds Systems' . $Settings->welcome . '');
            SEOMeta::setCanonical('' . $Settings->url . '/terms-and-conditions');
            OpenGraph::setDescription('' . $Settings->welcome . '');
            OpenGraph::setTitle('' . $Settings->sitename . ' - ' . $Settings->welcome . '');
            OpenGraph::setUrl('' . $Settings->url . '/terms');
            OpenGraph::addProperty('type', 'website');
            Twitter::setTitle('' . $Settings->sitename. '');
            Twitter::setSite('@amanisounds');
            $page_name = 'Terms';
            $Term = Term::all();
            $page_title = 'Terms Of Service';
            $keywords = 'Vehicle Sound Systems, Vehicle Alarm Systems, Vehicle Surveillance Systems';
            return view('front.terms', compact('page_title', 'Term', 'page_name','keywords'));
        }
    }

    public function delivery()
    {
        $SEOSettings = DB::table('seosettings')->get();
        foreach ($SEOSettings as $Settings) {
            SEOMeta::setTitle('Terms Of Delivery | ' . $Settings->sitename . '  ');
            SEOMeta::setDescription('Amani Vehicle Sounds Systems' . $Settings->welcome . '');
            SEOMeta::setCanonical('' . $Settings->url . '/delivery');
            OpenGraph::setDescription('' . $Settings->welcome . '');
            OpenGraph::setTitle('' . $Settings->sitename . ' - ' . $Settings->welcome . '');
            OpenGraph::setUrl('' . $Settings->url . '/terms');
            OpenGraph::addProperty('type', 'website');
            Twitter::setTitle('' . $Settings->sitename. '');
            Twitter::setSite('@amanisounds');
            $page_name = 'Terms';
            $Term = Delivery::all();
            $page_title = 'Terms Of Delivery';
            $keywords = 'Vehicle Sound Systems, Vehicle Alarm Systems, Vehicle Surveillance Systems';
            return view('front.delivery', compact('page_title', 'Term', 'page_name','keywords'));
        }
    }



    public function privacy()
    {
        $SEOSettings = DB::table('seosettings')->get();
        foreach ($SEOSettings as $Settings) {
            SEOMeta::setTitle('Privacy Policy | ' . $Settings->sitename . '  ');
            SEOMeta::setDescription('Amani vehicle Sounds Privacy Policies' . $Settings->welcome . '');
            SEOMeta::setCanonical('' . $Settings->url . '/privacy');
            OpenGraph::setDescription('' . $Settings->welcome . '');
            OpenGraph::setTitle('' . $Settings->sitename . ' - ' . $Settings->welcome . '');
            OpenGraph::setUrl('' . $Settings->url . '/privacy');
            OpenGraph::addProperty('type', 'website');
            Twitter::setTitle('' . $Settings->sitename. '');
            Twitter::setSite('@amanisounds');
            $page_name = 'Terms';
            $Privacy = Privacy::all();
            $page_title = 'Privacy Policy';
            $keywords = 'Vehicle Sound Systems, Vehicle Alarm Systems, Vehicle Surveillance Systems';
            return view('front.privacy', compact('page_title', 'Privacy', 'page_name','keywords'));
        }
    }

    public function shipping()
    {
        $SEOSettings = DB::table('seosettings')->get();
        foreach ($SEOSettings as $Settings) {
            SEOMeta::setTitle('Shipping Policy | ' . $Settings->sitename . '  ');
            SEOMeta::setDescription('Amani vehicle Sounds Privacy Policies' . $Settings->welcome . '');
            SEOMeta::setCanonical('' . $Settings->url . '/privacy');
            OpenGraph::setDescription('' . $Settings->welcome . '');
            OpenGraph::setTitle('' . $Settings->sitename . ' - ' . $Settings->welcome . '');
            OpenGraph::setUrl('' . $Settings->url . '/privacy');
            OpenGraph::addProperty('type', 'website');
            Twitter::setTitle('' . $Settings->sitename. '');
            Twitter::setSite('@amanisounds');
            $page_name = 'Terms';
            $Privacy = Privacy::all();
            $page_title = 'Privacy Policy';
            $keywords = 'Vehicle Sound Systems, Vehicle Alarm Systems, Vehicle Surveillance Systems';
            return view('front.privacy', compact('page_title', 'Privacy', 'page_name','keywords'));
        }
    }



    public function copyright()
    {
        $SEOSettings = DB::table('seosettings')->get();
        foreach ($SEOSettings as $Settings) {
            SEOMeta::setTitle('Copyright Statement | ' . $Settings->sitename . '  ');
            SEOMeta::setDescription('Amani Vehicle Sounds Copyrights' . $Settings->welcome . '');
            SEOMeta::setCanonical('' . $Settings->url . '/copyright');
            OpenGraph::setDescription('' . $Settings->welcome . '');
            OpenGraph::setTitle('' . $Settings->sitename . ' - ' . $Settings->welcome . '');
            OpenGraph::setUrl('' . $Settings->url . '/copyright');
            OpenGraph::addProperty('type', 'website');
            Twitter::setTitle('' . $Settings->sitename. '');
            Twitter::setSite('@amanisounds');
            $page_name = 'Terms';
            $Copyright = DB::table('copyright')->get();
            $page_title = 'Copyright Statement';
            $keywords = 'Vehicle Sound Systems, Vehicle Alarm Systems, Vehicle Surveillance Systems';
            return view('front.copyright', compact('page_title', 'keywords','Copyright', 'page_name'));
        }
    }


    public function searchsite(Request $request)
    {
        $keywords = '';
        $category = $request->category;
        $search = $request->keyword;

        if(Auth::user()){
            $User = Auth::user()->email;
        }else{
            $User = \Request::ip();
        }

        // Add keyword
        $Search = Search::where('keyword',$search)->get();
        if($Search->isEmpty()){
            $SModel = new Search;
            $SModel->keyword = $search;
            $SModel->user = $User;
            $SModel->save();
        }else{

        }


        $Products = DB::table('product')->where('code', 'like', '%' . $request->keyword . '%')->orWhere('name', 'like', '%' . $request->keyword . '%')->paginate(200);
        $page_name = $request->search;
        $page_title = $request->search;
        $search_results = $search;
        $search_results_category = 'All Categories';
        $SEOSettings = DB::table('seosettings')->get();
        foreach ($SEOSettings as $Settings) {
            SEOMeta::setTitle('Our Products | ' . $Settings->sitename .'');
            SEOMeta::setDescription('Pioneer Car Speakers, Sony Car Speakers, Kenwood Car speakers, Kenwood speakers, Sony Speakers' . $Settings->welcome . '');
            SEOMeta::setCanonical('' . $Settings->url . '/search-results/');
            OpenGraph::setDescription('' . $Settings->welcome . '');
            OpenGraph::setTitle('' . $Settings->sitename . ' - ' . $Settings->welcome . '');
            OpenGraph::setUrl('' . $Settings->url . '/search-results/');
            OpenGraph::addProperty('type', 'website');
            Twitter::setTitle('' . $Settings->sitename. '');
            Twitter::setSite('@amanisounds');
            $ProductsCategory = DB::table('category')->where('keywords', 'like', '%' . $request->search . '%')->limit(4)->get();
            $ProductsTag = DB::table('tags')->where('title', 'like', '%' . $request->search . '%')->limit(1)->get();
            $ProductsBrand = DB::table('brands')->where('name', 'like', '%' . $request->search . '%')->limit(1)->get();

            // Call Route
            // return redirect()->route('search-results', ['ProductsTag'=>$ProductsTag,'ProductsBrand'=>$ProductsBrand,'ProductsCategory'=>$ProductsCategory]);

            return view('front.search-results', compact('ProductsCategory','ProductsTag','ProductsBrand','page_title','keywords', 'Products', 'page_name', 'search_results', 'search_results_category','search'));


        }




    }

    public function do_not(Request $request)
    {

        $search = $request->Checked;

        if(Auth::user()){
            $User = Auth::user()->email;
        }else{
            $User = \Request::ip();
        }

        // Add keyword
        $Search = Newsletters::where('user',$User)->get();
        if($Search->isEmpty()){
            $SModel = new Newsletters;
            $SModel->user = $User;
            $SModel->save();
        }else{

        }

        return "Understood!";

    }



    public function filter(Request $request)
    {
        $keywords = '';
        $category = $request->category;
        $brand = $request->brand;
        $search = $request->keyword;

                $Products = DB::table('product')->where('cat',$category)->where('brand', 'like', '%' . $request->brand . '%')->paginate(200);
                $page_name = $request->search;
                $page_title = $request->search;
                $search_results = $search;
                $search_results_category = 'All Categories';
                $SEOSettings = DB::table('seosettings')->get();
                foreach ($SEOSettings as $Settings) {
                    SEOMeta::setTitle('Our Products | ' . $Settings->sitename .'');
                    SEOMeta::setDescription('Pioneer Car Speakers, Sony Car Speakers, Kenwood Car speakers, Kenwood speakers, Sony Speakers' . $Settings->welcome . '');
                    SEOMeta::setCanonical('' . $Settings->url . '/search-results/');
                    OpenGraph::setDescription('' . $Settings->welcome . '');
                    OpenGraph::setTitle('' . $Settings->sitename . ' - ' . $Settings->welcome . '');
                    OpenGraph::setUrl('' . $Settings->url . '/search-results/');
                    OpenGraph::addProperty('type', 'website');
                    Twitter::setTitle('' . $Settings->sitename. '');
                    Twitter::setSite('@amanisounds');
                    $ProductsCategory = DB::table('category')->where('keywords', 'like', '%' . $request->search . '%')->limit(4)->get();
                    $ProductsTag = DB::table('tags')->where('title', 'like', '%' . $request->search . '%')->limit(1)->get();
                    $ProductsBrand = DB::table('brands')->where('name', 'like', '%' . $request->search . '%')->limit(1)->get();

                    return view('front.search-results', compact('ProductsCategory','ProductsTag','ProductsBrand','page_title','keywords', 'Products', 'page_name', 'search_results', 'search_results_category','search'));


        }




    }

    public function filters(Request $request)
    {
        $keywords = '';

        $mobile_search = $request->mobile_search;

                $Products = DB::table('product')->where('code', 'like', '%' . $mobile_search . '%')->orWhere('name', 'like', '%' . $mobile_search . '%')->paginate(200);
                $page_name = $mobile_search;
                $page_title = $mobile_search;
                $search_results = $mobile_search;
                $search_results_category = 'All Categories';
                $SEOSettings = DB::table('seosettings')->get();
                foreach ($SEOSettings as $Settings) {
                    SEOMeta::setTitle('Our Products | ' . $Settings->sitename .'');
                    SEOMeta::setDescription('Pioneer Car Speakers, Sony Car Speakers, Kenwood Car speakers, Kenwood speakers, Sony Speakers' . $Settings->welcome . '');
                    SEOMeta::setCanonical('' . $Settings->url . '/search-results/');
                    OpenGraph::setDescription('' . $Settings->welcome . '');
                    OpenGraph::setTitle('' . $Settings->sitename . ' - ' . $Settings->welcome . '');
                    OpenGraph::setUrl('' . $Settings->url . '/search-results/');
                    OpenGraph::addProperty('type', 'website');
                    Twitter::setTitle('' . $Settings->sitename. '');
                    Twitter::setSite('@amanisounds');
                    $ProductsCategory = DB::table('category')->where('keywords', 'like', '%' . $mobile_search . '%')->limit(4)->get();
                    $ProductsTag = DB::table('tags')->where('title', 'like', '%' . $mobile_search . '%')->limit(1)->get();
                    $ProductsBrand = DB::table('brands')->where('name', 'like', '%' . $mobile_search . '%')->limit(1)->get();
                    $search = $mobile_search;

                    return view('front.search-results', compact('ProductsCategory','ProductsTag','ProductsBrand','page_title','keywords', 'Products', 'page_name', 'search_results', 'search_results_category','search'));


        }




    }

    // manual login
    public function handleLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            $status = 1;
            return response()->json([
                'status' => $status,
                'user-type' => Auth::User()->type,
            ]);
        }

        // authentication failed...
        $status = 0;
        return $status;
    }


    public function portfolio(){

        $SEOSettings = DB::table('seosettings')->get();
        foreach ($SEOSettings as $Settings) {
            SEOMeta::setTitle('Our Work | ' . $Settings->sitename .'');
            SEOMeta::setDescription('Sony Car Speakers, Kenwood Car speakers, Pioneer Car Speakers,   Sony Speakers' . $Settings->welcome . '');
            SEOMeta::setCanonical('' . $Settings->url . '/our-portfolio');
            OpenGraph::setDescription('' . $Settings->welcome . '');
            OpenGraph::setTitle('' . $Settings->sitename . ' - ' . $Settings->welcome . '');
            OpenGraph::setUrl('' . $Settings->url . '/products');
            OpenGraph::addProperty('type', 'website');
            Twitter::setTitle('' . $Settings->sitename. '');
            Twitter::setSite('@amanisounds');
            $page_name = 'Products';
            $Copyright = DB::table('copyright')->get();
            $page_title = 'Portfolio';
            $search_results ='';
            $search_results_category = '';
            $Products = DB::table('portfolio')->OrderBy('id','DESC')->paginate(18);
            $keywords = 'Sony Car Tweeters, Sony Car Ampifires, Kenwood Car Speakers, Kenwood Car Subwoofers, Sony car Subwoofers';
            return view('front.portfolio', compact('keywords','page_title', 'Products', 'page_name', 'search_results', 'search_results_category'));
        }

    }

    public function folio($id){

        $SEOSettings = DB::table('seosettings')->get();
        foreach ($SEOSettings as $Settings) {
            SEOMeta::setTitle('Our Work | ' . $Settings->sitename .'');
            SEOMeta::setDescription('Sony Car Speakers, Kenwood Car speakers, Pioneer Car Speakers,   Sony Speakers' . $Settings->welcome . '');
            SEOMeta::setCanonical('' . $Settings->url . '/our-portfolio');
            OpenGraph::setDescription('' . $Settings->welcome . '');
            OpenGraph::setTitle('' . $Settings->sitename . ' - ' . $Settings->welcome . '');
            OpenGraph::setUrl('' . $Settings->url . '/products');
            OpenGraph::addProperty('type', 'website');
            Twitter::setTitle('' . $Settings->sitename. '');
            Twitter::setSite('@amanisounds');
            $page_name = 'Products';
            $Copyright = DB::table('copyright')->get();
            $page_title = 'Portfolio';
            $search_results ='';
            $search_results_category = '';
            $Products = DB::table('portfolio')->where('id',$id)->OrderBy('id','DESC')->get();
            $keywords = 'Sony Car Tweeters, Sony Car Ampifires, Kenwood Car Speakers, Kenwood Car Subwoofers, Sony car Subwoofers';
            return view('front.folio', compact('keywords','page_title', 'Products', 'page_name', 'search_results', 'search_results_category'));
        }

    }

    public function newsletter(Request $request)
    {
        $email = $request->user_email;
        $UserCheck = DB::table('users')->where('email',$request->user_email)->get();
        $UserSubscribers = DB::table('subscribers')->where('email',$request->user_email)->get();
        if($UserCheck->isEmpty()){
            // if($UserSubscribers->isEmpty()){
            //     $Subscriber = new Subscriber;
            //     $Subscriber->email = $email;
            //     $Subscriber->save();
            // }
            // Create User
            $password_inSecured = $email;
            //harshing password Here
            $password = Hash::make($password_inSecured);
            $name = "User-$email";
            $email = $email;

            $User = new User;
            $User->name = $name;
            $User->email = $email;
            $User->password = $password;
            $User->save();
            // Generate RednomCoupon
            $string =  rand(2,1000000);
            $coupon = "AVS$string";
            // Create Expiry
            $expire = now()->addDays(7)->format('Y-m-d');

            // Log the random coupon to the database
            $code = new CouponCode;
            $code->title = "NEWSLETTER";
            $code->code = $coupon;
            $code->status = 1;
            $code->expired_at = "$expire";
            $code->value = "8";
            $code->save();
            // Send Email
            ReplyMessage::mailsubscriber($email,$coupon);
            if ( ! Newsletter::isSubscribed($request->user_email) ) {
                Newsletter::subscribe($request->user_email);
            }
        }else{

        }


    }

    public function subscription_offers(){

    }

    public function sub(){

        return view('subscribe');
    }

       public function checkEmail(Request $request)
    {
        $email = $request->input('email');
        $isExists = \App\Models\User::where('email', $email)->first();
        //Create The Logics To return AJAX
        if($isExists){
            return response()->json(array("exists" => true));
        }else{
            return response()->json(array("exists" => false));
        }
    }
}


