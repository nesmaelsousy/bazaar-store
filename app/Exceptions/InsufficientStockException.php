<?php

namespace App\Exceptions;

use Exception;

class InsufficientStockException extends Exception
{
    public function __construct(public int $productId, public int $requested, public int $available = 0,public string $title)
    {
        parent::__construct("Product #{$productId} - Requested: {$requested}, Available: {$available}");
    }
    public function render()
    {
        return redirect()->back()
            ->withErrors(['stock' => "Product #{$this->title} is not available in the requested quantity"])
            ->withInput();
    }
}
