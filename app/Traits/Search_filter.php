<?php

namespace App\Traits;

use App\Models\Items;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

trait Search_filter
{
    public function search(Request $request):null|string
    {
        $search=$request->has('search')  ? $request->get('search') :null;
        return $search;
    }

    public function filter_data(string $price,int $selected_category,array $selected_brands,string $search=null):LengthAwarePaginator
    {
        $items = Items::query();

        if ($search != null) {
            $items = $items->search($search);
        }

        if ($selected_category != 0) {
            $items = $items->where('category_id', $selected_category);
        }

        if ($price != '') {
            $items = $items->when($price, function ($q) use ($price) {
                if ($price == "price_0_500") {
                    $q->whereBetween('price', [0, 500]);
                }

                if ($price == "price_501_1500") {
                    $q->whereBetween('price', [501, 1500]);
                }

                if ($price == "price_1501_3000") {
                    $q->whereBetween('price', [1501, 3000]);
                }

                if ($price == "price_3001_5000") {
                    $q->whereBetween('price', [3001, 5000]);
                }
            });
        }

        if(count($selected_brands) > 0){
            $items= $items->whereIn('brand_id', $selected_brands);
        }

        $items = $items->orderBy('id','desc')->paginate(6);

        return $items;
    }
}
