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
    public function execute(): void
    {
        $endpoint = $_SERVER['REQUEST_URI'];
        $httpMethod = $_SERVER['REQUEST_METHOD'];

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
           
            $this->callController();  
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
        echo '<h1>404<h1><h2>Págin Não Encontrada<h2>';
        die();
    }

    /**
     * Call Controller
     *
     * @return void
     */
    private function callController(){
        $controllerClass = $this->_controllerClass;
        $dependencyInjection = $this->_dependencyInjection;
        $method = $this->_method;

        $instance = new $controllerClass($dependencyInjection);
        try{
            showResponse($instance->$method());
        }catch(Exception $e){
            echo json_encode([
                'error' => $e->getMessage()
            ],500);
        }
        
        die();
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