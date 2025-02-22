<?php
namespace App\Core\DTOs\Units;

use App\Core\ResponseInterface;
class GetAllUnitResponse implements ResponseInterface {
    private array $units;

    public function __construct(array $units) {
        $this->units = $units;
    }


    public function toArray(): array
    {
        return ['units' => array_map(fn($unit) => $unit->toArray(), $this->units)];
    }
}
