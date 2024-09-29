<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
    	$post = DB::table('posts')->select('id')->where('author_id', auth()->user()->id);
    	$traffic = DB::table('view_posts')->whereIn('post_id', $post);

        $popular_posts = DB::table('posts')
                        ->select(
                            'posts.slug',
                            'title',
                            'categories.name',
                            'created_at',
                            DB::raw('count(view_posts.post_id) as view')
                        )
                        ->join('view_posts', 'posts.id', '=', 'view_posts.post_id')
                        ->join('categories', 'categories.id', '=', 'posts.category_id')
                        ->where('is_publish', true)
                        ->where('author_id', auth()->user()->id)
                        ->groupBy('posts.id')
                        ->orderBy('view','desc')
                        ->limit(4)
                        ->get();

    	return view('backend.dashboard', [
    		'total_post' => $post->count(),
    		'publish_post' => $post->where('is_publish',1)->count(),
    		'total_traffic' => $traffic->count(),
            'popular_posts' => $popular_posts,
    		'active' => 'Dashboard'
    	]);
    }
}
