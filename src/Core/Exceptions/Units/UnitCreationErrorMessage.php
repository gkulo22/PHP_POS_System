<?php
namespace App\Core\Exceptions\Units;

use App\Core\BaseExceptionInterface;
class UnitCreationErrorMessage implements BaseExceptionInterface {
    private array $error;

    public function __construct(string $unitName) {
        $this->error = ['message' => "Unit with name: {$unitName} already exists."];
    }


    public function toArray(): array
    {
        return ['error' => $this->error];
    }
}
