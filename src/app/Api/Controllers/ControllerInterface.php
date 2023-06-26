<?php

namespace App\Api\Controllers;

interface ControllerInterface
{
    public function execute(array $params): void;
}