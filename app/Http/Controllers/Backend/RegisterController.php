<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Sqids\Sqids;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\SignUpMail;

class RegisterController extends Controller
{
    public function index(){
    	return view('backend.authentikasi.register'); 
    }
    public function postRegistration(Request $request){
    	$request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|unique:users,username|min:6|max:255',
            'email' => 'required|unique:users,email|email|max:255',
            'password' => 'required|min:8|confirmed'
        ]);

        //$user = User::create($validatedData->all());

        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        if($user != null){
            $sqids = new Sqids(minLength: 10);
            $hash = $sqids->encode([$user->id]);

            $token = Str::random(64);

            DB::table('users_verify')->insert([
                'hash' => $hash,
                'user_id' => $user->id,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);

            $mailData = [
                'hash' => $hash,
                'name' => $user->name,
                'token' => $token
            ];

            Mail::to($request->email)->send(new SignUpMail($mailData));

            auth()->login($user);
            //return redirect('/email/verify')->with('success', 'Verification link sent!');

            return redirect('/login')->with('success', 'Registrasi berhasil, silahkan login');
        }else{
            return redirect('/register')->with('error', 'Registrasi gagal, silahkan coba sekali lagi');
        }
    }
    
}
