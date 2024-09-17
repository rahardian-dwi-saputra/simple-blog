<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Models\Post;

class AllPostController extends Controller
{
    public function __construct(){
        View::share('active', 'All Post');
    }
    public function index(){
    	if (request()->ajax()){
    	}
    	return view('backend.allpost.index', [
            'categories' => DB::table('categories')->select('slug','name')->get()
        ]);
    }
}
