<?php

namespace App\Routes;

use App\Api\Routes\RouterInterface;
use App\Api\Routes\RouterSwitchInterface;
use App\Factories\Controllers\Cnpj\CnpjValidatorFactory;
use App\Factories\Controllers\Cpf\CpfFormatterFactory;
use App\Factories\Controllers\Cpf\CpfValidatorFactory;
use App\Factories\Models\CnpjFactory;
use App\Factories\Controllers\Cnpj\CnpjFormatterFactory;
use App\Factories\Models\CpfFactory;

class RouterSwitch implements RouterSwitchInterface
{
    public function __construct(
        private CnpjFormatterFactory $cnpjFormatterFactory,
        private CnpjValidatorFactory $cnpjValidatorFactory,
        private CnpjFactory $cnpjFactory,
        private CpfFormatterFactory $cpfFormatterFactory,
        private CpfValidatorFactory $cpfValidatorFactory,
        private CpfFactory $cpfFactory
    )
    {
    }

    public function execute(RouterInterface $route): bool
    {
        $cnpj = $this->cnpjFactory->create();
        $cnpjFormatter = $this->cnpjFormatterFactory->create([$cnpj]);
        $route->post('/cnpj/formatter', $cnpjFormatter);

        $cnpjValidator = $this->cnpjValidatorFactory->create([$cnpj]);
        $route->post('/cnpj/validator', $cnpjValidator);

        $cpf = $this->cpfFactory->create();
        $cpfFormatter = $this->cpfFormatterFactory->create([$cpf]);
        $route->post('/cpf/formatter', $cpfFormatter);

        $cpfValidator = $this->cpfValidatorFactory->create([$cpf]);
        $route->post('/cpf/validator', $cpfValidator);

        return false;
    }
}