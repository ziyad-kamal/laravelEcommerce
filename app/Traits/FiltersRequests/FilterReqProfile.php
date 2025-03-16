<?php

namespace App\Traits\FiltersRequests;

use Illuminate\Http\Request;

trait FilterReqProfile
{
    public function filter_req_profile(Request $request):array
    {
        $name     = filter_var($request->get('name')       ,FILTER_SANITIZE_STRING);
        $email    = filter_var($request->get('email')      ,FILTER_SANITIZE_EMAIL);
        $password = filter_var($request->get('password')   ,FILTER_SANITIZE_STRING);

        return [
            'name'     => $name,
            'email'    => $email,
            'password' => $password,
        ];
    }

    public function filter_req_photo(string $fileName):array
    {
        $fileName = filter_var($fileName   ,FILTER_SANITIZE_STRING);

        return [
            'fileName'     => $fileName,
        ];
    }
}
