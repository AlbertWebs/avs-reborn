<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use App\Blog;

use App\Comment;

use App\Notifications; 

use SEOMeta;
use OpenGraph;
use Twitter;

use Illuminate\Support\Facades\Redirect;

use Mail;

use Session;
class BlogController extends Controller
{
    public function index(){
        $SEOSettings = DB::table('seosettings')->get();
        foreach($SEOSettings as $Settings){
        SEOMeta::setTitle(''.$Settings->sitename.' - Our Blogs');
        SEOMeta::setDescription(''.$Settings->welcome.'');
        SEOMeta::setCanonical(''.$Settings->url.'/news');

        OpenGraph::setDescription(''.$Settings->welcome.''); 
        OpenGraph::setTitle(''.$Settings->sitename.' - '.$Settings->welcome.'');
        OpenGraph::setUrl(''.$Settings->url.'/news');
        OpenGraph::addProperty('type', 'articles');
        
        
        Twitter::setTitle(''.$Settings->sitename.' - '.$Settings->welcome.'');
        Twitter::setSite(''.$Settings->twitter.'');

        $Blog = DB::table('blogs')->paginate(6);
        $page_title = 'Our Blog';
        $page_name = 'Our Blog';
        return view('blog.index',compact('page_title','Blog','page_name'));
        }
    }

    public function blog($title){
        $SEOSettings = DB::table('seosettings')->get();
        $Blog = DB::table('blogs')->where('slung',$title)->get();
        $Popular = DB::table('blogs')->paginate(8);
        foreach($Blog as $value){
        foreach($SEOSettings as $Settings){
        SEOMeta::setTitle(''.$value->title.' - '.$Settings->sitename.' ');
        SEOMeta::setDescription(''.$Settings->welcome.'');
        SEOMeta::setCanonical(''.$Settings->url.'/blog-posts/'.$title.'');

        OpenGraph::setDescription(''.$Settings->welcome.''); 
        OpenGraph::setTitle(''.$Settings->sitename.' - '.$Settings->welcome.'');
        OpenGraph::setUrl(''.$Settings->url.'/blog-posts');
        OpenGraph::addProperty('type', 'articles');
        
        
        Twitter::setTitle(''.$Settings->sitename.' - '.$Settings->welcome.'');
        Twitter::setSite(''.$Settings->twitter.'');
       
            $Cat = DB::table('category')->get();
       
            $name = $value->author;
            $post_id = $value->id;
            $Title = $value->title;
            $Comments = DB::table('comments')->where('blog_id',$post_id)->where('status','1')->get();
                
                    if($name == '' OR $name == NULL){
                        $newName = 'Albert Muhatia';
                    }else{
                        $newName = $value->author;
                    }
                
                    $Author = DB::table('users')->where('name',$newName)->get();
                    $page_title = $title;
                    $page_name = $title;
                    
                    
                    $Author = DB::table('users')->where('name',$newName)->get();
                    return view('blog.blog',compact('page_title','Blog','page_name','Comments','Author','Popular'));
        }
        
    }
    }

    public function add_comment(Request $request){
       
        $comments = new comment;
        $comments->author=$request->name;
        $comments->email=$request->email;
        $comments->content=$request->message;
        $comments->blog_id=$request->blog_id;
        $comments->save();

        Session::flash('message', "Your Comment has been posted");
        return Redirect::back();

    }
    public function blogCat($cat){
        $SEOSettings = DB::table('seosettings')->get();
        foreach($SEOSettings as $Settings){
        SEOMeta::setTitle(''.$Settings->sitename.' - Our Blogs');
        SEOMeta::setDescription(''.$Settings->welcome.'');
        SEOMeta::setCanonical(''.$Settings->url.'/news/'.$cat.'');

        OpenGraph::setDescription(''.$Settings->welcome.''); 
        OpenGraph::setTitle(''.$Settings->sitename.' - '.$Settings->welcome.'');
        OpenGraph::setUrl(''.$Settings->url.'/news');
        OpenGraph::addProperty('type', 'articles');
        
        
        Twitter::setTitle(''.$Settings->sitename.' - '.$Settings->welcome.'');
        Twitter::setSite(''.$Settings->twitter.'');

        $Categories = DB::table('category')->where('cat',$cat)->get();
        foreach ($Categories as $key => $value) {
            $Blog = DB::table('blogs')->where('cat',$value->id)->paginate(9);
            if($Blog->isEmpty()){
                $page_title = 'Sorry There are No Blogs Written For That Category';
            }else{
                foreach ($Blog as $key => $value) {
                    $page_title = $value->title;
                    $page_name = $page_title;
                 }
            }
           
        }
        
        
        return view('blog.index',compact('page_title','Blog','page_name'));
    }
    }

