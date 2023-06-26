<?php

namespace App\Routes;

use App\Api\Controllers\ControllerInterface;
use App\Api\Routes\RouterInterface;

class Router implements RouterInterface
{

    public function get(
        string $uri,
        ControllerInterface $controller,
        array $params = []
    ): void {
        if ($_SERVER[self::HTTP_METHOD_KEY] != self::GET_TYPE || $_SERVER[self::URI_KEY] != $uri) {
            return;
        }

        $controller->execute($_GET);
    }

    public function post(
        string $uri,
        ControllerInterface $controller,
        array $params = []
    ): void {
        if ($_SERVER[self::HTTP_METHOD_KEY] != self::POST_TYPE || $_SERVER[self::URI_KEY] != $uri) {
            return;
        }

        $controller->execute($_POST);
    }
}