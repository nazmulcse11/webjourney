<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailVerifyController extends Controller
{
    public function email_verify(Request $request)
    {
        $user_details = Auth::guard('web')->user();
        if($request->isMethod('post')){

            $request->validate([
                'email_verify_token' => 'required|max:10'
            ]);

            if($request->email_verify_token == $user_details->email_verify_token){
                User::where('id',$user_details->id)->update(['is_email_verify'=>1]);
                return redirect()->route('user.dashboard');
            }
            toastr_warning('Invalid code. Please enter a valid code');
            return redirect()->back();
        }
        return view('frontend.pages.email_verify.email_verify');
    }
}
