<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Redirect;

use App\User;

use App\Order;

use Session;

use App\ReplyMessage;

use App\orders;

use App\TraceServices;

use App\Product;

use App\Review;

use SEOMeta;
use OpenGraph;
use Twitter;

class ClientController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $keywords = '';
        $SEOSettings = DB::table('seosettings')->get();
        foreach($SEOSettings as $Settings){
        SEOMeta::setTitle('My Account - '.$Settings->sitename.' - Clients Area');
        SEOMeta::setDescription(''.$Settings->welcome.'');
        SEOMeta::setCanonical(''.$Settings->url.'/clientarea');

        OpenGraph::setDescription(''.$Settings->welcome.''); 
        OpenGraph::setTitle(''.$Settings->sitename.' - '.$Settings->welcome.'');
        OpenGraph::setUrl(''.$Settings->url.'/clientarea');
        OpenGraph::addProperty('type', 'articles');
        
        
        Twitter::setTitle(''.$Settings->sitename.' - '.$Settings->welcome.'');
        Twitter::setSite(''.$Settings->twitter.'');
        $id = Auth::user()->id;
        //$TraceServices = DB::table('traceservices')->where('status','0')->where('user_id',$id)->get();
        $id = Auth::user()->id;
        $Orders = DB::table('orders')->where('user_id',$id)->get(); 
        $page_name = '';
        $page_title = '';
        $page_title = 'ClientArea';
        $Order= DB::table('orders')->where('user_id',$id)->paginate(3);
        return view('clientarea.index',compact('keywords','page_title','Order','page_name','page_title','Orders'));
        }
    }

    public function profile(){
        $keywords = '';
        $SEOSettings = DB::table('seosettings')->get();
        foreach($SEOSettings as $Settings){
        SEOMeta::setTitle('My Profile - '.$Settings->sitename.' - Profile');
        SEOMeta::setDescription(''.$Settings->welcome.'');
        SEOMeta::setCanonical(''.$Settings->url.'/clientarea/profile');

        OpenGraph::setDescription(''.$Settings->welcome.''); 
        OpenGraph::setTitle(''.$Settings->sitename.' - '.$Settings->welcome.'');
        OpenGraph::setUrl(''.$Settings->url.'/clientarea/profile');
        OpenGraph::addProperty('type', 'articles');
        
        
        Twitter::setTitle(''.$Settings->sitename.' - '.$Settings->welcome.'');
        Twitter::setSite(''.$Settings->twitter.'');
        $Orders = DB::table('orders')->where('user_id',$id)->get(); 
        $id = Auth::user()->id;
        $User = User::find($id);
        $page_name = '';
        $page_title = '';
        $page_title = 'My Profile';
        return view('clientarea.profile',compact('keywords','page_title','User','page_name','page_title','Orders'));
        }
    }

    public function orders(){
        $SEOSettings = DB::table('seosettings')->get();
        foreach($SEOSettings as $Settings){
        SEOMeta::setTitle('Orders'.$Settings->sitename.' - Orders');
        SEOMeta::setDescription(''.$Settings->welcome.'');
        SEOMeta::setCanonical(''.$Settings->url.'/clientarea/orders');

        OpenGraph::setDescription(''.$Settings->welcome.''); 
        OpenGraph::setTitle(''.$Settings->sitename.' - '.$Settings->welcome.'');
        OpenGraph::setUrl(''.$Settings->url.'/clientarea/orders');
        OpenGraph::addProperty('type', 'articles');
        
        
        Twitter::setTitle(''.$Settings->sitename.' - '.$Settings->welcome.'');
        Twitter::setSite(''.$Settings->twitter.'');
        $id = Auth::user()->id;
        $page_name = '';
        $page_title = '';
        $Orders = DB::table('orders')->where('user_id',$id)->get(); 
        $page_title = 'ClientArea';
        return view('clientarea.orders',compact('page_title','Orders','page_name','page_title'));
        }
    }

    public function save(Request $request){
        $id = Auth::user()->id;
        if($request->email == Auth::user()->email ){
            $updateDetails = array(
                'name'=>$request->name,
                'address'=>$request->address,
                'location'=>$request->location,
                'mobile'=>$request->mobile,
                'notes'=>$request->notes,
                'country'=>$request->country,
                
            
            );
            DB::table('users')->where('id',$id)->update($updateDetails);
            Session::flash('message', "Changes have been saved");
            return Redirect::back();
        }
    }
    public function place_order(Request $request){
        $id = Auth::user()->id;
        $Order = new Order;
        $Order->user_id = $id;
        $Order->title = $request->title;
        $Order->content = $request->content;
        $Order->save();

        $subject = 'You have a new Order';
        $email = Auth::user()->email;
        $name = Auth::user()->name;
        $message= 'Login To the admins panel and Check your order';

        //Send Mail Notification
        ReplyMessage::mailNotificaton($name,$email,$subject,$message);

        $Message->save();
        $Notifications = new Notifications;
        $Notifications->type = 'Order';
        $Notifications->content = 'You have a new Order';
        $Notifications->save();

        Session::flash('message', "Order has Been Received");
        return Redirect::back();
    }

    public function thankyou(){
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
       
        $page_title = 'Thank You for your purchase';
        return view('clientarea.thankyou',compact('page_title','page_name','page_title','keywords'));
        }
    }

    public function addReview($id){
        $Product = Product::find($id);
        $SEOSettings = DB::table('seosettings')->get();
        foreach($SEOSettings as $Settings){
        SEOMeta::setTitle('Add Review'.$Settings->sitename.' - Add Review');
        SEOMeta::setDescription(''.$Settings->welcome.'');
        SEOMeta::setCanonical(''.$Settings->url.'/clientarea/addReview');

        OpenGraph::setDescription(''.$Settings->welcome.''); 
        OpenGraph::setTitle(''.$Settings->sitename.' - '.$Settings->welcome.'');
        OpenGraph::setUrl(''.$Settings->url.'/clientarea/addReview');
        OpenGraph::addProperty('type', 'articles');
        
        
        Twitter::setTitle(''.$Settings->sitename.' - '.$Settings->welcome.'');
        Twitter::setSite(''.$Settings->twitter.'');
        $id = Auth::user()->id;
        $page_name = '';
        $page_title = '';
        $keywords = 'Amani Vehicle Sounds';
        $User = User::find($id);
        $page_title = 'Thank You for your purchase';
        return view('clientarea.addReview',compact('page_title','page_name','page_title','keywords','User','Product'));
    }
    }

    public function invoice($invoicenumber){
        $Invoice = DB::table('invoices')->where('number',$invoicenumber)->where('user_id',Auth::user()->id)->get();
        $keywords = '';
        $SEOSettings = DB::table('seosettings')->get();
        foreach($SEOSettings as $Settings){
        SEOMeta::setTitle('Invoice - '.$invoicenumber.' - '.$Settings->sitename.' - Clients Area');
        SEOMeta::setDescription(''.$Settings->welcome.'');
        SEOMeta::setCanonical(''.$Settings->url.'/clientarea');

        OpenGraph::setDescription(''.$Settings->welcome.''); 
        OpenGraph::setTitle(''.$Settings->sitename.' - '.$Settings->welcome.'');
        OpenGraph::setUrl(''.$Settings->url.'/clientarea');
        OpenGraph::addProperty('type', 'articles');
        
        
        Twitter::setTitle(''.$Settings->sitename.' - '.$Settings->welcome.'');
        Twitter::setSite(''.$Settings->twitter.'');
        $id = Auth::user()->id;
        //$TraceServices = DB::table('traceservices')->where('status','0')->where('user_id',$id)->get();
        $page_name = '';
        $page_title = '';
        $page_title = 'Invoices';
        $Order= DB::table('orders')->where('user_id',$id)->get();
        return view('clientarea.invoice',compact('keywords','page_title','Order','page_name','page_title','Invoice','invoicenumber'));
        }

    }

    public function invoices(){
        $Invoice = DB::table('invoices')->where('user_id',Auth::user()->id)->paginate(3);
        $keywords = '';
        $SEOSettings = DB::table('seosettings')->get();
        foreach($SEOSettings as $Settings){
        SEOMeta::setTitle('My Account - '.$Settings->sitename.' - Clients Area');
        SEOMeta::setDescription(''.$Settings->welcome.'');
        SEOMeta::setCanonical(''.$Settings->url.'/clientarea');

        OpenGraph::setDescription(''.$Settings->welcome.''); 
        OpenGraph::setTitle(''.$Settings->sitename.' - '.$Settings->welcome.'');
        OpenGraph::setUrl(''.$Settings->url.'/clientarea');
        OpenGraph::addProperty('type', 'articles');
        
        
        Twitter::setTitle(''.$Settings->sitename.' - '.$Settings->welcome.'');
        Twitter::setSite(''.$Settings->twitter.'');
        $id = Auth::user()->id;
        //$TraceServices = DB::table('traceservices')->where('status','0')->where('user_id',$id)->get();
        $page_name = '';
        $page_title = '';
        $page_title = 'Invoices';
        $Order= DB::table('orders')->where('user_id',$id)->get();
        return view('clientarea.invoices',compact('keywords','page_title','Order','page_name','page_title','Invoice'));
        }

    }

    public function add_Review(Request $request){
        $name = $request->name;
        $email = $request->email;
        $content = $request->content;
        $rating = $request->rating;
        $product_id = $request->product_id;

        $Review = new Review;
        $Review->name = $name;
        $Review->email = $email;
        $Review->content = $content;
        $Review->product_id = $product_id;
        $Review->rating = $rating;
        $Review->save();

        Session::flash('message', "Your Review Will Be Published Soon");
        return Redirect::back();

    }

    public function transactions(){ 
       
        $SEOSettings = DB::table('seosettings')->get();
        foreach($SEOSettings as $Settings){
        SEOMeta::setTitle('Transactions -'.$Settings->sitename.' - Transactions');
        SEOMeta::setDescription(''.$Settings->welcome.'');
        SEOMeta::setCanonical(''.$Settings->url.'/clientarea/addReview');

        OpenGraph::setDescription(''.$Settings->welcome.''); 
        OpenGraph::setTitle(''.$Settings->sitename.' - '.$Settings->welcome.'');
        OpenGraph::setUrl(''.$Settings->url.'/clientarea/addReview');
        OpenGraph::addProperty('type', 'articles');
        
        
        Twitter::setTitle(''.$Settings->sitename.' - '.$Settings->welcome.'');
        Twitter::setSite(''.$Settings->twitter.'');
        $id = Auth::user()->id;
        $page_name = '';
        $page_title = '';
        $keywords = 'Amani Vehicle Sounds';
        $Payments = DB::table('mobile_payments')->where('user_id',Auth::user()->id)->paginate('3');
        $page_title = 'Thank You for your purchase';
        return view('clientarea.payments',compact('page_title','page_name','page_title','keywords','Payments'));
    }
    }
}
