<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\Languagerequest;
use App\Models\Language;
use App\Traits\FiltersRequests\FilterReqLang;

class LanguageController extends Controller
{
    use FilterReqLang;
    ##############################      index    #####################################
    public function index()
    {
        try {
            $language=Language::selection()->get();
            return view('admins.language.show',compact('language'));
        } catch (\Exception $th) {
            return redirect()->back()->with(['error'=>'something went wrong']);
        }
        
    }

    ##############################      create     #####################################
    public function create()
    {
        return view('admins.language.create');
    }

    ##############################      store     #####################################
    public function store(Languagerequest $request)
    {
        try {
            $filtered_data=$this->filter_req_lang($request);
            
            Language::create([
                'name'      => $filtered_data['name'],
                'abbr'      => $filtered_data['abbr'],
                'direction' => $filtered_data['direction'],
            ]);
    
            return redirect()->back()->with(['success'=>'you created category successfully']);

        } catch (\Exception $th) {
            return redirect()->back()->with(['error'=>'something went wrong']);
        }
    }
}
