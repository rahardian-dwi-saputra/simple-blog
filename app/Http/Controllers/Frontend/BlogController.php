<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Models\ViewPost;
use Illuminate\Support\Carbon;

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

        if(Auth::check()){
            $cek = ViewPost::where('user', Auth::user()->id)
                            ->whereDate('access_at', date('Y-m-d'))
                            ->count();

            if($cek == 0){
                ViewPost::create([
                    'post_id' => $post->id,
                    'user' => Auth::user()->id,
                    'visitor' => request()->ip(),
                    'access_at' => Carbon::now()
                ]);
            }
        }else{
            $cek = ViewPost::where('visitor', request()->ip())
                            ->whereDate('access_at', date('Y-m-d'))
                            ->count();

            if($cek == 0){
                ViewPost::create([
                    'post_id' => $post->id,
                    'visitor' => request()->ip(),
                    'access_at' => Carbon::now()
                ]);
            }
        }

        $post->loadCount('view_posts as view');

    	return view('frontend.blog.blog_detail',[
    		'post' => $post,
            'active' => 'Blog'
    	]);
    }
}
