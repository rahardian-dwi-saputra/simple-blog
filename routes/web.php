<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\RegisterController;
use App\Http\Controllers\Backend\ForgotPasswordController;
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
    return view('welcome');
});

Route::middleware('auth')->group(function(){
	Route::get('/dashboard', [DashboardController::class, 'index']);
	Route::post('/logout', [AuthController::class, 'logout']);

	Route::middleware('can:isAdmin')->group(function(){ 
		Route::resource('category', CategoryController::class)->except('show');
		Route::get('/category/checkSlug', [CategoryController::class, 'checkSlug']);
		Route::resource('user', UserController::class);
	});
});

Route::middleware('guest')->group(function(){
	Route::get('/login', [AuthController::class, 'index'])->name('login');
	Route::get('/register', [RegisterController::class, 'index']);
	Route::post('/register', [RegisterController::class, 'postRegistration']); 

	Route::get('/forgot-password', [ForgotPasswordController::class, 'index']);
	Route::post('/forgot-password', [ForgotPasswordController::class, 'submitForgetPasswordForm']);
	Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
	Route::post('/reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm']);
});

Route::post('/login', [AuthController::class, 'authenticate']);