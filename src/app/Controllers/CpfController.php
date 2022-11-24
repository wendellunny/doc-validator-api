<?php
namespace App\Controllers;

use App\Models\Cpf;

class CpfController
{
    private Cpf $cpfModel;
    public function __construct(array $dependencyInjection)
    {
        $this->cpfModel = $dependencyInjection['cpf_model'];
    }

    public function formatCpf(){
        
        $cpf = strval($_POST['cpf']);
        
        $this->cpfModel->setUnformattedCpf($cpf);

        echo json_encode($this->cpfModel->getCpf());
    }

    public function validateCpf(){
        $cpf = strval($_POST['cpf']);

        $this->cpfModel->setUnformattedCpf($cpf);
        
        echo $this->cpfModel->validateCpf()
        ? json_encode([ 'isValid' => true, 'message' => 'Este CPF é válido', 'cpf' => $this->cpfModel->getCpf(),])
        : json_encode(['isValid' => false, 'message' => 'Este CPF é inválido', 'cpf' => $this->cpfModel->getCpf(),]);
    }
}