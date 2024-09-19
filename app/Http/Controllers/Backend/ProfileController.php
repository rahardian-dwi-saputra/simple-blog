<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ProfileController extends Controller
{
	public function __construct(){
        View::share('active', 'Profil');
    }
    public function index(){
    	return view('backend.profile.myprofile');
    }
}
