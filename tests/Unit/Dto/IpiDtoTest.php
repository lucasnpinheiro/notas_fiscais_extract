<?php

namespace Lucasnpinheiro\NotasFiscaisExtract\Tests\Unit\Dto;

use Lucasnpinheiro\NotasFiscaisExtract\Dto\IpiDto;
use PHPUnit\Framework\TestCase;

class IpiDtoTest extends TestCase
{
    public function testToArray()
    {
        $data = [
            'IPITRIB' => [
                'VBC' => '10.00',
                'VIPI' => '5.00',
                'PIPI' => '2.00',
            ],
            'CST' => '123',
        ];

        $ipidto = new IpiDto($data);

        $expected = [
            'calculation_base' => 10.00,
            'percentage' => 5.00,
            'value' => 2.00,
            'cst' => '123',
        ];

        $this->assertEquals($expected, $ipidto->toArray());
    }

    public function testCalculationBase()
    {
        $data = [
            'IPITRIB' => [
                'VBC' => '10.00',
                'VIPI' => '5.00',
                'PIPI' => '2.00',
            ],
            'CST' => '123',
        ];

        $ipidto = new IpiDto($data);

        $this->assertEquals(10.00, $ipidto->calculationBase());
    }

    public function testPercentage()
    {
        $data = [
            'IPITRIB' => [
                'VBC' => '10.00',
                'VIPI' => '5.00',
                'PIPI' => '2.00',
            ],
            'CST' => '123',
        ];

        $ipidto = new IpiDto($data);

        $this->assertEquals(5.00, $ipidto->percentage());
    }

    public function testValue()
    {
        $data = [
            'IPITRIB' => [
                'VBC' => '10.00',
                'VIPI' => '5.00',
                'PIPI' => '2.00',
            ],
            'CST' => '123',
        ];

        $ipidto = new IpiDto($data);

        $this->assertEquals(2.00, $ipidto->value());
    }

    public function testCst()
    {
        $data = [
            'IPITRIB' => [
                'VBC' => '10.00',
                'VIPI' => '5.00',
                'PIPI' => '2.00',
            ],
            'CST' => '123',
        ];

        $ipidto = new IpiDto($data);

        $this->assertEquals('123', $ipidto->cst());
    }
}