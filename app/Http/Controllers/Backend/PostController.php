<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use DataTables;

class PostController extends Controller
{

    public function __construct(){
        View::share('active', 'Postingan Saya');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()){

            $data = Post::select(
                            'title',
                            'posts.slug',
                            'categories.name as category',
                            'is_publish', 
                            DB::raw('count(view_posts.post_id) as view'),
                            'created_at'
                        )
                        ->join('categories', 'categories.id', '=', 'posts.category_id')
                        ->leftJoin('view_posts', 'posts.id', '=', 'view_posts.post_id')
                        ->where('author_id', auth()->user()->id);

            if(!empty(request()->category)){
                $data = $data->where('categories.slug', request()->category);
            }

            if(!empty(request()->tampil)){
                if(request()->tampil == 'Ya')
                    $data = $data->where('posts.is_publish', 1);
                else
                    $data = $data->where('posts.is_publish', 0);
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
                ->addColumn('publish', function($row){ 
                        if($row->is_publish == 1)
                            return 'Ya';
                        else
                            return 'Tidak';

                })
                ->removeColumn('is_publish')
                ->addColumn('action', function($row){
     
                          $actionBtn = '<a href="/post/'.$row->slug.'" class="btn btn-primary btn-sm" title="Detail"><i class="fa fa-eye"></i></a> <a href="/post/'.$row->slug.'/edit" class="btn btn-warning btn-sm" title="Edit"><i class="fa fa-edit"></i></a> <a href="'.$row->slug.'" class="btn btn-danger btn-sm" id="hapus" title="Hapus"><i class="fa fa-trash"></i></a>';
                        return $actionBtn;
                })
                ->rawColumns(['action'])
                ->toJson();

        }

        return view('backend.post.index', [
            'categories' => DB::table('categories')->select('slug','name')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.post.create', [
            'title' => 'Buat Postingan Baru',
            'categories' => DB::table('categories')->select('slug','name')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
