<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use DataTables;
use Illuminate\Support\Facades\Storage;

class AllPostController extends Controller
{
    public function __construct(){
        View::share('active', 'All Post');
    }
    public function index(){
    	if (request()->ajax()){

            $data = Post::select(
                            'posts.slug',
                            'title',
                            'categories.name as category',
                            'users.name as author',
                            DB::raw('count(view_posts.post_id) as view'),
                            'posts.created_at'
                        )
                        ->join('categories', 'categories.id', '=', 'posts.category_id')
                        ->join('users', 'users.id', '=', 'posts.author_id')
                        ->leftJoin('view_posts', 'posts.id', '=', 'view_posts.post_id');

            if(!empty(request()->category)){
                $data = $data->where('categories.slug', request()->category);
            }

            if(!empty(request()->tanggal_awal)){
                $tanggal_awal = date('Y-m-d', strtotime(request()->tanggal_awal));
                $data = $data->whereDate('created_at','>=', $tanggal_awal);
            }

            if(!empty(request()->tanggal_akhir)){
                $tanggal_akhir = date('Y-m-d', strtotime(request()->tanggal_akhir));
                $data = $data->whereDate('created_at','<=', $tanggal_akhir);
            }

            $data = $data->groupBy('posts.id')
                        ->orderBy('created_at','desc');

            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                        

                        return '<a href="/allpost/detail/'.$row->slug.'" class="btn btn-primary btn-sm" title="View post"><i class="fa fa-eye"></i> Detail</a> <a href="'.$row->slug.'" class="btn btn-danger btn-sm" title="Banned post" id="hapus"><i class="fa fa-ban"></i> Hapus</a>';
     
                })
                ->rawColumns(['action'])
                ->toJson();
                        
    	}
    	return view('backend.allpost.index', [
            'categories' => DB::table('categories')->select('slug','name')->get()
        ]);
    }

    public function detail_post(Post $post){
        $post->loadCount('view_posts as view');

        return view('backend.post.show', [
            'data' => $post
        ]);
    }

    public function delete_post(Post $post){
        if($post->image){
            Storage::delete($post->image);
        }

        DB::table('view_posts')->where(['post_id'=> $post->id])->delete();
        $delete = Post::destroy($post->id);

        if($delete){
            return response()->json([
                'success' => true,
                'message' => 'Postingan berhasil dihapus',
            ]);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Postingan gagal dihapus, coba sekali lagi',
            ]);
        }
    }
}
