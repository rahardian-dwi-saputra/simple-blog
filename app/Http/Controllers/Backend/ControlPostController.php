<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use DataTables;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

class ControlPostController extends Controller{
    
    public function __construct(){
        View::share('active', 'Control Post');
    }
    public function index(){
    	if (request()->ajax()){

            $data = Post::select(
                            'title',
                            'posts.slug',
                            'users.name as penulis',
                            'categories.name as category',
                            'is_publish',
                            'published_at'
                        )
                        ->join('categories', 'categories.id', '=', 'posts.category_id')
                        ->join('users', 'users.id', '=', 'posts.user_id');

            if(!empty(request()->category)){
                $data = $data->where('categories.id', request()->category);
            }

            if(!empty(request()->tampil)){
                if(request()->tampil == 'Ya')
                    $data = $data->where('posts.is_publish', 1);
                else
                    $data = $data->where('posts.is_publish', 0);
            }

            if(!empty(request()->tanggal_awal)){
                $tanggal_awal = date('Y-m-d', strtotime(request()->tanggal_awal));
                $data = $data->whereDate('published_at','>=', $tanggal_awal);
            }

            if(!empty(request()->tanggal_akhir)){
                $tanggal_akhir = date('Y-m-d', strtotime(request()->tanggal_akhir));
                $data = $data->whereDate('published_at','<=', $tanggal_akhir);
            }

            $data = $data->groupBy('posts.id')
                        ->orderBy('published_at','desc');

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
     
                          $actionBtn = '<a href="/controlpost/detail/'.$row->slug.'" class="btn btn-primary btn-sm" title="Detail"><i class="fa fa-eye"></i></a> <a href="'.$row->slug.'" class="btn btn-danger btn-sm" id="hapus" title="Hapus"><i class="fa fa-ban"></i></a>';
                        return $actionBtn;
                })
                ->rawColumns(['action'])
                ->toJson();
    	}
    	return view('backend.controlpost.index', [
            'categories' => DB::table('categories')->select('id','name')->get()
        ]);
    }
    public function detail_post(Post $post){

        return view('backend.controlpost.banned_post', [
            'data' => $post
        ]);
    }
    public function banned_post(){

    }
}
