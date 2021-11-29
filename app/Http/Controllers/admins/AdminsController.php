<?php

namespace App\Http\Controllers\admins;

use App\models\Admins;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\{Auth,Hash};
use Illuminate\Http\{Request,RedirectResponse};

class AdminsController extends Controller
{
    ####################################     getlogin      ################################
    public function getLogin():View
    {
        return view('admins.auth.login');
    }

    ####################################      login      ################################
    public function login(Request $request):RedirectResponse
    {
        $credentials=$request->only('email','password');
        $auth = Auth::guard('admins');
        
        if ($auth instanceof \Illuminate\Contracts\Auth\StatefulGuard){
            if ($auth->attempt($credentials)) {
                return redirect('admins/dashboard');
            } 
        }else{
            return redirect('admins/get/login')->with(['error'=>'incorrect password or email']);
        }
    }

    ####################################     logout      ################################
    public function logout():RedirectResponse
    {
        Auth::logout();
        return redirect('admins/get/login');
    }

    ####################################     getadmins      ################################
    public function index():View
    {
        $admins=Admins::all();
        return view('admins.admin.show',compact('admins'));
    }

    ####################################     create      ################################
    public function create():View
    {
        return view('admins.admin.create');
    }

    ####################################      store      ################################
    public function store(ProfileRequest $request):RedirectResponse
    {
        Admins::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success','you added admin successfully');
    }

    ####################################     edit        ################################
    public function edit(int $id):View
    {
        $admin=Admins::find($id);
        if (!$admin) {
            return redirect()->back()->with('error','not found');
        }
        return view('admins.admin.edit',compact('admin'));
    }

    ####################################     update      ################################
    public function update(int $id,ProfileRequest $request):RedirectResponse
    {
        $admin=Admins::find($id);

        $admin->name     = $request->name;
        $admin->email    = $request->email;
        $admin->password = Hash::make($request->password);

        $admin->save();

        return redirect()->back()->with('success','you updated admin successfully');
    }

    ####################################     delete      ################################
    public function delete(int $id):RedirectResponse
    {
        $admin=Admins::find($id);
        if (!$admin) {
            return redirect()->back()->with('error','not found');
        }

        $admin->delete();

        return redirect()->back()->with('success','you deleted admin successfully');
    }
}
