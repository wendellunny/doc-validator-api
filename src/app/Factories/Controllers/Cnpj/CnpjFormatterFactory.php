<?php

namespace App\Factories\Controllers\Cnpj;

use App\Api\FactoryInterface;
use App\Controllers\Cnpj\CnpjFormatter;

class CnpjFormatterFactory implements FactoryInterface
{
    public function create(array $constructor = []): mixed
    {
        return new CnpjFormatter(...$constructor);
    }
}