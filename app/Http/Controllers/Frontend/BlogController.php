<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;

class BlogController extends Controller
{

    public function index(){
    	
        $posts = Post::with(['category','user:id,name,username'])
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

    public function categories(){
        return view('frontend.blog.categories',[
            'categories' => Category::select('slug','name')->get(),
            'active' => 'Categoris'
        ]);
    }

    public function blog_categories(Category $category){
        return view('frontend.blog.all_blog',[
            'posts' => $category->posts->load('category','user'),
            'active' => 'Blog',
            'title' => 'Postingan Kategori '.$category->name,
        ]);
    }

    public function blog_user(User $author){
        return view('frontend.blog.all_blog',[
            'posts' => $author->posts->load('category','user'),
            'active' => 'Blog',
            'title' => 'Postingan User '.$author->name,
        ]);
    }

    public function detail_post(Post $post){
        if($post->is_publish == 0)
            abort(404);

        $post->loadCount('view_posts as view');

        return view('frontend.blog.blog_detail',[
            'post' => $post,
            'active' => 'Blog'
        ]);
    }
}
