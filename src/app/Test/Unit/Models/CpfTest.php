<?php

namespace App\Test\Unit\Models;

use App\Models\Cpf;
use PHPUnit\Framework\TestCase;

class CpfTest extends TestCase
{
    /**
     * Instance CPF class
     *
     * @var Cpf
     */
    private Cpf $instance;

    /**
     * SetUp Method
     *
     * @return void
     */
    protected function setUp(): void
    {
        $this->setInstance();
    }

    /**
     * Set Instance
     *
     * @return void
     */
    private function setInstance(): void
    {
        $this->instance = new Cpf();
    }

    /**
     * Test Set unformattedCpf method When Successful
     *
     * @return void
     */
    public function testsetUnformattedCpfWhenSuccesful(): void
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

    /**
     * Test unformattedCpf method when CPF is passed outside the number of characters
     *
     * @return void
     */
    public function testsetUnformattedCpfWhenACpfIsPassedOutsideTheNumberOfCharacters(): void
    {
        $unformattedCpf = '447.408.520-55';

        $this->expectException(\Exception::class);
        $this->expectExceptionCode(400);
        $this->expectExceptionMessage('You did not pass a Cpf without formatting');

        $this->instance->setUnformattedCpf($unformattedCpf);
    }

    /**
     * Test getCpf method when not to set unformatted CPF
     *
     * @return void
     */
    public function testsgetCpfWhenNotToSetUnformattedCpf(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionCode(400);
        $this->expectExceptionMessage('Set Unformatted Cpf Value is Required');

        $this->instance->getCpf();
    }

    /**
     * Test validateCpf method when CPF is valid
     *
     * @return void
     */
    public function testValidateCpfWhenCpfIsValid(): void
    {
        $unformattedCpf = '44740852055';
        
        $this->instance->setUnformattedCpf($unformattedCpf);
        $isValid = $this->instance->validateCpf();

        $this->assertTrue($isValid);
    }

    /**
     * Test validateCpf method when CPF is invalid
     *
     * @return void
     */
    public function testValidateCpfWhenCpfIsInvalid(): void
    {
        $unformattedCpf = '44740852050';
        
        $this->instance->setUnformattedCpf($unformattedCpf);
        $isValid = $this->instance->validateCpf();

        $this->assertFalse($isValid);
    }

    /**
     * test validateCPF method when not to set Unformatted CPF
     *
     * @return void
     */
    public function testValidateCpfWhenNotToSetUnformattedCpf(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionCode(400);
        $this->expectExceptionMessage('Set Unformatted Cpf Value is Required');
        $this->instance->validateCpf();
    }
}