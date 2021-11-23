<?php

namespace App\Traits;

use Illuminate\Support\Collection;

trait GetDefault
{
    public function getDefault(array $item):array
    {
        $collected_item=collect($item);
        $filter=$collected_item->filter(function($val){
            //defaultLang() autoload from app\helpers\general
            return $val['abbr'] == defaultLang();
        });

        return array_values($filter->all())[0];
    }

    public function getOther(array $item):Collection
    {
        $collected_item=collect($item);
        return $collected_item->filter(function($val){
            //defaultLang() autoload from app\helpers\general
            return $val['abbr'] != defaultLang();
        });
    }
}
