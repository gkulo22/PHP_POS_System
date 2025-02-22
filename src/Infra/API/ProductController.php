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

    public function createProduct(array $args): JsonResponse
    {
        $request = $args['request'];

        $data = json_decode($request->getBody(), true);
        $productBase = new CreateProductRequest($data['unit_id'], $data['name'], $data['barcode'], $data['price']);

        return $this->core->createProduct($productBase);
    }

    public function getOneProduct(array $args): JsonResponse
    {
        $product_id = $args['id'];
        return $this->core->getOneProduct($product_id);
    }

    public function getAllProducts(array $args): JsonResponse
    {
        return $this->core->getAllProducts();
    }

    public function updateProductPrice(array $args): JsonResponse
    {
        $request = $args['request'];
        $product_id = $args['id'];

        $data = json_decode($request->getBody(), true);
        $productBase = new UpdateProductRequest($data['price']);
        return $this->core->updateProductPrice($product_id, $productBase);
    }

}
