<?php

namespace App\Http\Controllers\admins;

use App\Models\{Category,Language};
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Traits\FiltersRequests\FilterReqCategory;
use App\Traits\GetDefault;

class CategoryController extends Controller
{
    use GetDefault ,FilterReqCategory;
    ##############################      index       #####################################
    public function index()
    {
        //autoload from app\helpers\general
        $defualt=defaultLang();
        $category=Category::where('translation_lang',$defualt)->selection()->get();
        return view('admins.category.show',compact('category'));
    }

    ##############################      create       #####################################
    public function create()
    {
        $language=Language::selection()->get();
        return view('admins.category.create',compact('language'));
    }

    ##############################      store        #####################################
    public function store(CategoryRequest $request)
    {
        try{
            DB::beginTransaction();

            $category=$request->category;
            $defualt_category=$this->getDefault($category);

            $filterd_data=$this->filter_req_category($defualt_category);

            $defualt_category_id=Category::insertGetId([
                'translation_lang' => $defualt_category['abbr'],
                'translation_of'   => 0,
                'name'             => $filterd_data['name'],
                'description'      => $filterd_data['description'],
            ]);
    
            $otherCategories=$this->getOther($category);
    
            if(isset($otherCategories)){
                $otherCategories_arr=[];
                foreach($otherCategories as $othercategory){
                    $filterd_data=$this->filter_req_category($othercategory);

                    $otherCategories_arr[]=[
                        'translation_lang' => $othercategory['abbr'],
                        'translation_of'   => $defualt_category_id,
                        'name'             => $filterd_data['name'],
                        'description'      => $filterd_data['description'],
                    ];
                }
                
                Category::insert($otherCategories_arr);
            }

            DB::commit();
            return redirect()->back()->with(['success'=>__('messages.you created category successfully')]);

        }catch(\Exception $ex){
            DB::rollback();
        }

    }

    ##############################      edit       #####################################
    public function edit(int $id)
    {
        $category=Category::with('categories')->selection()->find($id);
        if(! $category){
            return redirect()->back()->with(['error'=>"this category isn't found"]);
        }

        $not_default_cate_lang=Category::find($id)->categories->pluck('translation_lang')
                            ->toArray();

        array_push($not_default_cate_lang,defaultLang());
        $all_lang=Language::all()->pluck('abbr')->toArray();

        $lang_diff=array_diff($all_lang , $not_default_cate_lang);

        return view('admins.category.edit',compact('category','lang_diff'));
    }

    ##############################      update       #####################################
    public function update(int $id,CategoryRequest $request)
    {
        $main_category=array_values($request->category)[0];

        $category=Category::selection()->find($id);
        if(! $category){
            return redirect()->back()->with(['error'=>__("messages.this category isn't found")]);
        }

        $filterd_data=$this->filter_req_category($main_category);

        Category::where('id',$id)->update([
            'name'        => $filterd_data['name'],
            'description' => $filterd_data['description'],
        ]);

        return redirect()->back()->with(['success'=>__('messages.you updated category successfully')]);
    }

    ##############################      delete       #####################################
    public function delete(int $id){
        $category=Category::find($id)->categories->pluck('id')->toArray();
        array_push($category,$id);
        
        Category::whereIn('id',$category)->delete();

        return redirect()->back()->with(['success'=>__('messages.you deleted category successfully')]);
    }

    ##############################      add new lang for category      #####################################
    public function addNewlang(CategoryRequest $request)
    {
        try {
            $category=(array)$request->category;
            
            $filterd_data=$this->filter_req_category($category);

            Category::create([
                'translation_lang' => $category[0]['translation_lang'],
                'translation_of'   => $category[0]['category_id'],
                'name'             => $filterd_data['name'],
                'description'      => $filterd_data['description'],
            ]);
    
            return redirect()->back()->with(['success'=>'you added successfully new language for this category']);

        } catch (\Exception $th) {
            return redirect()->back()->with(['error'=>'something went wrong']);
        }
        
    }
}
