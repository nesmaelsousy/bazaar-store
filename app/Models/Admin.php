<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;

class Admin extends User
{
    use HasFactory , Notifiable;
    protected $table = 'admins';  
    protected $fillable = ['name','username','image','email','phone','super_admin','status'];
    protected $hidden = ['password', 'remember_token'];

}
