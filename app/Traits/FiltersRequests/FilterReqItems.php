<?php

namespace App\Traits\FiltersRequests;

use Illuminate\Http\Request;

trait FilterReqItems
{
    public function filter_req_items(Request $request,string $file_name=null):array
    {
        $name        = filter_var($request->name        ,FILTER_SANITIZE_STRING);
        $description = filter_var($request->description ,FILTER_SANITIZE_STRING);
        $condition   = filter_var($request->condition   ,FILTER_SANITIZE_STRING);
        $price       = filter_var($request->price       ,FILTER_SANITIZE_STRING);
        $file_name   = filter_var($file_name            ,FILTER_SANITIZE_STRING);

        return [
            'name'        => $name,
            'description' => $description,
            'condition'   => $condition,
            'price'       => $price,
            'file_name'   => $file_name,
        ];
    }
}
