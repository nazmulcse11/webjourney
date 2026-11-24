<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Quiz;
use App\Models\QuizType;
use Illuminate\Http\Request;

class FQuizController extends Controller
{
    public function quiz_tutorial($slug)
    {
        $type = QuizType::where('status',1)->where('slug',$slug)->first();
        if (!$type) {
            abort(404);
        }
        $quizzes = Quiz::where('quiz_type_id',$type->id)->where('status',1)->get();

        // Find related tutorials for this quiz topic to strengthen internal linking
        $topicKeyword = strtolower(explode('-', $type->slug)[0] ?? '');
        $related_posts = Post::select(['id', 'title', 'slug'])
            ->where(['status' => 'publish', 'type' => 'post'])
            ->when($topicKeyword !== '', function ($query) use ($topicKeyword) {
                $query->where(function ($q) use ($topicKeyword) {
                    $q->where('title', 'like', '%' . $topicKeyword . '%')
                      ->orWhere('slug', 'like', '%' . $topicKeyword . '%');
                });
            })
            ->orderByDesc('view')
            ->latest('updated_at')
            ->take(6)
            ->get();

        if ($related_posts->count() < 4) {
            $fallback = Post::select(['id', 'title', 'slug'])
                ->where(['status' => 'publish', 'type' => 'post'])
                ->whereNotIn('id', $related_posts->pluck('id')->toArray())
                ->orderByDesc('view')
                ->take(6 - $related_posts->count())
                ->get();
            $related_posts = $related_posts->concat($fallback);
        }

        return view('frontend.pages.quiz.html_quiz',compact('quizzes','type','related_posts'));
    }

    public function quiz_answer_check(Request $request)
    {
        if($request->ajax()){
            $quiz = Quiz::select('correct_answer','explanation')->where('id',$request->quiz_id)->first();
            $answer = Quiz::select('correct_answer')->where('id',$request->quiz_id)->where('correct_answer',$request->choose_answer)->first();
            if($answer != NULL){
                return response()->json([
                    'status'      => 'success',
                    'explanation' => $quiz->explanation,
                ]);
            }else{
                return response()->json([
                    'status'         => 'wrong',
                    'correct_answer' => $quiz->correct_answer,
                    'explanation'    => $quiz->explanation,
                ]);
            }

        }
    }
}
