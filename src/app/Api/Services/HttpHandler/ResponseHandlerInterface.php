<?php

namespace App\Api\Services\HttpHandler;

interface ResponseHandlerInterface
{
    public function handle(ResponseInterface $response): void;
}