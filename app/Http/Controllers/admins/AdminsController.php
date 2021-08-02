<?php

namespace App\Http\Controllers\admins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AdminsController extends Controller
{
    public function getLogin(){
        return view('admins.auth.login');
    }

    public function login(Request $request){
        $credentials=$request->only('email','password');

        if(auth()->guard('admins')->attempt($credentials)){
            return Redirect::to('admins/dashboard');
        }else{
            return Redirect::to('admins/get/login')->with(['error'=>'incorrect password or email']);
        }
    }

    public function getDashboard(){
        return view('admins.auth.dashboard');
    }

    public function logout(){
        Auth::logout();
        return Redirect::to('admins/get/login');
    }
    
}
