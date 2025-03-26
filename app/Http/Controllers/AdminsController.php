<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Redirect;

use Stevebauman\Location\Facades\Location;

use Storage;

use Mail;

use Hash;

use Session;

use datetime;

use App\Models\Offer;

use App\Models\Coupon;

use App\Models\Tag;

use App\Models\Term;

use App\Models\Search;

use App\Models\CouponCode;

use App\Models\Brand;

use App\Models\Privacy;

use App\Models\Invoice;

use App\Models\Value;

use App\Models\Gallery;

use App\Models\Admin;

use App\Models\Stat;

use App\Models\User;

use App\Models\Mailer;

use App\Models\Client;

use App\Models\Video;

use App\Models\Page;

use App\Models\Slider;

use App\Models\Banner;

use App\Models\Page_Settings;

use App\Models\Message;

use App\Models\ReplyMessage;

use App\Models\CategoryBanners;

use App\Models\Category;

use App\Models\Special;

use App\Models\SubCategory;

use App\Models\ProExcel;

use App\Models\Product;

use App\Models\Services;

use App\Models\Portfolio;

use App\Models\Pricing;

use App\Models\Subscriber;

use App\Models\Update;

use App\Models\Payment;

use App\Models\Notifications;

use App\Models\Testimonial;

use App\Models\Service_Rendered;

use App\Models\Daily;

use App\Models\Blog;

use App\Models\Review;

use App\Models\Comment;

use App\Models\TraceServices;

use App\Models\Quote;

use App\Models\Doctor;

use App\Models\Order;

use App\Models\How;

use App\Models\Action;

use App\Models\File;

use Illuminate\Support\Str;

use App\Models\ServiceRequest;

