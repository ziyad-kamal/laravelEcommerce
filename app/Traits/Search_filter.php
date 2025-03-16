<?php

namespace App\Traits;

use App\Models\Items;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

trait Search_filter
{
    public function search(Request $request):null|string
    {
        $search=$request->has('search')  ? $request->get('search')   :null;
        return $search;
    }

    public function filter_data(string $price=null,int $selected_category=null,array $selected_brands=[],string $search=null):LengthAwarePaginator
    {
        $items    = Items::with(['category','brands']);

        if ($search != null) {
            $items = $items->search($search);
        }

        if ($selected_category != null) {
            $items = $items->where('category_id', $selected_category);
        }

        if ($price != null) {
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
            $items=Items::whereIn('brand_id',$selected_brands);
        }

        $items = $items->orderBy('id','desc')->paginate(2);

        return $items;
    }
}
