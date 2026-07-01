<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

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

use App\Models\ServiceRequest;

class AdminsController extends Controller
{
    private const PRODUCT_CATEGORY_MAX_UPLOAD_BYTES = 20971520; // 20MB
    private const ANDROID_BY_MODEL_SLUG = 'android-radios-by-car-model';

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
        $siteName = upload_base_name($request);

        $logo = $this->uploadSeoImageSimple($request, 'logo', $path, $siteName, 'logo', 'logo_cheat');
        $favicon = $this->uploadSeoImageSimple($request, 'favicon', $path, $siteName, 'favicon', 'favicon_cheat');
        $till_image = $this->uploadSeoImageSimple($request, 'till_image', $path, $siteName, 'till-image', 'till_image_cheat');
        $footer_logo = $this->uploadSeoImageSimple($request, 'footer_logo', $path, $siteName, 'footer-logo', 'footer_logo_cheat');
        

        
        $updateDetails = array(
            'sitename'=>$request->sitename,
            'logo'=>$logo,
            'till_image'=>$till_image,
            'footer_logo'=>$footer_logo,
            'email'=>$request->email,
            'email_one'=>$request->email_one,
            'mobile'=>$request->mobile,
            'mobile_one'=>$request->mobile_one,
            'mobile_one_display'=>$request->mobile_one_display ?? $request->mobile_one,
            'mobile_two'=>$request->mobile_two,
            'mobile_two_display'=>$request->mobile_two_display ?? $request->mobile_two,
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
        // If no delivery record exists, create a default one
        if ($Copyright->isEmpty()) {
            DB::table('delivery')->insert([
                'title' => 'Terms Of Delivery',
                'content' => '',
                'created_at' => now(),
                'updated_at' => now()
            ]);
            $Copyright = DB::table('delivery')->get();
        }
        $page_title = 'formfiletext';//For Style Inheritance
        $page_name = 'Copyright';
        return view('admin.delivery',compact('page_title','page_name','Copyright'));
    }
    public function edit_delivery(Request $request){
        $updateDetails = array(
            'content'=>$request->content,
            'updated_at' => now()
        );
        // Check if any record exists, if not create one, otherwise update the first one
        $existing = DB::table('delivery')->first();
        if ($existing) {
            DB::table('delivery')->where('id', $existing->id)->update($updateDetails);
        } else {
            DB::table('delivery')->insert(array_merge($updateDetails, [
                'title' => 'Terms Of Delivery',
                'created_at' => now()
            ]));
        }

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
        $aboutName = 'about-us';
        $image = $this->uploadSeoImageSimple($request, 'image', $path, $aboutName, 'main-image', 'image_cheat');
        $image_one = $this->uploadSeoImageSimple($request, 'image_one', $path, $aboutName, 'gallery-1', 'image_one_cheat');
        $image_two = $this->uploadSeoImageSimple($request, 'image_two', $path, $aboutName, 'gallery-2', 'image_two_cheat');

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
            $image = move_upload_with_seo_name($request->file('image'), $path, $request->title, 'gallery-image');
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
        $image = $this->uploadSeoImageSimple($request, 'image', $path, $request->title, 'gallery-image', 'image_cheat');
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
        $name = trim((string) $request->name);
        $email = trim((string) $request->email);

        if ($name === '' || $email === '') {
            Session::flash('messageError', 'Name and email are required.');
            return Redirect::back()->withInput();
        }

        if (empty($request->password)) {
            Session::flash('messageError', 'Password is required for new admins.');
            return Redirect::back()->withInput();
        }

        if (Admin::where('email', $email)->exists()) {
            Session::flash('messageError', 'An admin with this email already exists.');
            return Redirect::back()->withInput();
        }

        $path = 'uploads/admins';
        $image = move_upload_with_seo_name($request->file('image'), $path, $name, 'profile-image');
        
        $password = Hash::make($request->password);
         $Admin = new Admin;
         $Admin->name = $name;
         $Admin->email = $email;
         $Admin->password = $password;
         $Admin->image = $image;
         $Admin->save();

         $this->syncAdminLoginUser($email, $name, (string) $request->password, $image, null, (int) $Admin->id);

         Session::flash('message', $name . ' has been added as a new admin.');
         return Redirect::to(url('/admin/admins'));

    }
    public function admins(){
        $page_title = 'list';
        $page_name = 'Site Administrator';
        $Admin = Admin::orderBy('id')->get();
        return view('admin.admins',compact('page_title','Admin','page_name'));
    }

