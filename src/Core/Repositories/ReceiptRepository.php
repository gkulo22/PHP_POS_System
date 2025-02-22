<?php
namespace App\Core\Repositories;
use App\Core\RepositoryInterface;

interface ReceiptRepository extends RepositoryInterface {
    public function addProduct(string $receipt_id, string $product_id, int $quantity): bool;
}