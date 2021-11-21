<?php

namespace App\Http\Controllers\users;

use App\Models\Comments;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CommentRequest;
use App\Traits\FiltersRequests\FilterReqComment;
use Illuminate\Support\Facades\Redirect;

class CommentController extends Controller
{
    use FilterReqComment;

    public function __construct()
    {
        $this->middleware(['auth:web','verified']);
    }
####################################      create          #################################
    public function create(CommentRequest $request,int $id){
        try {
            $filtered_data=$this->filter_req_comment($request);

            Comments::create([
                'comment'     => $filtered_data['comment'],
                'user_id'     => Auth::user()->id,
                'item_id'     => $id
            ]);
    
            return  redirect()->back()->with(['success'=>'you added comment successfully']);

        } catch (\Exception $ex) {
            return redirect()->back()->with(['error'=>'Something went wrong']);
        }
    
    }

####################################      edit          #################################
    public function edit(int $id){
        try {
            $comment=Comments::where(['id'=>$id,'user_id'=>Auth::id()]);
            if(!$comment){
                return redirect()->back()->with(['error'=>'no comment found']);
            }

            return view('users.items.editComment',compact('comment'));

        } catch (\Exception $ex) {
            return Redirect::to('items/get')->with(['error'=>'Something went wrong']);
        }
        
    }

####################################      update          #################################
    public function update(CommentRequest $request,int $id){
        try {
            $comment=Comments::where(['id'=>$id,'user_id'=>Auth::id()]);
            if(! $comment){
                return redirect()->back()->with(['error'=>'no comment found']);
            }

            $filtered_data=$this->filter_req_comment($request);

            $comment->comment  = $filtered_data['comment'];
            $comment->save();
                
            return redirect()->back()->with(['success'=>'you updated comment successfully']);
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error'=>'something went wrong']);
        }
        
    }


####################################      delete          #################################
    public function delete(int $id){
        try {
            $comment=Comments::where(['id'=>$id,'user_id'=>Auth::id()]);
            if(! $comment){
                return redirect()->back()->with(['error'=>'no comment found']);
            }
            $comment->delete();

            return redirect()->back()->with(['success'=>'you deleted comment successfully']);

        } catch (\Exception $th) {
            return Redirect::to('items/get')->with(['error'=>'Something went wrong']);
        }
        
    }

}
