<?php

namespace App\Http\Controllers\Site;

use App\Models\favorite;
use App\Models\Product;
use App\UploadableImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\productRequest;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\ProductManageable;
use Illuminate\Support\Facades\Storage;
use Throwable;

class ProductController extends Controller
{
    use AuthorizesRequests;
    use ProductManageable;
    use UploadableImage;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::where('status', 'active')->Search($request)->when($request->sort == 'low_high', function ($q) {
            $q->orderBy('price', 'asc');
        })
        ->when($request->sort == 'high_low', function ($q) {
            $q->orderBy('price', 'desc');
        })->get();
        //  dd($products);
        $categories = Category::where('status', 'active')->pluck('name', 'id')->toArray();
        $sellers = User::where('status', 'active')->where('role', 'craftsmen')->pluck('name', 'id')->toArray();
         $addresses =  User::where('status', 'active')->where('role', 'craftsmen')->pluck('address', 'id')->toArray();
        
        return view('frontend.products.products', compact('products', 'categories', 'sellers','addresses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product = new Product();
        $categories = Category::where('status', 'active')->pluck('name', 'id')->toArray();
        $attributes = Attribute::all();
        return view('profile.craftsmen.add-product', compact('categories', 'product', 'attributes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $this->authorize('create', Product::class);

        $data = $request->validated();
        // dd($request->all());
        try {
            if ($request->hasFile('images')) {
                $data['images'] = $this->storeImages($request->file('images'));
            } else {
                $data['images'] = [];
            }

            $data['is_customizable'] = (int) $data['is_customizable'];

            if ($request->hasFile('image')) {
                $data['image'] = $this->uploadImage($request, 'products');
            }

            // إنشاء المنتج
            $product = $this->createProductWithSlug($data);

            // attributes
            if ($request->has('product_attributes') && !empty($request->product_attributes)) {

                // 1. تحويل JSON إلى مصفوفة PHP
                $attributes = json_decode($request->product_attributes, true);

                // 2. التحقق من أن البيانات صحيحة
                if (is_array($attributes) && count($attributes) > 0) {
                    // 3. تجهيز البيانات للإرفاق
                    $pivotData = [];

                    foreach ($attributes as $attributeId => $attributeData) {
                        // التأكد من وجود قيمة
                        if (isset($attributeData['value']) && !empty($attributeData['value'])) {

                            // 4. تخزين القيمة في حقل JSON بالجدول البيفوت
                            $pivotData[$attributeId] = [
                                'value' => json_encode([
                                    'name' => $attributeData['name'] ?? '',
                                    'value' => $attributeData['value']
                                ])
                            ];
                        }
                    }

                    // 5. إرفاق الخصائص بالمنتج
                    if (!empty($pivotData)) {
                        $product->attributes()->attach($pivotData);
                    }
                }
            }
        } catch (Throwable $e) {
            return $e;
        }



        return redirect()->route('craftsmen.profile.index')
            ->with('success', 'Product created successfully');
    }


    public function show(Product $product)
    {
        $product->load('attributes');
        $rating = round($product->reviews->avg('rating'));
        return view('frontend.products.product-details', compact('product', 'rating'));
    }
    // add to favorites
    public function addToFavorites(Request $request, Product $product)
    {
        $user = auth()->user();
        if (!$user) {
            session(['url.intended' => route('frontend.favorites.index')]);
            return redirect()->route('login');
        }
        $favorite = favorite::where('user_id', $user->id)
            ->where('product_id', $product->id)->first();
        if ($favorite) {
            $favorite->delete();
            return back()->with('success', 'Product removed from favorites.');
        }
        favorite::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);
        return back()->with('success', 'Product added to favorites.');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::where('status', 'active')->pluck('name', 'id')->toArray();
        return view('profile.craftsmen.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(productRequest $request, Product $product)
    {
        $this->authorize('update', $product);
        $data = $request->validated();

        // لو الصورة الاساسية صار عليها اي تحديث 
        $currentImagePath = $request->image;
        if ($request->hasFile('image')) {
            $data['image'] = $this->updateImage($request, $currentImagePath, 'products');
        }
        
        if ($request->has('removed_images')) {
            $removedImages = json_decode($request->input('removed_images'), true);

            if (is_array($removedImages) && count($removedImages) > 0) {
                // حذف من Storage
                foreach ($removedImages as $imagePath) {
                    if (Storage::exists($imagePath)) {
                        Storage::delete($imagePath);
                    }
                }

                // حذف من array البيانات
                $existingImages = $product->images ?? [];
                $data['images'] = array_filter($existingImages, function ($img) use ($removedImages) {
                    return !in_array($img, $removedImages);
                });
                $data['images'] = array_values($data['images']); // إعادة ترتيب الـ index
            }
        }

     
        if ($request->hasFile('images')) {
            $newImages = $this->storeImages($request->file('images'));
          
            $existingImages = $product->images ?? [];
            $data['images'] = array_merge($existingImages, $newImages);
        }
        try {
            $product->update($data);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
        return redirect()->route('craftsmen.profile.index')->with('success', 'The product has been modified');
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
        return redirect()->route('craftsmen.profile.index')->with('error', 'The product has been removed.');
    }
    // تخزين الصور الاخرى 
    private function storeImages($images)
    {
        $paths = [];
        foreach ($images as $image) {
            $path = $image->store('products', 'public');
            $paths[] = $path;
        }
        return $paths;
    }
}
