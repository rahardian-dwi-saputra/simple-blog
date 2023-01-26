<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use DataTables;
use Illuminate\Support\Facades\View;

class ControlPostController extends Controller{
    
    public function __construct(){
        View::share('active', 'Control Post');
    }
    public function index(){
    	if (request()->ajax()){
    		$data = Post::select('title','posts.slug','users.name as penulis','categories.name as category','is_publish','published_at')->join('categories', 'categories.id', '=', 'posts.category_id')->join('users', 'users.id', '=', 'posts.user_id')->orderBy('published_at','desc');

    		return DataTables::eloquent($data)
    			->addIndexColumn()
    			->editColumn('published_at', function($row){
                    return date('d-m-Y', strtotime($row->published_at));
                })
                ->addColumn('publish', function($row){ 
                        if($row->is_publish == 1)
                            return 'Ya';
                        else
                            return 'Tidak';

                })
                ->removeColumn('is_publish')
                ->addColumn('action', function($row){
     
                          $actionBtn = '<a href="/post/'.$row->slug.'" class="btn btn-primary btn-sm" title="Detail"><i class="fa fa-eye"></i></a> <a href="'.$row->slug.'" class="btn btn-danger btn-sm" id="hapus" title="Hapus"><i class="fa fa-trash"></i></a>';
                        return $actionBtn;
                })
                ->rawColumns(['action'])
                ->toJson();
    	}
    	return view('backend.controlpost.index');
    }
}
