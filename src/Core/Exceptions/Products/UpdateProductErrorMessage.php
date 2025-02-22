<?php
namespace App\Core\Exceptions\Products;

use App\Core\BaseExceptionInterface;

class UpdateProductErrorMessage implements BaseExceptionInterface {
    private array $error;

    public function __construct(string $product_id) {
        $this->error = ['message' => "Product with id: {$product_id} does not exist."];
    }


    public function toArray(): array
    {
        return ['error' => $this->error];
    }
}
