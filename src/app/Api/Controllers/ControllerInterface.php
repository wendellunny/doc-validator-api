<?php

namespace App\Api\Controllers;

use App\Api\Services\HttpHandler\ResponseInterface;

interface ControllerInterface
{
    public function execute(array $params): ResponseInterface;
}