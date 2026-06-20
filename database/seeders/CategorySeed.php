<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'slug'=>'Handmade_Pottery',
                'name' => 'Handmade Pottery',
                'description' => 'Beautiful handcrafted ceramic and pottery items',
                'status' => 'active',
            ],
           
          
            [
                'slug'=>'Leather_Goods',
                'name' => 'Leather Goods',
                'description' => 'Hand-crafted leather products',
                'status' => 'active',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}