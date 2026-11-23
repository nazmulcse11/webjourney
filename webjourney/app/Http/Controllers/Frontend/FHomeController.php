<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AddToFavourite;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostComment;
use App\Models\PostLike;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FHomeController extends Controller
{
    public function home_page(Request $request)
    {
        $posts = Post::with(['post_like','comments','post_favourite'])
            ->select(['id','image','title','slug','description','meta_description','view','created_at','updated_at'])
            ->where(['status'=>'publish','type'=>'post'])
            ->latest()->paginate(8);

        if ($request->ajax()) {
            return view('frontend.pages.partials.post_markup', compact('posts'))->render();
        }

        return view('frontend.pages.home.home',compact('posts'));
    }

    public function post_like(Request $request){
        if($request->ajax()){
            if(Auth::check()){
                $user_id = Auth::guard('web')->user()->id;
                $like_count = PostLike::where('user_id',$user_id)->where('post_id',$request->post_id)->count();

                if($like_count === 0){
                    PostLike::Create([
                        'post_id'=>$request->post_id,
                        'user_id'=>$user_id,
                    ]);
                    $total_like_count = PostLike::where('post_id',$request->post_id)->count();
                    return response()->json(['status'=>'liked','total_like_count'=>$total_like_count]);
                }else{
                    PostLike::where('user_id',$user_id)->where('post_id',$request->post_id)->delete();
                    $total_like_count = PostLike::where('post_id',$request->post_id)->count();
                    return response()->json(['status'=>'unliked','total_like_count'=>$total_like_count]);
                }

            }
            return response()->json(['status'=>'unauthenticated']);
        }
    }

    public function add_to_favourite(Request $request){
        if($request->ajax()){
            if(Auth::check()){
                $user_id = Auth::guard('web')->user()->id;
                $favourite_count = AddToFavourite::where('user_id',$user_id)->where('post_id',$request->post_id)->count();

                if($favourite_count === 0){
                    AddToFavourite::Create([
                        'post_id'=>$request->post_id,
                        'user_id'=>$user_id,
                    ]);
                    $total_favourite_count = AddToFavourite::where('post_id',$request->post_id)->count();
                    $total_favourite_count_single_user = AddToFavourite::where('user_id',$user_id)->count();
                    return response()->json([
                        'status'=>'add',
                        'total_favourite_count'=>$total_favourite_count,
                        'total_favourite_count_single_user'=>$total_favourite_count_single_user,
                    ]);
                }else{
                    AddToFavourite::where('user_id',$user_id)->where('post_id',$request->post_id)->delete();
                    $total_favourite_count = AddToFavourite::where('post_id',$request->post_id)->count();
                    $total_favourite_count_single_user = AddToFavourite::where('user_id',$user_id)->count();

                    return response()->json([
                        'status'=>'remove',
                        'total_favourite_count'=>$total_favourite_count,
                        'total_favourite_count_single_user'=>$total_favourite_count_single_user,
                    ]);
                }

            }
            return response()->json(['status'=>'unauthenticated']);
        }
    }

    public function post_details($slug)
    {
        $post_details = Post::with('categories','tags','post_like','post_favourite','comments')
            ->where(['status'=>'publish','type'=>'post'])
            ->where('slug',$slug)
            ->first();

        if($post_details){
            $categoryIds = $post_details->categories->pluck('id')->toArray();
            $tagIds = $post_details->tags->pluck('id')->toArray();

            $random_posts = Post::select('id', 'title', 'slug')
                ->where('id', '!=', $post_details->id)
                ->where(['status'=>'publish','type'=>'post'])
                ->when(!empty($categoryIds) || !empty($tagIds), function ($query) use ($categoryIds, $tagIds) {
                    $query->where(function ($q) use ($categoryIds, $tagIds) {
                        if (!empty($categoryIds)) {
                            $q->whereHas('categories', function ($cq) use ($categoryIds) {
                                $cq->whereIn('categories.id', $categoryIds);
                            });
                        }
                        if (!empty($tagIds)) {
                            $q->orWhereHas('tags', function ($tq) use ($tagIds) {
                                $tq->whereIn('tags.id', $tagIds);
                            });
                        }
                    });
                })
                ->orderByDesc('view')
                ->latest('updated_at')
                ->take(6)
                ->get();

            if ($random_posts->count() < 5) {
                $excludeIds = array_merge([$post_details->id], $random_posts->pluck('id')->toArray());
                $fallback_posts = Post::select('id', 'title', 'slug')
                    ->whereNotIn('id', $excludeIds)
                    ->where(['status'=>'publish','type'=>'post'])
                    ->orderByDesc('view')
                    ->latest('updated_at')
                    ->take(5 - $random_posts->count())
                    ->get();
                $random_posts = $random_posts->concat($fallback_posts);
            }

            DB::table('posts')
                ->where('id', $post_details->id)
                ->increment('view', 1);
            return view('frontend.pages.post.post_details',compact('post_details','random_posts'));
        }
        abort(404);
    }

    public function add_comment(Request $request)
    {
        $request->validate([
            'comment'=>'required|min:5|max:300'
        ]);
        PostComment::create([
            'user_id' => Auth::guard('web')->user()->id,
            'post_id' => $request->post_id,
            'comment' => $request->comment,
            'status' => 0,
        ]);
        toastr_success('Thanks for your review. Please wait for approval');
        return back();
    }

}
