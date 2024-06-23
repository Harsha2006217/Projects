<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\postCommentsController;
use App\Http\Controllers\NewsLetterController;
use App\Http\Controllers\AdminPostController;

// This is my web folder and contains all routes

Route::get('/', [PostController::class, 'index'])->name('home');

Route::get('posts/{post:slug}', [PostController::class, 'show'])->where('posts','[A-z_\-]+');
Route::post('posts/{post:slug}/comments', [postCommentsController::class, 'store'])->middleware('throttle:5,1');

Route::get('register', [RegisterController::class, 'create'])->middleware('guest')->middleware('throttle:5,1');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest')->middleware('throttle:5,1');

Route::post('sessions', [SessionController::class, 'store'])->middleware('guest');
Route::get('login', [SessionController::class, 'create'])->middleware('guest')->middleware('throttle:5,1');

Route::post('newsletter', [NewsLetterController::class]);

Route::middleware('can:admin')->group(function () {
    Route::post('admin/posts', [AdminPostController::class, 'store']); //!!! TODO verwijder code en route
    Route::get('admin/posts/create', [AdminPostController::class, 'create']); //!!! TODO verwijder code en route
    Route::get('admin/posts', [AdminPostController::class, 'index']);
    Route::get('admin/posts/{post}/edit', [AdminPostController::class, 'edit']);
    Route::patch('admin/posts/{post}', [AdminPostController::class, 'update']);
    Route::delete('admin/posts/{post}', [AdminPostController::class, 'destroy']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [SessionController::class, 'destroy']);
    Route::post('user/posts', [PostController::class, 'store'])->middleware('throttle:5,1');
    Route::get('user/posts/create', [PostController::class, 'create']);
    Route::get('user/posts', [PostController::class, 'index']);
});
