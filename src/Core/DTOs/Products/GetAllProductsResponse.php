<?php
namespace App\Core\DTOs\Products;

use App\Core\ResponseInterface;

class GetAllProductsResponse implements ResponseInterface {
    private array $products;

    public function __construct(array $products) {
        $this->products = $products;
    }

    public function toArray(): array
    {
        return ['products' => array_map(fn($product) => $product->toArray(), $this->products)];
    }
}