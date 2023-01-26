<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller{
    
    public function index(){
    	$post = DB::table('posts')->select('id')->where('user_id', auth()->user()->id);
    	$traffic = DB::table('view_posts')->whereIn('post_id', $post);

    	return view('backend.dashboard', [
    		'total_post' => $post->count(),
    		'publish_post' => $post->where('is_publish',1)->count(),
    		'total_traffic' => $traffic->count(),
    		'total_pelanggaran' => $post->where('blocked_at','!=',null)->count(),
    		'active' => 'Dashboard',
    	]); 
    }
}
