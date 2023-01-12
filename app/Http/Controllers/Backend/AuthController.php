<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller{
    
    public function index(){
    	return view('backend.login'); 
    }
    public function authenticate(Request $request){
    	
    }
}
