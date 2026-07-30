<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Str;
use File;


class CategoryController extends Controller
{
    public  function category()
    {
        $categories = Category::with('sub_categories')->latest()->get();
        return view('backend.category.category',compact('categories'));
    }

    public function add_category(Request $request)
    {
        $request->validate([
            'name'=>'required|max:191|unique:categories',
            'slug'=>'required|max:191|unique:categories'
        ]);

        $imageName = '';
        if ($image = $request->file('image')) {
            $imageName = time().'-'.uniqid().'.'.$image->getClientOriginalExtension();
            $image->move('images/category', $imageName);
        }

        Category::create([
            'name'=>$request->name,
            'slug'=>$request->slug ?? Str::slug($request->name),
            'image'=>$imageName,
        ]);
        toastr_success(__('Category Added Success.'));
        return redirect()->back();
    }

    //edit category
    public function edit_category(Request $request)
    {
        $request->validate([
            'e_name'=>'required|max:191|unique:categories,name,'.$request->e_id,
            'e_slug'=>'required|max:191|unique:categories,slug,'.$request->e_id,
        ]);

        $category = Category::find($request->e_id);
        $deleteOldImg =  'images/category/'.$category->image;

        if ($image = $request->file('e_image')) {
            if(file_exists($deleteOldImg)){
                File::delete($deleteOldImg);
            }
            $imageName = time().'-'.uniqid().'.'.$image->getClientOriginalExtension();
            $image->move('images/category', $imageName);
        }else{

            $imageName = $category->image ?? '';
        }

        Category::where('id',$request->e_id)->update([
            'name'=>$request->e_name,
            'slug'=>$request->e_slug ?? Str::slug($request->e_name),
            'image'=>$imageName,
        ]);
        toastr_success(__('Category Updated Success.'));
        return redirect()->back();
    }

    public function delete_category($id)
    {
        $category = Category::find($id);
        $deleteImg =  'images/category/'.$category->image;
        if(file_exists($deleteImg)){
            File::delete($deleteImg);
        }
        $category->delete();

        toastr_warning(__('Category Deleted Success.'));
        return redirect()->back();
    }

    public function change_category_status($id)
    {
        $status = Category::find($id);
        Category::where('id',$id)->update([
            'status'=>$status->status == 0 ? 1 : 0,
        ]);
        toastr_success(__('Status Change Success.'));
        return redirect()->back();
    }
}
