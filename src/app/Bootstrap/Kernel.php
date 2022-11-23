<?php

namespace App\Bootstrap;

use App\Routes\Router;

class Kernel 
{
    private Router $_router;

    public function __construct(Router $router)
    {
        $this->_router = $router; 
    }

    public function execute()
    {
        $this->_router->execute();
    }
}