class AdminsController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    //  Home Page
    public function index(){
        $Message = DB::table('messages')->where('status','0')->get();
        $Comments = DB::table('comments')->where('status','0')->get();
        $page_title = 'Admin Home';
        $page_name = 'Admin Home';
        return view('admin.index',compact('page_title','page_name','Comments','Message'));
    }

    public function list(){
        $page_title = 'list';
        return view('admin.list',compact('page_title'));
    }

    public function form(){
        $page_title = 'form';
        return view('admin.form',compact('page_title'));
    }
    public function formfile(){
        $page_title = 'formfile';
        return view('admin.formfile',compact('page_title'));
    }
    public function formfiletext(){
        $page_title = 'formfiletext';
        return view('admin.formfiletext',compact('page_title'));
    }

    public function error403(){
        $page_title = 'Error';
        return view('admin.403',compact('page_title'));
    }

    public function error404(){
        $page_title = 'Error';
        return view('admin.404',compact('page_title'));
    }

    public function error405(){
        $page_title = 'Error';
        return view('admin.405',compact('page_title'));
    }

    public function error500(){
        $page_title = 'Error';
        return view('admin.500',compact('page_title'));
    }

    public function error503(){
        $page_title = 'Error';
        return view('admin.503',compact('page_title'));
    }
   

    public function under_construction(){
        $page_title = 'Website Is Under Construction';
        return view('admin.under_construction',compact('page_title'));
    }
    public function wizard(){
        $page_title = 'Wizard';
        return view('admin.wizard',compact('page_title'));
    }

    public function maps(){
        $page_title = 'Maps';
        $page_name = 'Maps';
        return view('admin.maps',compact('page_title','page_name'));
    }

    //sitesettings
    public function sitesettings(){
        $SiteSettings = DB::table('sitesettings')->get();
        $page_title = 'formfiletext';
        $page_name = 'Site Setting';
        return view('admin.sitesettings',compact('page_title','page_name','SiteSettings'));
    }

    public function savesitesettings(Request $request)
    {
        $path = 'uploads/logo';
        if(isset($request->logo)){
            $file = $request->file('logo');
            $filename = $file->getClientOriginalName();
            $file->move($path, $filename);
            $logo = $filename;
        }else{
            $logo = $request->logo_cheat;
        }

        if(isset($request->favicon)){
            $file = $request->file('favicon');
            $filename = $file->getClientOriginalName();
            $file->move($path, $filename);
            $favicon = $filename;
        }else{
            $favicon = $request->favicon_cheat;
        }

        if(isset($request->till_image)){
            $till_image = $request->file('till_image');
            $filename = $till_image->getClientOriginalName();
            $till_image->move($path, $filename);
            $till_image = $filename;
        }else{
            $till_image = $request->till_image_cheat;
        }
        

        
        $updateDetails = array(
            'sitename'=>$request->sitename,
            'logo'=>$logo,
            'till_image'=>$till_image,
            'email'=>$request->email,
            'email_one'=>$request->email_one,
            'mobile'=>$request->mobile,
            'mobile_one'=>$request->mobile_one,
            'mobile_two'=>$request->mobile_two,
            'tagline'=>$request->tagline,
            'till'=>$request->till,
            'url'=>$request->url,
            'location'=>$request->location,
            'address'=>$request->address,
            'facebook'=>$request->facebook,
            'twitter'=>$request->twitter,
            'linkedin'=>$request->linkedin,
            'instagram'=>$request->instagram,
            'youtube'=>$request->youtube,
            'google'=>$request->google,
            'welcome'=>$request->welcome,
            'favicon'=>$favicon,
            
        );
        DB::table('sitesettings')->update($updateDetails);
        Session::flash('message', "Changes have Been Saved");
        return Redirect::back();
    }
    

    public function seosettings(){
        $SiteSettings = DB::table('seosettings')->get();
        $page_title = 'formfiletext';
        $page_name = 'SEO Setting';
        return view('admin.seosettings',compact('page_title','page_name','SiteSettings'));
    }

    public function saveseosettings(Request $request)
    {
       
        $updateDetails = array(
            'sitename'=>$request->sitename,
            'intro'=>$request->intro,
            'tagline'=>$request->tagline,
            
            'url'=>$request->url,
            'location'=>$request->location,
            'address'=>$request->address,
            'facebook'=>$request->facebook,
            'twitter'=>$request->twitter,
            'linkedin'=>$request->linkedin,
            'instagram'=>$request->instagram,
            'youtube'=>$request->youtube,
            'google'=>$request->google,
            'welcome'=>$request->welcome
            
        );
        DB::table('seosettings')->update($updateDetails);
        Session::flash('message', "Changes have Been Saved");
        return Redirect::back();
    }
    
    public function copyright(){
        $Copyright = DB::table('copyright')->get();
        $page_title = 'formfiletext';//For Style Inheritance
        $page_name = 'Copyright';
        return view('admin.copyright',compact('page_title','page_name','Copyright'));
    }
    public function edit_copyright(Request $request){
        $updateDetails = array(
            'content'=>$request->content
        );
        DB::table('copyright')->update($updateDetails);

        Session::flash('message', "Changes have Been Saved");
        return Redirect::back();
    }

    public function delivery(){
        $Copyright = DB::table('delivery')->get();
        $page_title = 'formfiletext';//For Style Inheritance
        $page_name = 'Copyright';
        return view('admin.delivery',compact('page_title','page_name','Copyright'));
    }
    public function edit_delivery(Request $request){
        $updateDetails = array(
            'content'=>$request->content
        );
        DB::table('delivery')->update($updateDetails);

        Session::flash('message', "Changes have Been Saved");
        return Redirect::back();
    }

    
    public function about(){
        $About = DB::table('about')->get();
        $page_title = 'formfiletext';//For Style Inheritance
        $page_name = 'About Us';
        return view('admin.about',compact('page_title','page_name','About'));
    }
    public function about_save(Request $request){
        $path = 'uploads/images';
        if(isset($request->image)){
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $file->move($path, $filename);
            $image = $filename;
        }else{
            $image = $request->image_cheat;
        }

        if(isset($request->image_one)){
            $file = $request->file('image_one');
            $filename = $file->getClientOriginalName();
            $file->move($path, $filename);
            $image_one = $filename;
        }else{
            $image_one = $request->image_one_cheat;
        }

        if(isset($request->image_two)){
            $file = $request->file('image_two');
            $filename = $file->getClientOriginalName();
            $file->move($path, $filename);
            $image_two = $filename;
        }else{
            $image_two = $request->image_two_cheat;
        }

        $updateDetails = array(
            'content'=>$request->content,
            'image'=>$image,
            'image_one'=>$image_one,
            'image_two'=>$image_two,
        );
        DB::table('about')->update($updateDetails);

        Session::flash('message', "Changes have Been Saved");
        return Redirect::back();
    }

    public function addTerms(){
        $page_name = 'Add Terms & Conditions';
        $page_title = 'formfiletext';//For Style Inheritance
        return view('admin.addTerms',compact('page_title','page_name'));
    }
    public function add_term(Request $request){
        $terms = new Term;
        $terms->title = $request->title;
        $terms->content = $request->content;
        $terms->save();
        Session::flash('message', "Content Has been Added");
        return Redirect::back();
    }

    public function terms(){
        $page_name = 'Terms & Conditions';
        $Terms = Term::All();
        $page_title = 'list';
        return view('admin.terms',compact('page_title','Terms','page_name'));
    }
    public function editTerm($id){
        $Terms = Term::find($id);
        $page_title = 'formfiletext';//For Style Inheritance
        $page_name = $Terms->title;
        return view('admin.editTerm')->with('Terms',$Terms)->with('page_title',$page_title)->with('page_name',$page_name);
    }

    public function edit_term(Request $request, $id){
       $updateDetails = array(
           'title'=>$request->title,
           'content' =>$request->content
       );
       DB::table('terms')->where('id',$id)->update($updateDetails);
       Session::flash('message', "Changes have been saved");
        return Redirect::back();
    }

    public function delete_term($id){
        DB::table('terms')->where('id',$id)->delete();
        return Redirect::back();
    }

    public function addPrivacy(){
        $page_name = 'Add Privacy Policy';
        $page_title = 'formfiletext';//For Style Inheritance
        return view('admin.addPrivacy',compact('page_title','page_name'));
    }
    public function add_privacy(Request $request){
        $privacy = new Privacy;
        $privacy->title = $request->title;
        $privacy->content = $request->content;
        $privacy->save();
        Session::flash('message', "Content Has been Added");
        return Redirect::back();
    }

    public function privacy(){
        $Privacy = Privacy::All();
        $page_name = 'Privacy Policies';
        $page_title = 'list';
        return view('admin.privacy',compact('page_title','Privacy','page_name'));
    }
    public function editPrivacy($id){
        $Privacy = Privacy::find($id);
        $page_name = $Privacy->title;
        $page_title = 'formfiletext';//For Style Inheritance
        
        return view('admin.editPrivacy')->with('Privacy',$Privacy)->with('page_name',$page_name)->with('page_title',$page_title);
    }

    public function edit_privacy(Request $request, $id){
       $updateDetails = array(
           'title'=>$request->title,
           'content' =>$request->content
       );
       DB::table('privacy')->where('id',$id)->update($updateDetails);
       Session::flash('message', "Changes have been saved");
        return Redirect::back();
    }

    public function delete_privacy($id){
        DB::table('privacy')->where('id',$id)->delete();
        return Redirect::back();
    }

    public function gallery(){
        $page_title = 'Gallery';
        $page_name = 'Image Gallery';
        $Gallery = Gallery::all();
        return view('admin.gallery',compact('page_title','Gallery','page_name'));
    }

    public function editGallery($id){
        $page_title = 'formfiletext';
        $Gallery = Gallery::find($id);
        $page_name =  $Gallery->title;
        return view('admin.editGallery',compact('page_title','Gallery','page_name'));
    }

    public function addGallery(){
        $page_title = 'formfiletext';
       
        $page_name =  'Add Image';
        return view('admin.addGallery',compact('page_title','page_name'));
    }
    public function add_Gallery(Request $request){
            $path = 'uploads/gallery';
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $file->move($path, $filename);
            $image = $filename;
            $Gallery  = new Gallery;
            $Gallery->title = $request->title;
            $Gallery->content = $request->content;
            $Gallery->image = $image;
            $Gallery->save();
            Session::flash('message', "Image Added To Gallery");
            return Redirect::back();
       
    } 

    public function save_gallery(Request $request, $id){
        $path = 'uploads/gallery';
        if(isset($request->image)){
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $file->move($path, $filename);
            $image = $filename;
        }else{
            $image = $request->image_cheat;
        }
        $updateDetails = array(
            'title'=>$request->title,
            'content' =>$request->content,
            'image' =>$image
        );
        DB::table('gallery')->where('id',$id)->update($updateDetails);
        Session::flash('message', "Changes have been saved");
        return Redirect::back();
    }
    
    public function galleryList(){
        $page_title = 'list';
        $page_name = 'Image Gallery';
        $Gallery = Gallery::all();
        return view('admin.galleryList',compact('page_title','Gallery','page_name'));
    }

    public function deleteGallery($id){
        DB::table('gallery')->where('id',$id)->delete();
        return Redirect::back();
    }
    public function addAdmin(){
        $page_name = 'Add Site Admin';
        $page_title = 'formfiletext';//For Style Inheritance
        return view('admin.addAdmin',compact('page_title','page_name'));
    }

    public function add_Admin(Request $request){
        $path = 'uploads/admins';
        
        $file = $request->file('image');
        $filename = $file->getClientOriginalName();
        $file->move($path, $filename);
        $image = $filename;
        
        $password_inSecured = $request->password;
        //harshing password Here
        $password = Hash::make($password_inSecured);
         $Admin = new Admin;
         $Admin->name = $request->name;
         $Admin->email = $request->email;
         $Admin->password = $password;
         $Admin->image = $image;
         $Admin->save();
         Session::flash('message', "$request->name has been added as new admin");
         return Redirect::back();

    }
    public function admins(){
        $page_title = 'list';
        $page_name = 'Site Administrator';
        $Admin = Admin::all();
        return view('admin.admins',compact('page_title','Admin','page_name'));
    }

    public function editAdmin($id){
        $newID = Auth::user()->id;
        $Admin = Admin::find($newID);
        $page_title = 'formfiletext';//For Style Inheritance
        $page_name = 'Edit Site Administrator';
       
        return view('admin.editAdmin',compact('page_title','Admin','page_name'));
    }

    public function edit_Admin(Request $request, $id){
        $path = 'uploads/admins';
        if($request->email == Auth::user()->email ){
            if(isset($request->image)){
                $fileSize = $request->file('image')->getSize();
                if($fileSize>=1800000){
                   Session::flash('message', "File Exceeded the maximum allowed Size");
                   Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
                   
                }else{
                   
                    $file = $request->file('image');
                    $filename = str_replace(' ', '', $file->getClientOriginalName());
                    $timestamp = new Datetime();
                    $new_timestamp = $timestamp->format('Y-m-d H:i:s');
                    $image_main_temp = $new_timestamp.'image'.$filename;
                    $image = str_replace(' ', '',$image_main_temp);
                    $file->move($path, $image);
                }
            }else{
                $image = $request->image_cheat;
            }
            $updateDetails = array(
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'facebook'=>$request->facebook,
                    'twitter'=>$request->twitter,
                    'linkedin'=>$request->linkedin,
                    'instagram'=>$request->instagram,
                    'youtube'=>$request->youtube,
                    'google'=>$request->google,
                    'content'=>$request->content,
                    'position'=>$request->position,
                    'image'=>$image
            );
            DB::table('admins')->where('id',$id)->update($updateDetails);
            Session::flash('message', "Your Changes Have Been Saved");
            return Redirect::back();
        }else{
            if(isset($request->image)){
                $fileSize = $request->file('image')->getSize();
                if($fileSize>=1800000){
                   Session::flash('message', "File Exceeded the maximum allowed Size");
                   Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
                   
                }else{
                   
                    $file = $request->file('image');
                    $filename = str_replace(' ', '', $file->getClientOriginalName());
                    $timestamp = new Datetime();
                    $new_timestamp = $timestamp->format('Y-m-d H:i:s');
                    $image_main_temp = $new_timestamp.'image'.$filename;
                    $image = str_replace(' ', '',$image_main_temp);
                    $file->move($path, $image);
                }
            }else{
                $image = $request->image_cheat;
            }
            $updateDetails = array(
                'name'=>$request->name,
                'email'=>$request->email,
                'facebook'=>$request->facebook,
                'twitter'=>$request->twitter,
                'linkedin'=>$request->linkedin,
                'instagram'=>$request->instagram,
                'youtube'=>$request->youtube,
                'google'=>$request->google,
                'content'=>$request->content,
                'position'=>$request->position,
                'image'=>$image
            );
            DB::table('admins')->where('id',$id)->update($updateDetails);
            Auth::guard('admin')->logout();
            return Redirect::back();
        }
    }
    

    public function deleteAdmin($id){
        if($id==1){
            echo "<script>alert('You cannot Delete the Supper Admin)</script>";
            
            return Redirect::back();
        }else{
            DB::table('admins')->where('id',$id)->delete();
            return Redirect::back();
        }
    }

    public function addUser(){
        $page_name = 'Add USer';
        $page_title = 'formfiletext';//For Style Inheritance
        return view('admin.addUser',compact('page_title','page_name'));
    }

    public function add_User(Request $request){
        $path = 'uploads/users';
        if(isset($request->image)){
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $file->move($path, $filename);
            $image = $filename;
        }else{
            $image = $request->image_cheat;
        }
        $password_inSecured = $request->password;
        //harshing password Here
        $password = Hash::make($password_inSecured);
         $User = new User;
         $User->name = $request->name;
         $User->email = $request->email;
         $User->password = $password;
         $User->image = $image;
         $User->save();
         Session::flash('message', "$request->name has been added as new User");
         return Redirect::back();

    }
    public function users(){
        $page_title = 'list';
        $page_name = 'Site Users';
        $User = User::all();
        return view('admin.users',compact('page_title','User','page_name'));
    }

    public function deleteUser($id){
        if($id==1){
            echo "<script>alert('You cannot Delete the Supper Admin)</script>";
            
            return Redirect::back();
        }else{
            DB::table('users')->where('id',$id)->delete();
            return Redirect::back();
        }
    }

    public function slider(){
        $Slider = Slider::all();
        $page_title = 'list';
        $page_name = 'Home Page Slider';
        return view('admin.slider',compact('page_title','Slider','page_name'));
    }

    public function addSlider(){
        $page_title = 'formfiletext';
        $page_name = 'Add Home Page Slider';
        return view('admin.addSlider',compact('page_title','page_name'));
    }

    public function add_Slider(Request $request){
        $path = 'uploads/slider';
        $file = $request->file('image');
        $filename = $file->getClientOriginalName();
        $file->move($path, $filename);
        $image = $filename;
        $Slider = new Slider;
        $Slider->name = $request->name;
        $Slider->content = $request->content;
        $Slider->image = $image;
        $Slider->save();
        Session::flash('message', "Slider Image Has Been Added");
        return Redirect::back();
    }

    public function editSlider($id){
        $Slider = Slider::find($id);
        $page_title = 'formfiletext';
        $page_name = 'Edit Home Page Slider';
        return view('admin.editSlider',compact('page_title','Slider','page_name'));
    }

    public function edit_Slider(Request $request, $id){
        $path = 'uploads/slider';
        if(isset($request->image)){
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $file->move($path, $filename);
            $image = $filename;
        }else{
            $image = $request->image_cheat;
        }
        $updateDetails = array(
            'name'=>$request->name,
            'content' =>$request->content,
            'image' =>$image
        );
        DB::table('slider')->where('id',$id)->update($updateDetails);
        Session::flash('message', "Changes have been saved");
        return Redirect::back();
    }

    public function deleteSlider($id){
        DB::table('slider')->where('id',$id)->delete();
        return Redirect::back();
    }

    public function banners(){
        $Slider = Banner::all();
        $page_title = 'list';
        $page_name = 'Banners';
        return view('admin.banner',compact('page_title','Slider','page_name'));
    }

    public function editBanner($id){
        $Banner = Banner::find($id);
        $page_title = 'formfiletext';
        $page_name = 'Site Banner';
        return view('admin.editBanner',compact('page_title','Banner','page_name'));
    }
    
    public function edit_Banner(Request $request, $id){
        $path = 'uploads/banners';
        if(isset($request->image)){
            $file = $request->file('image');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            
            $file->move($path, $filename);
            $image = $filename;
        }else{
            $image = $request->image_cheat;
        }
        $updateDetails = array(
            'name'=>$request->name,
            'section' =>$request->section,
            'image' =>$image
        );
        DB::table('banners')->where('id',$id)->update($updateDetails);
        Session::flash('message', "Changes have been saved");
        return Redirect::back();
    }

    public function addPage(){
        $page_title = 'formfiletext';//For Layout Inheritance
        $page_name = 'Add New Page';
        return view('admin.addPage',compact('page_title','page_name'));
    }

    public function add_Page(Request $request){

        $path = 'uploads/pages';
        if(isset($request->image_one)){
            $fileSize = $request->file('image_one')->getSize();
                if($fileSize>=1800000){
                Session::flash('message', "File Exceeded the maximum allowed Size");
                Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
                return Redirect::back();
                }else{
                
                $file = $request->file('image_one');
                $filename = str_replace(' ', '', $file->getClientOriginalName());
                $timestamp = new Datetime();
                $new_timestamp = $timestamp->format('Y-m-d H:i:s');
                $image_main_temp = $new_timestamp.'image'.$filename;
                $image_one = str_replace(' ', '',$image_main_temp);
                $file->move($path, $image_one);
                }
        }else{
            $image_one = $request->pro_img_cheat;
        }

        if(isset($request->image_two)){
            $fileSize = $request->file('image_two')->getSize();
             if($fileSize>=1800000){
                Session::flash('message', "File Exceeded the maximum allowed Size");
                Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
                
             }else{
                
                $file = $request->file('image_two');
                $filename = str_replace(' ', '', $file->getClientOriginalName());
                $timestamp = new Datetime();
                $new_timestamp = $timestamp->format('Y-m-d H:i:s');
                $image_main_temp = $new_timestamp.'image'.$filename;
                $image_two = str_replace(' ', '',$image_main_temp);
                $file->move($path, $image_two);
             }
        }else{
            $image_two = $request->pro_img_cheat;
        }
 
        
        if(isset($request->image_three)){
            $fileSize = $request->file('image_three')->getSize();
            if($fileSize>=1800000){
               Session::flash('message', "File Exceeded the maximum allowed Size");
               Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
               
            }else{
               
                $file = $request->file('image_three');
                $filename = str_replace(' ', '', $file->getClientOriginalName());
                $timestamp = new Datetime();
                $new_timestamp = $timestamp->format('Y-m-d H:i:s');
                $image_main_temp = $new_timestamp.'image'.$filename;
                $image_three = str_replace(' ', '',$image_main_temp);
                $file->move($path, $image_three);
            }
        }else{
            $image_three = $request->pro_img_cheat;
        }
        //Additional images
        
        if(isset($request->image_four)){
            $fileSize = $request->file('image_four')->getSize();
            if($fileSize>=1800000){
               Session::flash('message', "File Exceeded the maximum allowed Size");
               Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
               
            }else{
            
                $file = $request->file('image_four');
                $filename = str_replace(' ', '', $file->getClientOriginalName());
                $timestamp = new Datetime();
                $new_timestamp = $timestamp->format('Y-m-d H:i:s');
                $image_main_temp = $new_timestamp.'image'.$filename;
                $image_four = str_replace(' ', '',$image_main_temp);
                $file->move($path, $image_four);
            }
        }else{
            $image_four = $request->pro_img_cheat;
        }
 
        
 
        if(isset($request->image_five)){
            $fileSize = $request->file('image_five')->getSize();
            if($fileSize>=1800000){
               Session::flash('message', "File Exceeded the maximum allowed Size");
               Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
               
            }else{
                
                $file = $request->file('image_five');
                $filename = str_replace(' ', '', $file->getClientOriginalName());
                $timestamp = new Datetime();
                $new_timestamp = $timestamp->format('Y-m-d H:i:s');
                $image_main_temp = $new_timestamp.'image'.$filename;
                $image_five = str_replace(' ', '',$image_main_temp);
                $file->move($path, $image_five);
            }
        }else{
            $image_five = $request->pro_img_cheat;
        }
        $Page = new Page;
        $Page->name = $request->name;
        $Page->content = $request->content;
        $Page->image_one = $image_one;
        $Page->image_two = $image_two;
        $Page->image_three = $image_three;
        $Page->image_four = $image_four;
        $Page->image_five = $image_five;
        $Page->save();
        

        $Page_Settings = new Page_Settings;
        $Page_Settings->page_name = $request->name;
        $Page_Settings->save();
        Session::flash('message', "A Page Has Been Added");
        return Redirect::back();
    }

    public function pages(){
        $Page = Page::all();
        $page_title = 'list';
        $page_name = 'All Dynamic Pages';
        return view('admin.pages',compact('page_title','Page','page_name'));
    }

    public function editPage($id){
        $Page = Page::find($id);
        $page_title = 'formfiletext';
        $page_name = 'Edit Page';
        return view('admin.editPage',compact('page_title','Page','page_name'));
    }
    
    public function setPage($name){
        $Page = DB::table('pages_settings')->where('page_name',$name)->get();
        $page_title = 'formfiletext';
        $page_name = 'PageSettings';
        return view('admin.setPage',compact('page_title','Page','page_name'));
    }

    public function set_Page(Request $request, $name){

        $updateDetails = array(
            'sidebar'=>$request->sidebar,
            'sidebar_right' =>$request->sidebar_right,
            'slider' => $request->slider,
            'menu' => $request->menu,
        );

        DB::table('pages_settings')->where('page_name',$name)->update($updateDetails);
        Session::flash('message', "Changes have been saved");
        return Redirect::back();
    }

    public function edit_Page(Request $request, $id){
        $path = 'uploads/pages';
        if(isset($request->image_one)){
            $fileSize = $request->file('image_one')->getSize();
                if($fileSize>=1800000){
                Session::flash('message', "File Exceeded the maximum allowed Size");
                Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
                return Redirect::back();
                }else{
                
                $file = $request->file('image_one');
                $filename = str_replace(' ', '', $file->getClientOriginalName());
                $timestamp = new Datetime();
                $new_timestamp = $timestamp->format('Y-m-d H:i:s');
                $image_main_temp = $new_timestamp.'image'.$filename;
                $image_one = str_replace(' ', '',$image_main_temp);
                $file->move($path, $image_one);
                }
        }else{
            $image_one = $request->image_one_cheat;
        }

        if(isset($request->image_two)){
            $fileSize = $request->file('image_two')->getSize();
             if($fileSize>=1800000){
                Session::flash('message_image_two', "File Exceeded the maximum allowed Size");
                Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
                
             }else{
                
                $file = $request->file('image_two');
                $filename = str_replace(' ', '', $file->getClientOriginalName());
                $timestamp = new Datetime();
                $new_timestamp = $timestamp->format('Y-m-d H:i:s');
                $image_main_temp = $new_timestamp.'image'.$filename;
                $image_two = str_replace(' ', '',$image_main_temp);
                $file->move($path, $image_two);
             }
        }else{
            $image_two = $request->image_two_cheat;
        }
 
        
        if(isset($request->image_three)){
            $fileSize = $request->file('image_three')->getSize();
            if($fileSize>=1800000){
               Session::flash('message_image_three', "File Exceeded the maximum allowed Size");
               Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
               
            }else{
               
                $file = $request->file('image_three');
                $filename = str_replace(' ', '', $file->getClientOriginalName());
                $timestamp = new Datetime();
                $new_timestamp = $timestamp->format('Y-m-d H:i:s');
                $image_main_temp = $new_timestamp.'image'.$filename;
                $image_three = str_replace(' ', '',$image_main_temp);
                $file->move($path, $image_three);
            }
        }else{
            $image_three = $request->image_three_cheat;
        }
        //Additional images
        
        if(isset($request->image_four)){
            $fileSize = $request->file('image_four')->getSize();
            if($fileSize>=1800000){
               Session::flash('message_image_four', "File Exceeded the maximum allowed Size");
               Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
               
            }else{
            
                $file = $request->file('image_four');
                $filename = str_replace(' ', '', $file->getClientOriginalName());
                $timestamp = new Datetime();
                $new_timestamp = $timestamp->format('Y-m-d H:i:s');
                $image_main_temp = $new_timestamp.'image'.$filename;
                $image_four = str_replace(' ', '',$image_main_temp);
                $file->move($path, $image_four);
            }
        }else{
            $image_four = $request->image_four_cheat;
        }
 
        
 
        if(isset($request->image_five)){
            $fileSize = $request->file('image_five')->getSize();
            if($fileSize>=1800000){
               Session::flash('message_image_five', "File Exceeded the maximum allowed Size");
               Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
               
            }else{
                
                $file = $request->file('image_five');
                $filename = str_replace(' ', '', $file->getClientOriginalName());
                $timestamp = new Datetime();
                $new_timestamp = $timestamp->format('Y-m-d H:i:s');
                $image_main_temp = $new_timestamp.'image'.$filename;
                $image_five = str_replace(' ', '',$image_main_temp);
                $file->move($path, $image_five);
            }
        }else{
            $image_five = $request->image_five_cheat;
        }

        $updateDetails = array(
            'name' => $request->name,
            'content' => $request->content,
            'image_one' =>$image_one,
            'image_two' =>$image_two,
            'image_three' =>$image_three,
            'image_four' =>$image_four,
            'image_five' =>$image_five,
        );
        DB::table('pages')->where('id',$id)->update($updateDetails);
        Session::flash('message', "Changes have been saved");
        return Redirect::back();
    }

    public function allMessages(){
        $Message = Message::all();
        $page_title = 'list';
        $page_name = 'Messages';
        return view('admin.allMessages',compact('page_title','Message','page_name'));
    }
    public function unread(){
        $Message = DB::table('messages')->where('status','0')->get();
        $page_title = 'list';
        $page_name = 'Messages';
        return view('admin.allMessages',compact('page_title','Message','page_name'));
    }
    public function read($id){
        $Message = Message::find($id);
        $page_title = 'formfiletext';
        $page_name = 'Messages';
        return view('admin.read',compact('page_title','Message','page_name'));
    }
    public function reply(Request $request,$id){
        $reply = $request->message;
        $subject = $request->subject;
        $name = $request->name;
        $email = $request->email;
        
        //Call The Generic Reply Class
        ReplyMessage::SendMessage($reply,$subject,$name,$email,$id);
    }
    public function deleteMessage($id){
        DB::table('messages')->where('id',$id)->delete();
        return Redirect::back();
    }

        
