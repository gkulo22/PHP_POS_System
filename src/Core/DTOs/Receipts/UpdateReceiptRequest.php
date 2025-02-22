<?php

namespace App\Core\DTOs\Receipts;

class UpdateReceiptRequest {
    private bool $status;

    public function __construct(bool $status) {
        $this->status = $status;
    }

    public function getStatus(): bool {
        return $this->status;
    }
}
