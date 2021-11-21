<?php

namespace App\Traits\FiltersRequests;

use Illuminate\Http\Request;

trait FilterReqLang
{
    public function filter_req_lang(Request $request):array
    {
        $name      = filter_var($request->get('name')        ,FILTER_SANITIZE_STRING);
        $abbr      = filter_var($request->get('abbr')        ,FILTER_SANITIZE_STRING);
        $direction = filter_var($request->get('direction')   ,FILTER_SANITIZE_STRING);

        return [
            'name'      => $name,
            'abbr'      => $abbr,
            'direction' => $direction,
        ];
    }
}
