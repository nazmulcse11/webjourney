<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ContactMessage;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class StaticPageController extends Controller
{
    public function privacy_policy()
    {
        $all_tags = Tag::whereHas('posts')->get();
        $all_categories = Category::where('status',1)
            ->whereHas('posts')
            ->latest()
            ->get();

        $popular_posts = Post::where('status','publish')
            ->orderBy('view','Desc')
            ->orderBy('like','Desc')
            ->orderBy('share','Desc')
            ->take(5)
            ->get();
        return view ('frontend.pages.privacy.privacy_policy',compact('all_tags','all_categories','popular_posts'));
    }
    public function terms_of_use()
    {
        $all_tags = Tag::whereHas('posts')->get();
        $all_categories = Category::where('status',1)
            ->whereHas('posts')
            ->latest()
            ->get();

        $popular_posts = Post::where('status','publish')
            ->orderBy('view','Desc')
            ->orderBy('like','Desc')
            ->orderBy('share','Desc')
            ->take(5)
            ->get();
        return view ('frontend.pages.terms_of_use.terms_of_use',compact('all_tags','all_categories','popular_posts'));
    }
    public function about_us()
    {
        $all_tags = Tag::whereHas('posts')->get();
        $all_categories = Category::where('status',1)
            ->whereHas('posts')
            ->latest()
            ->get();

        $popular_posts = Post::where('status','publish')
            ->orderBy('view','Desc')
            ->orderBy('like','Desc')
            ->orderBy('share','Desc')
            ->take(5)
            ->get();
        return view ('frontend.pages.about.about_us',compact('all_tags','all_categories','popular_posts'));
    }
    public function contact_us()
    {
        $all_tags = Tag::whereHas('posts')->get();
        $all_categories = Category::where('status',1)
            ->whereHas('posts')
            ->latest()
            ->get();
        $popular_posts = Post::where('status','publish')
            ->orderBy('view','Desc')
            ->orderBy('like','Desc')
            ->orderBy('share','Desc')
            ->take(5)
            ->get();
        return view ('frontend.pages.contact.contact_us',compact('all_tags','all_categories','popular_posts'));
    }

    public function send_email(Request $request)
    {
        $request->validate([
            'name'=>'required|max:50|min:2',
            'email'=>'required|email|max:100|regex:/(.+)@(.+)\.(.+)/i',
            'email'=>'regex:/^\S*$/u',
            'message'=>'required|min:20|max:500',
        ]);
         try{
            Mail::to(get_static_option('email') ?? '')->send(new ContactMessage($request->name,$request->email,$request->message));
            }catch (\Exception $e){
             //
            }
        toastr_success(__('Message Send Success.'));
        return back();
    }
}
