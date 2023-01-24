<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;

class RegisterController extends Controller{
    
    public function index(){
    	return view('backend.authentikasi.register'); 
    }
    public function postRegistration(UserRequest $request){

        $validatedData = $request->safe()->merge([
            'is_admin' => 0
        ]);

    	$user = User::create($validatedData->all());
        

        return redirect('/login')->with('message', 'Registrasi berhasil');
    }

    public function tes(){
        return view('backend.authentikasi.emailverification');
    }
    
}