    public function editAdmin($id){
        $Admin = Admin::find($id);
        if (!$Admin) {
            Session::flash('messageError', 'The admin you are trying to edit does not exist.');
            return Redirect::to(url('/admin/admins'));
        }
        $page_title = 'formfiletext';//For Style Inheritance
        $page_name = 'Edit Site Administrator';
       
        return view('admin.editAdmin',compact('page_title','Admin','page_name'));
    }

    public function edit_Admin(Request $request, $id){
        $admin = Admin::find($id);
        if (!$admin) {
            Session::flash('messageError', 'Admin not found.');
            return Redirect::to(url('/admin/admins'));
        }

        $name = trim((string) $request->name);
        $email = trim((string) $request->email);
        $oldEmail = $admin->email;

        if ($name === '' || $email === '') {
            Session::flash('messageError', 'Name and email are required.');
            return Redirect::back()->withInput();
        }

        if ($request->filled('password') && strlen((string) $request->password) < 6) {
            Session::flash('messageError', 'Password must be at least 6 characters.');
            return Redirect::back()->withInput();
        }

        if (Admin::where('email', $email)->where('id', '!=', $id)->exists()) {
            Session::flash('messageError', 'Another admin already uses this email.');
            return Redirect::back()->withInput();
        }

        $path = 'uploads/admins';
        $image = $this->uploadSeoImage($request, 'image', $path, $name, 'profile-image', 'image_cheat');
        if ($image === false) {
            return Redirect::back()->withInput();
        }

        $updateDetails = array(
            'name' => $name,
            'email' => $email,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'linkedin' => $request->linkedin,
            'instagram' => $request->instagram,
            'youtube' => $request->youtube,
            'google' => $request->google,
            'content' => $request->content,
            'position' => $request->position,
            'image' => $image,
        );

        if ($request->filled('password')) {
            $updateDetails['password'] = Hash::make($request->password);
        }

        DB::table('admins')->where('id', $id)->update($updateDetails);

        $plainPassword = $request->filled('password') ? (string) $request->password : null;
        $passwordChanged = $plainPassword !== null;
        $this->syncAdminLoginUser($email, $name, $plainPassword, $image, $oldEmail, (int) $id);

        $sessionUser = Auth::user();
        $loginUser = $this->resolveLoginUserForAdmin($email, $oldEmail, (int) $id);
        $isSelf = $sessionUser && $loginUser && (int) $sessionUser->id === (int) $loginUser->id;

        if ($isSelf && ($passwordChanged || $email !== $oldEmail)) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return Redirect::to(url('/login'))
                ->with('message', 'Your account was updated. Please sign in with your new credentials.');
        }

        Session::flash('message', $passwordChanged
            ? 'Admin updated successfully. Login password has been changed.'
            : 'Admin updated successfully.');

