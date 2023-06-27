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

$router = new \App\Routes\Router();

$container = new \App\Bootstrap\DiContainer();
$app = $container->create(\App\Bootstrap\App::class);

$app->execute();

die();