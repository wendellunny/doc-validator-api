<?php

namespace App\Api\Routes;

use App\Api\Controllers\ControllerInterface;

interface RouterInterface
{
    public const URI_KEY = 'REQUEST_URI';
    public const HTTP_METHOD_KEY = 'REQUEST_METHOD';
    public const POST_TYPE = 'POST';
    public const GET_TYPE = 'GET';

    public function get(string $uri, ControllerInterface $controller): void;

    public function post(string $uri, ControllerInterface $controller): void;
}