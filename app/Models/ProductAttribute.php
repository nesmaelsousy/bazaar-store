<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    protected $table ='products_attribute';
    protected $casts = [
        'value'=> 'array'
    ];
    protected $fillable = ['product_id', 'attribute_id', 'value'];
}
