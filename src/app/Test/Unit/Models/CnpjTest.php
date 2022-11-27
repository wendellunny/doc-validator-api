<?php

namespace App\Test\Unit\Models;

use App\Models\Cnpj;
use PHPUnit\Framework\TestCase;

class CnpjTest extends TestCase
{
    private Cnpj $instance;

    protected function setUp(): void
    {
        $this->setInstance();
    }

    private function setInstance(): void 
    {
        $this->instance = new Cnpj();
    }

     /**
     * Test Set unformattedCnpj method When Successful
     *
     * @return void
     */
    public function testsetUnformattedCnpjWhenSuccesful(): void
    {
        $unformattedCnpj = '05223479000149';
        $formattedCnpj = '05.223.479/0001-49';
        

        $expected = [
            'original' => '05223479000149',
            'formatted' => '05.223.479/0001-49'
        ];

        $this->instance->setUnformattedCnpj($unformattedCnpj);

        $this->assertEquals($expected,$this->instance->getCnpj());
    }

    /**
     * Test unformattedCnpj method when CNPJ is passed outside the number of characters
     *
     * @return void
     */
    public function testsetUnformattedCnpjWhenACnpjIsPassedOutsideTheNumberOfCharacters(): void
    {
        $unformattedCnpj = '05.223.479/0001-49';

        $this->expectException(\Exception::class);
        $this->expectExceptionCode(400);
        $this->expectExceptionMessage('You did not pass a CNPJ without formatting');

        $this->instance->setUnformattedCnpj($unformattedCnpj);
    }

    /**
     * Test getCnpj method when not to set unformatted CNPJ
     *
     * @return void
     */
    public function testsgetCnpjWhenNotToSetUnformattedCnpj(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionCode(400);
        $this->expectExceptionMessage('Set Unformatted CNPJ Value is Required');

        $this->instance->getCnpj();
    }

    /**
     * Test validateCnpj method when CNPJ is valid
     *
     * @return void
     */
    public function testValidateCnpjWhenCpfIsValid(): void
    {
        $unformattedCnpj = '05223479000149';
        
        $this->instance->setUnformattedCnpj($unformattedCnpj);
        $isValid = $this->instance->validateCnpj();

        $this->assertTrue($isValid);
    }

    /**
     * Test validateCnpj method when CNPJ is invalid
     *
     * @return void
     */
    public function testValidateCnpjWhenCnpjIsInvalid(): void
    {
        $unformattedCnpj = '05223479000140';
        
        $this->instance->setUnformattedCnpj($unformattedCnpj);
        $isValid = $this->instance->validateCnpj();

        $this->assertFalse($isValid);
    }

    /**
     * test validateCnpj method when not to set Unformatted CNPJ
     *
     * @return void
     */
    public function testValidateCpfWhenNotToSetUnformattedCpf(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionCode(400);
        $this->expectExceptionMessage('Set Unformatted CNPJ Value is Required');
        $this->instance->validateCnpj();
    }
    
}