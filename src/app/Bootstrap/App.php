<?php

namespace App\Bootstrap;

use App\Api\Bootstrap\AppInterface;
use App\Api\Bootstrap\DiContainerInterface;
use App\Api\Routes\RouterInterface;
use App\Routes\Router;
use App\Routes\RouterSwitch;

class App implements AppInterface
{
    public function __construct(
        private RouterSwitch $routerSwitch,
        private Router $router,
    ) {}

    public function execute(): void
    {
        try{
            if (!$this->routerSwitch->execute($this->router)) {
                echo json(['message' => 'Endpoint não encontrado'], 404);
            }
        }catch (\Exception $e) {
            echo json(['message' => 'Endpoint não encontrado'], 404);
        }

    }
}