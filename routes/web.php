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

Route::get('/', function () {
    return view('index');
});

Auth::routes(['verify' => true]);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::get('/register-step2', [App\Http\Controllers\Auth\RegisterStep2Controller::class, 'index'])->name('register.step2');
Route::post('/register-step2', [App\Http\Controllers\Auth\RegisterStep2Controller::class, 'store']);

Route::get('/post', [App\Http\Controllers\PostController::class, 'index'])->name('post');
Route::post('/post', [App\Http\Controllers\PostController::class, 'store']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
