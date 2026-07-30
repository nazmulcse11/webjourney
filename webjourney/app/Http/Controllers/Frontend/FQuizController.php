<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\QuizType;
use Illuminate\Http\Request;

class FQuizController extends Controller
{
    public function quiz_tutorial($slug)
    {
        $type = QuizType::where('status',1)->where('slug',$slug)->first();
        $quizzes = Quiz::where('quiz_type_id',$type->id)->where('status',1)->get();
        return view('frontend.pages.quiz.html_quiz',compact('quizzes','type'));
    }

    public function quiz_answer_check(Request $request)
    {
        if($request->ajax()){
            $correct_answer = Quiz::select('correct_answer')->where('id',$request->quiz_id)->first();
            $answer = Quiz::select('correct_answer')->where('id',$request->quiz_id)->where('correct_answer',$request->choose_answer)->first();
            if($answer != NULL){
                return response()->json([
                    'status'=>'success',
                    'answer'=>$answer,
                ]);
            }else{
                return response()->json([
                    'status'=>'wrong',
                    'correct_answer'=>$correct_answer->correct_answer,
                ]);
            }

        }
    }
}
