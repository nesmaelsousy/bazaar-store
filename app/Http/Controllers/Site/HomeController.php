<?php

namespace App\Http\Controllers\Site;

use App\Models\Product;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Workshop;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 'active')->paginate(8);
        $users = User::where('role', 'craftsmen')->paginate(4);
        $workshops = Workshop::where('status', 'active')->get();
        


        return view('frontend.index', compact('products', 'users', 'workshops'));
    }
    function about()
    {
        return view('frontend.about');
    }
    function artisans()
    {
        $artisans = User::where('role', 'craftsmen')->with('products')->get();
        return view('frontend.craftsmen.artisans', compact('artisans'));
    }
   
    function workshops()
    {
        $workshops = Workshop::where('status', 'active')->get();
        return view('frontend.workshop.index', compact('workshops'));
    }
    function favorites()
    {
        if (!auth()->check()) {
            session(['url.intended' => route('frontend.favorites.index')]);
            return redirect()->route('login');
        }
        $favorites = auth()->user()
            ->favorites()
            ->with('product')
            ->get();
        return view('frontend.favorites', compact('favorites'));
    }
  


}
