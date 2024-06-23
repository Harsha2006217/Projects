<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthorizationController;

use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//!!todo maak een validatie/session controller aan en gebruik de user controller alleen voor user dingen

//routes die nu gebruikt kunnen worden
Route::post('signup',[AuthorizationController::class, 'signup'])->middleware('throttle:5,1');
Route::post('signin',[AuthorizationController::class, 'SignIn'])->middleware('throttle:5,1');
Route::post('logout', [AuthorizationController::class, 'logout'])->middleware('throttle:5,1')->middleware('auth.token');

Route::get('me', [UserController::class, 'me'])->middleware('throttle:5,1')->middleware('auth.token');
Route::get('users', [UserController::class, 'getAllUsers'])->middleware('throttle:5,1')->middleware('auth.token');
Route::post('user/create', [UserController::class, 'CreateUser'])->middleware(['auth.token', 'throttle:5,1']);
Route::post('post/create', [PostController::class, 'CreatePost'])->middleware(['auth.token', 'throttle:5,1']);
Route::get('post/user', [PostController::class, 'viewUserPost'])->middleware(['auth.token', 'throttle:5,1']);

//!! routes hieronder zijn nog niet in gebruik
//routes voor admins
// Route::prefix('admin')->group(function () {
// Route::get('data', [AdminController::class, 'show'])->middleware('auth.token')->middleware('throttle:5,1');
// Route::post('create', [AdminController::class, 'create'])->middleware('auth.token')->middleware('throttle:5,1');
// Route::post('update', [AdminController::class, 'update'])->middleware('auth.token')->middleware('throttle:5,1');
// Route::post('delete', [AdminController::class, 'delete'])->middleware('auth.token')->middleware('throttle:5,1');
// });

// routes voor alles gerelateerd aan normale gebruikers.
// Route::prefix('user')->group(function () {
//     Route::get('data', [PostController::class, 'show'])->middleware(['auth.token', 'throttle:5,1']);;
//     Route::post('update', [PostController::class, 'update'])->middleware(['auth.token', 'throttle:5,1']);;
//     Route::post('delete', [PostController::class, 'delete'])->middleware(['auth.token', 'throttle:5,1']);;
// });
