<?php

namespace App\Http\Controllers;

use App\SubCategory;
use Illuminate\Http\Request;
use App\Category;
use DB;
use Log;

class SubCategoryController extends Controller
{
  
    public function index()
    {
        $categories = Category::orderBy('id','desc')->get();

      
        $subcategories = DB::table('sub_categories')
            ->join('categories', 'sub_categories.parent_id', '=', 'categories.id')
            ->select('sub_categories.*', 'categories.id as category_id','categories.category_name')
            ->orderBy('sub_categories.id','desc')
            ->get();

            return response()->json(['sub_categories' => $subcategories,'categories' => $categories]);

        return view('subcategories.index',compact('subcategories','categories'));
    }


    public function store(Request $request)
    {


        $new_record = SubCategory::create([
            'subcategory_name' => $request->subcategory_name,
            'parent_id' => $request->category_id
            ]);
            return response()->json([
                'response_status'=>true,
                'message' => 'record has been created',
                'new_record' => DB::table('sub_categories')
                                ->join('categories', 'sub_categories.parent_id', '=', 'categories.id')
                                ->select('sub_categories.id','sub_categories.subcategory_name', 'categories.id as category_id','categories.category_name')
                                ->where('sub_categories.id',$new_record->id)
                                ->first()
            ]);

    }
    public function update(Request $request,$subCategory_id)
    {

        SubCategory::where('id',$subCategory_id)
        ->update([
             'subcategory_name' => $request->subcategory_name,
             'parent_id' => $request->category_id
        ]);

         return response()->json([
                'response_status'=>true,
                'message' => 'record has been updated',
                'updated_record' => DB::table('sub_categories')
                                ->join('categories', 'sub_categories.parent_id', '=', 'categories.id')
                                ->select('sub_categories.id','sub_categories.subcategory_name', 'categories.id as category_id','categories.category_name')
                                ->where('sub_categories.id',$subCategory_id)
                                ->first()
            ]);
    }


    public function destroy($subCategory_id)
    {
                return (SubCategory::find($subCategory_id)->delete()) 
                ? [ 'response_status' => true,  'message' => 'record has been deleted' ] 
                : [ 'response_status' => false, 'message' => 'record cannot delete' ];
    }
}
