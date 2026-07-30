<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageSettingsController extends Controller
{
    public function home_page_settings(Request $request)
    {
        if($request->isMethod('post')){
            update_static_option('keywords',$request->keywords);
            update_static_option('description',$request->description);
            toastr_success('Home page settings success');
            return back();
        }
        return view('backend.page_settings.home_page_settings');
    }

    public function contact_page_settings(Request $request)
    {
        if($request->isMethod('post')){
            update_static_option('contact_info_title',$request->contact_info_title);
            update_static_option('address',$request->address);
            update_static_option('phone',$request->phone);
            update_static_option('email',$request->email);
            update_static_option('youtube',$request->youtube);
            update_static_option('facebook',$request->facebook);
            update_static_option('linkedin',$request->linkedin);
            update_static_option('github',$request->github);
            update_static_option('stackoverflow',$request->stackoverflow);
            update_static_option('contact_message_title',$request->contact_message_title);
            toastr_success('Contact page settings success');
            return back();
        }
        return view('backend.page_settings.contact_page_settings');
    }
}
