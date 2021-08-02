<?php

namespace App\Http\Controllers\users;

use App\User;
use App\Models\Items;
use App\Models\Category;
use App\Traits\UploadImage;
use Illuminate\Http\Request;

use App\Http\Requests\photoRequest;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


class ProfileController extends Controller
{
    use UploadImage;
    
    public function __construct()
    {
        $this->middleware(['auth:web', 'verified']);
    }
####################################      index          #################################
    public function index(){
        //try {
            $user_items=User::find(Auth::user()->id)->items;
            $categories=Category::where('translation_lang',defaultLang())->get();

            return view('users.profile.show',compact('user_items','categories'));

        //} catch (\Exception $th) {
            return Redirect::to('/')->with(['error'=>'Something went wrong']);
        //}
        
    }

####################################      update          #################################
    public function update(ProfileRequest $request){
        try {
            $user=User::find(Auth::user()->id);

            $name     = filter_var($request->get('name')       ,FILTER_SANITIZE_STRING);
            $email    = filter_var($request->get('email')      ,FILTER_SANITIZE_EMAIL);
            $password = filter_var($request->get('password')   ,FILTER_SANITIZE_STRING);

            $user->name     = $name;
            $user->email    = $email;
            $user->password = Hash::make($password);
            $user->save();
    
            return response()->json(['success'=>'you updated profile successfully']);

        } catch (\Exception $th) {
            return response()->json(['error'=>'something went wrong'],500);
        }
        
    }

####################################      update photo          #################################
    public function updatePhoto(ProfileRequest $request){
        try {
            $fileName=$this->uploadphoto($request,'images/users');

            $file_name = filter_var($fileName   ,FILTER_SANITIZE_STRING);

            $user=User::find(Auth::user()->id);
            $user->photo  = $file_name;
            $user->save();

            $data=[
                'photo'   => $fileName,
                'success' => 'you updated photo successfully'
            ];
    
            return response()->json($data);
        } catch (\Exception $th) {
            return response()->json(['error'=>'something went wrong'],500);
        }
        
    }
}
