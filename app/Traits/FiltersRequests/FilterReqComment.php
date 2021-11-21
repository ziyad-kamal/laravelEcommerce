<?php

namespace App\Traits\FiltersRequests;

use Illuminate\Http\Request;

trait FilterReqComment
{
    public function filter_req_comment(Request $request):array
    {
        $comment  = filter_var($request->get('comment')        ,FILTER_SANITIZE_STRING);

        return [
            'comment'      => $comment,
        ];
    }
}
