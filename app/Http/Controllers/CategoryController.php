<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
   
    public function index()
    {
        return Category::orderBy('id','desc')->get();

       // return view('categories.index',compact('categories'));
    }

    public function store(Request $request)
    {
        $new_record = Category::create(['category_name' => $request->category_name]);
         return response()->json([
                'response_status'=>true,
                'message' => 'record has been created',
                'new_record' => Category::find($new_record->id)
            ]);
    }

   

    public function update(Request $request,$category_id)
    {

        $updated_record = Category::where('id',$category_id)
                                ->update([
                                    'category_name' => $request->category_name
                                ]);

         return response()->json([
                'response_status'=>true,
                'message' => 'record has been updated',
                'updated_record' => Category::find($category_id)
            ]); 
     }

    public function destroy($category_id)
    {
                return (Category::find($category_id)->delete()) 
                ? [ 'response_status' => true,  'message' => 'record has been deleted' ] 
                : [ 'response_status' => false, 'message' => 'record cannot delete' ];
    }
}
