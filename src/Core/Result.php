<?php
namespace App\Core;

class Result {
    private int $status_code;
    private ResponseInterface $content;

    public function __construct(int $statusCode, ResponseInterface $content) {
        $this->status_code = $statusCode;
        $this->content = $content;
    }

    public function getStatusCode(): int {
        return $this->status_code;
    }

    public function getContent(): ResponseInterface {
        return $this->content;
    }
}
