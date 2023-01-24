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
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\BlogController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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

Route::controller(BlogController::class)->group(function () {
    Route::get('/blog', 'index');
    Route::get('/blog/detail/{post:slug}', 'detail_post');
    Route::get('/blog/category', 'categories');
});

Route::middleware(['auth'])->group(function(){
	Route::get('/dashboard', [DashboardController::class, 'index']);
	Route::get('/post/checkSlug', [PostController::class, 'checkSlug']);
	Route::resource('post', PostController::class);
	Route::post('/logout', [AuthController::class, 'logout']);

	Route::middleware('can:isAdmin')->group(function(){ 
		Route::resource('category', CategoryController::class)->except('show');
		Route::get('/category/checkSlug', [CategoryController::class, 'checkSlug']);
		Route::get('/controlpost', [ControlPostController::class, 'index']);
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




Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/email/verify', function () {
    return view('backend.authentikasi.verifyemail');
})->middleware('auth')->name('verification.notice');