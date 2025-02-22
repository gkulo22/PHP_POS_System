<?php
namespace App\Core\Repositories;
use App\Core\Models\ProductForReceipt;
use App\Core\RepositoryInterface;

interface ReceiptRepository extends RepositoryInterface {
    public function addProduct(string $receipt_id, ProductForReceipt $product): bool;
}