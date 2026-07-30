<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;


class AdminController extends Controller
{
    public function login(Request $request)
    {
        if($request->isMethod('Post')){
            $this->validate($request, [
                'email' => 'required|string',
                'password' => 'required|min:8'
            ], [
                'email.required' => __('Email is required'),
                'password.required' => __('Password is required')
            ]);

            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
                return response()->json([
                    'msg' => __('Login Success Redirecting'),
                    'type' => 'success',
                    'status' => 'ok'
                ]);
            }
            return response()->json([
                'msg' => __('Email or Password Is Wrong !!'),
                'type' => 'danger',
                'status' => 'not_ok'
            ]);
        }
        return view('backend.admin.login');
    }

    //admin logout
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
