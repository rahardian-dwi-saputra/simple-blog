<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller{
    
    public function index(){
    	return view('backend.authentikasi.register'); 
    }
}