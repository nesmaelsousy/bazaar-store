<?php

namespace App;

use App\Models\Product;
use Illuminate\Support\Str;

trait ProductManageable
{
    public function generateSlug($title){
        return Str::slug($title);
    }
    public function prepareProductData($data){

        $data['slug']= $this->generateSlug($data['title']);
        return $data;
    }

    public function createProductWithSlug($data){
     $data = $this->prepareProductData($data);
     $product = Product::create($data);
      $product->updateQuietly([
        'slug' => $product->slug . '_' . $product->id
    ]);
         return $product;
    }
}
