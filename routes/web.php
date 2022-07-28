<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\PageUser\CommentsController;
use App\Http\Controllers\PageUser\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();
Route::get('/',[HomeController::class,'index']);
Route::get('postView/{category_slug}',[HomeController::class,'getDetailPost']);
Route::get('categoryindex/{slug}',[HomeController::class, 'viewCategory']);

//comment
Route::post('comments',[CommentsController::class,'store']);
Route::post('delete-comment',[CommentsController::class,'deleteComments']);

Route::get('search',[HomeController::class,'viewSearch']);


    Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index']);

        Route::get('category',[CategoryController::class, 'index'])->name('category');
        Route::get('add-category',[CategoryController::class, 'create']);
        Route::post('add-category',[CategoryController::class, 'store']);
        Route::get('edit-category/{id}',[CategoryController::class,'edit']);
        Route::put('upload-category/{id}',[CategoryController::class, 'upload']);
        // Route::get('delete-category/{id}',[CategoryController::class,'destroy']);
        Route::post('delete-category',[CategoryController::class,'destroy']);

        //post
        Route::get('post',[PostController::class, 'index']);
        Route::get('add-post',[PostController::class, 'create']);
        Route::post('add-post',[PostController::class, 'store']);
        Route::get('edit-post/{id}',[PostController::class, 'edit']);
        Route::put('upload-post/{id}',[PostController::class, 'upload']);
        Route::get('delete-post/{id}',[PostController::class, 'destroy']);

        Route::get('users',[UserController::class, 'index']);
        Route::get('edit-user/{id}',[UserController::class, 'edit']);
        Route::put('upload-user/{id}',[UserController::class, 'upload']);
        Route::get('delete-user/{id}',[UserController::class,'destroy']);
    });






