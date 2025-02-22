<?php
namespace App\Core\DTOs\Units;

use App\Core\Models\Unit;
use App\Core\ResponseInterface;
class GetOneUnitResponse implements ResponseInterface {
    private Unit $unit;

    public function __construct(Unit $unit) {
        $this->unit = $unit;
    }


    public function toArray(): array
    {
        return ['unit' => $this->unit->toArray()];
    }
}
