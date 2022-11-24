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

    public function validateCpf(){
        ini_set('memory_limit', '256M');
       $cpf = $this->formattedCpf;

        $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
            
        if (strlen($cpf) != 11) {
            return false;
        }
    
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }
    
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;      
    }
    
}