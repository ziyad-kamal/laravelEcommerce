<?php

namespace App\Http\Controllers\users;

use DB;
use App\Models\Items;
use App\Models\Brands;
use App\Models\Orders;
use App\Models\Review;
use App\Traits\Search;
use App\Models\Category;
use App\Models\Comments;
use App\Traits\UploadImage;
use Illuminate\Http\Request;
use App\Http\Requests\ItemRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Cviebrock\EloquentSluggable\Services\SlugService;


class ItemsController extends Controller
{
    use UploadImage;
    use Search;

    public function __construct()
    {
        $this->middleware(['auth:web', 'verified'])->except('show', 'showResults');
    }
#########################################    index    ####################################
    public function index()
    {
        try {
            $categories = Category::where('translation_lang',defaultLang())->get();
            $brands=Brands::all();
            return view('users.items.create', compact('categories','brands'));

        } catch (\Exception $ex) {
            return Redirect::to('items/get')->with(['error'=>'something went wrong']);
        }
        
    }

#########################################    create    ####################################
    public function create(ItemRequest $request)
    {
        try {
            //import from traits uploadImage
            $fileName = $this->uploadphoto($request, 'images/items');

            $name        = filter_var($request->get('name')       ,FILTER_SANITIZE_STRING);
            $description = filter_var($request->get('description'),FILTER_SANITIZE_STRING);
            $condition   = filter_var($request->get('condition')  ,FILTER_SANITIZE_STRING);
            $price       = filter_var($request->get('price')      ,FILTER_SANITIZE_STRING);
            $file_name   = filter_var($fileName                   ,FILTER_SANITIZE_STRING);

            Items::create([
                'name'        => $name,
                'slug'        => SlugService::createSlug(Items::class,'slug',$name),
                'description' => $description,
                'condition'   => $condition,
                'price'       => $price,
                'photo'       => $file_name,
                'date'        => now(),
                'users_id'    => Auth::user()->id,
                'category_id' => $request->get('category_id'),
                'brand_id'    => $request->get('brand_id'),
            ]);

            return Redirect::to('items/create')->with(['success' => 'you created item successfully']);

        } catch (\Exception $th) {
            return redirect()->back()->with(['error'=>'Something went wrong']);
        }
        
    }

#########################################      show items     ####################################
    public function show(Request $request)
    {
        try {
            //import from trait (search)
            $search            = $this->search($request);
            $price             = $request->has('price') ? $request->get('price') : null;
            $selected_category = $request->has('category') ? $request->get('category') : null;
            $selected_brands   = $request->has('brands') ? $request->get('brands') : [];

            $items    = Items::with(['category','brands']);
            $category = Category::where('translation_lang',defaultLang())->get();
            $brands   = Brands::all();

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

            if ($request->has('agax')) {
                $view = view('users.items.allItems', compact('items'))->render();
                return response()->json(['html' => $view,'items'=>$items]);
            }

            return view('users.items.show',
                    compact('items', 'search', 'price', 'selected_category', 'category','brands','selected_brands'));

        } catch (\Exception $th) {
            return redirect()->back()->with(['error'=>'Something went wrong']);
        }
        
    }

#########################################      show item details      ####################################
    public function showDetails($slug, Request $request)
    {
        try {
            $item    = Items::where('slug',$slug)->first();
            $item_id = $item->id;

            if(!$item){
                return Redirect::to('items/get')->with(['error'=>'Something went wrong']);
            }

            $comments = Comments::with('users')->where('item_id', $item_id)
                    ->orderBy('id','desc')->paginate(3);
            
            if (request('id') && request('resourcePath')) {
                $payment_status = $this->getPaymentStatus(request('id'), request('resourcePath'));
                if (isset($payment_status['id'])) {
                    Orders::create([
                        'item_id'             => $item_id,
                        'bank_transaction_id' => $payment_status['id'],
                        'user_id'             => Auth::user()->id,
                        'total_amount'        => $item->price,
                    ]);
    
                    $msg='the operation is finished successfully';
                    return view('users.items.details', compact('item', 'comments','msg'));
                } else {
                    $error='the operation is failed';
                    return view('users.items.details', compact('item', 'comments','error'));
                }
    
            }
            
            if ($request->has('agax')) {
                $view = view('users.items.comments', compact('comments'))->render();
                return response()->json(['html' => $view]);
            }
    
            return view('users.items.details', compact('item', 'comments'));

        } catch (\Exception $th) {
            return Redirect::to('items/get')->with(['error'=>'something went wrong']);
        }
        
    }

#########################################       payment status      ####################################
    public function getPaymentStatus($id,$resourcePath)
    {
        try {
            $url = "https://test.oppwa.com/";
            $url .=$resourcePath;
            $url .= "?entityId=8a8294174b7ecb28014b9699220015ca";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Authorization:Bearer OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg='));
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // this should be set to true in production
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $responseData = curl_exec($ch);
            if (curl_errno($ch)) {
                return curl_error($ch);
            }
            curl_close($ch);

            return json_decode($responseData , true) ;

        } catch (\Exception $th) {
            return redirect()->back()->with(['error'=>'Something went wrong']);
        }
        
    }

#########################################      get checkout      ####################################
    public function getCheckout(Request $request)
    {
        try {
            $url = "https://test.oppwa.com/v1/checkouts";
            $data = "entityId=8a8294174b7ecb28014b9699220015ca" .
                    "&amount=" . $request->price .
                    "&currency=EUR" .
                    "&paymentType=DB";
    
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Authorization:Bearer OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg='));
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // this should be set to true in production
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $responseData = curl_exec($ch);
            if (curl_errno($ch)) {
                return curl_error($ch);
            }
            curl_close($ch);
            $res=json_decode($responseData,true);
            $item_id=$request->item_id;
    
            $view=view('users.items.checkout',compact('res','item_id'))->render();
    
            return response()->json(['form'=>$view]);
        } catch (\Exception $th) {
            return Redirect::to('items/get')->with(['error'=>'something went wrong']);
        }
        
    }

#########################################     delete      ####################################
    public function deleteItem(Request $request)
    {
        try {
            $item_id = $request->id;
            $item = Items::find($item_id);
            if(! $item){
                return response()->json(['error'=>'item not found'],404);
            }

            $item->delete();
            $data = [
                'success' => 'this item is deleted successfully',
                'item_id' => $item_id,
            ];

            return response()->json($data);
        } catch (\Exception $th) {
            return response()->json(['error'=>'something went wrong'],500);
        }
    }

#########################################      edit       ####################################
    public function editItem(Request $request)
    {
        try {
            $item = Items::find($request->id);
            if(! $item){
                return response()->json(['error'=>'item not found'],404);
            }

            return response()->json(compact('item'));

        } catch (\Exception $th) {
            return response()->json(['error'=>'something went wrong'],500);
        }
        
    }

#########################################      update       ####################################
    public function update(ItemRequest $request)
    {
        try {
            if ($request->file('photo')) {
                //import from traits uploadImage
                $fileName = $this->uploadphoto($request, 'images/items');
            } else {
                $fileName = $request->get('filename');
            }

            $name        = filter_var($request->get('name')       ,FILTER_SANITIZE_STRING);
            $description = filter_var($request->get('description'),FILTER_SANITIZE_STRING);
            $condition   = filter_var($request->get('condition')  ,FILTER_SANITIZE_STRING);
            $price       = filter_var($request->get('price')      ,FILTER_SANITIZE_STRING);
            $file_name   = filter_var($fileName                   ,FILTER_SANITIZE_STRING);

            $item              = Items::find($request->id);
            if(! $item){
                return response()->json(['error'=>'item not found'],404);
            }

            $item->name        = $name;
            $item->description = $description;
            $item->condition   = $condition;
            $item->price       = $price;
            $item->category_id = $request->get('category_id');
            $item->photo       = $file_name;

            $item->save();

            return response()->json(compact('item'));
        } catch (\Exception $th) {
            return response()->json(['error'=>'something went wrong'],500);
        }
        
    }

#########################################      show search results       ####################################
    public function showResults(Request $request)
    {
        //try {
            //import from trait (search)
            $search = $this->search($request);
            if ($search != null) {
                $items = Items::search($search)->get();
            } else {
                $items = null;
            }

            $user_auth = Auth::user();

            return response()->json(compact('items', 'search', 'user_auth'));

        //} catch (\Exception $th) {
            return response()->json(['error'=>'something went wrong'],500); 
        //}
    }

#########################################        rate        ####################################
    public function rate(Request $request)
    {
        try {
            DB::beginTransaction();

            $item_id      = $request->item_id;
            $item         = Items::find($item_id);
            if(! $item){
                return Redirect::to('orders/show')->with(['error'=>'item not found']);
            }

            $item_rate    = $item->rate;
            $rate_count   = Review::where('item_id',$item_id)->count();
            $request_rate = $request->rate;

            $new_rate=(($item_rate * $rate_count) + $request_rate) / ($rate_count + 1);

            $item->rate=$new_rate;
            $item->save();

            Review::create([
                'rate'    => $request_rate,
                'item_id' => $item_id,
                'user_id' => Auth::user()->id
            ]);

            $order=Orders::find($request->order_id);
            if(! $order){
                return Redirect::to('orders/show')->with(['error'=>'order not found']);
            }
            
            $order->rating=1;
            $order->save();

            DB::commit();

            return Redirect::to('orders/show')->with(['success'=>'thank you for review']);

        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back()->with(['error'=>'something went wrong']);
        }
        
    }

    public function getRate()
    {
        
    }
}
