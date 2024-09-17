<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{

    public function __construct(){
        View::share('active', 'User');
    }

    public function index(){
    	return view('backend.user.index');
    }

    public function show(User $user){
    	return view('backend.user.show', ['data' => $user]);
    }
}
