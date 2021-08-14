<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use Auth;
use DB;
use Illuminate\Http\Request;

class BrandController extends Controller
{
   
    public function index()
    {

        $brands = DB::table('brands')
                        ->select('id','brand_name','brand_image','parent_id as category_ids')
                        ->orderBy('id','desc')
                        ->get();

        foreach ($brands as $value) {
        
                $value->categories = DB::table('categories')
                ->select('id','category_name')
                ->whereIn('id',json_decode($value->category_ids))
                ->get();
        }

        return response()->json([
            'categories' => Category::orderBy('id','desc')->select('id','category_name')->get(),
            'brands' => $brands
            ]);
    }

    public function store(Request $request)
    {
           
            $brand_image = '';
            if($request->hasFile('brand_image')){
            $brand_image = $request->brand_image->getClientOriginalName();
            $request->brand_image->move(public_path('uploads/brand_images/'),$brand_image);	
            $brand_image = asset('uploads/brand_images/' . $brand_image);	
            }
            $data = [
                'brand_name' => $request->brand_name,
                'brand_image' => $brand_image,
                'parent_id' => json_encode($request->category_ids)
            ];

           

                $new_record = Brand::create($data); 

                $brand = DB::table('brands')
                ->select('id','brand_name','brand_image','parent_id as category_ids')
                ->where('id',$new_record->id)
                ->first();

                $brand->categories = \DB::table('categories')
                ->select('id','category_name')
                ->whereIn('id',json_decode($brand->category_ids))
                ->get();

                return response()->json([
                    'response_status'=>true,
                    'message' => 'record has been created',
                    'new_record' => $brand                                 
                ]);


    }



    public function update_brand(Request $request,$brand_id)
    {

        $brand_image = '';
        if($request->hasFile('brand_image')){
        $brand_image = $request->brand_image->getClientOriginalName();
        $request->brand_image->move(public_path('uploads/brand_images/'),$brand_image);	
        $brand_image = asset('uploads/brand_images/' . $brand_image);	
        }
        $data = [
            'brand_name' => $request->brand_name,
            'brand_image' => $brand_image,
            'parent_id' => json_encode($request->category_ids)
        ];
        $updated = \DB::table('brands')->where('id',$brand_id)->update($data);    
        
        
        
        $brand = DB::table('brands')
        ->select('id','brand_name','brand_image','parent_id as category_ids')
        ->where('id',$brand_id)
        ->first();

        $brand->categories = \DB::table('categories')
        ->select('id','category_name')
        ->whereIn('id',json_decode($brand->category_ids))
        ->get();



        return response()->json([
                'response_status'=>true,
                'message' => 'record has been created',
                'updated_record' => $brand

                                 
            ]);

       
  
    }


    public function destroy($brand_id)
    {
                return (Brand::find($brand_id)->delete()) 
                ? [ 'response_status' => true,  'message' => 'record has been deleted' ] 
                : [ 'response_status' => false, 'message' => 'record cannot delete' ];
    }
}
