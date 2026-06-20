<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\OrderItem;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;
    protected $guarded = []; 
    public function seller()
    {
        return $this->belongsTo(User::class)->withDefault(['role'=>'craftsmen']);
    }
      public function user()
    {
        return $this->belongsTo(User::class)->withDefault(['role'=>'client']);
    }
     public function orderItems()
    {
        return $this->hasMany(OrderItem::class,'order_id');
    }
      public function products()
    {
        return $this->belongsToMany(Product::class, 'order_items', 'order_id','product_id','id','id')
        ->using(OrderItem::class)
        ->withPivot(['product_name','quantity','price','options']);
    }
    public function address(){
        return $this->hasone(OrderAddress::class);
    }
  
    
    // 
   protected static function  booted(){
    static::creating(function(Order $order){
        // 20260001 
        $order->number = Order::getNextOrderNumber();
    });
    }
    public static function getNextOrderNumber(){
        // Select Max(number) of orders 
        $year = Carbon::now()->year;
        $number = Order::whereYear('created_at', $year )->max('number');
        if($number){
           return $number +1  ;
        }
        return $year .'0001';
    }
       public static function scopeFilter(Builder $query, $filter)
    {
        $query->when($filter['number'] ?? false, function ($query, $number) {
            $query->where('number', 'like', "%{$number}%");
        });
        $query->when($filter['order_type'] ?? false, function ($query, $order_type) {
            $query->where('order_type', '=', $order_type);
        });
    }
   
        
}
