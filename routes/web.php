<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\LoginController;
use App\Http\Controllers\LoginGoogle;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
// use App\Http\Controllers\HomeController;
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

//Auth
// Auth::routes();
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [LoginController::class, 'login'])->name('login');
Route::post('auth-login', [LoginController::class, 'actionlogin'])->name('actionlogin');
Route::get('auth-register', [RegisterController::class, 'register'])->name('auth-register');
Route::post('auth-register', [RegisterController::class, 'actionregister'])->name('actionregister');

// Route::redirect('/', '/auth-login');

Route::get('/auth-login', function () {
    return view('pages.auth-login', ['type_menu' => 'auth']);
});
// Route::redirect('/', '/auth-login2');

//Register


// lOGINGOOGLE
Route::controller(LoginGoogle::class)->group(function(){
    Route::get('auth.google', 'redirectGoogle')->name('auth.google');
    Route::get('logingoogle/callback', 'callback');
    Route::get('product', 'product');
    Route::get('logout', 'logout');
    Route::post('login_action', 'login_action');
    Route::get('generate_password', 'generate_password');
});

//product
Route::get('/product', [ProductController::class, 'index']);
//search
Route::get('product/cari',[ProductController::class, 'cari']);
//
Route::get('/product/create', [ProductController::class, 'create']);
Route::post('/product/store', [ProductController::class, 'store']);
Route::get('/product/edit/{product}', [ProductController::class, 'edit']);
Route::put('/product/update/{product}', [ProductController::class, 'update']);
Route::delete('/product/delete/{product}', [ProductController::class, 'delete']);

//Laundry Main

Route::get('/dashboard', [ProductController::class, 'countdata']);

