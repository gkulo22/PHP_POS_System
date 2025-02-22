<?php
namespace App\Core\Models;

class Sales {
    public int $numReceipts;
    private float $revenue;

    public function __construct(int $numReceipts, float $revenue) {
        $this->numReceipts = $numReceipts;
        $this->revenue = $revenue;
    }

    public function toArray(): array {
        return ['numReceipts' => $this->numReceipts, 'revenue' => $this->revenue];
    }

    public function fromArray(array $data): void {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}
