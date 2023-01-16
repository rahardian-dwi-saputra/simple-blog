<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller{
    
    public function index(){
    	return view('backend.authentikasi.register'); 
    }
    public function postRegistration(Request $request){
    	$request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|unique:users|min:3|alpha_dash',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|confirmed',
        ]);
    }
}