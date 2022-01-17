<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class loginController extends Controller
{
    public function halamanlogin(){
        return view ('login');
    }

    public function login(Request $request){
        // $data = User::where('email',$request->email)->firstOrFail();
        // if($data){
        //     if(Hash::check($request->password,$data->password)){
        //         session(['berhasil_login' => true]);
        //         return redirect('/dashboard');
        //     }
        // }
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect('/dashboard');
        }
        return redirect('/')->with('message','Email atau password salah!');
}

    public function logout(Request $request){
        Auth::logout();
        return redirect ('/');
    }

}
