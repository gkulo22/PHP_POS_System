<?php
namespace App\Core\Repositories;
use App\Core\RepositoryInterface;

interface ProductRepository extends RepositoryInterface {
    public function hasBarcode(string $barcode): bool;
}