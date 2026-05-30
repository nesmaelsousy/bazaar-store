<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;

class cart extends Model
{
    //تعطيل الزيادة 
    // التلقائية للمفتاح الأساسي (المستخدم عند استخدام UUID أو معرّفات مخصصة بدلاً من الأعداد الصحيحة)
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'cookie_id',
        'user_id',
        'product_id',
        'quantity',
        'options',
    ];

    //event (created , creating , updated , updating , saving , save 
    //  deleting , deleted , restored , restoring  , retrieved)

    protected static function booted()
    {
        // random id each time we create a cart
        static::creating(function (cart $cart) {
            $cart->id = Str::uuid();
        });
        static::addGlobalScope('cookie_id', function ($builder) {
            $builder->where('cookie_id', self::getCookieId());
        });
    }
    //observe any change in the cart and update the quantity



    public function user()
    {
        return $this->belongsTo(User::class)->withDefault(['name' => 'Anonymous']);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public static function  getCookieId()
    {
        $cookie_id =  Cookie::get('cart_id');
        if (!$cookie_id) {
            $cookie_id = Str::uuid();
            //store when response sent 
            //  Cookie::queue('name cooki', $value, expire in days);
            Cookie::queue('cart_id', $cookie_id, 60 * 24 * 30);
        }
        return $cookie_id;
    }
}
