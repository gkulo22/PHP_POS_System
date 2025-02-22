<?php
namespace App\Infra\API;

use App\Core\CoreFacade;
use App\Core\DTOs\Units\CreateUnitRequest;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ServerRequestInterface as Request;
class UnitController {

    private CoreFacade $core;
    public function __construct(CoreFacade $core) {
        $this->core = $core;
    }
    public function createUnit(Request $request): JsonResponse {
        $data = json_decode($request->getBody(), true);
        $unitBase = new CreateUnitRequest($data['name']);

        return $this->core->createUnit($unitBase);
    }

    public function getOneUnit(string $unit_id): JsonResponse {
        return $this->core->getOneUnit($unit_id);
    }

    public function getAllUnits(): JsonResponse {
        return $this->core->getAllUnits();
    }
}
