<?php

namespace App\Routes;


class Router
{
    
    private Routes $_routes;
    private string $_controllerClass;
    private string $_method;
    private array $_dependencyInjection;

    public function __construct(Routes $routes)
    {
        $this->_routes = $routes;
    }

    public function execute()
    {
        $endpoint = $_SERVER['REQUEST_URI'];
        $httpMethod = $_SERVER['REQUEST_METHOD'];

        $this->goRoute($endpoint, $httpMethod);
    }

    private function goRoute($endpoint, $httpMethod){
        $routes = $this->_routes->get();
        
        if(isset($routes[$endpoint]) && $httpMethod === $routes[$endpoint]['http_method']){
            $routeData = $routes[$endpoint];
            $this->setControllerClass($routeData['controller_class']);
            $this->setMethod($routeData['method']);
            $this->setDependencyInjection($routeData['dependency_injection']);
           
            $this->callController();  
        }else{
           $this->showNotFoundPage();
        }
    }

    private function showNotFoundPage(){
        echo '<h1>404<h1><h2>Págin Não Encontrada<h2>';
        die();
    }

    private function callController(){
        $controllerClass = $this->_controllerClass;
        $dependencyInjection = $this->_dependencyInjection;
        $method = $this->_method;

        $instance = new $controllerClass($dependencyInjection);
        $instance->$method();
        die();
    }

    private function setControllerClass(string $controllerClass)
    {
        $this->_controllerClass = $controllerClass;
    }

    private function setMethod(string $method)
    {
        $this->_method= $method;
    }

    private function setDependencyInjection(array $dependencyInjection)
    {
        $this->_dependencyInjection = $dependencyInjection;
    }
    


}