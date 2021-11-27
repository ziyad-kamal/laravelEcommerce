<?php

namespace App\Http\Controllers\admins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{Auth,Redirect};

class AdminsController extends Controller
{
    public function getLogin()
    {
        return view('admins.auth.login');
    }

    public function login(Request $request)
    {
        $credentials=$request->only('email','password');
        $auth = Auth::guard('admin');
        
        if ($auth instanceof \Illuminate\Contracts\Auth\StatefulGuard){
            if ($auth->attempt($credentials)) {
                return Redirect::to('admins/dashboard');
            } 
        }else{
            return Redirect::to('admins/get/login')->with(['error'=>'incorrect password or email']);
        }
    }

    public function getDashboard()
    {
        return view('admins.auth.dashboard');
    }

    public function logout(){
        Auth::logout();
        return Redirect::to('admins/get/login');
    }
    
}
