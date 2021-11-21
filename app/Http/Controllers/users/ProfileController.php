<?php

namespace App\Http\Controllers\users;

use App\User;
use App\Models\Category;
use App\Traits\UploadImage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileRequest;
use App\Traits\FiltersRequests\FilterReqProfile;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    use UploadImage;
    use FilterReqProfile;

    public function __construct()
    {
        $this->middleware(['auth:web', 'verified']);
    }
####################################      index          #################################
    public function index()
    {
        try {
            $user_items=User::find(Auth::user()->id)->items;
            $categories=Category::where('translation_lang',defaultLang())->get();

            return view('users.profile.show',compact('user_items','categories'));

        } catch (\Exception $th) {
            return Redirect::to('/')->with(['error'=>'Something went wrong']);
        }
        
    }

####################################      update          #################################
    public function update(ProfileRequest $request)
    {
        try {
            $user=User::find(Auth::user()->id);

            $filtered_data=$this->filter_req_profile($request);

            $user->name     = $filtered_data['name'];
            $user->email    = $filtered_data['email'];
            $user->password = Hash::make($filtered_data['passoword']);
            $user->save();
    
            return response()->json(['success'=>'you updated profile successfully']);

        } catch (\Exception $th) {
            return response()->json(['error'=>'something went wrong'],500);
        }
        
    }

####################################      update photo          #################################
    public function updatePhoto(ProfileRequest $request)
    {
        try {
            $fileName=$this->uploadphoto($request,'images/users');

            $filtered_data=$this->filter_req_photo($fileName);

            $user=User::find(Auth::user()->id);
            $user->photo  = $filtered_data['fileName'];
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
