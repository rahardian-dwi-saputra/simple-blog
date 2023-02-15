<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller{
    
    public function index(){
    	$posts = Post::with(['category','user:id,name'])
    				->withCount('view_posts as view')
    				->where('is_publish', 1)
                    ->whereNull('blocked_at')
    				->orderBy('published_at','desc')
    				->limit(6)
    				->get();
    	
    	return view('frontend.home', [
    		'posts' => $posts,
    		'active' => 'Home'
    	]); 
    }
}
