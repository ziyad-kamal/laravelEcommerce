<?php

namespace App\Traits\FiltersRequests;

trait FilterReqCategory
{
    public function filter_req_category(array $category):array
    {
        $name        = filter_var($category['name']        ,FILTER_SANITIZE_STRING);
        $description = filter_var($category['description'] ,FILTER_SANITIZE_STRING);

        return [
            'name'        => $name,
            'description' => $description,
        ];
    }
}
