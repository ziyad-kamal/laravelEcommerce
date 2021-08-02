<?php

namespace App\Traits;

trait Search{
    public function search($request){
        $search=$request->has('search')  ? $request->get('search')   :null;
        return $search;
    }
}