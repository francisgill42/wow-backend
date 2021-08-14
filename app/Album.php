<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Album extends Model
{
   protected $fillable = [
    'album_name',
    'album_image',
    'category_id',
    'sub_category_id',
    'brand_id', 
   ];

   public static function get_brands_with_categories()
   {
      return DB::table('albums')
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
      ->get();
   }
}
