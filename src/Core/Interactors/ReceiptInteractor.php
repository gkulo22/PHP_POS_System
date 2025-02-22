<?php
namespace App\Core\Interactors;

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
        $this->receiptRepository->create($receipt);
        return new Result(201);
    }

    public function addProductInReceipt(): Result {
        return new Result(200);
    }

    public function getOneReceipt(string $receipt_id): Result {
        $receipt = $this->receiptRepository->getOne($receipt_id);
        if (!($receipt instanceof Receipt)) {
            return new Result(404);
        }

        return new Result(200);
    }

    public function updateReceiptStatus(string $receipt_id, bool $status): Result {
        $receipt = $this->receiptRepository->getOne($receipt_id);
        if (!($receipt instanceof Receipt)) {
            return new Result(404);
        }

        $this->receiptRepository->update($receipt_id, ['status'=>$status]);
        return new Result(200);
    }

    public function deleteReceipt(string $receipt_id): Result {
        $receipt = $this->receiptRepository->getOne($receipt_id);
        if (!($receipt instanceof Receipt)) {
            return new Result(404);
        }
        $this->receiptRepository->delete($receipt_id);
        return new Result(200);
    }
}