public function categories(){
    $Category = Category::all();
    $page_title = 'list';
    $page_name = 'Categories';
    return view('admin.categories',compact('page_title','Category','page_name'));
}

public function addCategory(){
    $page_title = 'formfiletext';
    $page_name = 'Add Category';
    return view('admin.addCategory',compact('page_title','page_name'));
}

public function add_Category(Request $request){
    
    $Category = new Category;
    $Category->cat = $request->name;
    
    $Category->save();
    Session::flash('message', "Category Has Been Added");
    return Redirect::back();
}

public function editCategories($id){
    $Category = Category::find($id);
    $page_title = 'formfiletext';
    $page_name = 'Edit Home Page Slider';
    return view('admin.editCategory',compact('page_title','Category','page_name'));
}

public function edit_Category(Request $request, $id){
    $path = 'uploads/categories';
        if(isset($request->image)){
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $file->move($path, $filename);
            $image = $filename;
        }else{
            $image = $request->image_cheat;
        }
    $updateDetails = array(
        'cat'=>$request->name,
        'keywords'=>$request->keywords,
        'description'=>$request->content,
        'image'=>$image
      
    );
    DB::table('category')->where('id',$id)->update($updateDetails);
    Session::flash('message', "Changes have been saved");
    return Redirect::back();
}

public function deleteCategory($id){
    DB::table('category')->where('id',$id)->delete();
    return Redirect::back();
}

public function subCategories(){
    $Category = SubCategory::all();
    $page_title = 'list';
    $page_name = 'Categories';
    return view('admin.SubCategories',compact('page_title','Category','page_name'));
}

public function addSubCategory(){
    $page_title = 'formfiletext';
    $page_name = 'Add Category';
    return view('admin.addSubCategory',compact('page_title','page_name'));
}

public function add_SubCategory(Request $request){
    
    $SubCategory = new SubCategory;
    $SubCategory->name = $request->name;
    $SubCategory->cat_id = $request->cat_id;
    
    $SubCategory->save();
    Session::flash('message', "Category Has Been Added");
    return Redirect::back();
}

public function editSubCategories($id){
    $Category = SubCategory::find($id);
    $page_title = 'formfiletext';
    $page_name = 'Edit Home Page Slider';
    return view('admin.editSubCategory',compact('page_title','Category','page_name'));
}

public function edit_SubCategory(Request $request, $id){
    
    $updateDetails = array(
        'cat_id'=>$request->cat_id,
        'name' =>$request->name,
      
    );
    DB::table('sub_category')->where('id',$id)->update($updateDetails);
    Session::flash('message', "Changes have been saved");
    return Redirect::back();
}

public function deleteSubCategory($id){
    DB::table('sub_category')->where('id',$id)->delete();
    return Redirect::back();
}

public function addProduct(){
    $page_title = 'formfiletext';//For Layout Inheritance
    $page_name = 'Add New Product';
    return view('admin.addProduct',compact('page_title','page_name'));
}

public function add_Product(Request $request){

    $path = 'uploads/product';
    if(isset($request->fb_pixels)){
        $fileSize = $request->file('fb_pixels')->getSize();
            if($fileSize>=1800000){
            Session::flash('message', "File Exceeded the maximum allowed Size");
            Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
            return Redirect::back();
            }else{
            
                $file = $request->file('fb_pixels');
                /** Renaming Edits */
                $extension = $file->getClientOriginalExtension();
                $image_main_temp = $request->name.'-fb_pixels.'.$extension;
                $fb_pixels = str_replace(' ', '-',$image_main_temp);
                $file->move($path, $fb_pixels);
                /* Renaming Edits Ends*/ 
            }
    }else{
        $fb_pixels = $request->pro_img_cheat;
    }

    if(isset($request->thumbnail)){
        $fileSize = $request->file('thumbnail')->getSize();
            if($fileSize>=1800000){
            Session::flash('message', "File Exceeded the maximum allowed Size");
            Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
            return Redirect::back();
            }else{
            
                $file = $request->file('thumbnail');
                /** Renaming Edits */
                $extension = $file->getClientOriginalExtension();
                $image_main_temp = $request->name.'-thumbnail.'.$extension;
                $thumbnail = str_replace(' ', '-',$image_main_temp);
                $file->move($path, $thumbnail);
                /* Renaming Edits Ends*/ 
            }
    }else{
        $thumbnail = $request->pro_img_cheat;
    }
    


    if(isset($request->image_one)){
        $fileSize = $request->file('image_one')->getSize();
            if($fileSize>=1800000){
            Session::flash('message', "File Exceeded the maximum allowed Size");
            Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
            return Redirect::back();
            }else{
            
                $file = $request->file('image_one');
                /** Renaming Edits */
                $extension = $file->getClientOriginalExtension();
                $image_main_temp = $request->name.'-001.'.$extension;
                $image_one = str_replace(' ', '-',$image_main_temp);
                $file->move($path, $image_one);
                /* Renaming Edits Ends*/ 
            }
    }else{
        $image_one = $request->pro_img_cheat;
    }

    if(isset($request->image_two)){
        $fileSize = $request->file('image_two')->getSize();
         if($fileSize>=1800000){
            Session::flash('message', "File Exceeded the maximum allowed Size");
            Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
            
         }else{
            
             $file = $request->file('image_two');
             /** Renaming Edits */
             $extension = $file->getClientOriginalExtension();
             $image_main_temp = $request->name.'-002.'.$extension;
             $image_two = str_replace(' ', '-',$image_main_temp);
             $file->move($path, $image_two);
             /* Renaming Edits Ends*/ 
         }
    }else{
        $image_two = $request->pro_img_cheat;
    }

    
    if(isset($request->image_three)){
        $fileSize = $request->file('image_three')->getSize();
        if($fileSize>=1800000){
           Session::flash('message', "File Exceeded the maximum allowed Size");
           Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
           
        }else{
           
            $file = $request->file('image_three');
             /** Renaming Edits */
             $extension = $file->getClientOriginalExtension();
             $image_main_temp = $request->name.'-003.'.$extension;
             $image_three = str_replace(' ', '-',$image_main_temp);
             $file->move($path, $image_three);
             /* Renaming Edits Ends*/ 
        }
    }else{
        $image_three = $request->pro_img_cheat;
    }
    //Additional images
   
    $slung = Str::slug($request->name);
    $Product = new Product;
    $Product->name = $request->name;
    $Product->google_product_category = $request->google_product_category;
    $Product->slung = $slung;
    $Product->iframe = $request->iframe;
    $Product->meta = $request->meta;
    $Product->content = $request->content;
    $Product->price = $request->price;
    $Product->brand = $request->brand;
    $Product->price_raw = $request->price;
    $Product->code = $request->code;
    $Product->cat = $request->cat;
    $Product->sub_cat = $request->sub_cat;
    $Product->image_one = $image_one;
    $Product->fb_pixels = $fb_pixels;
    
    $Product->thumbnail = $thumbnail;
    
    $Product->image_two = $image_two;
    $Product->image_three = $image_three;
 
    $Product->save();
    
    Session::flash('message', "You have Added One New Product");
    return Redirect::back();
}

public function Products(){
    $Product = Product::all();
    $page_title = 'list';
    $page_name = 'All Products';
    return view('admin.products',compact('page_title','Product','page_name'));
}


public function productslte(){
    $Product = Product::all();
    $page_title = 'list';
    $page_name = 'All Products';
    return view('admin.products-lte',compact('page_title','Product','page_name'));
}



public function editProduct($id){
    $Product = Product::find($id);
    $page_title = 'formfiletext';
    $page_name = 'Edit Product';
    return view('admin.editProduct',compact('page_title','Product','page_name'));
}

