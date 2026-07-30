<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CommentReply;
use App\Models\Post;
use App\Models\PostComment;
use App\Models\Subcategory;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use File;


class PostController extends Controller
{
    public function post()
    {
        $posts = Post::with('categories','sub_categories')
            ->latest()
            ->get();
        return view('backend.post.post',compact('posts'));
    }
    public function add_post(Request $request)
    {
        if($request->isMethod('post')){
            $request->validate([
                'title'=>'required|max:191|unique:posts',
                'slug'=>'required|max:191|unique:posts',
                'description'=>'required',
                'meta_title'=>'string|max:191',
                'meta_description'=>'max:500',
                'status'=>'required',
                'type'=>'required',
            ]);

            $imageName = '';
            if ($image = $request->file('image')) {
                $filename = $request->image->getClientOriginalName();
                $imageName = $filename.'-'.time().'-'.uniqid().'.'.$image->getClientOriginalExtension();
                $image->move('images/post', $imageName);
            }

            $post = Post::create([
                'title'=>$request->title,
                'slug'=>$request->slug ?? Str::slug($request->title),
                'type'=>$request->type,
                'image'=>$imageName,
                'meta_title'=>$request->meta_title,
                'meta_description'=>$request->meta_description,
                'description'=>$request->description,
                'admin_id'=>Auth::guard('admin')->user()->id,
                'status'=>$request->status,
                'video'=>$request->video,
            ]);
            $post->categories()->attach($request->category);
            $post->sub_categories()->attach($request->sub_category);
            $post->tags()->attach($request->tag);

            toastr_success(__('Post Added Success.'));
            return redirect()->back();
        }
        $categories = Category::where('status',1)->latest()->get();
        $sub_categories = Subcategory::where('status',1)->latest()->get();
        $tags = Tag::latest()->get();
        return view('backend.post.add_post',compact('categories','sub_categories','tags'));
    }

    //edit post
    public function edit_post(Request $request,$id=null)
    {
        $post = Post::findOrFail($id);

        if($request->isMethod('post')){
            $request->validate([
                'title'=>'required|max:191|unique:posts,title,'.$id,
                'slug'=>'required|max:191|unique:posts,slug,'.$id,
                'description'=>'required',
                'meta_title'=>'string|max:191',
                'meta_description'=>'max:500',
                'status'=>'required',
                'type'=>'required',
            ]);

            $imageName = '';
            $deleteOldImg =  'images/post/'.$post->image;
            if ($image = $request->file('image')) {
                if(file_exists($deleteOldImg)){
                    File::delete($deleteOldImg);
                }
                $filename = $request->image->getClientOriginalName();
                $imageName = $filename.'-'.time().'-'.uniqid().'.'.$image->getClientOriginalExtension();
                $image->move('images/post', $imageName);
            }else{
                $imageName = $post->image;
            }

            Post::where('id',$id)->update([
                'title'=>$request->title,
                'slug'=>Str::slug($request->slug),
                'type'=>$request->type,
                'image'=>$imageName,
                'meta_title'=>$request->meta_title,
                'meta_description'=>$request->meta_description,
                'description'=>$request->description,
                'admin_id'=>Auth::guard('admin')->user()->id,
                'status'=>$request->status,
                'video'=>$request->video,
            ]);
            $post->categories()->sync($request->category);
            $post->sub_categories()->sync($request->subcategory);
            $post->tags()->sync($request->tag);

            toastr_success(__('Post Updated Success.'));
            return redirect()->back();
        }
        $categories = Category::where('status',1)->latest()->get();
        $sub_categories = Subcategory::where('status',1)->latest()->get();
        $tags = Tag::latest()->get();
        return view('backend.post.edit_post',compact('post','categories','sub_categories','tags'));
    }

    public function change_post_status($id)
    {
        $status = Post::find($id);
        Post::where('id',$id)->update([
            'status'=>$status->status == 'publish' ? 'draft' : 'publish',
        ]);
        toastr_success(__('Status Change Success.'));
        return redirect()->back();
    }

    public function delete_post($id)
    {
        $post = Post::find($id);
        $deleteImg =  'images/post/'.$post->image;
        if (file_exists($deleteImg)) {
            File::delete($deleteImg);
        }
        $post->categories()->detach();
        $post->sub_categories()->detach();
        $post->tags()->detach();
        $post->delete();

        toastr_warning(__('Post Deleted Success'));
        return redirect()->back();
    }

    //post comments
    public function comments()
    {
        $comments = PostComment::with('post')->orderBy('id','Desc')->get();
        return view('backend.post.comments',compact('comments'));
    }

    public function change_comment_status($id)
    {
        $status = PostComment::find($id);
        PostComment::where('id',$id)->update([
            'status'=>$status->status == 1 ? 0 : 1,
        ]);
        toastr_success(__('Status Change Success.'));
        return redirect()->back();
    }

    public function delete_comment($id)
    {
        PostComment::find($id)->delete();
        toastr_warning(__('Post Deleted Success'));
        return redirect()->back();
    }

    public function reply_comment(Request $request)
    {
        $request->validate([
            'reply'=>'required',
        ]);
        CommentReply::create([
            'post_comment_id'=>$request->comment_id,
            'reply'=>$request->reply,
        ]);
        toastr_success(__('Reply Send Success.'));
        return redirect()->back();
    }
}
