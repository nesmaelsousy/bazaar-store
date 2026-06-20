<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderItem extends Pivot
{
    use HasFactory;
    protected $table = 'order_items';
    // pivot نرجع نفعل ال 
    public $incrementing = true;
    public function product()
    {
        return $this->belongsTo(Product::class)->withDefault(['name' => $this->product_name]);
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id')->withDefault(['role' => 'craftsmen']);
    }
}
