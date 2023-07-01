<?php

namespace App\Controllers\Cpf;

use App\Api\Controllers\ControllerInterface;
use App\Api\Services\HttpHandler\ResponseInterface;
use App\Bootstrap\DiContainer;
use App\Models\Cpf;
use App\Services\HttpHandler\Response;

class CpfFormatter implements ControllerInterface
{
    public function __construct(private Response $response, private Cpf $cpf)
    {
    }

    public function execute(array $params): ResponseInterface
    {

        $cpf = strval($params['cpf']);
        $this->cpf->setUnformattedCpf($cpf);

        return $this->response->json($this->cpf->getCpf());
    }
}