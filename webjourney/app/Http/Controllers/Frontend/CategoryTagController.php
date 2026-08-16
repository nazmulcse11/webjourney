<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class CategoryTagController extends Controller
{
    public function category_tutorial($slug)
    {
        $category = Category::where('slug',$slug)->first();
        if($category){
            $posts = $category->posts()->status()->paginate(8);
            return view('frontend.pages.category.post_by_category',compact('posts','category'));
        }
        abort(404);
    }

    public function subcategory_tutorial($slug)
    {
        $subcategory = Subcategory::where('slug',$slug)->first();
        if($subcategory){
            $posts = $subcategory->posts()->status()->paginate(8);
            return view('frontend.pages.category.post_by_subcategory',compact('posts','subcategory'));
        }
        abort(404);
    }

    public function tag_tutorial($slug)
    {
        $tag = Tag::where('slug',$slug)->first();
        $posts = $tag->posts()->status()->paginate(8);
        return view('frontend.pages.tag.post_by_tag',compact('posts','tag'));

    }
}
