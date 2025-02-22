<?php
namespace App\Core\Interactors;

use App\Core\DTOs\Sales\GetAllSalesResponse;
use App\Core\Models\Sales;

class SalesInteractor {
    public static function countRevenue(array $receipts): GetAllSalesResponse {
        $numReceipts = 0;
        $revenue = 0.0;
        foreach ($receipts as $receipt) {
            if (!$receipt->getStatus()) {
                $numReceipts++;
                $revenue += $receipt->getTotal();
            }
        }

        $sales = new Sales($numReceipts, $revenue);
        return new GetAllSalesResponse($sales);
    }
}