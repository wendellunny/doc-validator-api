<?php

namespace App\Routes;


class Router
{

    private Routes $_routes;

    public function __construct(Routes $routes)
    {
        $this->_routes = $routes;
    }

    public function execute()
    {
        $request = $_SERVER['REQUEST_URI'];

        $this->goRoute($request);
        
    }

    private function goRoute($request){
        $routes = $this->_routes->get();

        if(isset($routes[$request])){
            $routeData = $routes[$request];
            $controllerClass = $routeData['controller_class'];
            $method = $routeData['method'];

            $instance = new $controllerClass($routeData['dependency_injection']);
            $instance->$method();
            die();
        }else{
            echo '<h1>404<h1><h2>Págin Não Encontrada<h2>';
        }
    }
    


}