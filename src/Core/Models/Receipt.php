<?php
namespace App\Core\Models;
class Receipt {
    public string $id;
    private bool $status;
    private array $products;
    private float $total;

    public function __construct(string $id, string $status, array $products, float $total) {
        $this->id = $id;
        $this->status = $status;
        $this->products = $products;
        $this->total = $total;
    }

    public function getId(): string {
        return $this->id;
    }

    public function getStatus(): string {
        return $this->status;
    }

    public function getProducts(): array {
        return $this->products;
    }

    public function getTotal(): float {
        return $this->total;
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'products' => $this->products,
            'total' => $this->total
        ];
    }
}
