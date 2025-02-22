<?php
namespace App\Infra\API;

use App\Core\CoreFacade;
use App\Core\DTOs\Receipts\addProductInReceiptRequest;
use App\Core\DTOs\Receipts\UpdateReceiptRequest;
use App\Core\DTOs\Units\CreateUnitRequest;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ServerRequestInterface as Request;

class ReceiptController {
    private CoreFacade $core;
    public function __construct(CoreFacade $core) {
        $this->core = $core;
    }

    public function createReceipt(array $args): JsonResponse {
        return $this->core->createReceipt();
    }

    public function addProductInReceipt(array $args): JsonResponse {
        $request = $args['request'];
        $receipt_id = $args['id'];

        $data = json_decode($request->getBody(), true);
        $productForReceiptBase = new addProductInReceiptRequest($data['id'], $data['quantity']);
        return $this->core->addProductInReceipt($receipt_id, $productForReceiptBase);
    }

    public function getOneReceipt(array $args): JsonResponse {
        $receipt_id = $args['id'];
        return $this->core->getOneReceipt($receipt_id);
    }

    public function closeReceipt(array $args): JsonResponse {
        $request = $args['request'];
        $receipt_id = $args['id'];

        $data = json_decode($request->getBody(), true);
        $receiptStatusBase = new UpdateReceiptRequest(!($data['status'] === "closed"));
        return $this->core->updateReceiptStatus($receipt_id, $receiptStatusBase);
    }

    public function deleteReceipt(array $args): JsonResponse {
        $receipt_id = $args['id'];
        return $this->core->deleteReceipt($receipt_id);
    }
}