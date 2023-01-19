<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use DataTables;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        if (request()->ajax()){
            
            $data = Post::select('title','posts.slug','categories.name as category','is_publish','view','published_at')->join('categories', 'categories.id', '=', 'posts.category_id')->where('user_id', auth()->user()->id)->orderBy('published_at','desc');

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
     
                          $actionBtn = '<a href="/post/'.$row->slug.'" class="btn btn-primary btn-sm" title="Detail"><i class="fa fa-eye"></i></a> <a href="/post/'.$row->slug.'/edit" class="btn btn-warning btn-sm" title="Edit"><i class="fa fa-edit"></i></a> <a href="'.$row->slug.'" class="btn btn-danger btn-sm" id="hapus" title="Hapus"><i class="fa fa-trash"></i></a>';
                        return $actionBtn;
                })
                ->rawColumns(['action'])
                ->toJson();
        }
        return view('backend.post.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('backend.post.create', [
            'title' => 'Buat Postingan Baru',
            'categories' => Category::all()
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
            'published_at' => date('Y-m-d', strtotime($request->tanggal_posting))
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
        return view('backend.post.show', ['data' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post){
        return view('backend.post.edit', [
            'title' => 'Edit Postingan',
            'data' => $post,
            'categories' => Category::all(),
            'tanggal_posting' => date('d-m-Y', strtotime($post->published_at)),
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
            'published_at' => date('Y-m-d', strtotime($request->tanggal_posting))
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
        if($post->image){
            Storage::delete($post->image);
        }
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
