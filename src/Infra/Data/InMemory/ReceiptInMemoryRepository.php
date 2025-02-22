<?php
namespace App\Infra\Data\InMemory;

use App\Core\Repositories\ReceiptRepository;

class ReceiptInMemoryRepository extends InMemoryRepository implements ReceiptRepository {
    public function addProduct(string $receipt_id, string $product_id, int $quantity): bool
    {
        $receipt = $this->getOne($receipt_id);
        if ($receipt) {
            $receipt->products[] = $product_id;
            $receipt->total = array_sum(array_column($receipt->products, 'total'));
            return true;
        }
        return false;
    }
}
