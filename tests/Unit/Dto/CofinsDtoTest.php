<?php

namespace Lucasnpinheiro\NotasFiscaisExtract\Tests\Unit\Dto;

use Lucasnpinheiro\NotasFiscaisExtract\Dto\CofinsDto;
use PHPUnit\Framework\TestCase;

class CofinsDtoTest extends TestCase
{
    public function testCanCreateInstance()
    {
        $data = [
            "COFINSALIQ" => [
                "VBC" => "10.00",
                "PCOFINS" => "10.00",
                "VCOFINS" => "10.00",
                "CST" => "01"
            ]
        ];

        $cofinsDto = new CofinsDto($data);

        $this->assertInstanceOf(CofinsDto::class, $cofinsDto);
    }

    public function testToArray()
    {
        $data = [
            "COFINSALIQ" => [
                "VBC" => "10.00",
                "PCOFINS" => "10.00",
                "VCOFINS" => "10.00",
                "CST" => "01"
            ]
        ];

        $cofinsDto = new CofinsDto($data);

        $expected = [
            "calculation_base" => 10.00,
            "percentage" => 10.00,
            "value" => 10.00,
            "cst" => "01"
        ];

        $this->assertEquals($expected, $cofinsDto->toArray());
    }

    public function testCalculationBase()
    {
        $data = [
            "COFINSALIQ" => [
                "VBC" => "10.00",
                "PCOFINS" => "10.00",
                "VCOFINS" => "10.00",
                "CST" => "01"
            ]
        ];

        $cofinsDto = new CofinsDto($data);

        $this->assertEquals(10.00, $cofinsDto->calculationBase());
    }

    public function testPercentage()
    {
        $data = [
            "COFINSALIQ" => [
                "VBC" => "10.00",
                "PCOFINS" => "10.00",
                "VCOFINS" => "10.00",
                "CST" => "01"
            ]
        ];

        $cofinsDto = new CofinsDto($data);

        $this->assertEquals(10.00, $cofinsDto->percentage());
    }

    public function testValue()
    {
        $data = [
            "COFINSALIQ" => [
                "VBC" => "10.00",
                "PCOFINS" => "10.00",
                "VCOFINS" => "10.00",
                "CST" => "01"
            ]
        ];

        $cofinsDto = new CofinsDto($data);

        $this->assertEquals(10.00, $cofinsDto->value());
    }

    public function testCst()
    {
        $data = [
            "COFINSALIQ" => [
                "VBC" => "10.00",
                "PCOFINS" => "10.00",
                "VCOFINS" => "10.00",
                "CST" => "01"
            ]
        ];

        $cofinsDto = new CofinsDto($data);

        $this->assertEquals("01", $cofinsDto->cst());
    }
}