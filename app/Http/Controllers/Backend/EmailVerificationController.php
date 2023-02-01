<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\SignupEmail;
use App\Models\User;

class EmailVerificationController extends Controller{
    
    public function index(){
    	return view('backend.authentikasi.verifyemail'); 
    }
    public function send_verification(Request $request){

    	$cek = DB::table('users_verify')
    			->where('user_id', $request->user()->id)->first();

    	if(!$cek){
    		$token = Str::random(64);

    		DB::table('users_verify')->insert([
                'user_id' => $request->user()->id,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);

    	}else{
    		$token = $cek->token;
    	}

    	$data = [
            'id' => $request->user()->id,
            'name' => $request->user()->name,
            'token' => $token
        ];

        Mail::to($request->user()->email)->send(new SignupEmail($data));
        return back()->with('message', 'Verification link sent!');
    }
    public function verifyUser($id, $token){
        $verifyUser = DB::table('users_verify')->where([
            ['user_id', $id],
            ['token', $token],
        ])->first();

        if(!$verifyUser){
            return redirect('/login')->with('LoginError', 'Invalid Token!');
        }

        $user = User::where('id', $verifyUser->user_id)->update([
            'email_verified_at' => Carbon::now()
        ]);

        DB::table('users_verify')->where(['user_id'=> $verifyUser->user_id])->delete();

        return redirect()->intended('dashboard');
    }
}
