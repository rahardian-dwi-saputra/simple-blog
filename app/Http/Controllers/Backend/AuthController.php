<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller{
    
    public function index(){
    	return view('backend.authentikasi.login'); 
    }
    public function authenticate(Request $request){
    	
        $validator = Validator::make($request->all(), [
            'login'    => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()){
            return back()->with('LoginError','Invalid Input');
        }

        $login_type = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL )? 'email': 'username';
        $request->merge([$login_type => $request->input('login')]);

        if (Auth::attempt($request->only($login_type, 'password'))){
    		$request->session()->regenerate();
    		return redirect()->intended('dashboard');
    	}

    	return back()->with('LoginError','Login Failed');
    }
    public function logout(Request $request){
    	Auth::logout();
    	$request->session()->invalidate();
    	$request->session()->regenerateToken();
    	return redirect('/login');
    }
}
