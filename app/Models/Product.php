<?php

namespace App\Models;

use App\Models\Attribute;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'images' => 'array',
    ];

    public function scopeFilter(Builder $query, $filter)
    {
        $query->when($filter['title'] ?? false, function ($query, $title) {
            $query->where('title', 'like', "%{$title}%");
        });
        $query->when($filter['status'] ?? false, function ($query, $status) {
            $query->where('status', '=', $status);
        });
    }
    public function scopeSearch($query, $request)
    {
       
        // Category
        if ($request->categories_name && $request->categories_name !== 'all') {
            $query->where('category_id', $request->categories_name);
        }

        // Seller (artisan)
        if ($request->seller_name) {
            $query->where('seller_id', $request->seller_name);
        }

        // City
        if ($request->address) {
            $query->whereHas('seller', function ($q) use ($request) {
                $q->where('address', $request->address);
            });
        }

        // Price range
        if ($request->minPrice) {
            $query->where('price', '>=', $request->minPrice);
        }

        if ($request->maxPrice) {
            $query->where('price', '<=', $request->maxPrice);
        }

        return $query;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function isCustomizable(): Attribute
    {
        return Attribute::make(
            get: fn($value) => (bool) $value,
            set: fn($value) => (int) $value,
        );
    }
    protected function carts()
    {
        return $this->hasMany(Cart::class);
    }
    public function favorites()
    {
        return $this->hasMany(favorite::class);
    }

    public function isFavorite()
    {
        if (!auth()->check()) {
            return false;
        }
        return $this->favorites()->where('user_id', auth()->id())->exists();
    }
    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'products_attributes')->withPivot('value');
    }
    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
}
