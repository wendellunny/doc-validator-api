<?php

namespace App\Controllers;

use App\Models\Cnpj;

class CnpjController
{
    private Cnpj $cnpjModel;

    public function __construct(array $dependencyInjection)
    {
        $this->cnpjModel = $dependencyInjection['cnpj_model'];
    }

    public function formatCnpj()
    {
        $cnpj = strval($_POST['cnpj']);
        $this->cnpjModel->setUnformattedCnpj($cnpj);

        return json($this->cpfModel->getCpf());
    }

    public function validateCnpj(): string
    {
        $cnpj = strval($_POST['cnpj']);
        $this->cnpjModel->setUnformattedCnpj($cnpj);
        
        return $this->cnpjModel->validateCnpj()
        ? json([ 
            'isValid' => true, 
            'message' => 'Este CNPJ é válido', 
            'cnpj' => $this->cnpjModel->getCnpj()
        ])
        : json([
            'isValid' => false,
            'message' => 'Este CNPJ é inválido', 
            'cnpj' => $this->cnpjModel->getCnpj()
        ]);
    }
}