<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::resource('categories','CategoryController');
Route::resource('subcategories','SubCategoryController');
Route::resource('brands','BrandController');
Route::resource('albums','AlbumController');


Route::get('get_data_for_albums/{cat_id}','AlbumController@get_data_for_albums');

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
