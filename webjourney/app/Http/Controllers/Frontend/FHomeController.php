<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AddToFavourite;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostComment;
use App\Models\PostLike;
use App\Models\QuizType;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FHomeController extends Controller
{
    public function home_page(Request $request)
    {
        $posts = Post::select(['id','image','title','slug','description','meta_description','view','created_at','updated_at'])
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

            // Previous & Next tutorial navigation (preferring same category)
            $previous_post = Post::select('id', 'title', 'slug')
                ->where(['status' => 'publish', 'type' => 'post'])
                ->where('id', '<', $post_details->id)
                ->when(!empty($categoryIds), function ($q) use ($categoryIds) {
                    $q->whereHas('categories', function ($cq) use ($categoryIds) {
                        $cq->whereIn('categories.id', $categoryIds);
                    });
                })
                ->orderByDesc('id')
                ->first();

            if (!$previous_post) {
                $previous_post = Post::select('id', 'title', 'slug')
                    ->where(['status' => 'publish', 'type' => 'post'])
                    ->where('id', '<', $post_details->id)
                    ->orderByDesc('id')
                    ->first();
            }

            $next_post = Post::select('id', 'title', 'slug')
                ->where(['status' => 'publish', 'type' => 'post'])
                ->where('id', '>', $post_details->id)
                ->when(!empty($categoryIds), function ($q) use ($categoryIds) {
                    $q->whereHas('categories', function ($cq) use ($categoryIds) {
                        $cq->whereIn('categories.id', $categoryIds);
                    });
                })
                ->orderBy('id')
                ->first();

            if (!$next_post) {
                $next_post = Post::select('id', 'title', 'slug')
                    ->where(['status' => 'publish', 'type' => 'post'])
                    ->where('id', '>', $post_details->id)
                    ->orderBy('id')
                    ->first();
            }

            // Match the best interactive quiz for this tutorial
            $matched_quiz = $this->findMatchingQuiz($post_details);

            // Parse description for Auto-TOC anchor IDs and FAQPage JSON-LD Schema
            [$processed_description, $toc_items, $faq_items] = $this->parseDescriptionForSeo(
                (string) $post_details->description,
                (string) $post_details->title,
                (string) $post_details->slug
            );
            $post_details->description = $processed_description;

            // Merge structured admin-panel FAQs (if present)
            $custom_faqs = [];
            $rawFaqs = $post_details->faqs;
            if (is_string($rawFaqs)) {
                $rawFaqs = json_decode($rawFaqs, true);
            }
            if (is_array($rawFaqs)) {
                foreach ($rawFaqs as $item) {
                    $q = trim((string) ($item['question'] ?? ''));
                    $a = trim((string) ($item['answer'] ?? ''));
                    if ($q !== '' && $a !== '') {
                        $custom_faqs[] = [
                            'question' => $q,
                            'answer'   => $a,
                        ];
                    }
                }
            }

            if (!empty($custom_faqs)) {
                $faq_items = $custom_faqs;
                $toc_items[] = [
                    'id'    => 'post-faq-section',
                    'text'  => 'Frequently Asked Questions',
                    'level' => 2,
                ];
            }

            DB::table('posts')
                ->where('id', $post_details->id)
                ->increment('view', 1);
            return view('frontend.pages.post.post_details', compact(
                'post_details',
                'random_posts',
                'previous_post',
                'next_post',
                'matched_quiz',
                'toc_items',
                'faq_items',
                'custom_faqs'
            ));
        }
        abort(404);
    }

    private function findMatchingQuiz(Post $post): ?QuizType
    {
        $quizTypes = QuizType::where('status', 1)
            ->whereHas('quizzes', function ($q) {
                $q->where('status', 1);
            })
            ->withCount(['quizzes' => function ($q) {
                $q->where('status', 1);
            }])
            ->get();

        if ($quizTypes->isEmpty()) {
            return null;
        }

        $haystack = strtolower(
            $post->title . ' ' .
            $post->slug . ' ' .
            $post->categories->pluck('name')->implode(' ') . ' ' .
            $post->tags->pluck('name')->implode(' ')
        );

        $keywordMap = [
            'jquery'     => 'jquery',
            'select2'    => 'jquery',
            'next.js'    => 'next',
            'nextjs'     => 'next',
            'react'      => 'react',
            'typescript' => 'typescript',
            'vue'        => 'vue',
            'flutter'    => 'flutter',
            'mysql'      => 'mysql',
            'sql'        => 'mysql',
            'laragon'    => 'mysql',
            'laravel'    => 'laravel',
            'javascript' => 'javascript',
            'ajax'       => 'javascript',
            'css'        => 'css',
            'bootstrap'  => 'css',
            'html'       => 'html',
            'php'        => 'php',
        ];

        foreach ($keywordMap as $keyword => $quizSlugPart) {
            if (strpos($haystack, $keyword) !== false) {
                $found = $quizTypes->first(function ($qt) use ($quizSlugPart) {
                    return stripos($qt->slug, $quizSlugPart) !== false || stripos($qt->type, $quizSlugPart) !== false;
                });
                if ($found) {
                    return $found;
                }
            }
        }

        return $quizTypes->first(function ($qt) {
            return stripos($qt->slug, 'laravel') !== false;
        }) ?? $quizTypes->first();
    }

    private function parseDescriptionForSeo(string $html, string $title, string $slug): array
    {
        $tocItems = [];
        $faqItems = [];
        $usedIds = [];

        $ignoredHeadings = [
            'final thoughts',
            'conclusion',
            'summary',
            'tags',
            'frequently asked questions',
            'faq',
            'faqs',
        ];

        // Inject deterministic anchor IDs into h2 and h3 headings and collect TOC items
        $processedHtml = preg_replace_callback(
            '/<h([23])([^>]*)>(.*?)<\/h\1>/is',
            function ($matches) use (&$tocItems, &$usedIds, $ignoredHeadings) {
                $level = (int) $matches[1];
                $attrs = $matches[2];
                $innerHtml = $matches[3];
                $plainText = trim(html_entity_decode(strip_tags($innerHtml), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
                $plainText = preg_replace('/\s+/', ' ', $plainText);

                if ($plainText === '' || mb_strlen($plainText) < 3) {
                    return $matches[0];
                }

                if (preg_match('/\bid=["\']([^"\']+)["\']/i', $attrs, $idMatch)) {
                    $anchorId = $idMatch[1];
                } else {
                    $baseSlug = Str::slug(Str::limit($plainText, 60, ''));
                    if ($baseSlug === '') {
                        $baseSlug = 'section-' . (count($tocItems) + 1);
                    }
                    $anchorId = $baseSlug;
                    $counter = 2;
                    while (in_array($anchorId, $usedIds, true)) {
                        $anchorId = $baseSlug . '-' . $counter;
                        $counter++;
                    }
                    $attrs .= ' id="' . $anchorId . '"';
                }

                $usedIds[] = $anchorId;
                $tocItems[] = [
                    'id'    => $anchorId,
                    'text'  => $plainText,
                    'level' => $level,
                ];

                return '<h' . $level . $attrs . '>' . $innerHtml . '</h' . $level . '>';
            },
            $html
        );

        // Extract FAQ items from question headings or interview question posts
        $isInterviewOrFaqPost = stripos($slug, 'interview-question') !== false
            || stripos($title, 'interview question') !== false;

        $segments = preg_split('/(<h[23][^>]*>.*?<\/h[23]>)/is', $processedHtml, -1, PREG_SPLIT_DELIM_CAPTURE);
        $inFaqSection = false;

        for ($i = 1; $i < count($segments); $i += 2) {
            $headingHtml = $segments[$i];
            $followingHtml = $segments[$i + 1] ?? '';

            $headingText = trim(html_entity_decode(strip_tags($headingHtml), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
            $headingText = preg_replace('/\s+/', ' ', $headingText);
            $lowerHeading = strtolower($headingText);

            if (in_array($lowerHeading, ['frequently asked questions', 'faq', 'faqs'], true)) {
                $inFaqSection = true;
                continue;
            }

            if (in_array($lowerHeading, $ignoredHeadings, true)) {
                continue;
            }

            $isQuestion = substr($headingText, -1) === '?'
                || $inFaqSection
                || $isInterviewOrFaqPost
                || preg_match('/^(what|why|how|when|where|can|should|is|are|does|do)\b/i', preg_replace('/^\d+[\.\)\-\s]+/', '', $headingText));

            if ($isQuestion && mb_strlen($headingText) >= 10) {
                $answerText = trim(html_entity_decode(strip_tags($followingHtml), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
                $answerText = preg_replace('/\s+/', ' ', $answerText);
                if (mb_strlen($answerText) >= 40) {
                    $faqItems[] = [
                        'question' => $headingText,
                        'answer'   => Str::limit($answerText, 450),
                    ];
                }
            }
        }

        // Only emit FAQPage schema when there are at least 2 valid Q&As (max 10)
        if (count($faqItems) < 2) {
            $faqItems = [];
        } else {
            $faqItems = array_slice($faqItems, 0, 10);
        }

        return [$processedHtml, $tocItems, $faqItems];
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
