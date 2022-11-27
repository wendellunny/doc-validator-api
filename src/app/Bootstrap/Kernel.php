<?php

namespace App\Bootstrap;

use App\Routes\Router;

class Kernel 
{
    /**
     * Router
     *
     * @var Router
     */
    private Router $_router;

    /**
     * Contructor method
     *
     * @param Router $router
     */
    public function __construct(Router $router)
    {
        $this->_router = $router; 
    }
    
    /**
     * Execute Kernel App
     *
     * @return void
     */
    public function execute(): void
    {
        $endpoint = $_SERVER['REQUEST_URI'];
        $httpMethod = $_SERVER['REQUEST_METHOD'];

        $this->_router->execute($endpoint, $httpMethod);
    }
}