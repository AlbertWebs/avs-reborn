<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboadController extends Controller
{
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
        $Orders = DB::table('orders')->where('user_id',$id)->get(); 
        $page_name = '';
        $page_title = '';
        $page_title = 'ClientArea';
        $Order= DB::table('orders')->where('user_id',$id)->paginate(3);
        return view('clientarea.index',compact('keywords','page_title','Order','page_name','page_title','Orders'));
        }
    }
}
