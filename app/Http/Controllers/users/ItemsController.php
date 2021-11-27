<?php

namespace App\Http\Controllers\users;

use App\Http\Requests\ItemRequest;
use App\Http\Controllers\Controller;
use App\Traits\FiltersRequests\FilterReqItems;
use Illuminate\Support\Facades\{Auth,DB};
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Traits\{UploadImage,PaymentOrder,Search_filter};
use App\Models\{Items,Brands,Orders,Review,Category,Comments};
use Illuminate\Contracts\View\View;
use Illuminate\Http\{RedirectResponse,JsonResponse,Request};

class ItemsController extends Controller
{
    use UploadImage ,PaymentOrder ,FilterReqItems, Search_filter;

    public function __construct()
    {
        $this->middleware(['auth:web','verified'])->except('show', 'showResults');
    }
#########################################    index    ####################################
    public function index():View|RedirectResponse
    {
        try {
            $categories = Category::where('translation_lang',defaultLang())->get();
            $brands=Brands::all();
            return view('users.items.create', compact('categories','brands'));

        } catch (\Exception $ex) {
            return redirect('items/get')->with(['error'=>'something went wrong']);
        }
        
    }

#########################################    create    ####################################
    public function create(ItemRequest $request):RedirectResponse
    {
        try {
            //import from app/Traits/uploadImage
            $file_name = $this->uploadphoto($request, 'images/items');

            $fiterd_data=$this->filter_req_items($request,$file_name);

            Items::create([
                'name'        => $fiterd_data['name'] ,
                'slug'        => SlugService::createSlug(Items::class,'slug',$fiterd_data['name'] ),
                'description' => $fiterd_data['description'],
                'condition'   => $fiterd_data['condition'],
                'price'       => $fiterd_data['price'],
                'photo'       => $fiterd_data['file_name'],
                'date'        => now(),
                'users_id'    => Auth::user()->id,
                'category_id' => $request->get('category_id'),
                'brand_id'    => $request->get('brand_id'),
            ]);

            return redirect('items/create')->with(['success' => 'you created item successfully']);

        } catch (\Exception $th) {
            return redirect()->back()->with(['error'=>'Something went wrong']);
        }
        
    }

#########################################      show items     ####################################
    public function show(Request $request):View|RedirectResponse|JsonResponse
    {
        try {
            $search            = $this->search($request);
            $price             = $request->has('price') ? $request->get('price') : null;
            $selected_category = $request->has('category') ? $request->get('category') : null;
            $selected_brands   = $request->has('brands') ? $request->get('brands') : [];

            $items=$this->filter_data($price,$selected_category,$selected_brands,$search);

            $category = Category::where('translation_lang',defaultLang())->get();
            $brands   = Brands::all();

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
/**
 * @return 
 */
    public function showDetails(string $slug, Request $request):View|RedirectResponse|JsonResponse
    {
        try {
            $item    = Items::where('slug',$slug)->first();
            if(!$item){
                return redirect('items/get')->with(['error'=>'Something went wrong']);
            }

            $comments = Comments::with('users')->where('item_id', $item->id)
                    ->orderBy('id','desc')->paginate(3);
            
            $resourcePath=request('resourcePath');
            if ($resourcePath) {
                $url=$this->generateUrl($resourcePath);
                
                $this->paymentOrder($item,$comments,$url);
            }

            if ($request->has('agax')) {
                $view = view('users.items.comments', compact('comments'))->render();
                return response()->json(['html' => $view]);
            }
    
            return view('users.items.details', compact('item', 'comments'));

        } catch (\Exception $th) {
            return redirect('items/get')->with(['error'=>'something went wrong']);
        }
        
    }

#########################################      get checkout      ####################################
    public function getCheckout(Request $request):JsonResponse
    {
        try {
            $url  = "https://test.oppwa.com/v1/checkouts";
            $data = "entityId=8a8294174b7ecb28014b9699220015ca" .
                    "&amount=" . $request->price .
                    "&currency=EUR" .
                    "&paymentType=DB";
    
            $res=$this->getPaymentStatus($url,$data);
            
            $item_slug=$request->item_slug;
    
            $view=view('users.items.checkout',compact('res','item_slug'))->render();
    
            return response()->json(['form'=>$view]);
        } catch (\Exception $th) {
            return response()->json(['error'=>'something went wrong']);
        }
        
    }

#########################################     delete      ####################################
    public function deleteItem(Request $request):JsonResponse
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
    public function editItem(Request $request):JsonResponse
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
    public function update(ItemRequest $request):JsonResponse
    {
        try {
            if ($request->file('photo')) {
                //import from traits uploadImage
                $file_name = $this->uploadphoto($request, 'images/items');
            } else {
                $file_name = $request->get('filename');
            }

            $fiterd_data=$this->filter_req_items($request,$file_name);

            $item              = Items::find($request->id);
            if(! $item){
                return response()->json(['error'=>'item not found'],404);
            }

            $item->name        = $fiterd_data['name'];
            $item->description = $fiterd_data['description'];
            $item->condition   = $fiterd_data['condition'];
            $item->price       = $fiterd_data['price'];
            $item->category_id = $request->get('category_id');
            $item->photo       = $fiterd_data['file_name'];

            $item->save();

            return response()->json(compact('item'));
        } catch (\Exception $th) {
            return response()->json(['error'=>'something went wrong'],500);
        }
        
    }

#########################################      show search results       ####################################
    public function showResults(Request $request):JsonResponse
    {
        try {
            //import from trait (search)
            $search = $this->search($request);
            if ($search != null) {
                $items = Items::search($search)->get();
            } else {
                $items = null;
            }

            $user_auth = Auth::user();

            return response()->json(compact('items', 'search', 'user_auth'));

        } catch (\Exception $th) {
            return response()->json(['error'=>'something went wrong'],500); 
        }
    }

#########################################        rate        ####################################
    public function rate(Request $request):RedirectResponse
    {
        try {
            DB::beginTransaction();

            $item_id      = $request->item_id;
            $item         = Items::find($item_id);
            if(! $item){
                return redirect('orders/show')->with(['error'=>'item not found']);
            }

            $request_rate = (int)$request->rate;

            $old_rates=Review::where('item_id',$item_id)->pluck('rate')->toArray();
            
            array_push($old_rates,$request_rate);
            
            $new_rate=collect($old_rates)->avg();
            
            $item->rate=$new_rate;
            $item->save();

            Review::create([
                'rate'    => $request_rate,
                'item_id' => $item_id,
                'user_id' => Auth::user()->id
            ]);

            $order=Orders::find($request->order_id);
            if(! $order){
                return redirect('orders/show')->with(['error'=>'order not found']);
            }
            
            $order->rating=1;
            $order->save();

            DB::commit();

            return redirect('orders/show')->with(['success'=>'thank you for review']);

        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back()->with(['error'=>'something went wrong']);
        }
    }
}
