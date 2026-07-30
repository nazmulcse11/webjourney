<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend;


Route::get('/',[Frontend\FHomeController::class,'home_page'])->name('homepage');
Route::get('/privacy-policy',[Frontend\StaticPageController::class,'privacy_policy'])->name('privacy.policy');
Route::get('/terms-of-use',[Frontend\StaticPageController::class,'terms_of_use'])->name('terms.of.use');
Route::get('/about-us',[Frontend\StaticPageController::class,'about_us'])->name('about.us');
Route::get('/contact-us',[Frontend\StaticPageController::class,'contact_us'])->name('contact.us');
Route::post('contact/send-email',[Frontend\StaticPageController::class,'send_email'])->name('contact.email.send');
Route::get('tutorial/{category}',[Frontend\CategoryTagController::class,'category_tutorial'])->name('category.tutorial');
Route::get('tutorial/search/{tag}',[Frontend\CategoryTagController::class,'tag_tutorial'])->name('tag.tutorial');
Route::get('/{slug}',[Frontend\FHomeController::class,'post_details'])->name('post.details');
Route::get('search/header-live-search',[Frontend\FSearchController::class,'header_live_search'])->name('header.live.search');
Route::get('search/label/search-string',[Frontend\FSearchController::class,'header_click_search'])->name('header.click.search');

//Quiz

Route::group(['prefix'=>'quiz'],function(){
    Route::get('/{slug}',[Frontend\FQuizController::class,'quiz_tutorial'])->name('quiz.tutorial');
    Route::get('answer/check',[Frontend\FQuizController::class,'quiz_answer_check'])->name('quiz.answer.check');
});
//Quiz End

//Cources
Route::group(['prefix'=>'course'],function(){
    Route::get('all',[Frontend\FCourseController::class,'all_course'])->name('course.all');
    Route::get('user/details',[Frontend\FCourseController::class,'all_course'])->name('course.all');
});


Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

require_once __DIR__ . '/user.php';
require_once __DIR__ . '/admin.php';
