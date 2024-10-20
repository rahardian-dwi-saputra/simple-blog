<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Sqids\Sqids;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\SignUpMail;

class VerificationController extends Controller
{
    public function index(){
    	return view('backend.authentikasi.verifyemail');
    }

    public function verifyUser($hash, $token){
    	$sqids = new Sqids(minLength: 10);
    	$ids = $sqids->decode($hash);

        $verifyUser = DB::table('users_verify')->where([
            ['user_id', $ids[0]],
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

    public function send_verification(Request $request){

    	$cek = DB::table('users_verify')
    			->where('user_id', $request->user()->id)->first();

    	if(!$cek){
    		$token = Str::random(64);

    		$sqids = new Sqids(minLength: 10);
            $hash = $sqids->encode([$user->id]);

    		DB::table('users_verify')->insert([
    			'hash' => $hash,
                'user_id' => $request->user()->id,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);

    	}else{
    		$token = $cek->token;
    		$hash = $cek->hash;
    	}

    	$mailData = [
            'hash' => $hash,
            'name' => $request->user()->name,
            'token' => $token
        ];

        Mail::to($request->email)->send(new SignUpMail($mailData));
        return back()->with('message', 'Verification link sent!');
    }
}
