<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
            return redirect('/login')->with('success', 'Registrasi berhasil, silahkan login');
        }else{
            return redirect('/register')->with('error', 'Registrasi gagal, silahkan coba sekali lagi');
        }
    }
}
