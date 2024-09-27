<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DataTables;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function __construct(){
        View::share('active', 'User');
    }

    public function index(){
    	if (request()->ajax()){
    		$user = User::select(
                            'id',
                            'name',
                            'username',
                            'email',
                            'created_at'
                        )->where('can_delete', 1);

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
                    ->editColumn('created_at', function(User $data) {
                        return date('d-m-Y H:i:s', strtotime($data->created_at));
                    })
                    ->addColumn('action', function($row){

                        $actionBtn = '';

                        if($row->email_verified_at != null && $row->blocked_at == null){
                            $actionBtn .= '<a href="'.$row->id.'" class="btn btn-secondary btn-sm" title="Suspend user" id="btn-suspent"><i class="fa fa-user-alt-slash"></i></a> ';
                        }elseif ($row->email_verified_at != null && $row->blocked_at != null){
                            $actionBtn .= '<a href="'.$row->id.'" class="btn btn-success btn-sm" title="Unsuspend user" id="btn-suspent"><i class="fa fa-reply"></i></a> ';
                        }

                        $actionBtn .= '<a href="/user/'.$row->id.'" class="btn btn-primary btn-sm" title="Detail"><i class="fa fa-eye"></i></a> <a href="'.$row->id.'" class="btn btn-danger btn-sm" id="hapus" title="Hapus"><i class="fa fa-trash"></i></a>';

                        return $actionBtn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
    	}

    	return view('backend.user.index');
    }

    public function show(User $user){
    	return view('backend.user.show', ['data' => $user]);
    }

    public function destroy(User $user){
        if($user->can_delete == 1){
            $posts = DB::table('posts')->where('author_id',$user->id)->get();

            foreach ($posts as $post) {
                if($post->image){
                    Storage::delete($post->image);
                }
            }

            DB::table('posts')->where('author_id',$user->id)->delete();

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
