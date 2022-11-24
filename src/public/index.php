<?php
/**
 * Document formatting and validation API
 * 
 * @author wendellunny
 */

require __DIR__ 
. DIRECTORY_SEPARATOR 
. '..'
. DIRECTORY_SEPARATOR
. 'vendor'
. DIRECTORY_SEPARATOR
. 'autoload.php';

$routes = new \App\Routes\Routes;
$router = new \App\Routes\Router($routes);
$app = new App\Bootstrap\Kernel($router);

$app->execute();