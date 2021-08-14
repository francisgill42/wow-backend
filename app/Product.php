<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
    		'collection_id',
    		'color_id',
    		'product_code',
    		'product_title',
    		'product_price',
    		'product_description',
			'product_images',
			'url'
        ];

        protected $casts = [
        	'product_images' => 'array',
        ];
}
