<?php

namespace App\Routes;

use App\Api\Controllers\ControllerInterface;
use App\Api\Routes\RouterInterface;
use App\Api\Services\HttpHandler\ResponseInterface;
use App\Services\HttpHandler\Response;

class Router implements RouterInterface
{
    private ResponseInterface $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
        $this->response->json(['message' => 'Página não encontrada'], 404);
    }

    public function get(
        string $uri,
        ControllerInterface $controller,
        array $params = []
    ): void {
        if ($_SERVER[self::HTTP_METHOD_KEY] != self::GET_TYPE || $_SERVER[self::URI_KEY] != $uri) {
            return;
        }

        $this->response = $controller->execute($_GET);
    }

    public function post(
        string $uri,
        ControllerInterface $controller,
        array $params = []
    ): void {
        if ($_SERVER[self::HTTP_METHOD_KEY] != self::POST_TYPE || $_SERVER[self::URI_KEY] != $uri) {
            return;
        }

        $this->response = $controller->execute($_POST);
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}