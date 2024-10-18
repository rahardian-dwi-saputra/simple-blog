<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Support\Facades\Hash;
use Validator;

class ProfileController extends Controller
{
	public function __construct(){
        View::share('active', 'Profil');
    }

    public function index(){ 
    	return view('backend.profile.myprofile');
    }

    public function change_foto(Request $request){

        $validator = Validator::make($request->all(), [
            'profile_picture' => 'required|image|max:1000|mimes:png,jpg,jpeg',
        ]);

        if($validator->fails()){
            return $validator->errors();            
        }

        if ($request->hasFile('profile_picture')) {
            
            if(auth()->user()->foto){
                Storage::delete(auth()->user()->foto);
            }

            // Rename image
            $filename = time().'.'.$request->file('profile_picture')->guessExtension();
            
            $path = $request->file('profile_picture')->storeAs(
                'profile_pictures', $filename
            );

            User::where('id', auth()->user()->id)->update(['foto' => $path]);

            return response()->json([
                'success' => true,
                'message' => 'Foto profil berhasil diunggah',
            ]);        
        }
        
        return response()->json([
            'success' => false,
            'message' => 'Foto profil gagal diunggah',
        ]);
    }

    public function edit_profile(){
    	return view('backend.profile.edit');
    }

    public function update_profile(Request $request){
        $rules = [
            'name' => 'required|string|max:255|min:4'
        ];

        if($request->username != auth()->user()->username){
            $rules['username'] = 'required|unique:users,username|max:255|min:4';
        }

        if($request->email != auth()->user()->email){
            $rules['email'] = 'required|unique:users,email|max:255|email';
        }

        $validated = $request->validate($rules);
        User::where('id', auth()->user()->id)->update($validated);
        return redirect('/myprofil')->with('success','Data Profil Berhasil Diedit');
    }

    public function edit_sandi(){
        return view('backend.profile.ubah_sandi');
    }

    public function update_sandi(UpdatePasswordRequest $request){
        $request->user()->update([
            'password' => Hash::make($request->get('new_password'))
        ]);
        return redirect('/myprofil')->with('success','Password berhasil diubah');
    }
}