    public function search_blog(Request $request){
        $SEOSettings = DB::table('seosettings')->get();
        foreach($SEOSettings as $Settings){
        SEOMeta::setTitle(''.$Settings->sitename.' - Search Blog');
        SEOMeta::setDescription(''.$Settings->welcome.'');
        SEOMeta::setCanonical(''.$Settings->url.'blog/search');

        OpenGraph::setDescription(''.$Settings->welcome.''); 
        OpenGraph::setTitle(''.$Settings->sitename.' - '.$Settings->welcome.'');
        OpenGraph::setUrl(''.$Settings->url.'blog/search');
        OpenGraph::addProperty('type', 'articles');
        
        
        Twitter::setTitle(''.$Settings->sitename.' - '.$Settings->welcome.'');
        Twitter::setSite(''.$Settings->twitter.'');
        $search = $request->search;
        $Blog = DB::table('blogs')->where('title','like', '%'.$search.'%')->paginate(6);
        
        if($Blog->isEmpty()){
            //Do something here if the array is empty
            $Cat = DB::table('category')->get();
            $page_title = $search;
            $page_name = $search;
            return view('blog.empty',compact('Cat','page_title','page_name'));
        }else{
       
       
            foreach($Blog as $value){
                $Cat = DB::table('category')->get();
                //Order By Views Descend
                $Popular = DB::table('blogs')->paginate(8);
                $Tags = DB::table('tags')->get();
                $name = $value->author;
            
                if($name == '' OR $name == NULL){
                    $newName = 'Albert Muhatia';
                }else{
                    $newName = $value->author;
                }
                $page_title = $search;
                $page_name = $search;
                $Author = DB::table('users')->where('name',$newName)->get();
                return view('blog.index',compact('Cat','Blog','Author','Tags','Popular','page_title','page_name'));
            } 
        } 
       
    }
        
    }
    public function tag($tag){
        $SEOSettings = DB::table('seosettings')->get();
        foreach($SEOSettings as $Settings){
        SEOMeta::setTitle(''.$Settings->sitename.' - Tag');
        SEOMeta::setDescription(''.$Settings->welcome.'');
        SEOMeta::setCanonical(''.$Settings->url.'/blog/tag');

        OpenGraph::setDescription(''.$Settings->welcome.''); 
        OpenGraph::setTitle(''.$Settings->sitename.' - '.$Settings->welcome.'');
        OpenGraph::setUrl(''.$Settings->url.'/blog/tag');
        OpenGraph::addProperty('type', 'articles');
        
        
        Twitter::setTitle(''.$Settings->sitename.' - '.$Settings->welcome.'');
        Twitter::setSite(''.$Settings->twitter.'');
            
        $Blog = DB::table('blogs')->where('cat',$tag)->get();
            //Check if array is empty 
            if($Blog->isEmpty()){
                //Do something here if the array is empty
                $Cat = DB::table('category')->paginate(3);
                $page_title = $tag;
                $page_name = $tag;
                return view('blog.empty',compact('Cat','page_title','page_name'));
            }else{
                foreach($Blog as $value){
                    $Cat = DB::table('category')->paginate(3);
                    $Blog = DB::table('blogs')->where('category',$tag)->paginate();
                    $Popular = DB::table('blogs')->paginate(8);
                    $Tags = DB::table('tags')->get();
                    $name = $value->author;
                
                    if($name == '' OR $name == NULL){
                        $newName = 'Albert Muhatia';
                    }else{
                        $newName = $value->author;
                    }
                    $page_title = $tag;
                    $page_name = $tag;
                    $Author = DB::table('users')->where('name',$newName)->get();
                    return view('blog.index',compact('Cat','Blog','Author','Tags','Popular','page_title','page_name'));
                }
            }
        }
    
}


public function videos(){
    $SEOSettings = DB::table('seosettings')->get();
    foreach($SEOSettings as $Settings){
    SEOMeta::setTitle(''.$Settings->sitename.' - Our Videos');
    SEOMeta::setDescription(''.$Settings->welcome.'');
    SEOMeta::setCanonical(''.$Settings->url.'/blog/videos');

    OpenGraph::setDescription(''.$Settings->welcome.''); 
    OpenGraph::setTitle(''.$Settings->sitename.' - '.$Settings->welcome.'');
    OpenGraph::setUrl(''.$Settings->url.'/blog/videos');
    OpenGraph::addProperty('type', 'articles');
    
    
    Twitter::setTitle(''.$Settings->sitename.' - '.$Settings->welcome.'');
    Twitter::setSite(''.$Settings->twitter.'');

    $videos = DB::table('videos')->paginate(6);
    $page_title = 'Videos';
    $page_name = 'Videos';
    return view('blog.videos',compact('page_title','videos','page_name'));
    }
}

}
