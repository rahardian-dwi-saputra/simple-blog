<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use DataTables;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;

class PostController extends Controller
{
    public function __construct(){
        View::share('active', 'Postingan Saya');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        if (request()->ajax()){
            
            $data = Post::select(
                            'title',
                            'posts.slug',
                            'categories.name as category',
                            'is_publish', 
                            DB::raw('count(view_posts.post_id) as view'),
                            'published_at'
                        )
                        ->join('categories', 'categories.id', '=', 'posts.category_id')
                        ->leftJoin('view_posts', 'posts.id', '=', 'view_posts.post_id')
                        ->where('user_id', auth()->user()->id);

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
                ->removeColumn('is_publish')
                ->addColumn('action', function($row){
     
                          $actionBtn = '<a href="/post/'.$row->slug.'" class="btn btn-primary btn-sm" title="Detail"><i class="fa fa-eye"></i></a> <a href="/post/'.$row->slug.'/edit" class="btn btn-warning btn-sm" title="Edit"><i class="fa fa-edit"></i></a> <a href="'.$row->slug.'" class="btn btn-danger btn-sm" id="hapus" title="Hapus"><i class="fa fa-trash"></i></a>';
                        return $actionBtn;
                })
                ->rawColumns(['action'])
                ->toJson();
        }
        return view('backend.post.index', [
            'categories' => DB::table('categories')->select('id','name')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('backend.post.create', [
            'title' => 'Buat Postingan Baru',
            'categories' => DB::table('categories')->select('id','name')->get()
        ]);
    }

    public function checkSlug(Request $request){
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request){
        
        $data_merge = [
            'category_id' => $request->category,
            'user_id' => auth()->user()->id,
            'excerpt' => Str::limit(strip_tags($request->body), 200),
            'is_publish' => 0,
            'published_at' => $request->tanggal_posting
        ];

        if($request->has('publish')){
            $data_merge['is_publish'] = 1;
        }

        if($request->file('image')){
            $data_merge['image'] = $request->file('image')->store('post-images');
        }

        $validatedData = $request->safe()->merge($data_merge);

        Post::create($validatedData->all());
        return redirect('/post')->with('success','Berhasil membuat postingan baru');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post){
        if (!Gate::allows('access-post', $post)) {
            abort(403);
        }

        return view('backend.post.show', [
            'data' => $post,
            'view' => DB::table('view_posts')->where('post_id',$post->id)->count(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post){
        if (!Gate::allows('access-post', $post)) {
            abort(403);
        }

        return view('backend.post.edit', [
            'title' => 'Edit Postingan',
            'data' => $post,
            'categories' => DB::table('categories')->select('id','name')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post){

        $data_merge = [
            'category_id' => $request->category,
            'user_id' => auth()->user()->id,
            'excerpt' => Str::limit(strip_tags($request->body), 200),
            'is_publish' => 0,
            'published_at' => $request->tanggal_posting
        ];

        if($request->has('publish')){
            $data_merge['is_publish'] = 1;
        }

        if($request->file('image')){
            if($post->image){
                Storage::delete($post->image);
            }
            $data_merge['image'] = $request->file('image')->store('post-images');
        }

        $validatedData = $request->safe()->merge($data_merge);

        Post::find($post->id)->update($validatedData->all());
        return redirect('/post')->with('success','Postingan berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post){
        if (!Gate::allows('access-post', $post)) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak punya hak pada postingan ini',
            ]);
        }

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
