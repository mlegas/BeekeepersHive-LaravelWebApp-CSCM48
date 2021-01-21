<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\IndexController::class, 'index']);

Auth::routes(['verify' => true]);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::get('/register-step2', [App\Http\Controllers\Auth\RegisterStep2Controller::class, 'index'])->name('register.step2');
Route::post('/register-step2', [App\Http\Controllers\Auth\RegisterStep2Controller::class, 'store'])->name('register.step2.store');

Route::get('/posts', [App\Http\Controllers\PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [App\Http\Controllers\PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [App\Http\Controllers\PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{post}', [App\Http\Controllers\PostController::class, 'show'])->name('posts.show');
Route::delete('/posts/{post}', [App\Http\Controllers\PostController::class, 'destroy'])->name('posts.destroy');

Route::post('/posts/{post}', [App\Http\Controllers\CommentController::class, 'storePost'])->name('comments.post.store');
Route::post('/profiles/{profile_page}', [App\Http\Controllers\CommentController::class, 'storeProfilePage'])->name('comments.profilepage.store');

Route::get('/profiles/{profile_page}', [App\Http\Controllers\ProfilePageController::class, 'show'])->name('profilepages.show');
