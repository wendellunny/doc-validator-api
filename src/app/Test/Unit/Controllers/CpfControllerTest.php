<?php 

namespace App\Test\Unit\Controllers;

use App\Controllers\CpfController;
use App\Models\Cpf;
use PHPUnit\Framework\TestCase;

class CpfControllerTest extends TestCase
{
    /**
     * Class instance
     *
     * @var CpfController
     */
    private CpfController $instance;

    /**
     * Cpf Model Mock
     *
     * @var Cpf
     */
    private Cpf $cpfMock;

    /**
     * SetUp Method
     *
     * @return void
     */
    protected function setUp(): void
    {
        $this->setMocks();
        $this->setInstance();
    }

    /**
     * Set Mocks Methods
     *
     * @return void
     */
    private function setMocks(): void
    {
        $this->cpfMock = $this->createMock(Cpf::class);
    }

    /**
     * Set Instance Method
     *
     * @return void
     */
    private function setInstance(): void
    {
        $this->instance = new CpfController(['cpf_model' => $this->cpfMock]);
    }

    /**
     * Test formatCpf method
     *
     * @return void
     */
    public function testFormatCpf(): void
    {
        $expected = [
            'original' => '44740852055',
            'formatted' => '447.408.520-55'
        ];

        $request = [
            'cpf' => '44740852055'
        ];

        $this->cpfMock
            ->expects($this->once())
            ->method('setUnformattedCpf')
            ->with($request['cpf']);

        $this->cpfMock
            ->expects($this->once())
            ->method('getCpf')
            ->willReturn($expected);
            ;

        $response = $this->instance->formatCpf($request);

        $this->assertEquals(json_encode($expected), $response);
    }

    /**
     * Test validateCpf method when CPF is valid
     *
     * @return void
     */
    public function testValidateCpfWhenCpfIsValid()
    {
        $expected = json_encode([ 
            'isValid' => true, 
            'message' => 'Este CPF é válido', 
            'cpf' => [
                'original' => '44740852055',
                'formatted' => '447.408.520-55'
            ]
        ]);

        $request = [
            'cpf' => '44740852055'
        ];

        $this->cpfMock
            ->expects($this->once())
            ->method('setUnformattedCpf')
            ->with($request['cpf']);
        
        $this->cpfMock
            ->expects($this->once())
            ->method('validateCpf')
            ->willReturn(true);
        
        $this->cpfMock
            ->expects($this->once())
            ->method('getCpf')
            ->willReturn([
                'original' => '44740852055',
                'formatted' => '447.408.520-55'
            ]);

        $response = $this->instance->validateCpf($request);

        $this->assertEquals($expected,$response);
    }

    /**
     * Test validateCpf method when CPF is invalid
     *
     * @return void
     */
    public function testValidateCpfWhenCpfIsInvalid(): void
    {
        $expected = json_encode([ 
            'isValid' => false, 
            'message' => 'Este CPF é inválido', 
            'cpf' => [
                'original' => '44740852050',
                'formatted' => '447.408.520-50'
            ]
        ]);

        $request = [
            'cpf' => '44740852050'
        ];

        $this->cpfMock
            ->expects($this->once())
            ->method('setUnformattedCpf')
            ->with($request['cpf']);
        
        $this->cpfMock
            ->expects($this->once())
            ->method('validateCpf')
            ->willReturn(false);

        $this->cpfMock
            ->expects($this->once())
            ->method('getCpf')
            ->willReturn([
                'original' => '44740852050',
                'formatted' => '447.408.520-50'
            ]);

        $response = $this->instance->validateCpf($request);

        $this->assertEquals($expected,$response);
    }
}