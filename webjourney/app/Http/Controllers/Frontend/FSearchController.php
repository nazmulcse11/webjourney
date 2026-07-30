<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class FSearchController extends Controller
{
    public function header_live_search(Request $request)
    {
        $posts = Post::where('title', 'like', '%'.$request->search_string.'%')->where('status','publish')->orderBy('id', 'desc')->get();
        return response()->json([
            'search_result'=> view('frontend.pages.partials.live_search_result', compact('posts'))->render()
        ]);
    }

    public function header_click_search(Request $request)
    {
        $posts = Post::where('title', 'like', '%'.$request->search_string.'%')->where('status','publish')->orderBy('id', 'desc')->paginate(8);
        return view('frontend.pages.search.search', compact('posts'));
    }
}
