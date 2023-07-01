<?php

namespace App\Services\HttpHandler;

use App\Api\Services\HttpHandler\ResponseInterface;

class Response implements ResponseInterface
{
    private string $content = '';

    private array $headers = [];

    private int $statusCode = 200;

    public function getContent(): string
    {
        return $this->content;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function setContent(string $content): ResponseInterface
    {
        $this->content = $content;
        return $this;
    }

    public function setHeaders(array $headers): ResponseInterface
    {
        $this->headers = $headers;
        return $this;
    }

    public function addHeader(string $header): ResponseInterface
    {
        $this->headers[] = $header;
        return $this;
    }

    public function setStatusCode(int $statusCode): ResponseInterface
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    public function json(array $data, $code = 200, $headers = []): ResponseInterface
    {
        $this->addHeader('Content-type: application/json');

        $headers = array_merge($this->headers, $headers);
        $content = json_encode($data);

        $this->setHeaders($headers);
        $this->setContent($content);
        $this->setStatusCode($code);

        return $this;
    }
}