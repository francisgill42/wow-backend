<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'brand_name',
        'brand_image',
        'parent_id',
    ];

    
}
