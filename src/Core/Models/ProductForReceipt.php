<?php
namespace App\Core\Models;

class ProductForReceipt {
    public string $id;
    public int $quantity;
    public float $price;
    public float $total;

    public function __construct(string $id, string $quantity, float $price, float $total) {
        $this->id = $id;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->total = $total;
    }

    public function getId(): string {
        return $this->id;
    }

    public function getQuantity(): int {
        return $this->quantity;
    }

    public function getPrice(): float {
        return $this->price;
    }

    public function getTotal(): float {
        return $this->total;
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'total' => $this->total
        ];
    }

    public function fromArray(array $data): void {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}
