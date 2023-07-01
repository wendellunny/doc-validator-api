<?php
namespace App\Controllers\Cnpj;

use App\Api\Controllers\ControllerInterface;
use App\Api\Services\HttpHandler\ResponseInterface;
use App\Models\Cnpj;
use App\Services\HttpHandler\Response;

class CnpjFormatter implements ControllerInterface
{

    public function __construct(private Response $response, private Cnpj $cnpj)
    {
    }

    public function execute(array $params): ResponseInterface
    {

        $cnpj = strval($params['cnpj']);
        $this->cnpj->setUnformattedCnpj($cnpj);

        return $this->response->json($this->cnpj->getCnpj());
    }
}