        return Redirect::to(url('/admin/admins'));
    }
    

    public function deleteAdmin($id){
        if($id==1){
            Session::flash('messageError', 'You cannot delete the Super Admin.');
            return Redirect::to(url('/admin/admins'));
        }

        $admin = Admin::find($id);
        if ($admin) {
            User::where('email', $admin->email)->where('type', 1)->delete();
            DB::table('admins')->where('id', $id)->delete();
            Session::flash('message', 'Admin deleted successfully.');
        }

        return Redirect::to(url('/admin/admins'));
    }

    private function syncAdminLoginUser(string $email, string $name, ?string $plainPassword = null, ?string $image = null, ?string $previousEmail = null, ?int $adminId = null): void
    {
        $user = $this->resolveLoginUserForAdmin($email, $previousEmail, $adminId);
        $hashedPassword = $plainPassword !== null ? Hash::make($plainPassword) : null;

        if ($user) {
            $update = [
                'name' => $name,
                'email' => $email,
                'type' => 1,
                'updated_at' => now(),
            ];

            if ($image !== null) {
                $update['image'] = $image;
            }

            if ($hashedPassword !== null) {
                $update['password'] = $hashedPassword;
            }

            DB::table('users')->where('id', $user->id)->update($update);
            return;
        }

        if ($plainPassword === null) {
            return;
        }

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => $plainPassword,
            'type' => 1,
            'image' => $image,
        ]);
    }

    private function resolveLoginUserForAdmin(string $email, ?string $previousEmail = null, ?int $adminId = null): ?User
    {
        foreach (array_unique(array_filter([$previousEmail, $email])) as $candidate) {
            $user = User::where('email', $candidate)->first();
            if ($user) {
                return $user;
            }
        }

        if (!Auth::check() || Auth::user()->type !== 'admin' || $adminId === null) {
            return null;
        }

        $sessionUser = Auth::user();
        $adminRecord = Admin::find($adminId);
        if (!$adminRecord) {
            return null;
        }

        if (in_array($sessionUser->email, [$adminRecord->email, $previousEmail, $email], true)) {
            return $sessionUser;
        }

        $profileAdminId = Admin::where('email', $sessionUser->email)->value('id');
        if ($profileAdminId && (int) $profileAdminId === (int) $adminId) {
            return $sessionUser;
        }

        // Legacy fallback: sidebar links to editAdmin/{userId} when emails differ between tables.
        if ((int) $sessionUser->id === (int) $adminId) {
            return $sessionUser;
        }

        return null;
    }

    public function addUser(){
        $page_name = 'Add USer';
        $page_title = 'formfiletext';//For Style Inheritance
        return view('admin.addUser',compact('page_title','page_name'));
    }

    public function add_User(Request $request){
        $path = 'uploads/users';
        $image = $this->uploadSeoImageSimple($request, 'image', $path, $request->name, 'profile-image', 'image_cheat');
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
        $image = move_upload_with_seo_name($request->file('image'), $path, $request->name, 'slider-image');
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
        $image = $this->uploadSeoImageSimple($request, 'image', $path, $request->name, 'slider-image', 'image_cheat');
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
        $image = $this->uploadSeoImageSimple($request, 'image', $path, $request->name, 'banner', 'image_cheat');
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
        $pageImages = $this->uploadSeoImageBatch($request, $path, $request->name, $this->galleryImageRoles());
        if ($pageImages === false) {
            return Redirect::back();
        }

        $image_one = $pageImages['image_one'];
        $image_two = $pageImages['image_two'];
        $image_three = $pageImages['image_three'];
        $image_four = $pageImages['image_four'];
        $image_five = $pageImages['image_five'];
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
        $pageImages = $this->uploadSeoImageBatch($request, $path, $request->name, $this->galleryImageRoles(), true);
        if ($pageImages === false) {
            return Redirect::back();
        }

        $image_one = $pageImages['image_one'];
        $image_two = $pageImages['image_two'];
        $image_three = $pageImages['image_three'];
        $image_four = $pageImages['image_four'];
        $image_five = $pageImages['image_five'];

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
    $Category = Category::orderBy('order', 'asc')->get();
    $page_title = 'list';
    $page_name = 'Categories';
    return view('admin.categories',compact('page_title','Category','page_name'));
}

public function updateCategoryOrder(Request $request){
    $orders = $request->orders;
    foreach ($orders as $index => $categoryId) {
        DB::table('category')->where('id', $categoryId)->update(['order' => $index + 1]);
    }
    return response()->json(['success' => true, 'message' => 'Category order updated successfully']);
}

public function updateSingleCategoryOrder(Request $request){
    DB::table('category')->where('id', $request->id)->update(['order' => $request->order]);
    return response()->json(['success' => true, 'message' => 'Order updated']);
}

public function toggleCategoryHome(Request $request){
    try {
        $id = $request->id;
        $home = $request->home;
        
        // Validate input
        if (!$id) {
            return response()->json(['success' => false, 'message' => 'Category ID is required'], 400);
        }
        
        // Update database
        $updated = DB::table('category')->where('id', $id)->update(['home' => $home]);
        
        if ($updated) {
            \Log::info('Category home updated', ['id' => $id, 'home' => $home]);
            return response()->json(['success' => true, 'message' => 'Category home status updated', 'id' => $id, 'home' => $home]);
        } else {
            return response()->json(['success' => false, 'message' => 'No category found with that ID'], 404);
        }
    } catch (\Exception $e) {
        \Log::error('Error updating category home', ['error' => $e->getMessage()]);
        return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
    }
}

public function toggleCategoryStatus(Request $request){
    $id = $request->id;
    $status = $request->status;
    DB::table('category')->where('id', $id)->update(['status' => $status]);
    return response()->json(['success' => true, 'message' => 'Category status updated']);
}

public function addCategory(){
    $page_title = 'formfiletext';
    $page_name = 'Add Category';
    return view('admin.addCategory',compact('page_title','page_name'));
}

