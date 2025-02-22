<?php

namespace App\Core\Interactors;

use App\Core\DTOs\Units\CreateUnitResponse;
use App\Core\DTOs\Units\GetAllUnitResponse;
use App\Core\DTOs\Units\GetOneUnitResponse;
use App\Core\Exceptions\Units\UnitCreationErrorMessage;
use App\Core\Exceptions\Units\GetUnitErrorMessage;
use App\Core\Models\Unit;
use App\Core\Repositories\UnitRepository;
use App\Core\RepositoryInterface;
use App\Core\Result;

class UnitInteractor {
    private UnitRepository $unitRepository;

    public function __construct(UnitRepository $unitRepository) {
        $this->unitRepository = $unitRepository;
    }

    public function createUnit(string $name): Result {
        if ($this->unitRepository->hasName($name)) {
            return new Result(409, new UnitCreationErrorMessage($name));
        }

        $unit = new Unit(RepositoryInterface::NO_ID, $name);
        $object = $this->unitRepository->create($unit);
        $unit = new Unit($object->id, $object->getName());
        return new Result(201, new CreateUnitResponse($unit));
    }

    public function getOneUnit(string $unit_id): Result {
        $unit = $this->unitRepository->getOne($unit_id);
        if (!($unit instanceof Unit)) {
            return new Result(404, new GetUnitErrorMessage($unit_id));
        }

        return new Result(200, new GetOneUnitResponse($unit));
    }

    public function getAllUnits(): Result {
        $units = $this->unitRepository->getAll();
        return new Result(200, new GetAllUnitResponse($units));
    }
}