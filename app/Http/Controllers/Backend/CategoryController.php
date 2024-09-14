<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Post;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class CategoryController extends Controller
{
    public function __construct(){
        View::share('active', 'Category');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.kategori.index', ['categories' => Category::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.kategori.create', ['title' => 'Tambah Kategori Baru']);
    }

    public function checkSlug(Request $request){
        $slug = SlugService::createSlug(Category::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories|string|max:255',
            'slug' => 'required|unique:categories',
        ]);
        
        Category::create($validated);
        return redirect('/category')->with('success','Data Kategori Baru Berhasil Ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('backend.kategori.edit', [
            'title' => 'Edit Kategori',
            'data' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $rules = [
            'name' => 'required|unique:categories|string|max:255'
        ];

        if($request->slug != $category->slug){
            $rules['slug'] = 'required|unique:categories';
        }

        $validated = $request->validate($rules);
        Category::where('id', $category->id)->update($validated);
        return redirect('/category')->with('success','Data Kategori Berhasil Diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $cek = Post::where('category_id', $category->id)->count();
        if($cek == 0){
            Category::destroy($category->id);
            return redirect('/category')->with('success','Data kategori berhasil dihapus');
        }else{
            return redirect('/category')->with('error','Data kategori tidak dapat dihapus karena sedang digunakan');
        }
    }
}