public function add_Category(Request $request){
    
    // Get the highest order value and add 1
    $maxOrder = DB::table('category')->max('order') ?? 0;
    
    $slung = $request->slung;
    if($slung == null || $slung == ""){
        $slung = Str::slug($request->name);
    }
    
    $Category = new Category;
    $Category->cat = $request->name;
    $Category->slung = $slung;
    $Category->order = $maxOrder + 1;
    $Category->home = $request->home ?? 0;
    
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
        $image = $this->uploadSeoImage($request, 'image', $path, $request->name, 'category-image', 'image_cheat', null, self::PRODUCT_CATEGORY_MAX_UPLOAD_BYTES);
        if ($image === false) {
            return Redirect::back();
        }
    $slung = $request->slung;
    if($slung == null || $slung == ""){
        $slung = Str::slug($request->name);
    }
    $updateDetails = array(
        'cat'=>$request->name,
        'slung'=>$slung,
        'keywords'=>$request->keywords,
        'description'=>$request->content,
        'image'=>$image,
        'order'=>$request->order
      
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
    $androidCategory = DB::table('category')->where('slung', self::ANDROID_BY_MODEL_SLUG)->first();
    $androidCategoryId = $androidCategory->id ?? null;

    $query = DB::table('sub_category')->orderBy('name');
    if ($androidCategoryId) {
        $query->where('cat_id', $androidCategoryId);
    }

    $Category = $query->get();
    $page_title = 'list';
    $page_name = 'Car Models';
    return view('admin.SubCategories', compact('page_title', 'Category', 'page_name', 'androidCategory', 'androidCategoryId'));
}

public function addSubCategory(){
    $androidCategory = DB::table('category')->where('slung', self::ANDROID_BY_MODEL_SLUG)->first();
    $androidCategoryId = $androidCategory->id ?? null;
    $page_title = 'formfiletext';
    $page_name = 'Add Car Model';
    return view('admin.addSubCategory', compact('page_title', 'page_name', 'androidCategory', 'androidCategoryId'));
}

public function add_SubCategory(Request $request){
    $name = trim((string) $request->name);
    if ($name === '') {
        Session::flash('messageError', 'Sub category name is required.');
        return Redirect::back()->withInput();
    }

    if (empty($request->cat_id)) {
        Session::flash('messageError', 'Please select a parent category.');
        return Redirect::back()->withInput();
    }

    $duplicate = DB::table('sub_category')
        ->where('cat_id', $request->cat_id)
        ->whereRaw('LOWER(name) = ?', [Str::lower($name)])
        ->exists();

    if ($duplicate) {
        Session::flash('messageError', 'This sub category already exists under the selected parent category.');
        return Redirect::back()->withInput();
    }

    $SubCategory = new SubCategory;
    $SubCategory->name = $name;
    $SubCategory->cat_id = $request->cat_id;
    $SubCategory->slung = $this->uniqueSubCategorySlug($name, $request->cat_id);
    
    $SubCategory->save();
    Session::flash('message', 'Car model "' . $name . '" has been added.');
    return Redirect::to(url('/admin/subCategories'));
}

public function editSubCategories($id){
    $Category = SubCategory::find($id);
    $page_title = 'formfiletext';
    $page_name = 'Edit Car Model';
    return view('admin.editSubCategory',compact('page_title','Category','page_name'));
}

public function edit_SubCategory(Request $request, $id){
    $name = trim((string) $request->name);
    if ($name === '') {
        Session::flash('messageError', 'Sub category name is required.');
        return Redirect::back()->withInput();
    }

    if (empty($request->cat_id)) {
        Session::flash('messageError', 'Please select a parent category.');
        return Redirect::back()->withInput();
    }

    $duplicate = DB::table('sub_category')
        ->where('cat_id', $request->cat_id)
        ->whereRaw('LOWER(name) = ?', [Str::lower($name)])
        ->where('id', '!=', $id)
        ->exists();

    if ($duplicate) {
        Session::flash('messageError', 'This sub category already exists under the selected parent category.');
        return Redirect::back()->withInput();
    }

    $updateDetails = array(
        'cat_id'=>$request->cat_id,
        'name' =>$name,
        'slung' => $this->uniqueSubCategorySlug($name, $request->cat_id, $id),
      
    );
    DB::table('sub_category')->where('id',$id)->update($updateDetails);
    Session::flash('message', 'Car model updated successfully.');
    return Redirect::to(url('/admin/subCategories'));
}

public function deleteSubCategory($id){
    DB::table('sub_category')->where('id',$id)->delete();
    return Redirect::to(url('/admin/subCategories'));
}

public function addProduct(){
    $page_title = 'formfiletext';//For Layout Inheritance
    $page_name = 'Add New Product';
    return view('admin.addProduct',compact('page_title','page_name'));
}

public function add_Product(Request $request){

    if (trim($request->name ?? '') === '') {
        Session::flash('messageError', 'Product name is required.');
        return Redirect::back()->withInput();
    }

    if ($request->price === null || $request->price === '' || !is_numeric($request->price) || (float) $request->price <= 0) {
        Session::flash('messageError', 'Product price is required and must be greater than zero.');
        return Redirect::back()->withInput();
    }

    if (empty($request->cat)) {
        Session::flash('messageError', 'Please select a category.');
        return Redirect::back()->withInput();
    }

    $subCategoryValidationError = $this->validateSubCategorySelection($request->cat, $request->sub_cat);
    if ($subCategoryValidationError !== null) {
        Session::flash('messageError', $subCategoryValidationError);
        return Redirect::back()->withInput();
    }

    $path = 'uploads/product';
    $productName = $request->name;
    $productCode = trim($request->code ?? '');

    if ($productCode === '') {
        $productCode = product_code_from_name($productName);
    }

    $productCode = unique_product_code(strtoupper($productCode));

    $fb_pixels = $this->uploadSeoImage($request, 'fb_pixels', $path, $productName, 'facebook-pixel', null, null, self::PRODUCT_CATEGORY_MAX_UPLOAD_BYTES);
    if ($fb_pixels === false) {
        return Redirect::back();
    }

    $thumbnail = $this->uploadSeoImage($request, 'thumbnail', $path, $productName, 'thumbnail', null, null, self::PRODUCT_CATEGORY_MAX_UPLOAD_BYTES);
    if ($thumbnail === false) {
        return Redirect::back();
    }

    $gallery = $this->processProductGalleryUploads($request, $path, $productName);
    if ($gallery === false) {
        return Redirect::back();
    }

    if (empty($gallery)) {
        Session::flash('messageError', 'Please add at least one gallery image (main product image).');
        return Redirect::back();
    }

    $galleryColumns = $this->syncProductGalleryColumns($gallery);

    $slung = Str::slug($request->name);
    $Product = new Product;
    $subCategoryId = $request->filled('sub_cat') ? $request->sub_cat : null;
    $Product->name = $request->name;
    $Product->google_product_category = $request->google_product_category;
    $Product->slung = $slung;
    $Product->iframe = $request->iframe;
    $Product->meta = $request->meta;
    $Product->content = $request->content;
    $Product->price = $request->price;
    $Product->brand = $request->brand;
    $Product->price_raw = $request->price;
    $Product->code = $productCode;
    $Product->cat = $request->cat;
    $Product->sub_cat = $subCategoryId;
    $Product->image_one = $galleryColumns['image_one'];
    $Product->fb_pixels = $fb_pixels;
    $Product->thumbnail = $thumbnail;
    $Product->image_two = $galleryColumns['image_two'];
    $Product->image_three = $galleryColumns['image_three'];
    $Product->gallery_images = $galleryColumns['gallery_images'];

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

    public function updateCategorySlugs(){
        $categories = DB::table('category')->get();
        $count = 0;
        foreach ($categories as $value) {
            $slung = Str::slug($value->cat);
            $updateDetails = array(
                'slung' => $slung,
            );
            DB::table('category')->where('id',$value->id)->update($updateDetails);
            $count++;
        }
        return back()->with('message', $count . ' Category slugs updated successfully');
    }

    public function updateProductSlugs(){
        $products = DB::table('product')->whereNull('slung')->orWhere('slung', '')->get();
        $count = 0;
        foreach ($products as $product) {
            $slung = Str::slug($product->name);
            // Check if slug already exists to prevent duplicates
            $originalSlung = $slung;
            $i = 1;
            while(DB::table('product')->where('slung', $slung)->where('id', '!=', $product->id)->exists()){
                $slung = $originalSlung . '-' . $i;
                $i++;
            }
            DB::table('product')->where('id', $product->id)->update(['slung' => $slung]);
            $count++;
        }
        return back()->with('message', $count . ' Product slugs updated successfully');
    }



public function edit_Product(Request $request, $id){
    if (trim((string) $request->name) === '') {
        Session::flash('messageError', 'Product name is required.');
        return Redirect::back()->withInput();
    }

    if ($request->price === null || $request->price === '' || !is_numeric($request->price) || (float) $request->price <= 0) {
        Session::flash('messageError', 'Product price is required and must be greater than zero.');
        return Redirect::back()->withInput();
    }

    if (empty($request->cat)) {
        Session::flash('messageError', 'Please select a category.');
        return Redirect::back()->withInput();
    }

    $subCategoryValidationError = $this->validateSubCategorySelection($request->cat, $request->sub_cat);
    if ($subCategoryValidationError !== null) {
        Session::flash('messageError', $subCategoryValidationError);
        return Redirect::back()->withInput();
    }

    $path = 'uploads/product';
    $productName = $request->name;

    $fb_pixels = $this->uploadSeoImage($request, 'fb_pixels', $path, $productName, 'facebook-pixel', 'fb_pixels_cheat', null, self::PRODUCT_CATEGORY_MAX_UPLOAD_BYTES);
    if ($fb_pixels === false) {
        return Redirect::back();
    }

    $thumbnail = $this->uploadSeoImage($request, 'thumbnail', $path, $productName, 'thumbnail', 'thumbnail_cheat', null, self::PRODUCT_CATEGORY_MAX_UPLOAD_BYTES);
    if ($thumbnail === false) {
        return Redirect::back();
    }

    $gallery = $this->processProductGalleryUploads($request, $path, $productName);
    if ($gallery === false) {
        return Redirect::back();
    }

    $galleryColumns = $this->syncProductGalleryColumns($gallery);

   if($request->stock == 'on'){
       $stock = 'In Stock';
   }else{
       $stock = 'Out of Stock';
   }
   $slung = Str::slug($request->name);


   
    $subCategoryId = $request->filled('sub_cat') ? $request->sub_cat : null;

    $updateDetails = array(
        'name' => $request->name,
        'slung' => $slung,
        'meta' => $request->meta,
        'google_product_category'=>$request->google_product_category,
        'iframe' => $request->iframe,
        'content' => $request->content,
        'image_one' => $galleryColumns['image_one'],
        'thumbnail' => $thumbnail,
        'stock' => $stock,
        'brand' => $request->brand,
        'fb_pixels' => $fb_pixels,
        'image_two' => $galleryColumns['image_two'],
        'image_three' => $galleryColumns['image_three'],
        'gallery_images' => $galleryColumns['gallery_images'],
        'price' =>$request->price,
        'price_raw' =>$request->price_raw,
        'code' =>$request->code,
        'cat' =>$request->cat,
        'sub_cat' =>$subCategoryId,
        'replaced' => $request->replaced ?? 0,
        'tag' => $request->tag ?? null,
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
    $serviceImages = $this->uploadSeoImageBatch($request, $path, $request->name, $this->threeGalleryImageRoles(), true);
    if ($serviceImages === false) {
        return Redirect::back();
    }

    $image_one = $serviceImages['image_one'];
    $image_three = $serviceImages['image_three'];

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
    $serviceImages = $this->uploadSeoImageBatch($request, $path, $request->name, $this->threeGalleryImageRoles(), true);
    if ($serviceImages === false) {
        return Redirect::back();
    }

    $image_one = $serviceImages['image_one'];
    $image_three = $serviceImages['image_three'];

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
    $portfolioImages = $this->uploadSeoImageBatch($request, $path, $request->name, $this->galleryImageRoles());
    if ($portfolioImages === false) {
        return Redirect::back();
    }

    $image_one = $portfolioImages['image_one'];
    $image_two = $portfolioImages['image_two'];
    $image_three = $portfolioImages['image_three'];
    $image_four = $portfolioImages['image_four'];
    $image_five = $portfolioImages['image_five'];

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
    $portfolioImages = $this->uploadSeoImageBatch($request, $path, $request->name, $this->galleryImageRoles(), true);
    if ($portfolioImages === false) {
        return Redirect::back();
    }

    $image_one = $portfolioImages['image_one'];
    $image_two = $portfolioImages['image_two'];
    $image_three = $portfolioImages['image_three'];
    $image_four = $portfolioImages['image_four'];
    $image_five = $portfolioImages['image_five'];

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
    $image_one = $this->uploadSeoImage($request, 'image_one', $path, $request->name, 'testimonial-image');
    if ($image_one === false) {
        return Redirect::back();
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
    $image_one = $this->uploadSeoImage($request, 'image_one', $path, $request->name, 'testimonial-image', 'image_one_cheat');
    if ($image_one === false) {
        return Redirect::back();
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
    $blogImages = $this->uploadSeoImageBatch($request, $path, $title, [
        'image_one' => 'main-image',
        'image_two' => 'gallery-2',
    ]);
    if ($blogImages === false) {
        return Redirect::back();
    }

    $image_one = $blogImages['image_one'];
    $image_two = $blogImages['image_two'];

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
    $blogImages = $this->uploadSeoImageBatch($request, $path, $request->title, $this->galleryImageRoles(), true);
    if ($blogImages === false) {
        return Redirect::back();
    }

    $image_one = $blogImages['image_one'];
    $image_two = $blogImages['image_two'];
    $image_three = $blogImages['image_three'];
    $image_four = $blogImages['image_four'];

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
    $image = $this->uploadSeoImage($request, 'image', $path, $request->name, 'doctor-image', 'image_cheat');
    if ($image === false) {
        return Redirect::back();
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
    $image = $this->uploadSeoImageSimple($request, 'image', $path, $request->name, 'doctor-image');
    
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
    $file = $this->uploadSeoImage($request, 'file', $path, $request->title, 'company-profile', 'file_cheat');
    if ($file === false) {
        return Redirect::back();
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
      $path = 'uploads/files';
      $file = $this->uploadSeoImageSimple($request, 'file', $path, upload_base_name($request), 'document', 'file_cheat');
  
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
    
    // Ensure directory exists
    if (!file_exists($path)) {
        mkdir($path, 0755, true);
    }
    
    $image_one = $this->uploadSeoImage($request, 'image_one', $path, $request->name, 'brand-logo');
    if ($image_one === false) {
        return Redirect::back();
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
    
    // Ensure directory exists
    if (!file_exists($path)) {
        mkdir($path, 0755, true);
    }
    
    $image_one = $this->uploadSeoImage($request, 'image_one', $path, $request->name, 'brand-logo', 'image_one_cheat');
    if ($image_one === false) {
        return Redirect::back();
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
    $image_one = $this->uploadSeoImage($request, 'file', $path, $request->subject, 'mail-attachment', 'file_cheat');
    if ($image_one === false) {
        return Redirect::back();
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
         
         // Ensure directory exists
         if (!file_exists($path)) {
             mkdir($path, 0755, true);
         }
         
        $product = Product::find($id);
        $productName = $product ? $product->name : 'product-offer';
        $image_one = $this->uploadSeoImage($request, 'file', $path, $productName, 'offer-banner', 'file_cheat');
        if ($image_one === false) {
            return Redirect::back();
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
    $image = $this->uploadSeoImageSimple($request, 'image', $path, $request->name, 'tag-image', 'image_cheat');
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
      
            $ProductUrl = "https://amanivehiclesounds.com/product/$ProAdd->slung";
            $ImageURL = "https://amanivehiclesounds.com/uploads/product/$ProAdd->fb_pixels";
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
    $image = $this->uploadSeoImageSimple($request, 'image', $path, $request->title, 'category-banner') ?? '0';
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
    $image = $this->uploadSeoImageSimple($request, 'image', $path, $request->title, 'category-banner', 'image_cheat');
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

private function uploadSeoImage(Request $request, string $field, string $path, string $baseName, string $role, ?string $fallbackField = null, ?string $defaultFallback = null, int $maxSize = 1800000)
{
    if (!$request->hasFile($field)) {
        if ($fallbackField !== null) {
            return $request->input($fallbackField);
        }

        return $defaultFallback ?? $request->pro_img_cheat ?? null;
    }

    $file = $request->file($field);
    if ($file->getSize() >= $maxSize) {
        Session::flash('message', 'File Exceeded the maximum allowed Size');
        Session::flash('messageError', 'An error occured, You may have exceeded the maximum size for an image you uploaded');

        return false;
    }

    return move_upload_with_seo_name($file, $path, $baseName, $role);
}

private function uploadSeoImageSimple(Request $request, string $field, string $path, string $baseName, string $role, ?string $fallbackField = null)
{
    if (!$request->hasFile($field)) {
        return $fallbackField !== null ? $request->input($fallbackField) : null;
    }

    return move_upload_with_seo_name($request->file($field), $path, $baseName, $role);
}

private function storeProductGalleryImage(Request $request, string $field, string $path, string $baseName, string $role, ?string $fallbackField = null)
{
    return $this->uploadSeoImage($request, $field, $path, $baseName, $role, $fallbackField);
}

private function uploadSeoImageBatch(Request $request, string $path, string $baseName, array $fieldRoles, bool $useFieldCheats = false)
{
    $results = [];

    foreach ($fieldRoles as $field => $role) {
        $result = $this->uploadSeoImage(
            $request,
            $field,
            $path,
            $baseName,
            $role,
            $useFieldCheats ? $field.'_cheat' : null,
            $useFieldCheats ? null : 'pro_img_cheat'
        );

        if ($result === false) {
            return false;
        }

        $results[$field] = $result;
    }

    return $results;
}

private function galleryImageRoles(): array
{
    return [
        'image_one' => 'main-image',
        'image_two' => 'gallery-2',
        'image_three' => 'gallery-3',
        'image_four' => 'gallery-4',
        'image_five' => 'gallery-5',
    ];
}

private function threeGalleryImageRoles(): array
{
    return [
        'image_one' => 'main-image',
        'image_two' => 'gallery-2',
        'image_three' => 'gallery-3',
    ];
}

private function processProductGalleryUploads(Request $request, string $path, string $productName, int $maxImages = 20)
{
    $maxSize = self::PRODUCT_CATEGORY_MAX_UPLOAD_BYTES;
    $order = json_decode($request->input('gallery_order_json', '[]'), true);

    if (!is_array($order)) {
        $order = [];
    }

    $newFiles = $request->file('gallery_files', []);
    if (!is_array($newFiles)) {
        $newFiles = $newFiles ? [$newFiles] : [];
    }

    $gallery = [];
    $nextIndex = 1;

    foreach ($order as $item) {
        if (count($gallery) >= $maxImages) {
            break;
        }

        if (!is_array($item) || empty($item['type'])) {
            continue;
        }

        if ($item['type'] === 'existing' && !empty($item['filename'])) {
            $gallery[] = $item['filename'];
            $nextIndex++;
            continue;
        }

        if ($item['type'] === 'new') {
            $fileIndex = $item['index'] ?? null;
            $file = ($fileIndex !== null && isset($newFiles[$fileIndex])) ? $newFiles[$fileIndex] : null;

            if (!$file || !$file->isValid()) {
                continue;
            }

            if ($file->getSize() >= $maxSize) {
                Session::flash('message', 'File Exceeded the maximum allowed Size');
                Session::flash('messageError', 'An error occured, You may have exceeded the maximum size for an image you uploaded');

                return false;
            }

            $role = $nextIndex === 1 ? 'main-image' : 'gallery-' . $nextIndex;
            $gallery[] = move_upload_with_seo_name($file, $path, $productName, $role);
            $nextIndex++;
        }
    }

    return $gallery;
}

private function syncProductGalleryColumns(array $gallery): array
{
    $gallery = array_values($gallery);

    return [
        'gallery_images' => json_encode($gallery),
        'image_one' => $gallery[0] ?? null,
        'image_two' => $gallery[1] ?? null,
        'image_three' => $gallery[2] ?? null,
    ];
}

private function isAndroidByModelCategory($categoryId): bool
{
    if (empty($categoryId)) {
        return false;
    }

    $category = DB::table('category')->where('id', $categoryId)->first();
    if (!$category) {
        return false;
    }

    $slug = trim((string) ($category->slung ?? ''));
    if ($slug !== '') {
        return Str::lower($slug) === self::ANDROID_BY_MODEL_SLUG;
    }

    $name = trim((string) ($category->cat ?? ''));
    return Str::contains(Str::lower($name), 'android radios by car model');
}

private function validateSubCategorySelection($categoryId, $subCategoryId): ?string
{
    if (!$this->isAndroidByModelCategory($categoryId)) {
        return null;
    }

    if (empty($subCategoryId)) {
        return 'Please select a car model sub category for Android Radios by Car Model.';
    }

    $belongsToCategory = DB::table('sub_category')
        ->where('id', $subCategoryId)
        ->where('cat_id', $categoryId)
        ->exists();

    if (!$belongsToCategory) {
        return 'Selected car model does not belong to the chosen category.';
    }

    return null;
}

private function uniqueSubCategorySlug(string $name, $categoryId, $excludeId = null): string
{
    $baseSlug = Str::slug($name);
    if ($baseSlug === '') {
        $baseSlug = 'model';
    }

    $slug = $baseSlug;
    $suffix = 2;
    while (true) {
        $query = DB::table('sub_category')
            ->where('cat_id', $categoryId)
            ->where('slung', $slug);

        if (!empty($excludeId)) {
            $query->where('id', '!=', $excludeId);
        }

        if (!$query->exists()) {
            return $slug;
        }

        $slug = $baseSlug . '-' . $suffix;
        $suffix++;
    }
}

}




