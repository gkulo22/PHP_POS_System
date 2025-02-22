<?php
namespace App\Core;
interface RepositoryInterface {
    public const NO_ID = "no_id";
    public function create(object $entity): object;
    public function getOne(string $entityId): ?object;
    public function getAll(): array;
    public function update(string $entityId, array $data): bool;
    public function delete(string $entityId): bool;
}
