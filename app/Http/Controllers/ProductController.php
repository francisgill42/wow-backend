<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function store(Request $request)
    {
                $product_images =[];
                for ($i=0; $i < count($request->product_images); $i++) { 
                  $product_image = $request->product_images[$i]->getClientOriginalName();
                  $request->product_images[$i]->move(public_path('uploads/product_images/'),$product_image);
            
                     $product_images[] = asset('uploads/product_images/' . $product_image);
                }
                $arr = [
                    'collection_id' => $request->collection_id,
                    'color_id' => $request->color_id,
                    'product_code' => $request->product_code,
                    'product_title' => $request->product_title,
                    'product_price' => $request->product_price,
                    'product_description' => $request->product_description,
                    'product_images' => $product_images,
                    'url' => $request->product_url 
                ];
               
                $product = Product::create($arr);

                return response()->json([
                    'response_status' => true,
                    'message' => 'record has been inserted',
                    'new_record' => Product::find($product->id),
                ]);

    }

    public function update(Request $request, $id)
    {
       $product_images =[];
                for ($i=0; $i < count($request->product_images); $i++) { 
                  $product_image = $request->product_images[$i]->getClientOriginalName();
                  $request->product_images[$i]->move(public_path('uploads/product_images/'),$product_image);
            
                     $product_images[] = asset('uploads/product_images/' . $product_image);
                }
                $arr = [
                    'product_code' => $request->product_code,
                    'color_id' => $request->color_id,
                    'product_title' => $request->product_title,
                    'product_price' => $request->product_price,
                    'product_description' => $request->product_description,
                    'product_images' => $product_images,
                    'url' => $request->product_url 
                ];
               
                $product = Product::where('id',$id)->update($arr);

                return response()->json([
                    'response_status' => true,
                    'message' => 'record has been update',
                    'updated_record' => Product::find($id),
                ]);
    }

    public function destroy($id)
    {
        return (Product::find($id)->delete()) 
        ? [ 'response_status' => true,  'message' => 'record has been deleted' ] 
        : [ 'response_status' => false, 'message' => 'record cannot delete' ];
    }
}
