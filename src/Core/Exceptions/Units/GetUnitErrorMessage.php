<?php
namespace App\Core\Exceptions\Units;

use App\Core\BaseExceptionInterface;
class GetUnitErrorMessage implements BaseExceptionInterface {
    private array $error;

    public function __construct(string $unitId) {
        $this->error = ["message" => "Unit with id: {$unitId} does not exist."];
    }

    public function toArray(): array
    {
        return ['error' => $this->error];
    }
}