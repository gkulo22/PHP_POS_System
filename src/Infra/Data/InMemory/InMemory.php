<?php
namespace App\Infra\Data\InMemory;

use App\Core\Database;
use App\Core\Repositories\ProductRepository;
use App\Core\Repositories\ReceiptRepository;
use App\Core\Repositories\UnitRepository;

class InMemory implements Database {
    public UnitInMemoryRepository $_units;
    public ProductInMemoryRepository $_products;
    public ReceiptInMemoryRepository $_receipts;
//    public $_sales;

    public function __construct() {
        $this->_units = new UnitInMemoryRepository();
        $this->_products = new ProductInMemoryRepository();
        $this->_receipts = new ReceiptInMemoryRepository();
//        $this->_sales = new SalesInMemoryRepository();
    }

    public function getUnitsData(): UnitRepository {
        return $this->_units;
    }

    public function getProductsData(): ProductRepository {
        return $this->_products;
    }

    public function getReceiptsData(): ReceiptRepository {
        return $this->_receipts;
    }

//    public function sales() {
//        return $this->_sales;
//    }
}
