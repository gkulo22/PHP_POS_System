<?php
namespace App\Core;

use App\Core\DTOs\Products\CreateProductRequest;
use App\Core\DTOs\Products\UpdateProductRequest;
use App\Core\DTOs\Units\CreateUnitRequest;
use App\Core\Interactors\ProductInteractor;
use App\Core\Interactors\ReceiptInteractor;
use App\Core\Interactors\SalesInteractor;
use App\Core\Interactors\UnitInteractor;
use Laminas\Diactoros\Response\JsonResponse;

class CoreFacade {
    private ProductInteractor  $productInteractor;
    private UnitInteractor  $unitInteractor;
    private ReceiptInteractor  $receiptInteractor;
//    private SalesInteractor  $salesInteractor;

    public function __construct(Database $database) {
        $this->productInteractor = new ProductInteractor($database->getProductsData());
        $this->unitInteractor = new UnitInteractor($database->getUnitsData());
        $this->receiptInteractor = new ReceiptInteractor($database->getReceiptsData());
//        $this->salesInteractor = $salesInteractor;
    }

    // Units
    public function createUnit(CreateUnitRequest $request): JsonResponse
    {
        $result = $this->unitInteractor->createUnit($request->getName());
        return new JsonResponse($result->getContent()->toArray(), $result->getStatusCode());
    }

    public function getOneUnit(string $unit_id): JsonResponse
    {
        $result = $this->unitInteractor->getOneUnit($unit_id);
        return new JsonResponse($result->getContent()->toArray(), $result->getStatusCode());
    }

    public function getAllUnits(): JsonResponse
    {
        $result = $this->unitInteractor->getAllUnits();
        return new JsonResponse($result->getContent()->toArray(), $result->getStatusCode());
    }

    # Products
    public function createProduct(CreateProductRequest $request): JsonResponse
    {
        $result = $this->productInteractor->createProduct($request->getUnitId(), $request->getName(), $request->getBarcode(), $request->getPrice());
        return new JsonResponse($result->getContent()->toArray(), $result->getStatusCode());
    }

    public function getOneProduct(string $product_id): JsonResponse
    {
        $result = $this->productInteractor->getOneProduct($product_id);
        return new JsonResponse($result->getContent()->toArray(), $result->getStatusCode());
    }

    public function getAllProducts(): JsonResponse
    {
        $result = $this->productInteractor->getAllProducts();
        return new JsonResponse($result->getContent()->toArray(), $result->getStatusCode());
    }

    public function updateProductPrice(string $product_id, UpdateProductRequest $request): JsonResponse
    {
        $result = $this->productInteractor->UpdateProductPrice($product_id, $request->getPrice());
        return new JsonResponse($result->getContent()->toArray(), $result->getStatusCode());
    }

    # Receipts

}