public function editProductDetails($id){
    $Product = Product::find($id);
    $page_title = 'formfiletext';
    $page_name = 'Edit Product';
    return view('admin.editProductDetails',compact('page_title','Product','page_name'));
}


public function edit_Product_Details(Request $request, $id){
    $updateDetails = array(
        
        'content' => $request->content,
        
    );
    DB::table('product')->where('id',$id)->update($updateDetails);
    Session::flash('message', "Changes have been saved");
    return Redirect::back();
}

public function edit_Product_slung(){
    $variable = DB::table('category')->get();
    foreach ($variable as $key => $value) {
        $slung = Str::slug($value->cat);
        $updateDetails = array(
        
            'slung' => $slung,
            
        );
        DB::table('category')->where('id',$value->id)->update($updateDetails);
    }
    echo "done";
}



public function edit_Product(Request $request, $id){
    $path = 'uploads/product';

    if(isset($request->fb_pixels)){
        $fileSize = $request->file('fb_pixels')->getSize();
        $file = $request->file('fb_pixels');
        $filename = str_replace(' ', '-', $file->getClientOriginalName());
        /** Renaming Edits */
        $random = rand(100,1000);
        $extension = $file->getClientOriginalExtension();
        $ProductName = str_replace(' ','-',$request->name);
        $image_main_temp = $random.'-fb_pixels.'.$extension;
        $fb_pixels = str_replace('  ', '-',$image_main_temp);
        $file->move($path, $fb_pixels);
        /* Renaming Edits Ends*/ 
    }else{
        $fb_pixels = $request->fb_pixels_cheat;
    }

    if(isset($request->thumbnail)){
        $fileSize = $request->file('thumbnail')->getSize();
            if($fileSize>=1800000){
            Session::flash('message', "File Exceeded the maximum allowed Size");
            Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
            return Redirect::back();
            }else{
            
                $file = $request->file('thumbnail');
                /** Renaming Edits */
                $extension = $file->getClientOriginalExtension();
                $image_main_temp = $request->name.'-thumbnail.'.$extension;
                $thumbnail = str_replace(' ', '-',$image_main_temp);
                $file->move($path, $thumbnail);
                /* Renaming Edits Ends*/ 
            }
    }else{
        $thumbnail = $request->thumbnail_cheat;
    }
    

    if(isset($request->image_one)){
        $fileSize = $request->file('image_one')->getSize();
            if($fileSize>=1800000){
            Session::flash('message', "File Exceeded the maximum allowed Size");
            Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
            return Redirect::back();
            }else{
                $file = $request->file('image_one');
                /** Renaming Edits */
                $extension = $file->getClientOriginalExtension();
                $image_main_temp = $request->name.'-001.'.$extension;
                $image_one = str_replace(' ', '-',$image_main_temp);
                $file->move($path, $image_one);
                /* Renaming Edits Ends*/ 
                
                      
            }
    }else{
        $image_one = $request->image_one_cheat; 
    }

    if(isset($request->image_two)){
        $fileSize = $request->file('image_two')->getSize();
         if($fileSize>=1800000){
            Session::flash('message_image_two', "File Exceeded the maximum allowed Size");
            Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
            
         }else{
            
            $file = $request->file('image_two');
            /** Renaming Edits */
            $extension = $file->getClientOriginalExtension();
            $image_main_temp = $request->name.'-002.'.$extension;
            $image_twoRaw = str_replace(' ', '-',$image_main_temp);
            $image_two = str_replace('&', 'and',$image_twoRaw);
            $file->move($path, $image_two);
            /* Renaming Edits Ends*/ 
          
        
         }
    }else{
        $image_two = $request->image_two_cheat;
    }

    
    if(isset($request->image_three)){
        $fileSize = $request->file('image_three')->getSize();
        if($fileSize>=1800000){
           Session::flash('message_image_three', "File Exceeded the maximum allowed Size");
           Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
           
        }else{
           
            $file = $request->file('image_three');
            /** Renaming Edits */
            $extension = $file->getClientOriginalExtension();
            $image_main_temp = $request->name.'-003.'.$extension;
            $image_three = str_replace(' ', '-',$image_main_temp);
            $file->move($path, $image_three);
            /* Renaming Edits Ends*/ 
          
        }
    }else{
        $image_three = $request->image_three_cheat;
    }
    //Additional images
    
   if($request->stock == 'on'){
       $stock = 'In Stock';
   }else{
       $stock = 'Out of Stock';
   }
   $slung = Str::slug($request->name);


   $replaced = $request->replaced;
  



   
    $updateDetails = array(
        'name' => $request->name,
        'slung' => $slung,
        'replaced' => $request->replaced,
        'meta' => $request->meta,
        'google_product_category'=>$request->google_product_category,
        'iframe' => $request->iframe,
        'content' => $request->content,
        'image_one' =>$image_one,
        'thumbnail' =>$thumbnail,
        'stock' => $stock,
        'brand' =>$request->brand,
        'fb_pixels' =>$fb_pixels,
        'image_two' =>$image_two,
        'image_three' =>$image_three,
        'price' =>$request->price,
        'price_raw' =>$request->price_raw,
        'code' =>$request->code,
        'cat' =>$request->cat,
        'tag' =>$request->tag,
        'sub_cat' =>$request->sub_cat,
    );
    
    DB::table('product')->where('id',$id)->update($updateDetails);
    Session::flash('message', "Changes have been saved");
    return Redirect::back();
}

public function deleteProduct($id){
    DB::table('product')->where('id',$id)->delete();
    return Redirect::back();
}

public function addService(){
    $page_title = 'formfiletext';//For Layout Inheritance
    $page_name = 'Add New Service';
    return view('admin.addService',compact('page_title','page_name'));
}

public function add_Service(Request $request){

    $path = 'uploads/services';
    if(isset($request->image_one)){
        $fileSize = $request->file('image_one')->getSize();
            if($fileSize>=1800000){
            Session::flash('message', "File Exceeded the maximum allowed Size");
            Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
            return Redirect::back();
            }else{
            
            $file = $request->file('image_one');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d H:i:s');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_one = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_one);
            }
    }else{
        $image_one = $request->image_one_cheat;
    }

    if(isset($request->image_two)){
        $fileSize = $request->file('image_two')->getSize();
         if($fileSize>=1800000){
            Session::flash('message_image_two', "File Exceeded the maximum allowed Size");
            Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
            
         }else{
            
            $file = $request->file('image_two');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d H:i:s');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_two = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_two);
         }
    }else{
        $image_two = $request->image_two_cheat;
    }

    
    if(isset($request->image_three)){
        $fileSize = $request->file('image_three')->getSize();
        if($fileSize>=1800000){
           Session::flash('message_image_three', "File Exceeded the maximum allowed Size");
           Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
           
        }else{
           
            $file = $request->file('image_three');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d H:i:s');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_three = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_three);
        }
    }else{
        $image_three = $request->image_three_cheat;
    }

    $Services = new Services;
    $Services->title = $request->name;
    $Services->content = $request->content;
    $Services->image_one = $image_one;
    // $Services->image_two = $image_two;
    $Services->image_three = $image_three;
    
    $Services->save();
  
    Session::flash('message', "Service Has Been Added");
    return Redirect::back();
}

public function services(){
    $Services = Services::all();
    $page_title = 'list';
    $page_name = 'Services';
    return view('admin.services',compact('page_title','Services','page_name'));
}

public function editServices($id){
    $Services = Services::find($id);
    $page_title = 'formfiletext';
    $page_name = 'Edit Services';
    return view('admin.editServices',compact('page_title','Services','page_name'));
}


public function edit_Services(Request $request, $id){
    $path = 'uploads/services';
    if(isset($request->image_one)){
        $fileSize = $request->file('image_one')->getSize();
            if($fileSize>=1800000){
            Session::flash('message', "File Exceeded the maximum allowed Size");
            Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
            return Redirect::back();
            }else{
            
            $file = $request->file('image_one');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d H:i:s');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_one = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_one);
            }
    }else{
        $image_one = $request->image_one_cheat;
    }

    if(isset($request->image_two)){
        $fileSize = $request->file('image_two')->getSize();
         if($fileSize>=1800000){
            Session::flash('message_image_two', "File Exceeded the maximum allowed Size");
            Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
            
         }else{
            
            $file = $request->file('image_two');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d H:i:s');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_two = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_two);
         }
    }else{
        $image_two = $request->image_two_cheat;
    }

    
    if(isset($request->image_three)){
        $fileSize = $request->file('image_three')->getSize();
        if($fileSize>=1800000){
           Session::flash('message_image_three', "File Exceeded the maximum allowed Size");
           Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
           
        }else{
           
            $file = $request->file('image_three');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d H:i:s');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_three = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_three);
        }
    }else{
        $image_three = $request->image_three_cheat;
    }

   

    $updateDetails = array(
        'title' => $request->name,
        'content' => $request->content,
        'image_one' =>$image_one,
        
        'image_three' =>$image_three,
        
    );
    DB::table('services')->where('id',$id)->update($updateDetails);
    Session::flash('message', "Changes have been saved");
    return Redirect::back();
}

public function deleteService($id){
    DB::table('services')->where('id',$id)->delete();
   
    return Redirect::back();
}

public function addPortfolio(){
    $page_title = 'formfiletext';//For Layout Inheritance
    $page_name = 'add Portfolio';
    return view('admin.addPortfolio',compact('page_title','page_name'));
}

public function add_Portfolio(Request $request){

    $path = 'uploads/portfolio';
    if(isset($request->image_one)){
        $fileSize = $request->file('image_one')->getSize();
            if($fileSize>=1800000){
            Session::flash('message', "File Exceeded the maximum allowed Size");
            Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
            return Redirect::back();
            }else{
            
            $file = $request->file('image_one');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d H:i:s');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_one = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_one);
            }
    }else{
        $image_one = $request->pro_img_cheat;
    }

    if(isset($request->image_two)){
        $fileSize = $request->file('image_two')->getSize();
         if($fileSize>=1800000){
            Session::flash('message', "File Exceeded the maximum allowed Size");
            Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
            
         }else{
            
            $file = $request->file('image_two');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d H:i:s');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_two = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_two);
         }
    }else{
        $image_two = $request->pro_img_cheat;
    }

    
    if(isset($request->image_three)){
        $fileSize = $request->file('image_three')->getSize();
        if($fileSize>=1800000){
           Session::flash('message', "File Exceeded the maximum allowed Size");
           Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
           
        }else{
           
            $file = $request->file('image_three');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d H:i:s');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_three = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_three);
        }
    }else{
        $image_three = $request->pro_img_cheat;
    }
    //Additional images
    
    if(isset($request->image_four)){
        $fileSize = $request->file('image_four')->getSize();
        if($fileSize>=1800000){
           Session::flash('message', "File Exceeded the maximum allowed Size");
           Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
           
        }else{
        
            $file = $request->file('image_four');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d H:i:s');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_four = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_four);
        }
    }else{
        $image_four = $request->pro_img_cheat;
    }

    

    if(isset($request->image_five)){
        $fileSize = $request->file('image_five')->getSize();
        if($fileSize>=1800000){
           Session::flash('message', "File Exceeded the maximum allowed Size");
           Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
           
        }else{
            
            $file = $request->file('image_five');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d H:i:s');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_five = str_replace(' ', '',$image_main_temp); 
            $file->move($path, $image_five);
        }
    }else{
        $image_five = $request->pro_img_cheat;
    }

    $Portfolio = new Portfolio;
    $Portfolio->title = $request->name;
    $Portfolio->content = $request->article_ckeditor;
    $Portfolio->client = $request->client;
    $Portfolio->link = $request->link;
    $Portfolio->date = $request->date;
    $Portfolio->service = $request->service;
    $Portfolio->product = $request->product;
    $Portfolio->image_one = $image_one;
    $Portfolio->image_two = $image_two;
    $Portfolio->image_three = $image_three;
    $Portfolio->image_four = $image_four;
    $Portfolio->image_five = $image_five;
    
    $Portfolio->save();
  
    Session::flash('message', "Portfolio Has Been Added");
    return Redirect::back();
}

public function portfolio(){
    $Portfolio = Portfolio::all();
    $page_title = 'list';
    $page_name = 'Portfolio';
    return view('admin.portfolio',compact('page_title','Portfolio','page_name'));
}

public function editPortfolio($id){
    $Portfolio = Portfolio::find($id);
    $page_title = 'formfiletext';
    $page_name = 'Edit Portfolio';
    return view('admin.editPortfolio',compact('page_title','Portfolio','page_name'));
}


