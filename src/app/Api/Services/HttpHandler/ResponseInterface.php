<?php

namespace App\Api\Services\HttpHandler;

interface ResponseInterface
{
    public function getContent(): string;

    public function getHeaders(): array;

    public function getStatusCode(): int;

    public function setContent(string $content): self;

    public function setHeaders(array $headers): self;

    public function addHeader(string $header): self;

    public function setStatusCode(int $statusCode): self;

    public function json(array $data, $code = 200, $headers = []): self;
}