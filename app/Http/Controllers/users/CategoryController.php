<?php

namespace App\Http\Controllers\users;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    
    public function index(){
        try {
            $categories=Category::selection()->where('translation_lang',defaultLang())->get();
            return view('users.category.index',compact('categories'));

        } catch (\Exception $ex) {
            return Redirect::to('category/get')->with(['error'=>'something went wrong']);
        }
        
    }

    public function show($id){
        try {
            $category  = Category::find($id);
            if(! $category){
                return Redirect::to('category/get')->with(['error'=>'no category found']);
            }

            $category_items = $category->items;
            
            return view('users.category.show',compact('category_items','category'));

        } catch (\Exception $ex) {
            return Redirect::to('category/get')->with(['error'=>'something went wrong']);
        }
        
    }
}
