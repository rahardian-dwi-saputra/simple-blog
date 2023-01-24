<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller{
    
    public function index(){
    	return view('frontend.home', [
    		'posts' => Post::where('is_publish', 1)->orderBy('published_at','desc')->limit(6)->get(),
    		'active' => 'Home'
    	]); 
    }
}
