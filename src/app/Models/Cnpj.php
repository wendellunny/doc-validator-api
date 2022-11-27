<?php

namespace App\Models;

class Cnpj
{
    private string $unformattedCnpj;
    private string $formattedCnpj;

    public function setUnformattedCnpj(string $cnpj)
    {
        if(strlen($cnpj) !== 14){
            throw new \Exception("You did not pass a CNPJ without formatting", 400);  
        }
        
        $this->unformattedCnpj = $cnpj;
        $this->formatCnpj();
    }

    public function getCnpj(): array
    {
        if(empty($this->unformattedCnpj)){
            throw new \Exception("Set Unformatted CNPJ Value is Required", 400);  
        }

        return [
            'original' => $this->unformattedCnpj,
            'formatted' => $this->formattedCnpj
        ];
    }

    public function formatCnpj()
    {
        $this->formattedCnpj = preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $this->unformattedCnpj);
    }

    public function validateCnpj(){
        if(empty($this->unformattedCnpj)){
            throw new \Exception("Set Unformatted CNPJ Value is Required" , 400);  
        }

        $cnpj = $this->unformattedCnpj;

        if (strlen($cnpj) != 14)
            return false;
    
        if (preg_match('/(\d)\1{13}/', $cnpj))
            return false;	
    
        for ($i = 0, $j = 5, $sum = 0; $i < 12; $i++)
        {
            $sum += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
    
        $rest = $sum % 11;
    
        if ($cnpj[12] != ($rest < 2 ? 0 : 11 - $rest))
            return false;
    
        for ($i = 0, $j = 6, $sum = 0; $i < 13; $i++)
        {
            $sum += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $rest = $sum % 11;
    
        return $cnpj[13] == ($rest < 2 ? 0 : 11 - $rest);
    }
}