public function edit_Portfolio(Request $request, $id){
    $path = 'uploads/portfolio';
    if(isset($request->image_one)){
        $fileSize = $request->file('image_one')->getSize();
            if($fileSize>=1800000){
            Session::flash('message', "File Exceeded the maximum allowed Size");
            Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
            return Redirect::back();
            }else{
            
            $file = $request->file('image_one');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d H:i:s');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_one = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_one);
            }
    }else{
        $image_one = $request->image_one_cheat;
    }

    if(isset($request->image_two)){
        $fileSize = $request->file('image_two')->getSize();
         if($fileSize>=1800000){
            Session::flash('message_image_two', "File Exceeded the maximum allowed Size");
            Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
            
         }else{
            
            $file = $request->file('image_two');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d H:i:s');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_two = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_two);
         }
    }else{
        $image_two = $request->image_two_cheat;
    }

    
    if(isset($request->image_three)){
        $fileSize = $request->file('image_three')->getSize();
        if($fileSize>=1800000){
           Session::flash('message_image_three', "File Exceeded the maximum allowed Size");
           Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
           
        }else{
           
            $file = $request->file('image_three');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d H:i:s');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_three = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_three);
        }
    }else{
        $image_three = $request->image_three_cheat;
    }
    //Additional images
    
    if(isset($request->image_four)){
        $fileSize = $request->file('image_four')->getSize();
        if($fileSize>=1800000){
           Session::flash('message_image_four', "File Exceeded the maximum allowed Size");
           Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
           
        }else{
        
            $file = $request->file('image_four');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d H:i:s');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_four = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_four);
        }
    }else{
        $image_four = $request->image_four_cheat;
    }

    

    if(isset($request->image_five)){
        $fileSize = $request->file('image_five')->getSize();
        if($fileSize>=1800000){
           Session::flash('message_image_five', "File Exceeded the maximum allowed Size");
           Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
           
        }else{
            
            $file = $request->file('image_five');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d H:i:s');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_five = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_five);
        }
    }else{
        $image_five = $request->image_five_cheat;
    }

   

    $updateDetails = array(
        'title' => $request->name,
        'content' => $request->article_ckeditor,
        'service' => $request->service,
        'date' => $request->date,
        'client' => $request->client,
        'product' => $request->product,
        'link' => $request->link,
        'image_one' =>$image_one,
        'image_two' =>$image_two,
        'image_three' =>$image_three,
        'image_four' =>$image_four,
        'image_five' =>$image_five
        
    );
    DB::table('portfolio')->where('id',$id)->update($updateDetails);
    Session::flash('message', "Changes have been saved");
    return Redirect::back();
}

public function deletePortfolio($id){
    DB::table('portfolio')->where('id',$id)->delete();
   
    return Redirect::back();
}

public function pricing(){
    $Pricing = Pricing::all();
    $page_title = 'pricing';
    $page_name = 'Pricing';
    return view('admin.pricing',compact('page_title','Pricing','page_name'));
}

public function editPricing($id){
    $Pricing = Pricing::find($id);
    $page_title = 'formfiletext';
    $page_name = 'Pricing';
    return view('admin.editPricing',compact('page_title','Pricing','page_name'));
}

public function addPricing(){
    $page_title = 'formfiletext';//For Layout Inheritance
    $page_name = 'add Pricing';
    return view('admin.addPricing',compact('page_title','page_name'));
}

public function add_Pricing(Request $request){
    $Pricing = new Pricing;
    $Pricing->price = $request->price;
    $Pricing->frequency = $request->frequency;
    $Pricing->service = $request->service;
    $Pricing->content = $request->article_ckeditor;
    $Pricing->budget = $request->budget;
    $Pricing->save();

    Session::flash('message', "New Pricing has Been Added");
    return Redirect::back();
}

public function edit_Pricing(Request $request, $id){
    $updateDetails = array(
      
        'content' => $request->content,
        'service' => $request->service,
        'budget' => $request->budget,
        'price' => $request->price,
        'frequency' =>$request->frequency,
       
        
    );
    DB::table('pricing')->where('id',$id)->update($updateDetails);
    Session::flash('message', "Changes have been saved");
    return Redirect::back();
}

public function deletePricing($id){
    DB::table('pricing')->where('id',$id)->delete();
   
    return Redirect::back();
}

public function subscribers(){
    $Subscribers = Subscriber::all();
    $page_title = 'list';
    $page_name = 'Subscribers';
    return view('admin.subscribers',compact('page_title','Subscribers','page_name'));
}

public function mailSubscriber($email){
    //Collect info
    $Mail = DB::table('mails')->orderByDesc('id')->paginate(1);
    foreach($Mail as $mail){
        $attachment = $mail->file;
        $subject = $mail->subject;
        $content = $mail->content;
        $url = url('/uploads/attachment/'.$attachment.'');
        
        
        //mail subscriber
        ReplyMessage::mailSubscriber($email,$subject,$content,$url);
        Session::flash('message', "mail has been sent");
        return Redirect::back();

    }
        
}
public function mailSubscribers(){
  $Subscribers = DB::table('subscribers')->get();
  foreach($Subscribers as $Subscriber){
    $email = $Subscriber->email;
    $Mail = DB::table('mails')->orderByDesc('id')->paginate(1);
    foreach($Mail as $mail){
        $attachment = $mail->file;
        $subject = $mail->subject;
        $content = $mail->content;
        $url = url('/uploads/attachment/'.$attachment.'');
        
        
        //mail subscriber
        ReplyMessage::mailSubscriber($email,$subject,$content,$url);
        Session::flash('message', "Mail has been sent");
        return Redirect::back();
        

    }
  }
  return Redirect::back();
    

}
public function deleteSubscriber($id){
    DB::table('subscribers')->where('id',$id)->delete();
   
    return Redirect::back();
}

public function updates(){
    $Update = Update::all();
    $page_title = 'list';
    $page_name = 'Updates';
    return view('admin.updates',compact('page_title','Update','page_name'));
}

public function update($id){
    $Update = Update::find($id);
    $page_title = 'formfiletext';
    $page_name = 'Updates';
    return view('admin.update',compact('page_title','Update','page_name'));
}
public function mark($id){
    $updateDetails = array(
        'status'=>1
    );
    DB::table('updates')->where('id',$id)->update($updateDetails);
    return back();
}

public function payments(){
    $Payment = Payment::all();
    $page_title = 'list';
    $page_name = 'Payments';
    return view('admin.payments',compact('page_title','Payment','page_name'));
}

public function payments_explore($id){
    $Payments = DB::table('mobile_payments')->where('transLoID',$id)->get();
    $page_name = 'Payments';
    $page_title = 'Admin Home';
    return view('admin.payments_explore',compact('page_title','Payments','page_name'));
}
public function order_explore($id){
    $Order = DB::table('orders')->where('id',$id)->get(); 
    $page_name = 'Orders';
    $page_title = 'Admin Home';
    return view('admin.order',compact('page_title','Order','page_name'));
}


public function notifications(){
    $Notifications = Notifications::all();
    $page_title = 'list';
    $page_name = 'Notifications';
    return view('admin.notifications',compact('page_title','Notifications','page_name'));
}

public function notification($id){
    $Notifications = Notifications::all();
    $page_title = 'list';
    $page_name = 'Notification';
    return view('admin.notification',compact('page_title','Notifications','page_name'));
}
public function deleteNotification($id){
    DB::table('notifications')->where('id',$id)->delete();
   
    return Redirect::back();
}


// Testimonials
public function addTestimonial(){
    $page_title = 'formfiletext';//For Layout Inheritance
    $page_name = 'addTestimonial';
    return view('admin.addTestimonial',compact('page_title','page_name'));
}

public function add_Testimonial(Request $request){

    $path = 'uploads/testimonials';
    if(isset($request->image_one)){
        $fileSize = $request->file('image_one')->getSize();
            if($fileSize>=1800000){
            Session::flash('message', "File Exceeded the maximum allowed Size");
            Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
            return Redirect::back();
            }else{
            
            $file = $request->file('image_one');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d H:i:s');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_one = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_one);
            }
    }else{
        $image_one = $request->pro_img_cheat;
    }

    

   

    $Testimonial = new Testimonial;
    $Testimonial->name = $request->name;
    $Testimonial->content = $request->content;
    $Testimonial->company = $request->company;
    $Testimonial->service = $request->service;
    $Testimonial->position = $request->position;
    $Testimonial->rating = $request->rating;
    
    $Testimonial->image = $image_one;
     
    $Testimonial->save();
  
    Session::flash('message', "Testimonial Has Been Added");
    return Redirect::back();
}

public function testimonials(){
    $Testimonial = Testimonial::all();
    $page_title = 'list';
    $page_name = 'Testimonial';
    return view('admin.testimonial',compact('page_title','Testimonial','page_name'));
}

public function editTestimonial($id){
    $Testimonial = Testimonial::find($id);
    $page_title = 'formfiletext';
    $page_name = 'Edit Testimonial';
    return view('admin.editTestimonial',compact('page_title','Testimonial','page_name'));
}


public function edit_Testimonial(Request $request, $id){
    $path = 'uploads/testimonials';
    if(isset($request->image_one)){
        $fileSize = $request->file('image_one')->getSize();
            if($fileSize>=1800000){
            Session::flash('message', "File Exceeded the maximum allowed Size");
            Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
            return Redirect::back();
            }else{
            
            $file = $request->file('image_one');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d H:i:s');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_one = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_one);
            }
    }else{
        $image_one = $request->image_one_cheat;
    }


   

    $updateDetails = array(
        'name' => $request->name,
        'content' => $request->content,
        'service' => $request->service,
        'company' => $request->company,
        'position' => $request->position,
       
        'image' =>$image_one,
        
        
    );
    DB::table('testimonial')->where('id',$id)->update($updateDetails);
    Session::flash('message', "Changes have been saved");
    return Redirect::back();
}

public function deleteTestimonial($id){
    DB::table('testimonial')->where('id',$id)->delete();
   
    return Redirect::back();
}

// Service rendered
public function addService_rendered(){
    $page_title = 'formfiletext';//For Layout Inheritance
    $page_name = 'addService_rendered';
    return view('admin.addService_rendered',compact('page_title','page_name'));
}

public function add_Service_rendered(Request $request){
    $Service_Rendered = new Service_Rendered;
    $Service_Rendered->name = $request->name;
    $Service_Rendered->cat = $request->cat;
    $Service_Rendered->save();
  
    Session::flash('message', "Service Rendered Has Been Added");
    return Redirect::back(); 
}

public function service_rendered(){
    $Service_Rendered = Service_Rendered::all();
    $page_title = 'list';
    $page_name = 'Service_Rendered';
    return view('admin.service_rendered',compact('page_title','Service_Rendered','page_name'));
}

public function editService_rendered($id){
    $Service_Rendered = Service_Rendered::find($id);
    $page_title = 'formfiletext';
    $page_name = 'Service_Rendered';
    return view('admin.editService_rendered',compact('page_title','Service_Rendered','page_name'));
}


public function edit_Service_rendered(Request $request, $id){
    

    $updateDetails = array(
        'name' => $request->name,
        'cat' => $request->cat,
           
    );
    DB::table('service_delivered')->where('id',$id)->update($updateDetails);
    Session::flash('message', "Changes have been saved");
    return Redirect::back();
}

public function deleteService_rendered($id){
    DB::table('service_delivered')->where('id',$id)->delete();
   
    return Redirect::back();
}
//Dailies
public function addDaily(){
    $page_title = 'formfiletext';//For Layout Inheritance
    $page_name = 'addDaily';
    return view('admin.addDaily',compact('page_title','page_name'));
}

public function add_Daily(Request $request){
    $Daily = new Daily;
    $Daily->author = $request->author;
    $Daily->content = $request->content;
    $Daily->save();
  
    Session::flash('message', "Daily Quote Has Been Added");
    return Redirect::back();
}

public function Daily(){
    $Daily = Daily::all();
    $page_title = 'list';
    $page_name = 'Daily';
    return view('admin.daily',compact('page_title','Daily','page_name'));
}

public function editDaily($id){
    $Daily = Daily::find($id);
    $page_title = 'formfiletext';
    $page_name = 'Daily';
    return view('admin.editDaily',compact('page_title','Daily','page_name'));
}


public function edit_Daily(Request $request, $id){
    

    $updateDetails = array(
        'author' => $request->author,
        'content' => $request->content,
           
    );
    DB::table('daily')->where('id',$id)->update($updateDetails);
    Session::flash('message', "Changes have been saved");
    return Redirect::back();
}

public function deleteDaily($id){
    DB::table('daily')->where('id',$id)->delete();
   
    return Redirect::back();
}
// Blog Controls

public function addBlog(){
    $Category = DB::table('category')->get();
    $page_title = 'formfiletext';//For Layout Inheritance
    $page_name = 'add Blog';
    return view('admin.addBlog',compact('page_title','page_name','Category'));
}

