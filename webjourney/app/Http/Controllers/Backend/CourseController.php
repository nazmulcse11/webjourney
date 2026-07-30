<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Post;
use App\Models\PostComment;
use App\Models\Subcategory;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use File;

class CourseController extends Controller
{
    public function course()
    {
        $courses = Course::with('categories','sub_categories')
            ->latest()
            ->get();
        return view('backend.course.course',compact('courses'));
    }
    public function add_course(Request $request)
    {
        if($request->isMethod('post')){
            $request->validate([
                'title'=>'required|max:191|unique:posts',
                'slug'=>'required|max:191|unique:posts',
                'price'=>'required',
                'description'=>'required',
                'meta_title'=>'string|max:191',
                'meta_description'=>'max:500',
                'status'=>'required',
                'type'=>'required',
            ]);

            $imageName = '';
            if ($image = $request->file('image')) {
                $imageName = time().'-'.uniqid().'.'.$image->getClientOriginalExtension();
                $image->move('images/course', $imageName);
            }

            $post = Course::create([
                'title'=>$request->title,
                'slug'=>$request->slug ?? Str::slug($request->title),
                'price'=>$request->price,
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

            toastr_success(__('Course Added Success.'));
            return redirect()->back();
        }
        $categories = Category::where('status',1)->latest()->get();
        $sub_categories = Subcategory::where('status',1)->latest()->get();
        $tags = Tag::latest()->get();
        return view('backend.course.add_course',compact('categories','sub_categories','tags'));
    }

    //edit post
    public function edit_course(Request $request,$id=null)
    {
        $course = Course::findOrFail($id);

        if($request->isMethod('post')){
            $request->validate([
                'title'=>'required|max:191|unique:posts,title,'.$id,
                'slug'=>'required|max:191|unique:posts,slug,'.$id,
                'price'=>'required',
                'description'=>'required',
                'meta_title'=>'string|max:191',
                'meta_description'=>'max:500',
                'status'=>'required',
                'type'=>'required',
            ]);

            $imageName = '';
            $deleteOldImg =  'images/course/'.$course->image;
            if ($image = $request->file('image')) {
                if(file_exists($deleteOldImg)){
                    File::delete($deleteOldImg);
                }
                $imageName = time().'-'.uniqid().'.'.$image->getClientOriginalExtension();
                $image->move('images/course', $imageName);
            }else{
                $imageName = $course->image;
            }

            Course::where('id',$id)->update([
                'title'=>$request->title,
                'slug'=>Str::slug($request->slug),
                'price'=>$request->price,
                'type'=>$request->type,
                'image'=>$imageName,
                'meta_title'=>$request->meta_title,
                'meta_description'=>$request->meta_description,
                'description'=>$request->description,
                'admin_id'=>Auth::guard('admin')->user()->id,
                'status'=>$request->status,
                'video'=>$request->video,
            ]);
            $course->categories()->sync($request->category);
            $course->sub_categories()->sync($request->subcategory);
            $course->tags()->sync($request->tag);

            toastr_success(__('Course Updated Success.'));
            return redirect()->back();
        }
        $categories = Category::where('status',1)->latest()->get();
        $sub_categories = Subcategory::where('status',1)->latest()->get();
        $tags = Tag::latest()->get();
        return view('backend.course.edit_course',compact('course','categories','sub_categories','tags'));
    }

    public function change_course_status($id)
    {
        $status = Course::find($id);
        Course::where('id',$id)->update([
            'status'=>$status->status == 'premium' ? 'free' : 'premium',
        ]);
        toastr_success(__('Status Change Success.'));
        return redirect()->back();
    }

    public function delete_course($id)
    {
        $course = Course::find($id);
        $deleteImg =  'images/course/'.$course->image;
        if (file_exists($deleteImg)) {
            File::delete($deleteImg);
        }
        $course->categories()->detach();
        $course->sub_categories()->detach();
        $course->tags()->detach();
        $course->delete();

        toastr_warning(__('Course Deleted Success'));
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
}
