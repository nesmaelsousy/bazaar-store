<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProductPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Product $product): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    // فقط الحرفي والادمن ينشأ 
    public function create(User | Admin $user): bool
    {
        if($user instanceof Admin){
            return true;
        }
        if($user instanceof User){
            return $user->role ==='craftsmen';
        }
       return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User| Admin $user, Product $product): bool
    {
         if($user instanceof Admin){
            return true;
        }
        return $user->id === $product->seller_id;

    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User |Admin $user, Product $product): bool
    {
         if($user instanceof Admin){
            return true;
        }
        return $user->id === $product->seller_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Product $product): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Product $product): bool
    {
        return false;
    }
}
