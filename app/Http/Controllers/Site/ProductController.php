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

   
    public function index(Request $request)
    {
        $products = Product::where('status', 'active')
            ->Search($request)
            ->paginate(12);

        $categories = Category::where('status', 'active')->pluck('name', 'id')->toArray();
        $sellers = User::where('status', 'active')
            ->where('role', 'craftsmen')
            ->pluck('name', 'id')->toArray();

        $addresses = User::where('status', 'active')
            ->where('role', 'craftsmen')
            ->pluck('address', 'id')->toArray();

        return view('frontend.products.products', compact(
            'products',
            'categories',
            'sellers',
            'addresses'
        ));
    }

   
    public function create()
    {
        $product = new Product();
        $categories = Category::where('status', 'active')->pluck('name', 'id')->toArray();
        $attributes = Attribute::all();

        return view('profile.craftsmen.add-product', compact(
            'categories',
            'product',
            'attributes'
        ));
    }

   
    public function store(ProductRequest $request)
    {
        $this->authorize('create', Product::class);

        $data = $request->validated();

        try {
            // dd($request->product_attributes);

            // image
            $data['images'] = $request->hasFile('images')
                ? $this->storeImages($request->file('images'))
                : [];

            $data['is_customizable'] = (int) $data['is_customizable'];

            if ($request->hasFile('image')) {
                $data['image'] = $this->uploadImage($request, 'products');
            }

            // create product
            $product = $this->createProductWithSlug($data);

            // attribute
            $this->syncAttributes($request, $product);
        } catch (Throwable $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }

        return redirect()->route('craftsmen.profile.index')
            ->with('success', 'Product created successfully');
    }

 
    public function show(Product $product)
    {
        $product->load('attributes');

        return view('frontend.products.product-details', compact('product'));
    }



    public function edit(Product $product)
    {
        $categories = Category::where('status', 'active')->pluck('name', 'id')->toArray();
        $attributes = Attribute::all();

        return view('profile.craftsmen.edit', compact('product', 'categories', 'attributes'));
    }

    public function update(productRequest $request, Product $product)
    {
        $this->authorize('update', $product);

        $data = $request->validated();

        try {

            // main image =
            $currentImagePath = $request->image;

            if ($request->hasFile('image')) {
                $data['image'] = $this->updateImage($request, $currentImagePath, 'products');
            }

            // if remove image
            if ($request->has('removed_images')) {

                $removedImages = json_decode($request->removed_images, true);

                if (is_array($removedImages)) {

                    foreach ($removedImages as $imagePath) {
                        if (Storage::exists($imagePath)) {
                            Storage::delete($imagePath);
                        }
                    }

                    $existingImages = $product->images ?? [];

                    $data['images'] = array_values(array_filter(
                        $existingImages,
                        fn($img) => !in_array($img, $removedImages)
                    ));
                }
            }

            // new image outher
            if ($request->hasFile('images')) {

                $newImages = $this->storeImages($request->file('images'));

                $existingImages = $product->images ?? [];

                $data['images'] = array_merge($existingImages, $newImages);
            }

            // update product
            $product->update($data);

            // update attrbute
            $this->syncAttributes($request, $product);
        } catch (Throwable $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }

        return redirect()->route('craftsmen.profile.index')
            ->with('success', 'The product has been modified');
    }

    // delete product
    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);

        $product->delete();

        $this->deleteOldImage($product->image);

        return redirect()->route('craftsmen.profile.index')
            ->with('error', 'The product has been removed.');
    }

    private function storeImages($images)
    {
        $paths = [];

        foreach ($images as $image) {
            $paths[] = $image->store('products', 'public');
        }

        return $paths;
    }

    // sync Attributes
    private function syncAttributes(Request $request, Product $product)
    {
        if (!$request->product_attributes) {
            return;
        }

        $attributes = json_decode($request->product_attributes, true);

        if (!is_array($attributes)) {
            return;
        }

        $pivot = [];

        foreach ($attributes as $id => $attribute) {

            $value = $attribute['value'] ?? null;

            if (!$value) {
                continue;
            }

            $pivot[$id] = [
                'value' => json_encode([
                    'value' => $value
                ])
            ];
        }

        $product->attributes()->sync($pivot);
    }
    // fav
    public function addToFavorites(Request $request, Product $product)
    {
        $user = auth()->user();

        if (!$user) {
            session(['url.intended' => route('frontend.favorites.index')]);
            return redirect()->route('login');
        }

        $favorite = favorite::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();

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
}
