<?php
namespace App\Core\DTOs\Products;

use App\Core\ResponseInterface;

class CreateProductRequest {
    private string $unit_id;
    private string $name;
    private string $barcode;
    private float $price;

    public function __construct(string $unit_id, string $name, string $barcode, float $price) {
        $this->unit_id = $unit_id;
        $this->name = $name;
        $this->barcode = $barcode;
        $this->price = $price;
    }

    public function getUnitId(): string {
        return $this->unit_id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getBarcode(): string {
        return $this->barcode;
    }

    public function getPrice(): float {
        return $this->price;
    }
}

