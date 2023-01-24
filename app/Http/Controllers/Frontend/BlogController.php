<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class BlogController extends Controller{
    
    public function index(){
    	return view('frontend.blog.all_blog',[
    		'posts' => Post::where('is_publish', 1)->orderBy('published_at','desc')->paginate(5),
            'active' => 'Blog'
    	]); 
    }
    public function categories(){
    	return view('frontend.blog.categories',[
            'categories' => Category::all(),
            'active' => 'Categoris'
        ]);
    }
    public function detail_post(Post $post){
    	return view('frontend.blog.blog_detail',[
    		'post' => $post,
            'active' => 'Blog'
    	]);
    }
}
