<?php

namespace App\Models;

class Cpf
{
    private string $unformattedCpf;
    private string $formattedCpf;

    public function setUnformattedCpf($cpf){
        $this->unformattedCpf = $cpf;
        $this->formatCpf();

    }

    public function getCpf(){
        return [
            'original' => $this->unformattedCpf,
            'formatted' => $this->formattedCpf
        ];
    }

    private function formatCpf(){
        $this->formattedCpf = preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $this->unformattedCpf);
    }
    
}