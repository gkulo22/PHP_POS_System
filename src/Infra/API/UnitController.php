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
    public function createUnit(array $args): JsonResponse {
        $request = $args['request'];
        $data = json_decode($request->getBody(), true);
        $unitBase = new CreateUnitRequest($data['name']);

        return $this->core->createUnit($unitBase);
    }

    public function getOneUnit(array $args): JsonResponse {
        $unit_id = $args['id'];
        return $this->core->getOneUnit($unit_id);
    }

    public function getAllUnits(array $args): JsonResponse {
        return $this->core->getAllUnits();
    }
}
