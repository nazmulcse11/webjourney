<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend;

Route::group(['prefix'=>'user'],function(){
    Route::post('register',[Frontend\UserController::class,'register'])->name('user.register');
    Route::post('login', [Frontend\UserController::class, 'login'])->name('user.login');
    Route::post('get-lost-password', [Frontend\UserController::class, 'get_lost_password'])->name('user.get.lost.password');
});

//social login
Route::get('login/facebook',[Frontend\UserController::class,'facebookRedirect'])->name('facebook.login');
Route::get('login/facebook/callback',[Frontend\UserController::class,'loginWithFacebook'])->name('facebook.callback');;
Route::get('login/google',[Frontend\UserController::class,'googleRedirect'])->name('google.login');
Route::get('login/google/callback',[Frontend\UserController::class,'loginWithGoogle'])->name('google.callback');
Route::get('login/github',[Frontend\UserController::class,'githubRedirect'])->name('github.login');
Route::get('login/github/callback',[Frontend\UserController::class,'loginWithGithub'])->name('github.callback');

Route::match(['get','post'],'user/email/verify',[Frontend\EmailVerifyController::class,'email_verify'])->name('email.verify');

Route::group(['middleware'=>['auth','user.email.verify']],function(){
    Route::group(['prefix'=>'user'],function(){
        Route::get('logout',[Frontend\UserController::class,'logout'])->name('user.logout');
        Route::get('dashboard',[Frontend\UserController::class,'dashboard'])->name('user.dashboard');
        Route::match(['get','post'],'profile',[Frontend\UserController::class,'profile'])->name('user.profile');
        Route::match(['get','post'],'password',[Frontend\UserController::class,'password'])->name('user.password');
        Route::get('favourites',[Frontend\UserController::class,'favourites'])->name('user.favourites');
        Route::post('remove/favourites',[Frontend\UserController::class,'remove_favourite'])->name('remove.from.favourite');
        Route::get('courses',[Frontend\UserController::class,'courses'])->name('user.courses');
        Route::get('course/playlist',[Frontend\UserController::class,'course_playlist'])->name('user.course.playlist');
        Route::get('reviews',[Frontend\UserController::class,'reviews'])->name('user.reviews');
    });

    Route::group(['prefix'=>'post'],function(){
        Route::post('like',[Frontend\FHomeController::class,'post_like'])->name('post.like');
        Route::post('add-to-favourite',[Frontend\FHomeController::class,'add_to_favourite'])->name('add.to.favourite');
        Route::post('add-comment',[Frontend\FHomeController::class,'add_comment'])->name('add.comment');
    });
});
