<?php

namespace App\Bootstrap;

use App\Api\Bootstrap\AppInterface;
use App\Api\Bootstrap\DiContainerInterface;
use App\Api\Routes\RouterInterface;
use App\Routes\Router;
use App\Routes\RouterSwitch;
use App\Services\HttpHandler\ResponseHandler;

class App implements AppInterface
{
    public function __construct(
        private RouterSwitch $routerSwitch,
        private Router $router,
        private ResponseHandler $responseHandler,
    ) {}

    public function execute(): void
    {
        try {
            $response = $this->routerSwitch->execute($this->router);
            $this->responseHandler->handle($response);
        }catch (\Exception $e) {
            echo json(['message' => $e->getMessage()], $e->getCode());
        }

    }
}