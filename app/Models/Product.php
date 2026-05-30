<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'colors' => 'array',
        'sizes' => 'array',
        'images' => 'array',
    ];

    public function scopeFilter(Builder $query, $filter)
    {
        $query->when($filter['title'] ?? false, function ($query, $name) {
            $query->where('title', 'like', "%{$title}%");
        });
        $query->when($filter['status'] ?? false, function ($query, $status) {
            $query->where('status', '=', $status);
        });
    }
    public static function UploadImage($request, $folder)
    {
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $path = $image->storeAs($folder, $imageName, 'public');
        return $path;
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function store()
    {
        return $this->belongsTo(Store::class);
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
}
