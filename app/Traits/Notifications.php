<?php

namespace App\Traits;

use App\Models\Comments;
use Illuminate\Database\Eloquent\Collection;

trait Notifications
{
    public function auth_items_id():array
    {
        $items_id  = auth()->user()->items->pluck('id')->toArray();

        return $items_id;
    }

    public function notifications_not_readed(int $user_id):Collection
    {
        $items_id                 = $this->auth_items_id();
        $notifications_not_readed = Comments::whereIn('item_id',$items_id)
                            ->where('user_id','!=',$user_id)->where('notification',0)->get();
        
        return $notifications_not_readed;
    }
}
