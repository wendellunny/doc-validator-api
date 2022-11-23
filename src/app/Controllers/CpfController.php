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
        
        $cpf = $_POST['cpf'];
        $this->cpfModel->setUnformattedCpf($cpf);

        echo json_encode($this->cpfModel->getCpf());
        die();
    }
}