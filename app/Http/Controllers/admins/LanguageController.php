<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\Languagerequest;
use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function index(){
        $language=Language::selection()->get();
        return view('admins.language.show',compact('language'));
    }

    public function create(){
        
        return view('admins.language.create');
    }

    public function store(Languagerequest $request){
        try {
            $name      = filter_var($request->get('name')        ,FILTER_SANITIZE_STRING);
            $abbr      = filter_var($request->get('abbr')        ,FILTER_SANITIZE_STRING);
            $direction = filter_var($request->get('direction')   ,FILTER_SANITIZE_STRING);
    
            Language::create([
                'name'      => $name,
                'abbr'      => $abbr,
                'direction' => $direction,
            ]);
    
            return redirect()->back()->with(['success'=>'you created category successfully']);

        } catch (\Exception $th) {
            return redirect()->back()->with(['error'=>'something went wrong']);
        }
    }
}
