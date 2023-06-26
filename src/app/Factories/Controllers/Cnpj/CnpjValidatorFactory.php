<?php

namespace App\Factories\Controllers\Cnpj;

use App\Api\FactoryInterface;
use App\Controllers\Cnpj\CnpjValidator;

class CnpjValidatorFactory implements FactoryInterface
{

    public function create(array $constructor = []): mixed
    {
        return new CnpjValidator(...$constructor);
    }
}