<?php
namespace App\Infra\API;

use App\Core\CoreFacade;
use App\Core\DTOs\GetAllSalesResponse;

class SalesController {
    private CoreFacade $core;
    public function __construct(CoreFacade $core) {
        $this->core = $core;
    }

    public function getSales(): GetAllSalesResponse {
        return $this->core->getSales();
    }
}

