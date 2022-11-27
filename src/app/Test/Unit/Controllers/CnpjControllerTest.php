<?php

namespace App\Test\Unit\Controllers;

use App\Controllers\CnpjController;
use App\Models\Cnpj;
use PHPUnit\Framework\TestCase;

class CnpjControllerTest extends TestCase
{
    private CnpjController $instance;
    private Cnpj $cnpjMock;

    protected function setUp(): void
    {
        $this->setMocks();
        $this->setInstance();
    }

    private function setMocks(): void
    {
        $this->cnpjMock = $this->createMock(Cnpj::class);
    }

    private function setInstance(): void
    {
        $this->instance = new CnpjController(['cnpj_model' => $this->cnpjMock]);
    }

    /**
     * Test formatCnpj method
     *
     * @return void
     */
    public function testFormatCnpj(): void
    {
        $expected = [
            'original' => '05223479000149',
            'formatted' => '05.223.479/0001-49'
        ];

        $request = [
            'cnpj' => '05223479000149'
        ];

        $this->cnpjMock
            ->expects($this->once())
            ->method('setUnformattedCnpj')
            ->with($request['cnpj']);

        $this->cnpjMock
            ->expects($this->once())
            ->method('getCnpj')
            ->willReturn($expected);
    
        $response = $this->instance->formatCnpj($request);

        $this->assertEquals(json_encode($expected), $response);
    }

    /**
     * Test validateCnpj method when CNPJ is valid
     *
     * @return void
     */
    public function testValidateCnpjWhenCpfIsValid()
    {
        $expected = json_encode([ 
            'isValid' => true, 
            'message' => 'Este CNPJ é válido', 
            'cnpj' => [
                'original' => '05223479000149',
                'formatted' => '05.223.479/0001-49'
            ]
        ]);

        $request = [
            'cnpj' => '05223479000149'
        ];

        $this->cnpjMock
            ->expects($this->once())
            ->method('setUnformattedCnpj')
            ->with($request['cnpj']);
        
        $this->cnpjMock
            ->expects($this->once())
            ->method('validateCnpj')
            ->willReturn(true);
        
        $this->cnpjMock
            ->expects($this->once())
            ->method('getCnpj')
            ->willReturn([
                'original' => '05223479000149',
                'formatted' => '05.223.479/0001-49'
            ]);

        $response = $this->instance->validateCnpj($request);

        $this->assertEquals($expected,$response);
    }

    /**
     * Test validateCnpj method when CNPJ is invalid
     *
     * @return void
     */
    public function testValidateCnpjWhenCpfIsInvalid(): void
    {
        $expected = json_encode([ 
            'isValid' => false, 
            'message' => 'Este CNPJ é inválido', 
            'cnpj' => [
                'original' => '05223479000140',
                'formatted' => '05.223.479/0001-40'
            ]
        ]);

        $request = [
            'cnpj' => '05223479000149'
        ];

        $this->cnpjMock
            ->expects($this->once())
            ->method('setUnformattedCnpj')
            ->with($request['cnpj']);
        
        $this->cnpjMock
            ->expects($this->once())
            ->method('validateCnpj')
            ->willReturn(false);
        
        $this->cnpjMock
            ->expects($this->once())
            ->method('getCnpj')
            ->willReturn([
                'original' => '05223479000140',
                'formatted' => '05.223.479/0001-40'
            ]);

        $response = $this->instance->validateCnpj($request);

        $this->assertEquals($expected,$response);
    }
}