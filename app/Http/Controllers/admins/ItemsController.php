<?php

namespace App\Http\Controllers\admins;

use App\Models\{Items,Category,Brands};
use App\Traits\UploadImage;
use App\Http\Requests\ItemRequest;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Traits\FiltersRequests\FilterReqItems;
use Cviebrock\EloquentSluggable\Services\SlugService;

class ItemsController extends Controller
{
    use UploadImage  ,FilterReqItems;

    public function index():View
    {
        $items      = Items::paginate(4);
        
        return view('admins.items.show',compact('items'));
    }

    ####################################     create      ################################
    public function create():View
    {
        $categories = Category::where('translation_lang',defaultLang())->get();
        $brands     = Brands::all();

        return view('admins.items.create',compact('brands','categories'));
    }

    ####################################      store      ################################
    public function store(ItemRequest $request):RedirectResponse
    {
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
            'admin_id'    => Auth::user()->id,
            'category_id' => $request->get('category_id'),
            'brand_id'    => $request->get('brand_id'),
        ]);

        return redirect()->back()->with(['success' => 'you created item successfully']);
    }

    ####################################     edit        ################################
    public function edit(int $id):View
    {
        $items=Items::find($id);
        if (!$items) {
            return redirect()->back()->with('error','not found');
        }

        $categories = Category::where('translation_lang',defaultLang())->get();
        $brands     = Brands::all();

        return view('admins.items.edit',compact('items','brands','categories'));
    }

    ####################################     update      ################################
    public function update(int $id,ItemRequest $request):RedirectResponse
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

            return redirect()->back()->with(['success' => 'you updated item successfully']);
        } catch (\Exception $th) {
            return redirect()->back()->with(['error' => 'something went wrong']);
        }
        
    }

    ####################################     delete      ################################
    public function delete(int $id):RedirectResponse
    {
        $Item=Items::find($id);
        if (!$Item) {
            return redirect()->back()->with('error','not found');
        }

        $Item->delete();

        return redirect()->back()->with('success','you deleted Item successfully');
    }
}
