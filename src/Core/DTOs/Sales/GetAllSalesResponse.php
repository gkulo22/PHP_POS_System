<?php

namespace App\Core\DTOs\Sales;

use App\Core\Models\Sales;
use App\Core\ResponseInterface;

class GetAllSalesResponse implements ResponseInterface{

    private Sales $sales;

    public function __construct(Sales $sales) {
        $this->sales = $sales;
    }

    public function toArray(): array
    {
        return ['sale' => $this->sales->toArray()];
    }
}
