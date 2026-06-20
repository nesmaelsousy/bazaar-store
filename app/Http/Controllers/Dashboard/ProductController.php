<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\admin;
use App\Models\Category;
use App\Models\Product;
use App\UploadableImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\productRequest;
use App\Models\User;
use App\ProductManageable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProductController extends Controller
{
    use AuthorizesRequests;  
    use ProductManageable;
    use UploadableImage;
    /**
     * Display a listing of the resource.
     */
    // show product table -> admin
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
        $sellers = User::where('status', 'active')
        ->where('role','craftsmen')->pluck('name','id')->toArray();
        $categories = Category::where('status', 'active')->pluck('name','id')->toArray();
        return view('dashboard.products.add', compact('product','sellers',  'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
  public function store(productRequest $request)
  {
    $this->authorize('create', Product::class);
    
    $data = $request->validated();
     if ($request->hasFile('image')) {
      $data['image'] = $this->uploadImage($request,'products');
    
    }

    $this->createProductWithSlug($data);

   
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
   
        $users = User::where('status','active')->pluck('name','id')->toArray();
        $categories = Category::where('status', 'active')->pluck('name','id')->toArray();
        return view('dashboard.products.edit', compact('product', 'categories','users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(productRequest $request, Product $product)
    {
        $this->authorize('update', $product);
        $data = $request->except('image', 'modal_type');
        $currentImage = $product->image;
        $data['image']= $this->updateImage($request, $currentImage,'products');

        try {
            $product->update($data);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
        return redirect()->route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
         $this->authorize('delete', $product);
        $product->delete();
        $imagePath = $product->image;
        //delete image
        $this->deleteOldImage($imagePath);
       
        return redirect()->route('admin.product.index');
    }
    
}
