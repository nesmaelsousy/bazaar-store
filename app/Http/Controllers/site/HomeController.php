<?php

namespace App\Http\Controllers\site;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::paginate(8);
        $users = User::where('role', 'craftsmen')->paginate(4);
        
        return view('frontend.index', compact('products', 'users'));
    }
    //show the user product
    
    // public function showProducts()
    // {
    //     $products = Product::paginate(10);

    //     return view('frontend.products', compact('products'));
    // }
    // public function showProduct()
    // {
    //     return view('frontend.product-details');
    // }
}
