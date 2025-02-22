<?php

namespace App\Core\DTOs\Receipts;

class addProductInReceiptRequest {
    private string $productId;
    private int $quantity;

    public function __construct(string $productId, int $quantity) {
        $this->productId = $productId;
        $this->quantity = $quantity;
    }

    public function getProductId(): string {
        return $this->productId;
    }

    public function getQuantity(): int {
        return $this->quantity;
    }
}