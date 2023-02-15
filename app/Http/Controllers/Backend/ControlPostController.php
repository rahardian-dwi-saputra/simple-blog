<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use DataTables;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\View\Composers\PostComposer;

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
                        ->join('users', 'users.id', '=', 'posts.user_id')
                        ->whereNull('posts.blocked_at');

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
                ->addColumn('publish', function($row){ 
                        if($row->is_publish == 1)
                            return 'Ya';
                        else
                            return 'Tidak';

                })
                ->addColumn('action', function($row){
                        if($row->is_publish == 1){
                            return '<a href="/controlpost/detail/'.$row->slug.'" class="btn btn-danger btn-sm" title="Banned post"><i class="fa fa-ban"></i> Banned</a>';
                        }else{
                            return '<a href="/controlpost/detail/'.$row->slug.'" class="btn btn-primary btn-sm" title="View post"><i class="fa fa-eye"></i> Lihat</a>';
                        }
     
                })
                ->rawColumns(['action'])
                ->removeColumn('is_publish')
                ->toJson();
    	}
    	return view('backend.controlpost.index', [
            'categories' => DB::table('categories')->select('id','name')->get()
        ]);
    }
    public function get_banned_post(){
        if (request()->ajax()){

            $data = Post::select(
                            'title',
                            'posts.slug',
                            'users.name as penulis',
                            'categories.name as category',
                            'posts.blocked_at',
                            'published_at'
                        )
                        ->join('categories', 'categories.id', '=', 'posts.category_id')
                        ->join('users', 'users.id', '=', 'posts.user_id')
                        ->whereNotNull('posts.blocked_at');

            if(!empty(request()->category)){
                $data = $data->where('categories.id', request()->category);
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
                    ->addColumn('action', function($row){
                        
                        return '<a href="/controlpost/detail/'.$row->slug.'" class="btn btn-success btn-sm" title="Restore post"><i class="fa fa-reply"></i> Restore</a>';

                    })
                    ->rawColumns(['action'])
                    ->toJson();
            
        }
    }
    public function detail_post(Post $post){
        $post->loadCount('view_posts as view');

        $postComposer = new PostComposer($post);
        $postComposer->compose();

        return view('backend.controlpost.banned_post', [
            'data' => $post
        ]);
    }
    public function banned_post(Request $request, Post $post){
        $this->validate($request, [
            'alasan' => 'required',
        ]);

        DB::table('banned_posts')->insert([
            'admin_id' => auth()->user()->id,
            'user_id' => $post->user->id,
            'post_id' => $post->id,
            'reason' => $request->alasan,
            'status' => 'Active',
            'added_at' => Carbon::now()
        ]);

        Post::find($post->id)->update([
            'blocked_at' => Carbon::now()
        ]);

        return redirect('/controlpost')->with('success','Postingan berhasil dibanned');
    }
    public function unbanned_post(Request $request, Post $post){
        if($post->blocked_at == null){
            return redirect('/controlpost')->with('success','Postingan tidak dalam kondisi dibanned');
        }

        DB::table('banned_posts')->where([
            'post_id' => $post->id
        ])->delete();

        Post::find($post->id)->update([
            'blocked_at' => null
        ]);

        return redirect('/controlpost')->with('success','Postingan berhasil dikembalikan');
    }
}
