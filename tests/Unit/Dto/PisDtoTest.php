<?php

namespace Lucasnpinheiro\NotasFiscaisExtract\Tests\Unit\Dto;

use Lucasnpinheiro\NotasFiscaisExtract\Dto\PisDto;
use PHPUnit\Framework\TestCase;

class PisDtoTest extends TestCase
{
    public function testToArray()
    {
        $data = [
            "PISALIQ" => [
                "VBC" => '10.00',
                "PPIS" => '5.00',
                "VPIS" => '2.00',
                "CST" => '123',
            ],
        ];

        $pisDto = new PisDto($data);

        $expected = [
            'calculation_base' => 10.00,
            'percentage' => 5.00,
            'value' => 2.00,
            'cst' => '123',
        ];

        $this->assertEquals($expected, $pisDto->toArray());
    }

    public function testCalculationBase()
    {
        $data = [
            "PISALIQ" => [
                "VBC" => '10.00',
                "PPIS" => '5.00',
                "VPIS" => '2.00',
                "CST" => '123',
            ],
        ];

        $pisDto = new PisDto($data);

        $this->assertEquals(10.00, $pisDto->calculationBase());
    }

    public function testPercentage()
    {
        $data = [
            "PISALIQ" => [
                "VBC" => '10.00',
                "PPIS" => '5.00',
                "VPIS" => '2.00',
                "CST" => '123',
            ],
        ];

        $pisDto = new PisDto($data);

        $this->assertEquals(5.00, $pisDto->percentage());
    }

    public function testValue()
    {
        $data = [
            "PISALIQ" => [
                "VBC" => '10.00',
                "PPIS" => '5.00',
                "VPIS" => '2.00',
                "CST" => '123',
            ],
        ];

        $pisDto = new PisDto($data);

        $this->assertEquals(2.00, $pisDto->value());
    }

    public function testCst()
    {
        $data = [
            "PISALIQ" => [
                "VBC" => '10.00',
                "PPIS" => '5.00',
                "VPIS" => '2.00',
                "CST" => '123',
            ],
        ];

        $pisDto = new PisDto($data);

        $this->assertEquals('123', $pisDto->cst());
    }
}