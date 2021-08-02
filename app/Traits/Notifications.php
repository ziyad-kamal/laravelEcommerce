<?php

namespace App\Traits;

use App\Models\Comments;


trait Notifications{
    public function auth_items_id(){
        $items_id  = auth()->user()->items->pluck('id')->toArray();

        return $items_id;
    }
    public function notifications_not_readed($user_id){
        $items_id                 = $this->auth_items_id();
        $notifications_not_readed = Comments::whereIn('item_id',$items_id)
                            ->where('user_id','!=',$user_id)->where('notification',0)->get();
        
        return $notifications_not_readed;
    }
}