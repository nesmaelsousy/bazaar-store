<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderAddress extends Model
{
    protected $fillable = [
        'order_id','fullname','phone','email','street','city','country',
        'BuildNum','district','apartment','floor'
        ];
    
    // public function getNameAttribute()
    // {
    //     return $this->fullname;
    // }
    //  public function getCountryAttribute()
    // {
    //     return $this->country;
    // }
        
}