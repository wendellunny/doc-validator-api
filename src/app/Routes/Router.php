<?php

namespace App\Routes;

use Exception;

class Router
{
    /**
     * Routes
     *
     * @var Routes
     */
    private Routes $_routes;

    /**
     * Controller Class
     *
     * @var string
     */
    private string $_controllerClass;

    /**
     * Controller method
     *
     * @var string
     */
    private string $_method;

    /**
     * Controller Dependency Injection
     *
     * @var array
     */
    private array $_dependencyInjection;

    /**
     * Contructor method
     *
     * @param Routes $routes
     */
    public function __construct(Routes $routes)
    {
        $this->_routes = $routes;
    }

    /**
     * Execute Router
     *
     * @return void
     */
    public function execute(string $endpoint, string $httpMethod): void
    {
        $this->goRoute($endpoint, $httpMethod);
    }

    /**
     * Method that directs to some registered route
     *
     * @param string $endpoint
     * @param string $httpMethod
     * @return void
     */
    private function goRoute(string $endpoint, string $httpMethod): void
    {
        $routes = $this->_routes->get();

        if(isset($routes[$endpoint]) && $httpMethod === $routes[$endpoint]['http_method']){
            $routeData = $routes[$endpoint];
            $this->setControllerClass($routeData['controller_class']);
            $this->setMethod($routeData['method']);
            $this->setDependencyInjection($routeData['dependency_injection']);
           
            $this->callController($httpMethod);  
        }else{
           $this->showNotFoundPage();
        }
    }

    /**
     * Show Not Found Page
     *
     * @return void
     */
    private function showNotFoundPage(): void
    {
        showResponse('<h1>404<h1><h2>Págin Não Encontrada<h2>',404);
    }

    /**
     * Call Controller
     *
     * @return void
     */
    private function callController($httpMethod){
        $controllerClass = $this->_controllerClass;
        $dependencyInjection = $this->_dependencyInjection;
        $method = $this->_method;

        $instance = new $controllerClass($dependencyInjection);
        try{
            showResponse(
                $instance->$method($_REQUEST)
            );
        }catch(Exception $e){
            showResponse(json([
                'error' => $e->getMessage()
            ]),$e->getCode());
        } 
    }

    /**
     * Controller class setter
     *
     * @param string $controllerClass
     * @return void
     */
    private function setControllerClass(string $controllerClass): void
    {
        $this->_controllerClass = $controllerClass;
    }

    /**
     * Method Setter
     *
     * @param string $method
     * @return void
     */
    private function setMethod(string $method): void
    {
        $this->_method= $method;
    }

    /**
     * Dependency Injection setter
     *
     * @param array $dependencyInjection
     * @return void
     */
    private function setDependencyInjection(array $dependencyInjection): void
    {
        $this->_dependencyInjection = $dependencyInjection;
    }
}