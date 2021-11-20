<?php

namespace App\Traits;

trait GetDefault
{
    public function getDefault($item):array
    {
        $collected_item=collect($item);
        $filter=$collected_item->filter(function($val){
            //defaultLang() autoload from app\helpers\general
            return $val['abbr'] == defaultLang();
        });

        return array_values($filter->all())[0];
    }

    public function getOther($item)
    {
        $collected_item=collect($item);
        return $collected_item->filter(function($val){
            //defaultLang() autoload from app\helpers\general
            return $val['abbr'] != defaultLang();
        });
    }
}
