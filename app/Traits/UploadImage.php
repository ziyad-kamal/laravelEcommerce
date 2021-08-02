<?php

namespace App\Traits;

trait UploadImage{
    public function uploadphoto($request,$path){
        $file     = $request->file('photo');
        $fileName = time() . '-' . $file-> getClientOriginalName();
        
        $file->move($path , $fileName);
        return $fileName;
    }
}