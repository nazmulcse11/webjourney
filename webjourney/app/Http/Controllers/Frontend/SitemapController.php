<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\QuizType;
use App\Models\Subcategory;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $posts = Post::select(['slug', 'created_at', 'updated_at'])
            ->where(['status' => 'publish', 'type' => 'post'])
            ->latest('updated_at')
            ->get();

        $categories = Category::select(['slug', 'updated_at', 'created_at'])
            ->where('status', 1)
            ->whereHas('posts')
            ->get();

        $subcategories = Subcategory::select(['slug', 'updated_at', 'created_at'])
            ->where('status', 1)
            ->whereHas('posts')
            ->get();

        $quizzes = QuizType::select(['slug', 'updated_at', 'created_at'])
            ->where('status', 1)
            ->whereHas('quizzes')
            ->get();

        $latestPostDate = optional($posts->first())->updated_at ?? optional($posts->first())->created_at ?? now();

        $xml = view('frontend.sitemap.index', compact(
            'posts',
            'categories',
            'subcategories',
            'quizzes',
            'latestPostDate'
        ))->render();

        return response($xml, 200, [
            'Content-Type' => 'application/xml; charset=UTF-8',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }

    public function feed(): Response
    {
        $posts = Post::with('categories')
            ->select(['id', 'title', 'slug', 'description', 'meta_description', 'image', 'created_at', 'updated_at'])
            ->where(['status' => 'publish', 'type' => 'post'])
            ->latest('updated_at')
            ->take(30)
            ->get();

        $latestPostDate = optional($posts->first())->updated_at ?? optional($posts->first())->created_at ?? now();

        $xml = view('frontend.sitemap.feed', compact('posts', 'latestPostDate'))->render();

        return response($xml, 200, [
            'Content-Type' => 'application/rss+xml; charset=UTF-8',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }
}
