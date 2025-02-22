<?php
namespace App\Core;

use App\Core\Repositories\ProductRepository;
use App\Core\Repositories\ReceiptRepository;
use App\Core\Repositories\UnitRepository;

interface Database {
    public function getUnitsData(): UnitRepository;
    public function getProductsData(): ProductRepository;
    public function getReceiptsData(): ReceiptRepository;
//    public function getSalesData(): SalesRepository;
}
