<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    /** @use HasFactory<\Database\Factories\StoreFactory> */
    use HasFactory;
    protected $guarded = [];
    public const RATINGS= [
        '0' => 'bad',
        '1' => 'not good',
        '2' => 'normal',
        '3' => 'good',
        '4' => 'very good'
    ];
    public static function scopeFilter($query, $filters)
    {
        $query->when($filters['search'] ?? null, function ($query) use ($filters) {
            $query->where('name', 'like', '%' . $filters['search'] . '%')
                ->orWhere('slug', 'like', '%' . $filters['search'] . '%')
                ->orWhere('phone', 'like', '%' . $filters['search'] . '%')
                ->orWhere('address', 'like', '%' . $filters['search'] . '%')
                ->orWhere('bio', 'like', '%' . $filters['search'] . '%')
                ->orWhere('status', 'like', '%' . $filters['search'] . '%');
        });
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    //Data Accessor
    public function getRatingOptions(): array
    {
        return $this->rating;
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
