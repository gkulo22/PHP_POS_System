<?php
namespace App\Core\DTOs\Units;

use App\Core\Models\Unit;
use App\Core\ResponseInterface;

class CreateUnitResponse implements ResponseInterface {
    private Unit $unit;

    function __construct(Unit $unit) {
        $this->unit = $unit;
    }

    public function getUnit(): Unit {
        return $this->unit;
    }

    public function toArray(): array {
        return ['unit' => $this->unit->toArray()];
    }
}