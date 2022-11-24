<?php

namespace App\Models;

class Cpf
{
    /**
     * Unformatted CPF
     *
     * @var string
     */
    private string $unformattedCpf;

    /**
     * Formatted CPF
     *
     * @var string
     */
    private string $formattedCpf;

    /**
     * Method that sets value in CPF attributes
     *
     * @param string $cpf
     * @return void
     */
    public function setUnformattedCpf(string $cpf): void
    {
        $this->unformattedCpf = $cpf;
        $this->formatCpf();

    }

    /**
     * Method to get CPF
     *
     * @return array
     * @throws Exception
     */
    public function getCpf(): array
    {
        if(empty($this->unformattedCpf)){
            throw new \Exception("Set Unformatted Cpf Value is Required");  
        }

        return [
            'original' => $this->unformattedCpf,
            'formatted' => $this->formattedCpf
        ];
    }

    /**
     * Method that formats the passed cpf and updates the formattedCpf attribute
     *
     * @return void
     */
    private function formatCpf(): void
    {
        $this->formattedCpf = preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $this->unformattedCpf);
    }

    /**
     * Method that validates a CPF
     *
     * @return boolean
     * @throws Exception
     */
    public function validateCpf(): bool
    {
        if(empty($this->unformattedCpf)){
            throw new \Exception("Set Unformatted Cpf Value is Required");    
        }
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