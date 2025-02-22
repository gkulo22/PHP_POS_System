<?php
namespace App\Infra\Data\InMemory;

use App\Core\Models\ProductForReceipt;
use App\Core\Repositories\ReceiptRepository;

class ReceiptInMemoryRepository extends InMemoryRepository implements ReceiptRepository {
    public function addProduct(string $receipt_id, ProductForReceipt $product): bool
    {
        $receipt = $this->getOne($receipt_id);
        if ($receipt) {
            $receipt->addProduct($product);
            $receipt->setTotal(array_sum(array_column($receipt->getProducts(), 'total')));
            return true;
        }
        return false;
    }
}
