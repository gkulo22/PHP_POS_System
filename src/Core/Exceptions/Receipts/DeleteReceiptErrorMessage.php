<?php

namespace App\Core\Exceptions\Receipts;

use App\Core\BaseExceptionInterface;

class DeleteReceiptErrorMessage implements BaseExceptionInterface {
    private array $error;

    public function __construct(string $receipt_id) {
        $this->error = ['message' => "Receipt with id: {$receipt_id} does not exist."];
    }
    public function toArray(): array
    {
        return ['error' => $this->error];
    }
}
