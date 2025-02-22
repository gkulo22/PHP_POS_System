<?php
namespace App\Core\DTOs;

use App\Core\ResponseInterface;

class EmptyResponse implements ResponseInterface {

    public function toArray(): array
    {
        return [];
    }
}