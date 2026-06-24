<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Exceptions\InsufficientStockException;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Exception;

class DeductProductQuantity
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCreated $event): void
    {
        DB::transaction(function () use ($event) {
            foreach ($event->items as $item) {
                //  تحقق من الكمية + قفل الصف
                $product = Product::where('id', $item->product_id)
                    ->lockForUpdate()->first();

                if (!$product || $product->stock_quantity - $item->quantity < 0)  {
                    throw new InsufficientStockException(
                        $item->product_id,
                        $item->quantity,
                        $product?->stock_quantity ?? 0,
                        $product->title
                    );
                }


                $product->update([
                    'stock_quantity' => DB::raw('stock_quantity - ' . $item->quantity)
                ]);
            }
        });
    }
}
