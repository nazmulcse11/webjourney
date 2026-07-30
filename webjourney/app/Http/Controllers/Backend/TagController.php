<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Str;

class TagController extends Controller
{
    public  function tag()
    {
        $tags = Tag::latest()->get();
        return view('backend.tag.tag',compact('tags'));
    }

    public function add_tag(Request $request)
    {
        $request->validate([
            'name'=>'required|max:191|unique:tags',
            'slug'=>'required|max:191|unique:tags',
        ]);

        Tag::create([
            'name'=>$request->name,
            'slug'=>$request->slug ?? Str::slug($request->name),
        ]);
        toastr_success(__('Tag Added Success.'));
        return redirect()->back();
    }

    //edit category
    public function edit_tag(Request $request)
    {
        $request->validate([
            'e_name'=>'required|max:191|unique:tags,name,'.$request->e_id,
            'e_slug'=>'required|max:191|unique:tags,slug,'.$request->e_id,
        ]);

        Tag::where('id',$request->e_id)->update([
            'name'=>$request->e_name,
            'slug'=>$request->e_slug ?? Str::slug($request->e_name),
        ]);
        toastr_success(__('Tag Updated Success.'));
        return redirect()->back();
    }

    public function delete_tag($id)
    {
        Tag::find($id)->delete();
        toastr_warning(__('Tag Deleted Success.'));
        return redirect()->back();
    }

}
