<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        $categories = Category::get();

        $maxprice = Category::withMax('products', 'price')->get();
        return view('frontend.categories', compact('categories', 'maxprice'));
    }
    public function products(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $products = $category->products()->where('status', 'active')->filter($request->all())
            ->paginate(10);
        $sellers = User::where('status', 'active')->where('role', 'craftsmen')->pluck('name', 'id')->toArray();
        $addresses =  User::where('status', 'active')->where('role', 'craftsmen')->pluck('address', 'id')->toArray();
        $categories = Category::all();
        return view(
            'frontend.products.products',
            compact('category', 'products', 'categories', 'sellers', 'addresses')
        );
    }
}
