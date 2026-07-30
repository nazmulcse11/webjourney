<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\BasicMail;
use App\Mail\ContactMessage;
use App\Models\AddToFavourite;
use App\Models\PostComment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class UserController extends Controller
{

    public function register(Request $request)
    {
        $request->validate([
            'name'=>'required|string:max:20',
            'email'=>'required|string|max:100|email|unique:users',
            'password'=>'required|min:8|max:20',
        ]);

        if($request->password == $request->confirm_password){
            $email_verify_tokn = sprintf("%d", random_int(1234, 9999));
            User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
                'email_verify_token'=> $email_verify_tokn,
            ]);

            try{
                $title = __('Verification Code');
                $info = __('Verification Code: ').$email_verify_tokn;
                $messages = __('Bellow is your verification code. Verify your email using this code.');
                Mail::to($request->email)->send(new BasicMail($title, $info, $messages));
            }catch (\Exception $e){
             //
            }

            if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
                return redirect()->route('user.dashboard');
            }
            return redirect()->route('homepage');
        }

    }

    public function login(Request $request)
    {
        if($request->isMethod('post')){
            $request->validate([
                'email' => 'required|string',
                'password' => 'required|min:8'
            ]);
            if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password],$request->get('remember'))){
                return response()->json([
                    'msg' => __('Login Success Redirecting'),
                    'type' => 'success',
                    'status' => 'login'
                ]);
            }
            return response()->json([
                'msg' => __('Invalid email or password'),
                'type' => 'danger',
                'status' => 'wrong'
            ]);
        }
    }

    //get lost password
    public function get_lost_password(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
        ]);

        $email = User::select('email')->where('email',$request->email)->first();
        if($email){
            $password = Str::random(8);
            $new_password = Hash::make($password );
            User::where('email',$request->email)->update(['password'=>$new_password]);

            try{
                $title = __('Forgot Password');
                $info = __('New password: ').$password;
                $messages = __('Bellow is your new password. Now you can login with this password');
                Mail::to($email->email)->send(new BasicMail($title,$info,$messages));
            }catch (\Exception $e){
                //
            }

            return response()->json([
                'msg'=> '<p style="color:darkgreen;text-align: left;">'.__("New password is send to your email. If you didn't receive any email submit again for a new password.").'</p>',
            ]);
        }
        return response()->json([
            'msg'=> '<p style="color:red;text-align: left;">'.__('Email not found. Please Enter a valid email').'<p>',
        ]);
    }

    //login with facebook
    public function facebookRedirect()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function loginWithFacebook()
    {
        $user = Socialite::driver('facebook')->stateless()->user();
        $findUser = User::where('facebook_id',$user->id)->orWhere('email', $user->email)->first();
        if($findUser){
            Auth::login($findUser);
            return redirect()->route('user.dashboard');
        }else{
            $new_user = new User();
            $new_user->name = $user->name;
            $new_user->email = $user->email;
            $new_user->facebook_id = $user->id;
            $new_user->password = bcrypt('123456');
            $new_user->is_email_verify = 1;
            $new_user->save();
            Auth::login($new_user);
            return redirect()->route('user.dashboard');
        }
    }

    // login with google
    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }
    public function loginWithGoogle()
    {
        $user = Socialite::driver('google')->stateless()->user();
        $findUser = User::where('google_id',$user->id)->orWhere('email', $user->email)->first();
        if($findUser){
            Auth::login($findUser);
            return redirect()->route('user.dashboard');
        }else{
            $new_user = new User();
            $new_user->name = $user->name;
            $new_user->email = $user->email;
            $new_user->google_id = $user->id;
            $new_user->password = bcrypt('123456');
            $new_user->is_email_verify = 1;
            $new_user->save();
            Auth::login($new_user);
            return redirect()->route('user.dashboard');
        }
    }

    // login with github
    public function githubRedirect()
    {
        return Socialite::driver('github')->redirect();
    }
    public function loginWithGithub()
    {
        $user = Socialite::driver('github')->stateless()->user();
        $findUser = User::where('github_id',$user->id)->orWhere('email', $user->email)->first();
        if($findUser){
            Auth::login($findUser);
            return redirect()->route('user.dashboard');
        }else{
            $new_user = new User();
            $new_user->name = $user->name;
            $new_user->email = $user->email;
            $new_user->github_id = $user->id;
            $new_user->password = bcrypt('12345678');
            $new_user->is_email_verify = 1;
            $new_user->save();
            Auth::login($new_user);
            return redirect()->route('user.dashboard');
        }
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('homepage');
    }

    public function dashboard()
    {
        return view('frontend.pages.user.dashboard');
    }

    public function profile(Request $request)
    {
        if($request->ajax()){
            $user_id = Auth::guard('web')->user()->id;
            $request->validate([
                'name'=>'required|max:100',
                'phone'=>'required|max:20',
            ]);

            User::where('id',$user_id)->update(['name'=>$request->name,'phone'=>$request->phone]);
            return response()->json(['status'=>'success']);
        }
        return view('frontend.pages.user.profile');
    }

    public function password(Request $request)
    {
        if($request->ajax()){
            $request->validate([
                'current_password'=>'required|max:20',
                'new_password'=>'required|max:20',
                'confirm_password'=>'required|max:20',
            ]);

            $user = User::select('id','password')->where('id', Auth::user()->id)->first();

            if (Hash::check($request->current_password, $user->password)) {
                if ($request->new_password == $request->confirm_password) {
                    User::where('id',$user->id)->update(['password'=>Hash::make($request->new_password)]);
                    return response()->json(['status'=>'success']);
                }
                return response()->json(['status'=>'not_match']);
            }
            return response()->json(['status'=>'wrong']);
        }
        return view('frontend.pages.user.password');
    }

    public function favourites()
    {
        return view('frontend.pages.user.favourites');
    }

    public function courses()
    {
        return view('frontend.pages.user.courses');
    }

    public function course_playlist()
    {
        return view('frontend.pages.user.course_playlist');
    }

    public function reviews()
    {
        $reviews = PostComment::with('post')->where(['user_id' => Auth::guard('web')->user()->id])->simplePaginate(10);
        return view('frontend.pages.user.reviews',compact('reviews'));
    }

    public function remove_favourite(Request $request)
    {
        if($request->ajax()){
            if(Auth::check()){
                $user_id = Auth::guard('web')->user()->id;
                AddToFavourite::where('user_id',$user_id)->where('post_id',$request->post_id)->delete();
                return response()->json(['status'=>'remove']);
            }
        }
    }
}