public function add_Blog(Request $request){
    $title = $request->title;
    $description = $request->content;
   
  
    $author = Auth::user()->name;
    $category = $request->cat;
    $path = 'uploads/blog';
    if(isset($request->image_one)){ 
        $fileSize = $request->file('image_one')->getSize();
            if($fileSize>=1800000){
            Session::flash('message', "File Exceeded the maximum allowed Size");
            Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
            return Redirect::back();
            }else{
            
            $file = $request->file('image_one');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d H:i:s');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_one = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_one);
            }
    }else{
        $image_one = $request->pro_img_cheat;
    }

    if(isset($request->image_two)){
        $fileSize = $request->file('image_two')->getSize();
         if($fileSize>=1800000){
            Session::flash('message', "File Exceeded the maximum allowed Size");
            Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
            
         }else{
            
            $file = $request->file('image_two');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d H:i:s');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_two = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_two);
         }
    }else{
        $image_two = $request->pro_img_cheat;
    }

    
    if(isset($request->image_three)){
        $fileSize = $request->file('image_three')->getSize();
        if($fileSize>=1800000){
           Session::flash('message', "File Exceeded the maximum allowed Size");
           Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
           
        }else{
           
            $file = $request->file('image_three');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d H:i:s');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_three = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_three);
        }
    }else{
        $image_three = $request->pro_img_cheat;
    }
    //Additional images
    
    if(isset($request->image_four)){
        $fileSize = $request->file('image_four')->getSize();
        if($fileSize>=1800000){
           Session::flash('message', "File Exceeded the maximum allowed Size");
           Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
           
        }else{
        
            $file = $request->file('image_four');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d H:i:s');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_four = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_four);
        }
    }else{
        $image_four = $request->pro_img_cheat;
    }

    

    

    $blog = new Blog; 
    $blog->title = $title;
    $blog->link = $request->link;
    $blog->content = $description;
    $blog->author = $author;
    $blog->category = $category;
    $blog->image_one = $image_one;
    $blog->image_two = $image_two;
    $blog->save();
    Session::flash('message', "Changes Saved Successfully");
    return Redirect::back();

    
 
    
    $Blog->save();
  
    Session::flash('message', "Blog Has Been Added");
    return Redirect::back();
}

public function blog(){
    $Blog = Blog::all();
    $page_title = 'list';
    $page_name = 'Blog';
    return view('admin.blog',compact('page_title','Blog','page_name'));
}

public function editBlog($id){
    $Blog = Blog::find($id);
    $page_title = 'formfiletext';
    $page_name = 'Edit Blog';
    return view('admin.editBlog',compact('page_title','Blog','page_name'));
}


public function edit_Blog(Request $request, $id){
    $path = 'uploads/blog';
    if(isset($request->image_one)){
        $fileSize = $request->file('image_one')->getSize();
            if($fileSize>=1800000){
            Session::flash('message', "File Exceeded the maximum allowed Size");
            Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
            return Redirect::back();
            }else{
            
            $file = $request->file('image_one');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d H:i:s');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_one = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_one);
            }
    }else{
        $image_one = $request->image_one_cheat;
    }

    if(isset($request->image_two)){
        $fileSize = $request->file('image_two')->getSize();
         if($fileSize>=1800000){
            Session::flash('message_image_two', "File Exceeded the maximum allowed Size");
            Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
            
         }else{
            
            $file = $request->file('image_two');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d H:i:s');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_two = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_two);
         }
    }else{
        $image_two = $request->image_two_cheat;
    }

    
    if(isset($request->image_three)){
        $fileSize = $request->file('image_three')->getSize();
        if($fileSize>=1800000){
           Session::flash('message_image_three', "File Exceeded the maximum allowed Size");
           Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
           
        }else{
           
            $file = $request->file('image_three');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d H:i:s');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_three = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_three);
        }
    }else{
        $image_three = $request->image_three_cheat;
    }
    //Additional images
    
    if(isset($request->image_four)){
        $fileSize = $request->file('image_four')->getSize();
        if($fileSize>=1800000){
           Session::flash('message_image_four', "File Exceeded the maximum allowed Size");
           Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
           
        }else{
        
            $file = $request->file('image_four');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d H:i:s');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_four = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_four);
        }
    }else{
        $image_four = $request->image_four_cheat;
    }

    

   

   

    $updateDetails = array(
        'title' => $request->title,
        'content' => $request->content,
        'author' => $request->author,
        'category' => $request->cat,
        'link' => $request->link,
        'image_one' =>$image_one,
        'image_two' =>$image_two,
        'image_three' =>$image_three,
        'image_four' =>$image_four,
      
        
    );
    DB::table('blogs')->where('id',$id)->update($updateDetails);
    Session::flash('message', "Changes have been saved");
    return Redirect::back();
}

public function delete_Blog($id){
    DB::table('blogs')->where('id',$id)->delete();
   
    return Redirect::back();
}




//Payable Services
public function traceServices(){
    $TraceServices = TraceServices::all();
    $page_title = 'list';
    $page_name = 'traceServices';
    return view('admin.traceServices',compact('page_title','TraceServices','page_name'));
}

public function editTraceServices($id){
    $TraceServices = TraceServices::find($id);
    $page_title = 'formfiletext';
    $page_name = 'TraceServices';
    return view('admin.editTraceServices',compact('page_title','TraceServices','page_name'));
}

public function addTraceServices(){
    $page_title = 'formfiletext';//For Layout Inheritance
    $page_name = 'addTraceServices';
    return view('admin.addTraceServices',compact('page_title','page_name'));
}

public function add_TraceServices(Request $request){
    $TraceServices = new TraceServices;
    $TraceServices->price = $request->price;
    $TraceServices->frequency = $request->frequency;
    $TraceServices->title = $request->title;
    $TraceServices->due = $request->due;
    $TraceServices->invoice = $request->invoice;
    $TraceServices->user_id = $request->user_id;
    $TraceServices->save();

    Session::flash('message', "New Traceble Service has Been Added");
    return Redirect::back();
}

public function edit_TraceServices(Request $request, $id){
    $updateDetails = array(
      
        
        'user_id' => $request->user_id,
        'invoice' => $request->invoice,
        'title' => $request->title,
        'due' =>$request->due,
        'price' => $request->price,
        'frequency' =>$request->frequency,
       
        
    );
    DB::table('traceservices')->where('id',$id)->update($updateDetails);
    Session::flash('message', "Changes have been saved");
    return Redirect::back();
}

public function deleteTraceServices($id){
    DB::table('traceservices')->where('id',$id)->delete();
   
    return Redirect::back();
}

public function quoterequeste(){
    $Quote = Quote::all();
    $ServiceRequest = ServiceRequest::all();
    $page_title = 'list';
    $page_name = 'Services and Quotes Request';
    return view('admin.requests',compact('page_title','ServiceRequest','Quote','page_name'));
}

public function markRequest($id,$status,$type){
    if($status == '1'){
        $newStatus = '0';
    }else{
        $newStatus = '1';
    }
    $updateDetails = array(
        'status'=>$newStatus,
    );
    if($type == 'quote'){
        DB::table('quoterequests')->where('id',$id)->update($updateDetails);
    }else{
        
        DB::table('servicerequests')->where('id',$id)->update($updateDetails);
    }
    return Redirect::back();
}

//Doctors
public function addDoctors(){
    $page_name = 'Add Site Admin';
    $page_title = 'formfiletext';//For Style Inheritance
    return view('admin.addDoctors',compact('page_title','page_name'));
}
public function doctors(){
    $page_title = 'list';
    $page_name = 'Our Doctors';
    $Doctor = Doctor::all();
    return view('admin.doctors',compact('page_title','Doctor','page_name'));
}

public function editDoctors($id){
    
    $Doctor = Doctor::find($id);
    $page_title = 'formfiletext';//For Style Inheritance
    $page_name = 'Edit Doctor';
   
    return view('admin.editDoctors',compact('page_title','Doctor','page_name'));
}

public function edit_Doctors(Request $request, $id){
    $path = 'uploads/doctors';
    
        if(isset($request->image)){
            $fileSize = $request->file('image')->getSize();
            if($fileSize>=1800000){
               Session::flash('message', "File Exceeded the maximum allowed Size");
               Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
               
            }else{
               
                $file = $request->file('image');
                $filename = str_replace(' ', '', $file->getClientOriginalName());
                $timestamp = new Datetime();
                $new_timestamp = $timestamp->format('Y-m-d H:i:s');
                $image_main_temp = $new_timestamp.'image'.$filename;
                $image = str_replace(' ', '',$image_main_temp);
                $file->move($path, $image);
            }
        }else{
            $image = $request->image_cheat;
        }
        $updateDetails = array(
                'name'=>$request->name,
              
                'facebook'=>$request->facebook,
                'twitter'=>$request->twitter,
                'linkedin'=>$request->linkedin,
                'instagram'=>$request->instagram,
                'youtube'=>$request->youtube,
                'google'=>$request->google,
                'content'=>$request->content,
                'position'=>$request->position,
                'image'=>$image
        );
        DB::table('doctors')->where('id',$id)->update($updateDetails);
        Session::flash('message', "Your Changes Have Been Saved");
        return Redirect::back();
 
}
public function add_Doctors(Request $request){
    $path = 'uploads/doctors';
    
    $file = $request->file('image');
    $filename = $file->getClientOriginalName();
    $file->move($path, $filename);
    $image = $filename;
    
     $Doctor = new Doctor;
     $Doctor->name = $request->name;
     $Doctor->facebook = $request->facebook;
    $Doctor->twitter = $request->twitter;
    $Doctor->linkedin = $request->linkedin;
    $Doctor->instagram = $request->instagram;
    $Doctor->youtube = $request->youtube;
    $Doctor->google = $request->google;
    $Doctor->content = $request->content;
    $Doctor->position = $request->position;
     $Doctor->image = $image;
     $Doctor->save();
     Session::flash('message', "$request->name has been added as new Doctor");
     return Redirect::back();


}


public function deleteDoctors($id){
    DB::table('doctors')->where('id',$id)->delete();
    return Redirect::back();
}

public function how(){
    $How = How::all();
    $page_title = 'list';
    $page_name = 'How it Works';
    return view('admin.how',compact('page_title','How','page_name'));
}


public function addHow(){
   
    $page_title = 'formfiletext';
    $page_name = 'Add How';
    return view('admin.addHow',compact('page_title','page_name'));
}

public function add_How(Request $request){
    $How =  new How;
    $How->label = $request->label;
    $How->title = $request->title;
    $How->content = $request->content;
    $How->save();
    Session::flash('message', "Added!!");
    return Redirect::back();
}

public function editHow($id){
    $How = How::find($id);
    $page_title = 'formfiletext';
    $page_name = 'Edit How';
    return view('admin.editHow',compact('page_title','How','page_name'));
}


public function edit_How(Request $request, $id){
    

    $updateDetails = array(
        'title' => $request->title,
        'content' => $request->content,
        'label' => $request->label,
       
    );
    DB::table('hows')->where('id',$id)->update($updateDetails);
    Session::flash('message', "Changes have been saved");
    return Redirect::back();
}

public function deleteHow($id){
    DB::table('hows')->where('id',$id)->delete();
   
    return Redirect::back();
}

public function videos(){
    $Video = Video::all();
    $page_title = 'Video';
    $page_name = 'Video';
    return view('admin.video',compact('page_title','Video','page_name'));
}

public function editVideo($id){
    $Video = Video::find($id);
    $page_title = 'formfiletext';
    $page_name = 'Edit Video';
    return view('admin.editVideo',compact('page_title','Video','page_name'));
}
public function deleteVideo($id){
    DB::table('videos')->where('id',$id)->delete();
   
    return Redirect::back();
}
public function edit_Video(Request $request, $id){
    $updateDetails = array(
        'title' => $request->title,
        'link' => $request->link,
        
       
    );
    DB::table('videos')->where('id',$id)->update($updateDetails);
    Session::flash('message', "Changes have been saved");
    return Redirect::back();
}

public function add_Video(Request $request, $id){
    $Video = new Video;
    $Video->link = $request->link;
    $Video->title = $request->title;
    $Video->save();
    Session::flash('message', "Changes have been saved");
    return Redirect::back();
}

public function addVideo(){
   
    $page_title = 'formfiletext';
    $page_name = 'Add Video';
    return view('admin.addVideo',compact('page_title','Video','page_name'));
}

public function addOrder(){
    $page_title = 'formfiletext';
    $page_name = 'Add Order';
    return view('admin.addOrder',compact('page_title','page_name'));
}

public function orders(){
    $Order = DB::table('orders')->orderBy('id','DESC')->get();
    $page_title = 'formfiletext';
    $page_name = 'List';
    return view('admin.orders',compact('page_title','page_name','Order'));
}

