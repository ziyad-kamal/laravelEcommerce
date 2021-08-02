<?php

namespace App\Http\Controllers\users;

use App\Models\Orders;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:web', 'verified']);
    }
    ################################      index          #################################
    public function index()
    {
        try {
            $orders=Orders::with('items')->selection()->where('user_id',Auth::user()->id)
                        ->orderBy('id','desc')->get();

            return view('users.orders.show',compact('orders'));

        } catch (\Exception $ex) {
            return redirect()->back()->with(['error'=>'Something went wrong']);
        }
        
    }

####################################      delete          #################################
    public function delete($id)
    {
        try {
            $order=Orders::find($id);
            if(! $order){
                return Redirect::to('orders/show')->with(['error'=>'no order found']);
            }
            $order->delete();
    
            return redirect()->back()
                ->with(['success'=>'you canceled order and 
                you will recieve your money in 2 days ']);
                
        } catch (\Exception $ex) {
            return Redirect::to('orders/show')->with(['error'=>'Something went wrong']);
        }
        
    }
}
