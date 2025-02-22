<?php
namespace App\Core\Interactors;

use App\Core\DTOs\EmptyResponse;
use App\Core\DTOs\Receipts\AddProductInReceiptResponse;
use App\Core\DTOs\Receipts\CreateReceiptResponse;
use App\Core\DTOs\Receipts\GetOneReceiptResponse;
use App\Core\Exceptions\Receipts\DeleteReceiptErrorMessage;
use App\Core\Exceptions\Receipts\GetReceiptErrorMessage;
use App\Core\Exceptions\Receipts\ReceiptClosedErrorMessage;
use App\Core\Exceptions\Receipts\UpdateReceiptErrorMessage;
use App\Core\Models\Product;
use App\Core\Models\ProductForReceipt;
use App\Core\Models\Receipt;
use App\Core\Repositories\ReceiptRepository;
use App\Core\RepositoryInterface;
use App\Core\Result;

class ReceiptInteractor {
    private ReceiptRepository $receiptRepository;

    public function __construct(ReceiptRepository $receiptRepository) {
        $this->receiptRepository = $receiptRepository;
    }

    public function createReceipt(): Result {
        $receipt = new Receipt(RepositoryInterface::NO_ID, true, [], 0.0);
        $object = $this->receiptRepository->create($receipt);
        $receipt = new Receipt($object->id, $object->getStatus(), $object->getProducts(), $object->getTotal());
        return new Result(201, new CreateReceiptResponse($receipt));
    }

    public function addProductInReceipt(string $receipt_id, int $quantity, Product $product): Result {
        $receipt = $this->receiptRepository->getOne($receipt_id);
        if (!($receipt instanceof Receipt)) {
            return new Result(404, new GetReceiptErrorMessage($receipt_id));
        }

        if (!$receipt->getStatus()) {
            return new Result(404, new ReceiptClosedErrorMessage($receipt_id));
        }

        $productForReceipt = new ProductForReceipt($product->id, $quantity, $product->getPrice(), $quantity * $product->getPrice());
        $this->receiptRepository->addProduct($receipt_id, $productForReceipt);
        $object = $this->receiptRepository->getOne($receipt_id);
        $receipt = new Receipt($object->id, $object->getStatus(), $object->getProducts(), $object->getTotal());
        return new Result(200, new AddProductInReceiptResponse($receipt));
    }

    public function getOneReceipt(string $receipt_id): Result {
        $receipt = $this->receiptRepository->getOne($receipt_id);
        if (!($receipt instanceof Receipt)) {
            return new Result(404, new GetReceiptErrorMessage($receipt_id));
        }

        return new Result(200, new GetOneReceiptResponse($receipt));
    }

    public function getAllReceipts(): array {
        return $this->receiptRepository->getAll();
    }

    public function updateReceiptStatus(string $receipt_id, bool $status): Result {
        $receipt = $this->receiptRepository->getOne($receipt_id);
        if (!($receipt instanceof Receipt)) {
            return new Result(404, new UpdateReceiptErrorMessage($receipt_id));
        }

        $this->receiptRepository->update($receipt_id, ['status'=>$status]);
        return new Result(200, new EmptyResponse());
    }

    public function deleteReceipt(string $receipt_id): Result {
        $receipt = $this->receiptRepository->getOne($receipt_id);
        if (!($receipt instanceof Receipt)) {
            return new Result(404, new DeleteReceiptErrorMessage($receipt_id));
        }
        $this->receiptRepository->delete($receipt_id);
        return new Result(200, new EmptyResponse());
    }
}
