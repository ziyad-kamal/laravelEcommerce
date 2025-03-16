<?php

namespace App\Traits;

use App\Models\Items;
use App\Models\Orders;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;

trait PaymentOrder
{
    public function paymentOrder(Items $item,LengthAwarePaginator $comments,string $url):View
    {
        $payment_status = $this->getPaymentStatus($url);
        
        if (isset($payment_status['id'])) {
            Orders::create([
                'item_id'             => $item->id,
                'bank_transaction_id' => $payment_status['id'],
                'user_id'             => Auth::user()->id,
                'total_amount'        => $item->price,
            ]);
            
            $msg='the operation is finished successfully';
            return view('users.items.details', compact('item', 'comments','msg'));
        }else{
            $error='the operation is failed';
            return view('users.items.details', compact('item', 'comments','error'));
        } 
    }

    public function getPaymentStatus(string $url,$data=null):array
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg='));
        if ($data==null) {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        }else{
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if (curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);

        return json_decode($responseData , true) ;
    }

    public function generateUrl(string $resourcePath):string
    {
        $url = "https://test.oppwa.com/";
        $url .=$resourcePath;
        $url .= "?entityId=8a8294174b7ecb28014b9699220015ca";

        return $url ;
    }
}
