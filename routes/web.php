<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\AllPostController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\RegisterController;
use App\Http\Controllers\Backend\VerificationController;
use App\Http\Controllers\Backend\ForgotPasswordController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\BlogController;

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

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', [HomeController::class, 'index']);

Route::get('/about', function(){
    return view('frontend.about',['active' => 'About']);
});

Route::controller(BlogController::class)->group(function(){
    Route::get('/blog', 'index');
    Route::get('/blog/category', 'categories');
    Route::get('/blog/category/{category:slug}', 'blog_categories');
    Route::get('/blog/user/{author:username}', 'blog_user');
    Route::get('/blog/detail/{post:slug}', 'detail_post');
});

Route::middleware('auth')->group(function(){ 
	Route::get('/dashboard', [DashboardController::class, 'index']);
	
	Route::get('/post/checkSlug', [PostController::class, 'checkSlug']);
	Route::resource('post', PostController::class);

	Route::controller(ProfileController::class)->group(function(){ 
		Route::get('/myprofil', 'index');
		Route::post('/change-foto','change_foto');
		Route::get('/myprofil/edit', 'edit_profile');
		Route::post('/myprofil/edit', 'update_profile');
		Route::get('/ubahsandi', 'edit_sandi');
		Route::post('/ubahsandi', 'update_sandi');
	});

	Route::post('/logout', [AuthController::class, 'logout']);

	Route::middleware('can:isAdmin')->group(function(){
		Route::resource('category', CategoryController::class)->except('show');
		Route::get('/category/checkSlug', [CategoryController::class, 'checkSlug']);

		Route::controller(AllPostController::class)->group(function(){ 
			Route::get('/allpost', 'index');
			Route::get('/allpost/detail/{post:slug}', 'detail_post');
			Route::delete('/allpost/delete/{post:slug}', 'delete_post');
		});
		
		Route::resource('user', UserController::class)->only(['index','show','destroy']);
	});
});

Route::middleware('auth')->group(function(){
	Route::controller(VerificationController::class)->group(function(){
		Route::get('/email/verify/{hash}/{token}', 'verifyUser')->name('verification.verify');
		Route::get('/email/verify', 'index')->name('verification.notice');
		Route::post('/email/verification-notification', 'send_verification')->middleware('throttle:6,1')->name('verification.send');
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