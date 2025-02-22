<?php

namespace App\Core\DTOs\Products;

use App\Core\Models\Product;
use App\Core\ResponseInterface;
class GetOneProductResponse implements ResponseInterface {
    private Product $product;

    public function __construct(Product $product) {
        $this->product = $product;
    }

    public function getProduct(): Product {
        return $this->product;
    }

    public function toArray(): array
    {
        return ['product' => $this->product->toArray()];
    }
}