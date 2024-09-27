<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class BlogController extends Controller
{

    public function index(){
    	
        $posts = Post::with(['category','user:id,name'])
                    ->withCount('view_posts as view')
                    ->where('is_publish',true)
                    ->latest()
                    ->get();

    	return view('frontend.blog.all_blog',[
    		'posts' => $posts,
            'active' => 'Blog',
            'title' => 'Semua Postingan',
    	]); 
    }

}
