<?php
namespace App\Core\Models;
class Product {
    public string $id;
    private string $unit_id;
    private string $name;
    private string $barcode;
    private float $price;

    public function __construct(string $id, string $unit_id, string $name, string $barcode, float $price) {
        $this->id = $id;
        $this->unit_id = $unit_id;
        $this->name = $name;
        $this->barcode = $barcode;
        $this->price = $price;
    }

    public function getId(): string {
        return $this->id;
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

    public function toArray(): array {
        return [
            'id' => $this->id,
            'unit_id' => $this->unit_id,
            'name' => $this->name,
            'barcode' => $this->barcode,
            'price' => $this->price
        ];
    }
}
