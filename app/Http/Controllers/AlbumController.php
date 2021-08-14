<?php

namespace App\Http\Controllers;

use App\Album;
use App\Brand;
use App\Category;
use App\SubCategory;
use App\Product;
use Illuminate\Http\Request;


class AlbumController extends Controller
{
/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */
public function index()
{
return 
response()->json([
'albums' => Album::get_brands_with_categories(),
'categories' => Category::orderBy('id','desc')->get()
]);
}

public function store(Request $request)
{
  
// return response()->json($request->all());   

$album_image = '';
if($request->hasFile('album_image')){
$album_image = $request->album_image->getClientOriginalName();
$request->album_image->move(public_path('uploads/album_images/'),$album_image);	
$album_image = asset('uploads/album_images/' . $album_image);	
}
$new_record = Album::create([
    'album_name' => $request->album_name,
    'album_image' => $album_image,
    'category_id' => $request->category_id,
    'sub_category_id' => $request->sub_category_id,
    'brand_id' => $request->brand_id,
]);
return response()->json([
'response_status'=>true,
'message' => 'record has been created',
'new_record' => \DB::table('albums')
->join('categories', 'albums.category_id', '=', 'categories.id')
->join('sub_categories', 'albums.sub_category_id', '=', 'sub_categories.id')
->join('brands', 'albums.brand_id', '=', 'brands.id')
->select(
   'albums.id as id',
   'albums.album_name',
   'albums.album_image',
   'categories.id as category_id',
   'categories.category_name',
   'sub_categories.id as sub_category_id',
   'sub_categories.subcategory_name as sub_category_name',
   'brands.id as brand_id',
   'brands.brand_name'
   )
    ->orderBy('id','desc')
    ->where('albums.id',$new_record->id)
    ->first()
]);


}

public function get_data_for_albums($c_id){

    $brands = [];
    foreach(Brand::all() as $cat_id){

        if(in_array($c_id,json_decode($cat_id->parent_id))){
           
            $brands[] = Brand::where('id',$cat_id->id)->first();
        }
    }

    $subcategories = SubCategory::orderBy('id','desc')->where('parent_id',$c_id)->get();

    return response()->json([
        'brands' => $brands,
        'sub_categories' => $subcategories
        ]);

}

public function get_products_by_album_id($id){


    return $products = Product::where('collection_id',$id)->get();

    // return response()->json([
    //     'brands' => $brands,
    //     'sub_categories' => $subcategories
    //     ]);

}

public function update(Request $request,$album_id)
{

if($request->hasFile('album_image')){
$album_image = $request->album_image->getClientOriginalName();
$request->album_image->move(public_path('uploads/album_images/'),$album_image);	
$album_image = asset('uploads/album_images/' . $album_image);	
}

else{
$album_image = $request->album_image;
}
$updated_record = \DB::table('albums')->where('id',$album_id)
->update([
'album_name' => $request->album_name,
'album_image' => $album_image,
'category_id' => $request->category_id,
'sub_category_id' => $request->sub_category_id,
'brand_id' => $request->brand_id,
]);



return response()->json([
'response_status'=>true,
'message' => 'record has been created',
'updated_record' => \DB::table('albums')
->join('categories', 'albums.category_id', '=', 'categories.id')
->join('sub_categories', 'albums.sub_category_id', '=', 'sub_categories.id')
->join('brands', 'albums.brand_id', '=', 'brands.id')
->select(
   'albums.id as id',
   'albums.album_name',
   'albums.album_image',
   'categories.id as category_id',
   'categories.category_name',
   'sub_categories.id as sub_category_id',
   'sub_categories.subcategory_name as sub_category_name',
   'brands.id as brand_id',
   'brands.brand_name'
   )
    ->where('albums.id',$album_id)
    ->first()
]);
}


public function destroy($album_id)
{

return (Album::find($album_id)->delete()) 
? [ 'response_status' => true,  'message' => 'record has been deleted' ] 
: [ 'response_status' => false, 'message' => 'record cannot delete' ];
}
}
