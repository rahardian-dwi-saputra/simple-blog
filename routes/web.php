<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\ControlPostController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\RegisterController;
use App\Http\Controllers\Backend\ForgotPasswordController;
use App\Http\Controllers\Backend\EmailVerificationController;
use App\Http\Controllers\Backend\ProfilController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\BlogController;

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

/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/', [HomeController::class, 'index']);

Route::controller(BlogController::class)->group(function(){
    Route::get('/blog', 'index');
    Route::get('/blog/detail/{post:slug}', 'detail_post');
    Route::get('/blog/category', 'categories');
});

Route::middleware(['auth','verified'])->group(function(){
	Route::get('/dashboard', [DashboardController::class, 'index']);
	Route::get('/post/checkSlug', [PostController::class, 'checkSlug']);
	Route::resource('post', PostController::class);
	Route::get('/banned-post', [PostController::class, 'banned_posts']);
	Route::get('/banned-post/detail/{post:slug}', [PostController::class, 'show']);
	Route::post('/logout', [AuthController::class, 'logout']);

	Route::post('/myprofil', [ProfilController::class, 'index']);

	Route::middleware('can:isAdmin')->group(function(){ 
		Route::resource('category', CategoryController::class)->except('show');
		Route::get('/category/checkSlug', [CategoryController::class, 'checkSlug']);

		Route::controller(ControlPostController::class)->group(function(){ 
			Route::get('/controlpost', 'index');
			Route::get('/controlpost/list', 'get_banned_post');
			Route::get('/controlpost/detail/{post:slug}', 'detail_post');
			Route::post('/controlpost/banned/{post:slug}', 'banned_post');
			Route::post('/controlpost/unbanned/{post:slug}', 'unbanned_post');
		});

	});

	Route::middleware('can:SuperUser')->group(function(){ 
		Route::resource('user', UserController::class);
	});
});

Route::middleware('auth')->group(function(){
	Route::controller(EmailVerificationController::class)->group(function(){ 
		Route::get('/email/verify/{id}/{token}', 'verifyUser')->name('verification.verify');
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