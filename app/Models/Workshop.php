<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'duration',
        'price',
        'availableSlots',
        'date',
        'status',
    ];
}
