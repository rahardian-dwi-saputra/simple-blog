<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\RegisterController;
use App\Http\Controllers\Backend\ForgotPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function(){ 
	Route::get('/dashboard', [DashboardController::class, 'index']);
	
	Route::resource('post', PostController::class);
	Route::get('/post/checkSlug', [PostController::class, 'checkSlug']);

	Route::post('/logout', [AuthController::class, 'logout']);

	Route::middleware('can:isAdmin')->group(function(){
		Route::resource('category', CategoryController::class)->except('show');
		Route::get('/category/checkSlug', [CategoryController::class, 'checkSlug']);
	});
});

Route::middleware('guest')->group(function(){ 
	Route::get('/login', [AuthController::class, 'index'])->name('login');

	Route::controller(RegisterController::class)->group(function(){ 
		Route::get('/register', 'index');
		Route::post('/register', 'postRegistration');
	});

	Route::controller(ForgotPasswordController::class)->group(function(){
    	Route::get('/forgot-password', 'index');
    	Route::post('/forgot-password', 'submitForgetPasswordForm');
    	Route::get('/reset-password/{token}', 'showResetPasswordForm')->name('reset.password.get');
    	Route::post('/reset-password', 'submitResetPasswordForm');
	});
});
Route::post('/login', [AuthController::class, 'authenticate']);