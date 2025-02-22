<?php
namespace App\Infra\Data\InMemory;

use App\Core\RepositoryInterface;
use Random\RandomException;

class InMemoryRepository implements RepositoryInterface {
    protected array $_store = [];

    /**
     * @throws RandomException
     */
    public function create($entity): object
    {
        $entity->id = $this->generateUuid();
        $this->_store[$entity->id] = $entity;
        return $entity;
    }

    public function getOne($entityId): ?object
    {
        return $this->_store[$entityId] ?? null;
    }

    public function getAll(): array
    {
        return array_values($this->_store);
    }

    public function update($entityId, $data): bool
    {
        if (isset($this->_store[$entityId])) {
            $entity = $this->_store[$entityId];
            foreach ($data as $key => $value) {
                $entity->$key = $value;
            }
            return true;
        }
        return false;
    }

    public function delete($entityId): bool
    {
        if (isset($this->_store[$entityId])) {
            unset($this->_store[$entityId]);
            return true;
        }
        return false;
    }

    /**
     * @throws RandomException
     */
    protected function generateUuid(): string
    {
        return strtoupper(bin2hex(random_bytes(16)));
    }
}
