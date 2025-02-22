<?php

namespace App\Infra\API;

use App\Core\CoreFacade;
use App\Core\DTOs\Products\CreateProductRequest;
use App\Core\DTOs\Products\UpdateProductRequest;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ServerRequestInterface as Request;
class ProductController {

    private CoreFacade $core;

    public function __construct(CoreFacade $core)
    {
        $this->core = $core;
    }

    public function createProduct(Request $request): JsonResponse
    {
        $data = json_decode($request->getBody(), true);
        $productBase = new CreateProductRequest($data['unit_id'], $data['name'], $data['barcode'], $data['price']);

        return $this->core->createProduct($productBase);
    }

    public function getOneProduct(string $product_id): JsonResponse
    {
        return $this->core->getOneProduct($product_id);
    }

    public function getAllProducts(): JsonResponse
    {
        return $this->core->getAllProducts();
    }

    public function updateProductPrice(string $product_id, Request $request): JsonResponse
    {
        $data = json_decode($request->getBody(), true);
        $productBase = new UpdateProductRequest($data['price']);
        return $this->core->updateProductPrice($product_id, $productBase);
    }

}
