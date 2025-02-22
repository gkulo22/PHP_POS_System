<?php

namespace App\Core\Exceptions\Products;

use App\Core\BaseExceptionInterface;

class ProductCreationErrorMessage implements BaseExceptionInterface{
    private array $error;

    public function __construct(string $barcode) {
        $this->error = ['message' => "Product with barcode: {$barcode} already exists."];
    }


    public function toArray(): array
    {
        return ['error' => $this->error];
    }
}