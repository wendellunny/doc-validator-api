<?php

namespace App\Api\Routes;

interface RouterSwitchInterface
{
    public function execute(RouterInterface $route): bool;

}