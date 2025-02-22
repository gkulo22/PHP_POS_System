<?php
namespace App\Core\DTOs\Products;

class UpdateProductRequest {
    private float $price;

    public function __construct(float $price){
        $this->price = $price;
    }

    public function getPrice(): float{
        return $this->price;
    }
}