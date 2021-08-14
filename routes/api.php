<?php

use Illuminate\Http\Request;

Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');

Route::get('me', 'AuthController@me');
Route::post('logout', 'AuthController@logout');


Route::resource('product','ProductController');

Route::resource('colors','ColorController');
Route::resource('categories','CategoryController');
Route::resource('subcategories','SubCategoryController');

Route::resource('brands','BrandController');
Route::post('brands/{id}','BrandController@update_brand');

Route::resource('albums','AlbumController');
Route::post('albums/{album_id}','AlbumController@update');
Route::get('albums/{album_id}/products','AlbumController@get_products_by_album_id');

Route::get('get_data_for_albums/{cat_id}','AlbumController@get_data_for_albums');
