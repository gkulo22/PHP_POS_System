<?php
namespace App\Infra\Data\InMemory;

use App\Core\Repositories\ProductRepository;

class ProductInMemoryRepository extends InMemoryRepository implements ProductRepository {
    public function hasBarcode($barcode): bool
    {
        foreach ($this->_store as $product) {
            if ($product->barcode === $barcode) {
                return true;
            }
        }
        return false;
    }
}
