<?php

namespace App\Core\DTOs\Receipts;

use App\Core\Models\Receipt;
use App\Core\ResponseInterface;

class GetOneReceiptResponse implements ResponseInterface {
    private Receipt $receipt;

    public function __construct(Receipt $receipt) {
        $this->receipt = $receipt;
    }
    public function toArray(): array
    {
        return ['receipt' => $this->receipt->toArray()];
    }
}
