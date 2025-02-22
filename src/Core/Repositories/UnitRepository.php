<?php
namespace App\Core\Repositories;
use App\Core\RepositoryInterface;

interface UnitRepository extends RepositoryInterface {
    public function hasName(string $name): bool;
}