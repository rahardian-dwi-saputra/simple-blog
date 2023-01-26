<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\ViewPost;

class BlogController extends Controller{
    
    public function index(){
        $posts = Post::with(['category','user:id,name'])
                    ->withCount('view_posts as view')
                    ->where('is_publish', 1)
                    ->orderBy('published_at','desc')
                    ->paginate(5);

    	return view('frontend.blog.all_blog',[
    		'posts' => $posts,
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
        if($post->is_publish == 0)
            abort(403);

    	return view('frontend.blog.blog_detail',[
    		'post' => $post,
            'active' => 'Blog'
    	]);
    }
}
