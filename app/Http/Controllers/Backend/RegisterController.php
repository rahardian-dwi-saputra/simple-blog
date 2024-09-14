<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index(){
    	return view('backend.authentikasi.register'); 
    }
    public function postRegistration(Request $request){
    	$validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|unique:users,username|min:6|max:255',
            'email' => 'required|unique:users,email|email:dns|max:255',
            'password' => 'required|min:8'
        ]);
    }
}
