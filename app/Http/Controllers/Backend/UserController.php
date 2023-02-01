<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterbyAdmin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller{

    public function __construct(){
        View::share('active', 'User');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        if (request()->ajax()){

            $user = User::select(
                            'id',
                            'name',
                            'username',
                            'email',
                            'is_admin',
                            'blocked_at')
                        ->where('can_delete', 1);

            if(!empty(request()->role)){
                if(request()->role == 'Admin')
                    $user = $user->where('is_admin', 1);
                elseif(request()->role == 'User')
                    $user = $user->where('is_admin', 0);
            }

            if(!empty(request()->verifikasi)){
                if(request()->verifikasi == 'Verified')
                    $user = $user->whereNotNull('email_verified_at');
                elseif(request()->verifikasi == 'Unverified')
                    $user = $user->whereNull('email_verified_at');
            }

            if(!empty(request()->status)){
                if(request()->status == 'Banned')
                    $user = $user->whereNotNull('blocked_at');
                elseif(request()->status == 'Aktif')
                    $user = $user->whereNull('blocked_at');
            }

            return Datatables::of($user)
                    ->addIndexColumn()
                    ->addColumn('role', function($row){ 
                        if($row->is_admin == 1)
                            return 'Admin';
                        else
                            return 'User';

                    })
                    ->removeColumn('is_admin')
                    ->addColumn('action', function($row){

                          $actionBtn = '<a href="#" class="btn btn-secondary btn-sm">Block</a>


                          <a href="/user/'.$row->id.'" class="btn btn-primary btn-sm" title="Detail"><i class="fa fa-eye"></i></a> <a href="/user/'.$row->id.'/edit" class="btn btn-warning btn-sm" title="Edit"><i class="fa fa-edit"></i></a> <a href="'.$row->id.'" class="btn btn-danger btn-sm" id="hapus" title="Hapus"><i class="fa fa-trash"></i></a>';


                        return $actionBtn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('backend.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('backend.user.create', ['title' => 'Tambah User Baru']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request){
        $validatedData = $request->safe()->merge([
            'is_admin' => $request->role,
            'password' => Hash::make($request->password)
        ]);

        $user = User::create($validatedData->all());

        if($user != null){
            $data = [
                'name' => $user->name,
                'username' => $user->username,
                'password' => $request->password
            ];

            Mail::to($user->email)->send(new RegisterbyAdmin($data));
        }

        return redirect('/user')->with('success','Data User Baru Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user){
        return view('backend.user.show', ['data' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user){
        return view('backend.user.edit', [
            'title' => 'Edit Data User',
            'data' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user){
        $validatedData = $request->safe()->merge(['is_admin' => $request->role]);
        User::find($user->id)->update($validatedData->all());
        return redirect('/user')->with('success','Data User Berhasil Diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user){
        if($user->can_delete == 1){
            $posts = DB::table('posts')->where('user_id',$user->id)->get();

            foreach ($posts as $post) {
                if($post->image){
                    Storage::delete($post->image);
                }
            }

            DB::table('posts')->where('user_id',$user->id)->delete();

            $user->tokens()->delete();
            $delete = User::destroy($user->id);
            if($delete){
                return response()->json([
                    'success' => true,
                    'message' => 'Data Pengguna berhasil dihapus',
                ]);
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'Data Pengguna gagal dihapus, coba sekali lagi',
                ]);
            }
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Data Pengguna tidak dapat dihapus',
            ]);
        }
    }
}
