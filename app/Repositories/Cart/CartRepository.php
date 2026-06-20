<?php 
namespace App\Repositories\Cart;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Collection;

// operations on cart in general 
interface CartRepository 
{
    public function getCart():Collection;
    public function addToCart(Product $product ,$quantity=1);
    public function updateCart($id, $quantity=1);
    public function deleteCart($id);
    public function clearCart();
    public function total():float;
    public function count();
}