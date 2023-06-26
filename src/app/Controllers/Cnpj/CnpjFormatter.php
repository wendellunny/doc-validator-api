<?php
namespace App\Controllers\Cnpj;

use App\Api\Controllers\ControllerInterface;
use App\Models\Cnpj;

class CnpjFormatter implements ControllerInterface
{

    public function __construct(private Cnpj $cnpj)
    {
    }

    public function execute(array $params): void
    {
        try {
            $cnpj = strval($params['cnpj']);
            $this->cnpj->setUnformattedCnpj($cnpj);
            echo json($this->cnpj->getCnpj());
        } catch (\Exception $e) {
            echo json(['message' => $e->getMessage()], $e->getCode());
        }
        die();
    }
}