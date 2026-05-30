<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\admin;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Http\Requests\productRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->query();
        $products = Product::Filter($query)->paginate('10');
        return view('dashboard.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product = new Product();
        $stores = Store::pluck('name', 'id')->toArray();
        $categories = Category::pluck('name', 'id')->toArray();
        return view('dashboard.products.add', compact('product', 'stores', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(productRequest $request)
    {

        $data = $request->except(['_token', '_method', 'image']);
        $data = $request->validated();

        $data['slug'] = Str::slug($data['title']) . '-' . rand(1000, 9999);
        // dd($data);
        if ($request->hasFile('image')) {
            $path = Product::UploadImage($request, 'product');
            $data['image'] = $path;
        }
        // dd($path);

        $product =  product::create($data);

        return redirect()->route('admin.product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $stores = Store::pluck('name', 'id')->toArray();
        $categories = Category::pluck('name', 'id')->toArray();
        return view('dashboard.products.edit', compact('product', 'stores', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(productRequest $request, Product $product)
    {
        $data = $request->except('image', 'modal_type');

        $old_image = $product->image;


        $new_image = $this->UploadImage($request);

        if ($new_image) {
            $data['image'] = $new_image;
        }

        try {
            $product->update($data);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }

        if ($old_image && $new_image) {
            Storage::disk('public')->delete($old_image);
        }

        return redirect()->route('admin.product.index')->with('warning', 'The Product has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        //delete image
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        return redirect()->route('admin.product.index')->with('success', 'The Product has been deleted');
    }
    protected function UploadImage(Request $request)
    {
        if (!$request->hasFile('image')) {
            return;
        }
        $file = $request->file('image');
        $name = $file->getClientOriginalName() . '_' . rand() . '_' . time();
        $path = $file->store('products', 'public');
        return $path;
    }
}
