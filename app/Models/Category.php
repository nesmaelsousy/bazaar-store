<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\Builder;


class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;
    protected $fillable = ['name', 'slug', 'parent_id', 'description', 'image', 'status'];

    public static function scopeFilter(Builder $query, $filter)
    {
        $query->when($filter['name'] ?? false, function ($query, $name) {
            $query->where('name', 'like', "%{$name}%");
        });
        $query->when($filter['status'] ?? false, function ($query, $status) {
            $query->where('status', '=', $status);
        });
    }
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
