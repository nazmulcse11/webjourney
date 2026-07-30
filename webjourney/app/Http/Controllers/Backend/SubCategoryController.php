<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Str;
use File;

class SubCategoryController extends Controller
{
    public  function sub_category()
    {
        $sub_categories = Subcategory::latest()->get();
        $categories = Category::where('status',1)->latest()->get();
        return view('backend.subcategory.subcategory',compact('sub_categories','categories'));
    }

    public function add_sub_category(Request $request)
    {
        $request->validate([
            'name'=>'required|max:191|unique:subcategories',
            'category_id'=>'required',
            'slug'=>'required|max:191|unique:subcategories',
        ]);
        $imageName = '';

        if ($image = $request->file('image')) {
            $imageName = time().'-'.uniqid().'.'.$image->getClientOriginalExtension();
            $image->move('images/subcategory', $imageName);
        }

        Subcategory::create([
            'name'=>$request->name,
            'slug'=>$request->slug ?? Str::slug($request->name),
            'category_id'=>$request->category_id,
            'image'=>$imageName,
        ]);
        toastr_success(__('Sub Category Added Success.'));
        return redirect()->back();
    }

    //edit category
    public function edit_sub_category(Request $request)
    {
        $request->validate([
            'e_name'=>'required|max:191|unique:subcategories,name,'.$request->e_id,
            'e_slug'=>'required|max:191|unique:subcategories,slug,'.$request->e_id,
            'e_category_id'=>'required',
        ]);

        $sub_category = Subcategory::find($request->e_id);
        $deleteOldImg =  'images/subcategory/'.$sub_category->image;

        if ($image = $request->file('e_image')) {
            if(file_exists($deleteOldImg)){
                File::delete($deleteOldImg);
            }
            $imageName = time().'-'.uniqid().'.'.$image->getClientOriginalExtension();
            $image->move('images/subcategory', $imageName);
        }else{
            $imageName = $sub_category->image ?? '';
        }

        Subcategory::where('id',$request->e_id)->update([
            'name'=>$request->e_name,
            'slug'=>$request->e_slug ?? Str::slug($request->e_name),
            'category_id'=>$request->e_category_id,
            'image'=>$imageName,
        ]);
        toastr_success(__('Sub Category Updated Success.'));
        return redirect()->back();
    }

    public function delete_sub_category($id)
    {
        $sub_category = Subcategory::find($id);
        $deleteImg =  'images/subcategory/'.$sub_category->image;
        if(file_exists($deleteImg)){
            File::delete($deleteImg);
        }
        $sub_category->delete();
        toastr_warning(__('Sub Category Deleted Success.'));
        return redirect()->back();
    }

    public function change_sub_category_status($id)
    {
        $status = Subcategory::find($id);
        Subcategory::where('id',$id)->update([
            'status'=>$status->status == 0 ? 1 : 0,
        ]);
        toastr_success(__('Status Change Success.'));
        return redirect()->back();
    }
}
