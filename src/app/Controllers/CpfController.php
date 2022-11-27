<?php
namespace App\Controllers;

use App\Models\Cpf;

class CpfController
{
    /**
     * Cpf Model
     *
     * @var Cpf
     */
    private Cpf $cpfModel;

    /**
     * Contructor Method
     *
     * @param array $dependencyInjection
     */
    public function __construct(array $dependencyInjection)
    {
        $this->cpfModel = $dependencyInjection['cpf_model'];
    }
    
    /**
     * Format CPF controller method
     *
     * @param array $request
     * @return string
     */
    public function formatCpf(array $request): string
    {
        $cpf = strval($request['cpf']);
        $this->cpfModel->setUnformattedCpf($cpf);

        return json($this->cpfModel->getCpf());
    }

    /**
     * Validate Cpf Controller method
     *
     * @param array $request
     * @return string
     */
    public function validateCpf(array $request): string
    {
        $cpf = strval($request['cpf']);
        $this->cpfModel->setUnformattedCpf($cpf);
        
        return $this->cpfModel->validateCpf()
        ? json([ 
            'isValid' => true, 
            'message' => 'Este CPF é válido', 
            'cpf' => $this->cpfModel->getCpf()
        ])
        : json([
            'isValid' => false,
            'message' => 'Este CPF é inválido', 
            'cpf' => $this->cpfModel->getCpf()
        ]);
    }
}