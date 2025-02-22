<?php
namespace App\Core\Models;

class ProductForReceipt {
    private string $id;
    private int $quantity;
    private float $price;
    private float $total;

    public function __construct(string $id, string $quantity, float $price, float $total) {
        $this->id = $id;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->total = $total;
    }

    public function toArray(): array {
        return ['id' => $this->id, 'quantity' => $this->quantity, 'price' => $this->price, 'total' => $this->total];
    }
}
