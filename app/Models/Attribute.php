<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\Builder;

class Attribute extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_attributes')
            ->withPivot('value');
    }
      public static function scopeFilter(Builder $query, $filter)
    {
        $query->when($filter['name'] ?? false, function ($query, $name) {
            $query->where('name', 'like', "%{$name}%");
        });
    }
}
