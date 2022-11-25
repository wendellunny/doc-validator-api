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
     * @return string
     */
    public function formatCpf(): string
    {
        $cpf = strval($_POST['cpf']);
        $this->cpfModel->setUnformattedCpf($cpf);

        return json_encode($this->cpfModel->getCpf());
    }

    /**
     * Validate Cpf Controller method
     *
     * @return void
     */
    public function validateCpf(): string
    {
        $cpf = strval($_POST['cpf']);
        $this->cpfModel->setUnformattedCpf($cpf);
        
        return $this->cpfModel->validateCpf()
        ? json_encode([ 'isValid' => true, 'message' => 'Este CPF é válido', 'cpf' => $this->cpfModel->getCpf(),])
        : json_encode(['isValid' => false, 'message' => 'Este CPF é inválido', 'cpf' => $this->cpfModel->getCpf(),]);
    }
}