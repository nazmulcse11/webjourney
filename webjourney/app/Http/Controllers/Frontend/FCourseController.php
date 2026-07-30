<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class FCourseController extends Controller
{
    public function all_course()
    {
        $courses = Course::where('status','publish')->get();
        return view('frontend.pages.course.all_course',compact('courses'));
    }
}