public function deleteOrders($id){
    DB::table('orders')->where('id',$id)->delete();
    return Redirect::back();
}
public function editOrders($id){
   $Order = Order::find($id);
   $page_title = 'formfiletext';
   $page_name = 'Orders';
   return view('admin.editOrders',compact('page_title','page_name','Order'));
}
public function swapOrder($id){
    $Order = Order::find($id);
    if($Order->status == 'pending'){
        $newStatus = 'Completed';
    }else{
        $newStatus = 'pending';
    }
    $updateDetails = array(
        'status'=>$newStatus
    );
    DB::table('orders')->where('id',$id)->update($updateDetails);
    return Redirect::back();
   
 }

public function edit_Orders(Request $request, $id){
    $updateDetails = array(
        'total' => $request->total,
        'user_id' => $request->user_id,
        'content' => $request->content,
        'status' => $request->status,
        'title' => $request->title,
        
       
    );
    DB::table('orders')->where('id',$id)->update($updateDetails);
    Session::flash('message', "Changes have been saved");
    return Redirect::back();
}

public function add_Order(Request $request){
    $Order = new Order;
    $Order->total = $request->total;
    $Order->user_id = $request->user_id;
    $Order->content = $request->content;
    $Order->status = $request->status;
    $Order->title = $request->title;
    $Order->save();
    Session::flash('message', "Order Has been Added");
    return Redirect::back();
}

public function profile_save(Request $request){
    $path = 'uploads/files';
    if(isset($request->file)){
        $fileSize = $request->file('file')->getSize();
        if($fileSize>=1800000){
           Session::flash('message', "File Exceeded the maximum allowed Size");
           Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
           
        }else{
           
            $file = $request->file('file');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d H:i:s');
            $image_main_temp = $new_timestamp.'file'.$filename;
            $file = str_replace(' ', '',$image_main_temp);
            $file->move($path, $file);
        }
    }else{
        $file = $request->file_cheat;
    }
    $updateDetails = array(
        'title'=>$request->title,
        'file'=>$file
    );
    DB::table('files')->update($updateDetails);
    Session::flash('message', "Changes Has Been Changed");
    return Redirect::back();
}
public function profile(Request $request){
    $File = File::all();
    $page_title = 'formfiletext';
    $page_name = 'Company Profile';
    return view('admin.profile',compact('page_title','page_name','File'));
}

public function editFile($id){ 
    $File = File::find($id);
    $page_title = 'formfiletext';
      $page_name = 'Edit File';
      return view('admin.editFile',compact('page_title','page_name','File'));
  }
  public function edit_File(Request $request,$id){
      if($request->file){
          $path = 'uploads/files';
          $file = $request->file('file');
          $filename = $file->getClientOriginalName();
          $file->move($path, $filename);
          $file = $filename;
      }else{
          $file = $request->file_cheat;
      }
  
      $updateDetails = array(
          'file'=>$file
      );
      Db::table('files')->where('id',$id)->update($updateDetails);
      Session::flash('message', "File Has Been Added");
      return Redirect::back();
  } 

  public function addBrand(){
    $page_title = 'formfiletext';//For Layout Inheritance
    $page_name = 'addClient';
    return view('admin.addBrand',compact('page_title','page_name'));
}

public function add_Brand(Request $request){

    $path = 'uploads/brands';
    if(isset($request->image_one)){
        $fileSize = $request->file('image_one')->getSize();
            if($fileSize>=1800000){
            Session::flash('message', "File Exceeded the maximum allowed Size");
            Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
            return Redirect::back();
            }else{
            
            $file = $request->file('image_one');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d H:i:s');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_one = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_one);
            }
    }else{
        $image_one = $request->pro_img_cheat;
    }

    

   

    $Brand = new Brand;
    $Brand->name = $request->name;
    $Brand->image = $image_one;
    $Brand->save();
  
    Session::flash('message', "Brand Has Been Added");
    return Redirect::back();
}

public function brands(){
    $Client = Brand::all();
    $page_title = 'list';
    $page_name = 'Brand';
    return view('admin.brands',compact('page_title','Client','page_name'));
}

public function editBrand($id){
    $Client = Brand::find($id);
    $page_title = 'formfiletext';
    $page_name = 'Edit Brand';
    return view('admin.editBrand',compact('page_title','Client','page_name'));
}


public function edit_Brand(Request $request, $id){
    $path = 'uploads/brands';
    if(isset($request->image_one)){
        $fileSize = $request->file('image_one')->getSize();
            if($fileSize>=1800000){
            Session::flash('message', "File Exceeded the maximum allowed Size");
            Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
            return Redirect::back();
            }else{
            
            $file = $request->file('image_one');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d H:i:s');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_one = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_one);
            }
    }else{
        $image_one = $request->image_one_cheat;
    }


   

    $updateDetails = array(
        'name' => $request->name,
      
        'image' =>$image_one,
        
        
    );
    DB::table('brands')->where('id',$id)->update($updateDetails);
    Session::flash('message', "Changes have been saved");
    return Redirect::back();
}

public function deleteBrand($id){
    $Brand = Brand::find($id);
    DB::table('product')->where('brand',$Brand->name)->delete();
    
    DB::table('brands')->where('id',$id)->delete();



    DB::table('product')->where('brand',$Brand->name)->delete();
    return Redirect::back();
}
public function stats(){
   $Stats = Stat::all();
   
   $page_title = 'list';
   $page_name = 'Work Statisicts';
   return view('admin.stats',compact('page_title','Stats','page_name'));

}
public function editStats($id){
    $Stats = Stat::find($id);
    $page_title = 'formfiletext';
    $page_name = 'Edit Statistics';
    return view('admin.editStats',compact('page_title','Stats','page_name'));
}
public function edit_Stats(Request $request,$id){
    $name = $request->title;
    $value = $request->value;

    $updateDetails = array(
        'title'=>$name,
        'value'=>$value
    );
    DB::table('stats')->where('id',$id)->update($updateDetails);
    Session::flash('message', "Stats have been saved");
    return Redirect::back();
}
// Values

public function addValues(){
    $page_name = 'Add Core values';
    $page_title = 'formfiletext';//For Style Inheritance
    return view('admin.addValues',compact('page_title','page_name'));
}
public function add_values(Request $request){
    $Value = new Value;
    $Value->title = $request->title;
    $Value->content = $request->content;
    $Value->save();
    Session::flash('message', "Content Has been Added");
    return Redirect::back();
}

public function values(){
    $CoreValues = Value::All();
    $page_name = 'Core Value';
    $page_title = 'list';
    return view('admin.values',compact('page_title','CoreValues','page_name'));
}
public function editValues($id){
    $Value = Value::find($id);
    $page_name = $Value->title;
    $page_title = 'formfiletext';//For Style Inheritance
    
    return view('admin.editValues')->with('Value',$Value)->with('page_name',$page_name)->with('page_title',$page_title);
}

public function edit_values(Request $request, $id){
   $updateDetails = array(
       'title'=>$request->title,
       'content' =>$request->content
   );
   DB::table('values')->where('id',$id)->update($updateDetails);
   Session::flash('message', "Changes have been saved");
    return Redirect::back();
}

public function delete_values($id){
    DB::table('values')->where('id',$id)->delete();
    return Redirect::back();
}

// Who We are


public function who(){
    $Action = Action::All();
    $page_name = 'Who We are';
    $page_title = 'list';
    return view('admin.who',compact('page_title','Action','page_name'));
}
public function editWho($id){
    $Action = Action::find($id);
    $page_name = $Action->title;
    $page_title = 'formfiletext';//For Style Inheritance
    
    return view('admin.editWho')->with('Action',$Action)->with('page_name',$page_name)->with('page_title',$page_title);
}

public function edit_who(Request $request, $id){
   $updateDetails = array(
       'title'=>$request->title,
       'content' =>$request->content
   );
   DB::table('actions')->where('id',$id)->update($updateDetails);
   Session::flash('message', "Changes have been saved");
    return Redirect::back();
}

public function delete_who($id){
    DB::table('actions')->where('id',$id)->delete();
    return Redirect::back();
}

public function updatemail(Request $request){
    $path = 'uploads/attachment';
    if(isset($request->file)){
        $fileSize = $request->file('file')->getSize();
            if($fileSize>=1800000){
            Session::flash('message', "File Exceeded the maximum allowed Size");
            Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
            return Redirect::back();
            }else{
            
            $file = $request->file('file');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d H:i:s');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_one = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_one);
            }
    }else{
        $image_one = $request->file_cheat;
    }

    $Mailler = new Mailer;
    $Mailler->subject = $request->subject;
    $Mailler->content = $request->content;
    $Mailler->file = $image_one;
    $Mailler->save();
    Session::flash('message', "Changes have been saved");
    return Redirect::back();
}

public function version(){
  
    return view('version',compact('page_title','page_name'));
}
public function reviews(){
    $Review = Review::all();
    $page_title = 'list';
    $page_name = 'Reviews';
    return view('admin.reviews',compact('page_title','Review','page_name'));

}

public function approve($id){
    $updateDetails = array(
        'status'=>1
    );
    DB::table('reviews')->where('id',$id)->update($updateDetails);
    Session::flash('message-comment', "Review Has Been Approved");
    return Redirect::back();
}

public function decline($id){
    DB::table('reviews')->where('id',$id)->delete();
   
    Session::flash('message-comment', "Review Has Been Deleted");
    return Redirect::back();
}
// Offers
public function Products_offer(){
    $Product = Product::all();
    $page_title = 'list';
    $page_name = 'All Products On Offer';
    return view('admin.offer',compact('page_title','Product','page_name'));
}

public function swap_offer(Request $request, $id)
{
         $path = 'uploads/product';
        if(isset($request->file)){
            $fileSize = $request->file('file')->getSize();
                if($fileSize>=1800000){
                Session::flash('message', "File Exceeded the maximum allowed Size");
                Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
                return Redirect::back();
                }else{
                
                $file = $request->file('file');
                $filename = str_replace(' ', '', $file->getClientOriginalName());
                $timestamp = new Datetime();
                $new_timestamp = $timestamp->format('Y-m-d H:i:s');
                $image_main_temp = $new_timestamp.'image'.$filename;
                $image_one = str_replace(' ', '',$image_main_temp);
                $file->move($path, $image_one);
                }
        }else{
            $image_one = $request->file_cheat;
        }
        // $offer_pecentage = str_replace('%', '', $request->percentage); 
   
        //Get New Price
        // $Price = Product::find($id);
        // $productPrice = $Price->price;
        
        // $offcut = ($offer_pecentage*$productPrice)/100;
        
        // $newPrice = round($productPrice - $offcut);

        // Round Off The New Price
        $newPrice = $request->newPrice;
        $productPrice = $request->price;
        $updateDetails = array('offer'=>1,'price_raw'=>$newPrice,'price'=>$productPrice,'offer_banner'=>$image_one);
         
         DB::table('product')->where('id',$id)->update($updateDetails);
         Session::flash('message', "Offers Updated Successfully");
         return Redirect::back();
  
   
} 

public function swap_offers(Request $request, $id)
{
        // $offer_pecentage = str_replace('%', '', $request->percentage); 
   
        //Get New Price
        // $Price = Product::find($id);
        // $productPrice = $Price->price;
        
        // $offcut = ($offer_pecentage*$productPrice)/100;
        
        // $newPrice = round($productPrice - $offcut);

        // Round Off The New Price
        $newPrice = $request->newPrice;
        $productPrice = $request->price;
        $updateDetails = array('offer'=>1,'price'=>$newPrice,'price_raw'=>$productPrice);
         
         DB::table('product')->where('id',$id)->update($updateDetails);
         Session::flash('message', "Offers Updated Successfully");
         return Redirect::back();
  
   
} 

public function swapoffer($id){
    $Product = Product::find($id);
    $page_title = 'formfiletext';
    $page_name = 'Give Offers';
    return view('admin.offerpage',compact('page_title','Product','page_name'));
}

public function special_offer($id){
    $Product = Product::find($id);
    $page_title = 'formfiletext';
    $page_name = 'Give Offers';
    return view('admin.offerspecial',compact('page_title','Product','page_name'));
}

public function special_offer_post(Request $request){
    $Offers = DB::table('special_offers')->get();
    $count = count($Offers);
    if($count == 0){
       $product_id = $request->product_id;
       $pecentage = $request->percent;
       $content = $request->content;
       $Special = new Special;
       $Special->product_id = $product_id;
       $Special->percent = $pecentage;
       $Special->content = $content;
       $Special->save();
       //Redirect to page
       $Product = Special::all();
       $page_title = 'formfiletext';
       $page_name = 'Special Offers';
       return view('admin.special_offer_edit',compact('page_title','Product','page_name'));

    }else{
        Session::flash('message', "You have an active offer");
        return Redirect::back();
    }
}

