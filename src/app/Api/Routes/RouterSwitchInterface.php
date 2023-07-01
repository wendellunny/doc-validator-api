<?php

namespace App\Api\Routes;

use App\Api\Services\HttpHandler\ResponseInterface;

interface RouterSwitchInterface
{
    public function execute(RouterInterface $route): ResponseInterface;

}