<?php

namespace App\Services\HttpHandler;

use App\Api\Services\HttpHandler\RequestHandlerInterface;
use App\Api\Services\HttpHandler\ResponseHandlerInterface;
use App\Api\Services\HttpHandler\ResponseInterface;

class ResponseHandler implements ResponseHandlerInterface
{
    public function handle(ResponseInterface $response): void
    {
        $this->removeSensitiveHeaders();

        http_response_code($response->getStatusCode());
        foreach ($response->getHeaders() as $header) {
            header($header);
        }
        echo $response->getContent();
        die;
    }

    private function removeSensitiveHeaders(): void
    {
        header_remove('X-Powered-By');
    }

}