<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller{
    
    public function index(){
    	return view('backend.authentikasi.login'); 
    }
    public function authenticate(Request $request){
    	$this->validate($request, [
        	'login'    => 'required',
        	'password' => 'required',
    	]);

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
