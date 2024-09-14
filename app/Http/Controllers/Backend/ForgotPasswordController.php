<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    public function index(){
    	return view('backend.authentikasi.forgotpassword'); 
    }
    public function submitForgetPasswordForm(Request $request){

    	$request->validate([
            'email' => 'required|email|exists:users'
        ]);

        $token = Str::random(64);

        DB::table('password_reset_tokens')->insert([
            'email' => $request->email, 
            'token' => $token, 
            'created_at' => Carbon::now()
        ]);

        $mailData = [
            'token' => $token
        ];

        Mail::to($request->email)->send(new ResetPasswordMail($mailData));

        return back()->with('message', 'We have e-mailed your password reset link!');
    }
    public function showResetPasswordForm($token){
        return view('backend.authentikasi.resetpassword', ['token' => $token]);
    }
    public function submitResetPasswordForm(Request $request){

        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users',
            'password' => 'required|min:5|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_reset_tokens')->where([
            'email' => $request->email, 
            'token' => $request->token
        ])->first();

        if(!$updatePassword){
            return back()->with('message','Invalid token!');
        }

        $user = User::where('email', $request->email)->update([
            'password' => Hash::make($request->password)
        ]);
 
        DB::table('password_reset_tokens')->where(['email'=> $request->email])->delete();
  
        return redirect('/login')->with('message', 'Your password has been changed!');
    }
}