public function special_offer_edit(){
    $Product = Special::all();
    $page_title = 'formfiletext';
    $page_name = 'Special Offers';
    return view('admin.special_offer_edit',compact('page_title','Product','page_name'));
}



public function deleteOffer($id)
{
    $Product = Product::find($id);
    $Raw_price = $Product->price_raw;
    $updateDetails = array(
        'offer'=>0,
        'price'=>$Raw_price,
    );
    DB::table('product')->where('id',$id)->update($updateDetails);
    
    return Redirect::back();
}


public function deleteOfferRestore()
{
    $Product = Product::all();
    foreach($Product as $Pro){
        if($Pro->price_raw == null){

        }else{
            $Raw_price = $Pro->price_raw;
            $updateDetails = array(
                'offer'=>0,
                'price'=>$Raw_price,
            );
            $id = $Pro->id;
            DB::table('product')->where('id',$id)->update($updateDetails);
        }
    }    
    
}

public function swapTrending($id){
    $Product = Product::find($id);
    if($Product->trending == 1){
        $newStatus = 0;
    }else{
        $newStatus = 1;
    }
    $updateDetails = array(
        'trending'=>$newStatus
    );
    DB::table('product')->where('id',$id)->update($updateDetails);
    return Redirect::back();
   
 }

 public function swap_full($id){
    $Product = Product::find($id);
    if($Product->full == 1){
        $newStatus = 0;
    }else{
        $newStatus = 1;
    }
    $updateDetails = array(
        'full'=>$newStatus
    );
    DB::table('product')->where('id',$id)->update($updateDetails);
    return Redirect::back();
   
 }

 

 public function swapFeatured($id){
    $Product = Product::find($id);
    if($Product->featured == 1){
        $newStatus = 0;
    }else{
        $newStatus = 1;
    }
    $updateDetails = array(
        'featured'=>$newStatus
    );
    DB::table('product')->where('id',$id)->update($updateDetails);
    return Redirect::back();
   
 }

 public function swapSlider($id){
    $Product = Product::find($id);
    if($Product->slider == 1){
        $newStatus = 0;
    }else{
        $newStatus = 1;
    }
    $updateDetails = array(
        'slider'=>$newStatus
    );
    DB::table('product')->where('id',$id)->update($updateDetails);
    return Redirect::back();
   
 }
 public function swapBanner($id){
    $Product = Product::find($id);
    if($Product->banner == 1){
        $newStatus = 0;
    }else{
        $newStatus = 1;
    }
    $updateDetails = array(
        'banner'=>$newStatus
    );
    DB::table('product')->where('id',$id)->update($updateDetails);
    return Redirect::back();
   
 }

 public function myApi(){
    $MPESA = Payment::all();
    $page_title = 'formfiletext';
    $page_name = 'My API';
    return view('admin.myApi',compact('page_title','MPESA','page_name'));
 }

 public function balance(){
    $MPESA = DB::table('accountbalance')->get();
    $page_title = 'list';
    $page_name = 'My Account Balance';
    return view('admin.balance',compact('page_title','MPESA','page_name')); 
 }

 public function lnmo(){
    $MPESA = DB::table('lnmo_api_response')->get();
    $page_title = 'list';
    $page_name = 'My API';
    return view('admin.lnmo',compact('page_title','MPESA','page_name'));
 }
 public function b2b(){
    $MPESA = DB::table('b2b_api_response')->get();
    $page_title = 'list';
    $page_name = 'My API';
    return view('admin.b2b',compact('page_title','MPESA','page_name'));
 }
 public function b2c(){
    $MPESA = DB::table('b2c_api_response')->get();
    $page_title = 'list';
    $page_name = 'My API';
    return view('admin.b2c',compact('page_title','MPESA','page_name'));
 }
 public function reverse(){
    $MPESA = DB::table('reverse_transaction')->get();
    $page_title = 'list';
    $page_name = 'My API';
    return view('admin.reverse',compact('page_title','MPESA','page_name'));
 }
 

 public function lnmo_confirm($id){
    $updateDetails = array(
        'status'=>1
    );
    DB::table('lnmo_api_response')->where('lnmoID',$id)->update($updateDetails);
    Session::flash('message-comment', "Payment Has Been Approved");
    return Redirect::back();

 }

 public function invoices(){
    $page_name = 'Invoices';
    $Invoice = Invoice::All();
    $page_title = 'list';
    return view('admin.invoices',compact('page_title','Invoice','page_name'));
}

public function approveInvoice($id){
    $updateDetails = array(
        'status'=>1
    );
    DB::table('invoices')->where('id',$id)->update($updateDetails);
    Session::flash('message-comment', "Payment Has Been Approved");
    return Redirect::back();

 }

 
 public function deleteInvoice($id){
    DB::table('invoices')->where('id',$id)->delete();
    return Redirect::back();
 }

// 
public function tags(){
    $Tag = Tag::all();
    $page_title = 'list';
    $page_name = 'Categories';
    return view('admin.tags',compact('page_title','Tag','page_name'));
}

public function addTag(){
    $page_title = 'formfiletext';
    $page_name = 'Add Tag';
    return view('admin.addTag',compact('page_title','page_name'));
}

public function add_Tag(Request $request){
    $slung = Str::slug($request->name);
    $Tag = new Tag;
    $Tag->title = $request->name;
    $Tag->slung = $slung;
   
    $Tag->save();
    Session::flash('message', "Tag Has Been Added");
    return Redirect::back();
}

public function editTag($id){
    $Tag = Tag::find($id);
    $page_title = 'formfiletext';
    $page_name = 'Edit Home Page Slider';
    return view('admin.editTag',compact('page_title','Tag','page_name'));
}

public function edit_Tag(Request $request, $id){
    $path = 'uploads/tags';
        if(isset($request->image)){
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $file->move($path, $filename);
            $image = $filename;
        }else{
            $image = $request->image_cheat;
        }
    $slung = Str::slug($request->name);
    $updateDetails = array(
        'title'=>$request->name,
        'slung'=>$slung,
        'keywords'=>$request->keywords,
        'content'=>$request->content,
        'image'=>$image
      
    );
    DB::table('tags')->where('id',$id)->update($updateDetails);
    Session::flash('message', "Changes have been saved");
    return Redirect::back();
}

public function deleteTag($id){
    DB::table('category')->where('id',$id)->delete();
    return Redirect::back();
}

public function wishlist(){
    $Wishlist = DB::table('wishlists')->get();
    $page_title = 'list';
    $page_name = 'Wishlist';
    return view('admin.wishlist',compact('page_title','Wishlist','page_name'));
}

public function addProductToFacebookPixel(){

    
    // Empty
    // DB::table('_pro_excel')->delete();
    ProExcel::truncate();
    // $Products = Product::whereNotNull('fb_pixels');
    $Products = DB::table('product')->whereNotNull('code')->whereNotNull('fb_pixels')->get();
    // $Products = DB::table('product')->where('code','MVH-S325BT')->get();
    // foreach ($Products as $key => $value) {
    //     echo $value->id;
    //     echo "<br>";
    // }
    // var_dump($Products);
    // die();
    foreach($Products as $ProAdd){
      
            $ProductUrl = "https://amanivehiclesounds.co.ke/product/$ProAdd->slung";
            $ImageURL = "https://amanivehiclesounds.co.ke/uploads/product/$ProAdd->fb_pixels";
            $ProExcel  = new ProExcel;
            $ProExcel->code = $ProAdd->code;
            $ProExcel->google_product_category = $ProAdd->google_product_category;
            $ProExcel->title = $ProAdd->name;
            $ProExcel->description = $ProAdd->meta;
            $ProExcel->availability = $ProAdd->stock;
            $ProExcel->condition = "new";
            $ProExcel->price = $ProAdd->price;
            $ProExcel->link = $ProductUrl;
            $ProExcel->image_link = $ImageURL;
            $ProExcel->brand = $ProAdd->brand;
            $ProExcel->save();
        
    }

    

    return redirect()->route('exporting');
}


public function updateCategory(){
    $Category = DB::table('product')->where('cat','12')->get();
    foreach($Category as $category){
        $TheCategory = '8478';
        $updateDetails = array (
             'google_product_category' => $TheCategory,
        );
        DB::table('product')->where('id',$category->id)->update($updateDetails);
    }
    return "Done";
}

public function google_product_category(){
    $Product = DB::table('product')->whereNull('google_product_category')->get();
    $page_title = 'list';
    $page_name = 'Categories';
    return view('admin.google_product_category',compact('page_title','Product','page_name'));
}

public function emptyProductToFacebookPixel(){
    DB::table('_pro_excel')->delete();
    Session::flash('message', "Table Has been cleared");
    return Redirect::back();
}


public function categoriesBanners(){
    $Category = CategoryBanners::all();
    $page_title = 'list';
    $page_name = 'Categories';
    return view('admin.categoriesBanners',compact('page_title','Category','page_name'));
}

public function addCategoryBanners(){
    $page_title = 'formfiletext';
    $page_name = 'Add Category';
    return view('admin.addCategoryBanners',compact('page_title','page_name'));
}

public function add_CategoryBanners(Request $request){
    $path = 'uploads/CategoryBanners';
        if(isset($request->image)){
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $file->move($path, $filename);
            $image = $filename;
        }else{
            $image = "0";
        }
    $CategoryBanners = new CategoryBanners;
    $CategoryBanners->product_id = $request->product_id;
    $CategoryBanners->category_id = $request->category_id;
    $CategoryBanners->title = $request->title;
    $CategoryBanners->status = "1";
    $CategoryBanners->content = $request->content;
    $CategoryBanners->format = $request->format;
    $CategoryBanners->link = $request->link;
    $CategoryBanners->status = $request->status;
    $CategoryBanners->banner = $image;
    $CategoryBanners->save();

    Session::flash('message', "Category Has Been Added");
    return Redirect::back();
}

public function editCategoriesBanners($id){
    $Category = CategoryBanners::find($id);
    $page_title = 'formfiletext';
    $page_name = 'Edit Home Page Slider';
    return view('admin.editCategoriesBanners',compact('page_title','Category','page_name'));
}

public function edit_CategoryBanners(Request $request, $id){
    $path = 'uploads/CategoryBanners';
        if(isset($request->image)){
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $file->move($path, $filename);
            $image = $filename;
        }else{
            $image = $request->image_cheat;
        }
    $updateDetails = array(
        'product_id'=>$request->product_id,
        'category_id'=>$request->category_id,
        'title'=>$request->title,
        'content'=>$request->content,
        'format'=>$request->format,
        'link'=>$request->link,
        'status'=>$request->status,
        'banner'=>$image
    );
    DB::table('offers')->where('id',$id)->update($updateDetails);
    Session::flash('message', "Changes have been saved");
    return Redirect::back();
}

public function deleteCategoryBanners($id){
    DB::table('offers')->where('id',$id)->delete();
    return Redirect::back();
}

/// /// /// ///

public function addcoupon(){
    $page_name = 'Add Core coupon';
    $page_title = 'formfiletext';//For Style Inheritance
    return view('admin.addCoupon',compact('page_title','page_name'));
}
public function add_coupon(Request $request){
    $Value = new CouponCode;
    $Value->title = $request->title;
    $Value->code = $request->code;
    $Value->expired_at = $request->expired_at;
    
    $Value->value = $request->value;
   
    $Value->save();
    Session::flash('message', "Content Has been Added");
    return Redirect::back();
}

public function coupons(){
    $Corecoupon = DB::table('coupon_codes')->get();
    $page_name = 'Core Value';
    $page_title = 'list';
    return view('admin.coupon',compact('page_title','Corecoupon','page_name'));
}
public function editcoupon($id){
    $Value = CouponCode::find($id);
    $page_name = $Value->title;
    $page_title = 'formfiletext';//For Style Inheritance
    
    return view('admin.editCoupon')->with('Value',$Value)->with('page_name',$page_name)->with('page_title',$page_title);
}

public function edit_coupon(Request $request, $id){
   $updateDetails = array(
       'title'=>$request->title,
       'code'=>$request->code,
       'expired_at'=>$request->expired_at,
       'value'=>$request->value,
     
   );
   DB::table('coupon_codes')->where('id',$id)->update($updateDetails);
   Session::flash('message', "Changes have been saved");
    return Redirect::back();
}

public function delete_coupon($id){
    DB::table('coupon_codes')->where('id',$id)->delete();
    return Redirect::back();
}

public function operations(){
    $Corecoupon = DB::table('coupon_codes')->get();
    $page_name = 'Operations';
    $page_title = 'list';
    return view('admin.operations',compact('page_title','Corecoupon','page_name'));
}

public function Searches(){
    $Search = Search::all();
    $page_title = 'list';
    $page_name = 'Services';
    return view('admin.Searches',compact('page_title','Search','page_name'));
}

}




