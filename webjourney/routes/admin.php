<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend;

Route::group(['prefix'=>'admin', 'as'=>'admin.'],function(){
    Route::match(['get','post'],'login/ab/cd/ef/nazmul',[Backend\AdminController::class,'login'])->name('login');

    Route::group(['middleware'=>'admin'],function(){
        Route::get('logout',[Backend\AdminController::class,'logout'])->name('logout');
        Route::get('dashboard',[Backend\DashboardController::class,'dashboard'])->name('dashboard');
        Route::get('dashboard/realtime-data',[Backend\DashboardController::class,'realtime_data'])->name('dashboard.realtime');

        Route::group(['prefix'=>'category'],function(){
            Route::get('/',[Backend\CategoryController::class,'category'])->name('category');
            Route::post('add-category',[Backend\CategoryController::class,'add_category'])->name('add.category');
            Route::post('edit-category',[Backend\CategoryController::class,'edit_category'])->name('edit.category');
            Route::post('delete-category/{id}',[Backend\CategoryController::class,'delete_category'])->name('delete.category');
            Route::post('change-category-status/{id}',[Backend\CategoryController::class,'change_category_status'])->name('status.category');
        });

        Route::group(['prefix'=>'subcategory'],function(){
            Route::get('/',[Backend\SubCategoryController::class,'sub_category'])->name('subcategory');
            Route::post('add-sub-category',[Backend\SubCategoryController::class,'add_sub_category'])->name('add.subcategory');
            Route::post('edit-sub-category',[Backend\SubCategoryController::class,'edit_sub_category'])->name('edit.subcategory');
            Route::post('delete-sub-category/{id}',[Backend\SubCategoryController::class,'delete_sub_category'])->name('delete.subcategory');
            Route::post('change-sub-category-status/{id}',[Backend\SubCategoryController::class,'change_sub_category_status'])->name('status.subcategory');
        });

        Route::group(['prefix'=>'tag'],function(){
            Route::get('/',[Backend\TagController::class,'tag'])->name('tag');
            Route::post('add-tag',[Backend\TagController::class,'add_tag'])->name('add.tag');
            Route::post('edit-tag',[Backend\TagController::class,'edit_tag'])->name('edit.tag');
            Route::post('delete-tag/{id}',[Backend\TagController::class,'delete_tag'])->name('delete.tag');
        });

        Route::group(['prefix'=>'post'],function(){
            Route::get('/',[Backend\PostController::class,'post'])->name('post');
            Route::match(['get','post'],'add-post',[Backend\PostController::class,'add_post'])->name('add.post');
            Route::match(['get','post'],'edit-post/{id?}',[Backend\PostController::class,'edit_post'])->name('edit.post');
            Route::post('change-post-status/{id}',[Backend\PostController::class,'change_post_status'])->name('status.post');
            Route::post('delete-post/{id}',[Backend\PostController::class,'delete_post'])->name('delete.post');
            Route::get('comments',[Backend\PostController::class,'comments'])->name('post.comment');
            Route::post('change-comment-status/{id}',[Backend\PostController::class,'change_comment_status'])->name('status.comment');
            Route::post('delete-comment/{id}',[Backend\PostController::class,'delete_comment'])->name('delete.comment');
            Route::post('reply-comment',[Backend\PostController::class,'reply_comment'])->name('reply.comment');
        });

        Route::group(['prefix'=>'quiz'],function(){
            Route::get('/',[Backend\QuizController::class,'quiz'])->name('quiz');
            Route::match(['get','post'],'add-quiz',[Backend\QuizController::class,'add_quiz'])->name('add.quiz');
            Route::match(['get','post'],'edit-quiz/{id?}',[Backend\QuizController::class,'edit_quiz'])->name('edit.quiz');
            Route::post('change-quiz-status/{id}',[Backend\QuizController::class,'change_quiz_status'])->name('status.quiz');
            Route::post('delete-quiz/{id}',[Backend\QuizController::class,'delete_quiz'])->name('delete.quiz');

            Route::get('/type',[Backend\QuizController::class,'type'])->name('type');
            Route::match(['get','post'],'type/add',[Backend\QuizController::class,'add_type'])->name('add.type');
            Route::match(['get','post'],'type/edit/{id?}',[Backend\QuizController::class,'edit_type'])->name('edit.type');
            Route::post('type/status/{id}',[Backend\QuizController::class,'change_type_status'])->name('status.type');
            Route::post('type/delete/{id}',[Backend\QuizController::class,'delete_type'])->name('delete.type');
        });

        Route::group(['prefix'=>'course'],function(){
            Route::get('/',[Backend\CourseController::class,'course'])->name('course');
            Route::match(['get','post'],'add-course',[Backend\CourseController::class,'add_course'])->name('add.course');
            Route::match(['get','post'],'edit-course/{id?}',[Backend\CourseController::class,'edit_course'])->name('edit.course');
            Route::post('change-course-status/{id}',[Backend\CourseController::class,'change_course_status'])->name('status.course');
            Route::post('delete-course/{id}',[Backend\CourseController::class,'delete_course'])->name('delete.course');
//            Route::get('comments',[Backend\CourseController::class,'comments'])->name('post.comment');
//            Route::post('change-comment-status/{id}',[Backend\CourseController::class,'change_comment_status'])->name('status.comment');
//            Route::post('delete-comment/{id}',[Backend\CourseController::class,'delete_comment'])->name('delete.comment');
        });

        //page settings
        Route::group(['prefix'=>'settings'],function(){
            Route::match(['get','post'],'contact-page-settings',[Backend\PageSettingsController::class,'contact_page_settings'])->name('settings.contact.page');
            Route::match(['get','post'],'home-page-settings',[Backend\PageSettingsController::class,'home_page_settings'])->name('settings.home.page');
        });

    });

});
