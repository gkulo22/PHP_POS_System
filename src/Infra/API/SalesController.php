<?php
namespace App\Infra\API;

use App\Core\CoreFacade;
use App\Core\DTOs\Sales\GetAllSalesResponse;
use Laminas\Diactoros\Response\JsonResponse;

class SalesController {
    private CoreFacade $core;
    public function __construct(CoreFacade $core) {
        $this->core = $core;
    }

    public function getSales(array $args): JsonResponse {
        return new JsonResponse($this->core->getSales()->toArray(), 200);
    }
}

