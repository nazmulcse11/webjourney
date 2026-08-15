<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Quiz;
use App\Models\QuizType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class QuizController extends Controller
{
    public  function quiz()
    {
        $quizzes = Quiz::latest()->get();
        return view('backend.quiz.quiz',compact('quizzes'));
    }

    public function add_quiz(Request $request)
    {
        if($request->isMethod('post')){
            $request->validate([
                'title'=>'required|unique:quizzes',
                'quiz_type_id'=>'required',
                'option_a'=>'required',
                'option_b'=>'required',
                'option_c'=>'required',
                'option_d'=>'required',
                'correct_answer'=>'required',
            ]);

            Quiz::create([
                'title'        => $request->title,
                'quiz_type_id' => $request->quiz_type_id,
                'option_a'     => $request->option_a,
                'option_b'     => $request->option_b,
                'option_c'     => $request->option_c,
                'option_d'     => $request->option_d,
                'correct_answer' => $request->correct_answer,
                'explanation'  => $request->explanation,
            ]);
            toastr_success(__('Quiz Added Success.'));
            return redirect()->back();
        }
        $types = QuizType::where('status',1)->get();
        return view('backend.quiz.add_quiz',compact('types'));
    }

    public function edit_quiz(Request $request,$id)
    {
        if($request->isMethod('post')){
            $request->validate([
                'title'=>'required|string|unique:quizzes,title,'.$id,
                'quiz_type_id'=>'required',
                'option_a'=>'required',
                'option_b'=>'required',
                'option_c'=>'required',
                'option_d'=>'required',
                'correct_answer'=>'required',
            ]);

            Quiz::where('id',$id)->update([
                'title'        => $request->title,
                'quiz_type_id' => $request->quiz_type_id,
                'option_a'     => $request->option_a,
                'option_b'     => $request->option_b,
                'option_c'     => $request->option_c,
                'option_d'     => $request->option_d,
                'correct_answer' => $request->correct_answer,
                'explanation'  => $request->explanation,
            ]);
            toastr_success(__('Quiz Updated Success.'));
            return redirect()->back();
        }
        $quiz = Quiz::find($id);
        $types = QuizType::where('status',1)->get();
        return view('backend.quiz.edit_quiz',compact('quiz','types'));
    }

    public function delete_quiz($id)
    {
        Quiz::find($id)->delete();
        toastr_warning(__('Quiz Deleted Success.'));
        return redirect()->back();
    }

    public function change_quiz_status($id)
    {
        $status = Quiz::find($id);
        Quiz::where('id',$id)->update([
            'status'=>$status->status == 0 ? 1 : 0,
        ]);
        toastr_success(__('Status Change Success.'));
        return redirect()->back();
    }

    public  function type()
    {
        $types = QuizType::latest()->get();
        return view('backend.quiz_type.type',compact('types'));
    }

    public function add_type(Request $request)
    {
        if($request->isMethod('post')){
            $request->validate([
                'type'=>'required',
                'slug'=>'required',
            ]);
            QuizType::create([
                'type'        => $request->type,
                'slug'        => $request->slug,
                'description' => $request->description,
            ]);
            toastr_success(__('Type Added Success.'));
            return redirect()->route('admin.type');
        }
        return view('backend.quiz_type.add_type');
    }

    public function edit_type(Request $request,$id)
    {
        if($request->isMethod('post')){
            $request->validate([
                'type'=>'required',
                'slug'=>'required',
            ]);

            QuizType::where('id',$id)->update([
                'type'        => $request->type,
                'slug'        => $request->slug,
                'description' => $request->description,
            ]);
            toastr_success(__('Type Updated Success.'));
            return redirect()->route('admin.type');
        }
        $type = QuizType::find($id);
        return view('backend.quiz_type.edit_type',compact('type'));
    }

    public function delete_type($id)
    {
        QuizType::find($id)->delete();
        toastr_warning(__('Type Deleted Success.'));
        return redirect()->back();
    }

    public function change_type_status($id)
    {
        $status = QuizType::find($id);
        QuizType::where('id',$id)->update([
            'status'=>$status->status == 0 ? 1 : 0,
        ]);
        toastr_success(__('Status Change Success.'));
        return redirect()->back();
    }
}
