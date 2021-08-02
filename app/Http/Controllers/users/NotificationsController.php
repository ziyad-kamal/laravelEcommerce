<?php

namespace App\Http\Controllers\users;

use App\Models\Comments;
use App\Traits\Notifications;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    use Notifications;
    
    public function __construct()
    {
        $this->middleware(['auth:web', 'verified']);
    }
####################################      show          #################################
    public function show()
    {
        //try {
            $user_id                  = Auth::user()->id;
            $items_id                 = $this->auth_items_id();
            $notifications_not_readed = $this->notifications_not_readed($user_id);

            $notifications_not_readed_count  = $notifications_not_readed->count();

            $all_notifications = Comments::with(['users','items'])->whereIn('item_id',$items_id)
                            ->where('user_id','!=',$user_id)->orderBy('id','desc')->get();

            $view=view('users.items.notifs_items',compact('all_notifications'))->render();
            
            return response()->json(compact('notifications_not_readed_count','view'));

        //} catch (\Exception $th) {
            return response()->json(['error'=>'something went wrong'],500);
        //}
        
    }

####################################      update          #################################
    public function update()
    {
        try {
            $notifications_not_readed=$this->notifications_not_readed(Auth::user()->id); 
            $comments_ids  = $notifications_not_readed->pluck('id')->toArray();
            Comments::whereIn('id', $comments_ids)
                ->update([
                    'notification' => 1,
                ]);

        } catch (\Exception $th) {
            return response()->json(['error'=>'something went wrong'],500);
        }
        
    }
}
