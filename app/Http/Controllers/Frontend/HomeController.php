<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){

    	$posts = DB::table('posts')
                        ->select(
                            'slug',
                            'title',
                            'excerpt',
                            'image',
                            DB::raw('count(view_posts.post_id) as view')
                        )
                        ->join('view_posts', 'posts.id', '=', 'view_posts.post_id')
                        ->where('is_publish', true)
                        ->groupBy('posts.id')
                        ->orderBy('view','desc')
                        ->limit(4)
                        ->get();

        $users = DB::table('users')
        				->select(
        					'name',
        					'foto',
        					DB::raw('count(posts.author_id) as total')
        				)
        				->join('posts', 'posts.author_id', '=', 'users.id')
        				->where('posts.is_publish', true)
                        ->groupBy('users.id')
                        ->orderBy('total','desc')
                        ->limit(3)
                        ->get();

    	return view('frontend.home', [
    		'active' => 'Home',
    		'posts' => $posts,
    		'users' => $users
    	]);
    }
}
