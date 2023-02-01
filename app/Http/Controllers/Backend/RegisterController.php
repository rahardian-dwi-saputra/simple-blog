<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Mail\SignupEmail;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller{
    
    public function index(){
    	return view('backend.authentikasi.register'); 
    }
    public function postRegistration(UserRequest $request){

        $validatedData = $request->safe()->merge([
            'password' => Hash::make($request->password),
            'is_admin' => 0
        ]);

    	$user = User::create($validatedData->all());
        
        if($user != null){
            $token = Str::random(64);

            DB::table('users_verify')->insert([
                'user_id' => $user->id,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);

            $data = [
                'id' => $user->id,
                'name' => $user->name,
                'token' => $token
            ];

            Mail::to($user->email)->send(new SignupEmail($data));
            auth()->login($user);

            return redirect('/email/verify')->with('success', 'Verification link sent!');
        }else{
            return redirect('/register')->with('error', 'Registrasi gagal, silahkan coba sekali lagi');
        } 
    }
    
}