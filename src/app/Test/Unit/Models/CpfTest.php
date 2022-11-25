<?php

namespace App\Test\Unit\Models;

use App\Models\Cpf;
use PHPUnit\Framework\TestCase;

class CpfTest extends TestCase
{
    private Cpf $instance;

    protected function setUp(): void
    {
        $this->setInstance();
    }

    private function setInstance(){
        $this->instance = new Cpf();
    }

    public function testsetCpf()
    {
        $unformattedCpf = '44740852055';
        $formattedCpf = '447.408.520-55';
        

        $expected = [
            'original' => $unformattedCpf,
            'formatted' => $formattedCpf
        ];

        $this->instance->setUnformattedCpf($unformattedCpf);

        $this->assertEquals($expected,$this->instance->getCpf());
    }

    public function testsgetCpfWhenNotToSetUnformattedCpf()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Set Unformatted Cpf Value is Required');

        $this->instance->getCpf();
    }

    public function testValidateCpfWhenCpfIsvalid()
    {
        $unformattedCpf = '44740852055';
        $formattedCpf = '447.408.520-55';
        

        $expected = [
            'original' => $unformattedCpf,
            'formatted' => $formattedCpf
        ];

        $this->instance->setUnformattedCpf($unformattedCpf);

        $this->assertEquals($expected,$this->instance->getCpf());
    }
}