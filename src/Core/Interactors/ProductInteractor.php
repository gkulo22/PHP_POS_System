<?php
namespace App\Core\Interactors;

use App\Core\DTOs\EmptyResponse;
use App\Core\DTOs\Products\CreateProductResponse;
use App\Core\DTOs\Products\GetAllProductsResponse;
use App\Core\DTOs\Products\GetOneProductResponse;
use App\Core\Exceptions\Products\GetProductErrorMessage;
use App\Core\Exceptions\Products\ProductCreationErrorMessage;
use App\Core\Exceptions\Products\UpdateProductErrorMessage;
use App\Core\Models\Product;
use App\Core\Repositories\ProductRepository;
use App\Core\RepositoryInterface;
use App\Core\Result;

class ProductInteractor {
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository) {
        $this->productRepository = $productRepository;
    }

    public function createProduct(string $unit_id, string $name, string $barcode, float $price): Result {
        if ($this->productRepository->hasBarcode($barcode)) {
            return new Result(409, new ProductCreationErrorMessage($barcode));
        }

        $product = new Product(RepositoryInterface::NO_ID, $unit_id, $name, $barcode, $price);
        $object = $this->productRepository->create($product);
        $product = new Product($object->id, $object->getUnitId(), $object->getName(), $object->getBarcode(), $object->getPrice());
        return new Result(201, new CreateProductResponse($product));
    }

    public function getOneProduct(string $product_id): Result {
        $product = $this->productRepository->getOne($product_id);
        if (!($product instanceof Product)) {
            return new Result(404, new GetProductErrorMessage($product_id));
        }

        return new Result(200, new GetOneProductResponse($product));
    }

    public function getAllProducts(): Result {
        $products = $this->productRepository->getAll();
        return new Result(200, new GetAllProductsResponse($products));
    }

    public function updateProductPrice(string $product_id, float $price): Result {
        $product = $this->productRepository->getOne($product_id);
        if (!($product instanceof Product)) {
            return new Result(404, new UpdateProductErrorMessage($product_id));
        }

        $this->productRepository->update($product_id, ['price'=>$price]);
        return new Result(200, new EmptyResponse());
    }
}
