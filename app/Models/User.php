<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Database\Factories\UserFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Order;
use App\Models\Cart;
use Spatie\Permission\Traits\HasRoles;

// #[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles;
    protected $fillable = [
        'name',
        'slug',
        'username',
        'email',
        'phone',
        'address',
        'bio',
        'image',
        'password',
        'role',
        'status',
    ];
    public function scopeFilter(Builder $query, $filter)
    {
        $query->when($filter['username'] ?? false, function ($query, $username) {
            $query->where('username', 'like', "%{$username}%");
        });
        $query->when($filter['role'] ?? false, function ($query, $role) {
            $query->where('role', '=', $role);
        });
    }
    public static function UploadImage($request, $folder)
    {
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $path = $image->storeAs($folder, $imageName, 'public');
        return $path;
    }
    // public function store()
    // {
    //     return $this->hasOne(Store::class);
    // }
    public function products()
    {
        return $this->hasMany(Product::class, 'seller_id');
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function sellerOrders()
    {
        return $this->hasMany(Order::class, 'seller_id');
    }
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
    public function productReviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function favorites()
    {
        return $this->hasMany(favorite::class);
    }
    public function hasRole(string $roleName): bool
    {
        return $this->role === $roleName;
    }
}
