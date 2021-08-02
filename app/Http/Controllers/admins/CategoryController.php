<?php

namespace App\Http\Controllers\admins;

use App\Models\Category;
use App\Models\Language;
use DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;


class CategoryController extends Controller
{
    ##############################      index       #####################################
    public function index(){
        //autoload from app\helpers\general
        $defualt=defaultLang();
        $category=Category::where('translation_lang',$defualt)->selection()->get();
        return view('admins.adminCategory.show',compact('category'));
    }

    ##############################      create       #####################################
    public function create(){
        $language=Language::selection()->get();
        return view('admins.adminCategory.create',compact('language'));
    }

    ##############################      store        #####################################
    public function store(CategoryRequest $request){
        try{
            DB::beginTransaction();

            $category=collect($request->category);
            $filter=$category->filter(function($val){
                //defaultLang() autoload from app\helpers\general
                return $val['abbr'] == defaultLang();
            });

            $defualt_category=array_values($filter->all())[0];

            $name        = filter_var($defualt_category['name']           ,FILTER_SANITIZE_STRING);
            $description = filter_var($defualt_category['description']    ,FILTER_SANITIZE_STRING);

            $defualt_category_id=Category::insertGetId([
                'translation_lang' => $defualt_category['abbr'],
                'translation_of'   => 0,
                'name'             => $name,
                'description'      => $description,
            ]);
    
            $otherCategories=$category->filter(function($val){
                return $val['abbr'] != defaultLang();
            });
    
            if(isset($otherCategories)){
                $otherCategories_arr=[];
                foreach($otherCategories as $othercategory){
                    $name        = filter_var($othercategory['name']           ,FILTER_SANITIZE_STRING);
                    $description = filter_var($othercategory['description']    ,FILTER_SANITIZE_STRING);

                    $otherCategories_arr[]=[
                        'translation_lang' => $othercategory['abbr'],
                        'translation_of'   => $defualt_category_id,
                        'name'             => $name,
                        'description'      => $description,
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
    public function edit($id){
        $category=Category::with('categories')->selection()->find($id);
        if(! $category){
            return redirect()->back()->with(['error'=>"this category isn't found"]);
        }

        $not_default_cate_lang=Category::find($id)->categories->pluck('translation_lang')
                            ->toArray();

        array_push($not_default_cate_lang,defaultLang());
        $all_lang=Language::all()->pluck('abbr')->toArray();

        $lang_diff=array_diff($all_lang , $not_default_cate_lang);

        return view('admins.adminCategory.edit',compact('category','lang_diff'));
    }

    ##############################      update       #####################################
    public function update($id,CategoryRequest $request){
        $main_category=array_values($request->category)[0];

        $category=Category::selection()->find($id);
        if(! $category){
            return redirect()->back()->with(['error'=>__("messages.this category isn't found")]);
        }

        $name        = filter_var($main_category['name']           ,FILTER_SANITIZE_STRING);
        $description = filter_var($main_category['description']    ,FILTER_SANITIZE_STRING);

        Category::where('id',$id)->update([
            'name'        => $name,
            'description' => $description,
        ]);

        return redirect()->back()->with(['success'=>__('messages.you updated category successfully')]);
    }

    ##############################      delete       #####################################
    public function delete($id){
        $category=Category::find($id)->categories->pluck('id')->toArray();
        array_push($category,$id);
        
        Category::whereIn('id',$category)->delete();

        return redirect()->back()->with(['success'=>__('messages.you deleted category successfully')]);
    }

    ##############################      add new lang for category      #####################################
    public function addNewlang(CategoryRequest $request)
    {
        try {
            $category=collect($request->category);
            
            $name        = filter_var($category[0]['name']           ,FILTER_SANITIZE_STRING);
            $description = filter_var($category[0]['description']    ,FILTER_SANITIZE_STRING);

            Category::create([
                'translation_lang' => $category[0]['translation_lang'],
                'translation_of'   => $category[0]['category_id'],
                'name'             => $name,
                'description'      => $description,
            ]);
    
            return redirect()->back()->with(['success'=>'you added successfully new language for this category']);

        } catch (\Exception $th) {
            return redirect()->back()->with(['error'=>'something went wrong']);
        }
        
    }
}
