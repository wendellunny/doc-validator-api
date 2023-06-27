<?php

namespace App\Routes;

use App\Api\Routes\RouterInterface;
use App\Api\Routes\RouterSwitchInterface;
use App\Controllers\Cnpj\CnpjFormatter;
use App\Controllers\Cnpj\CnpjValidator;
use App\Controllers\Cpf\CpfFormatter;
use App\Controllers\Cpf\CpfValidator;

class RouterSwitch implements RouterSwitchInterface
{
    public function __construct(
        private CnpjFormatter $cnpjFormatter,
        private CnpjValidator $cnpjValidator,
        private CpfFormatter $cpfFormatter,
        private CpfValidator $cpfValidator,
    )
    {
    }

    public function execute(RouterInterface $route): bool
    {
        $route->post('/cnpj/formatter', $this->cnpjFormatter);
        $route->post('/cnpj/validator', $this->cnpjValidator);
        $route->post('/cpf/formatter', $this->cpfFormatter);
        $route->post('/cpf/validator', $this->cpfValidator);

        return false;
    }
}