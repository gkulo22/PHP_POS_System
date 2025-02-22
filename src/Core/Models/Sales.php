<?php
namespace App\Core\Models;

class Sales {
    private int $numReceipts;
    private float $revenue;

    public function __construct(int $numReceipts, float $revenue) {
        $this->numReceipts = $numReceipts;
        $this->revenue = $revenue;
    }

    public function toArray(): array {
        return ['numReceipts' => $this->numReceipts, 'revenue' => $this->revenue];
    }
}
