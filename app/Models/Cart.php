<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;



class Cart extends Model
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
        'attributes',
        'engraving'
        
    ];
     protected $casts = [
        'attributes' => 'array', 
    ];

    //event (created , creating , updated , updating , saving , save 
    //  deleting , deleted , restored , restoring  , retrieved)

    protected static function booted()
    {
        // random id each time we create a cart
        static::creating(function (cart $cart) {
            $cart->id = Str::uuid();
        });



    }
    // فلتر لمين المستخدم الحالي سواء كان مسجل دخول أو زائر
    public function scopeForCurrentUser($query)
    {
        $cookie_id = self::getCookieId();
        if (Auth::check()) {
            return $query->where('carts.user_id', Auth::id());
        }
        return $query->where('carts.cookie_id', $cookie_id);
    }
     /**
     * Get carts for a specific user (useful for admin operations)
     */
    public function scopeForUser($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }
    /**
     * Get carts for a specific cookie (useful for guest operations)
     */
    public function scopeForCookie($query, string $cookieId)
    {
        return $query->where('cookie_id', $cookieId);
    }



    public function user()
    {
        return $this->belongsTo(User::class)->withDefault(['name' => 'Anonymous']);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public static function getCookieId()
    {
        $cookie_id = Cookie::get('cart_id');
        if (!$cookie_id) {
            $cookie_id = Str::uuid();
            //store when response sent 
            //  Cookie::queue('name cooki', $value, expire in days);
            Cookie::queue('cart_id', $cookie_id, 60 * 24 * 30);
        }
        return $cookie_id;
    }

}