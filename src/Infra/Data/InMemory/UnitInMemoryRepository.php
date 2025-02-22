<?php
namespace App\Infra\Data\InMemory;

use App\Core\Repositories\UnitRepository;

class UnitInMemoryRepository extends InMemoryRepository implements UnitRepository {
    public function hasName($name): bool
    {
        foreach ($this->_store as $unit) {
            if ($unit->name === $name) {
                return true;
            }
        }
        return false;
    }
}
