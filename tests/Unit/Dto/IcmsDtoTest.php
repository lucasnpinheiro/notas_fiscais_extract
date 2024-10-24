<?php

namespace Lucasnpinheiro\NotasFiscaisExtract\Tests\Unit\Dto;

use Lucasnpinheiro\NotasFiscaisExtract\Dto\IcmsDto;
use PHPUnit\Framework\TestCase;

class IcmsDtoTest extends TestCase
{
    public function testConstruct(): void
    {
        $data = [
            [
                'ORIG' => '1',
                'CST' => '1',
                'MODBC' => '100.00',
                'PREDBC' => '10.00',
                'VBC' => '100.00',
                'PICMS' => '10.00',
                'VICMS' => '10.00',
            ],
        ];

        $icmsDto = new IcmsDto($data);

        $this->assertEquals('1', $icmsDto->origin());
        $this->assertEquals('1', $icmsDto->cst());
        $this->assertEquals(100.00, $icmsDto->calculationBaseMode());
        $this->assertEquals(10.00, $icmsDto->calculationBaseReductionPercent());
        $this->assertEquals(100.00, $icmsDto->calculationBaseValue());
        $this->assertEquals(10.00, $icmsDto->icmsPercent());
        $this->assertEquals(10.00, $icmsDto->icmsValue());
    }

    public function testToArray(): void
    {
        $data = [
            [
                'ORIG' => '1',
                'CST' => '1',
                'MODBC' => '100.00',
                'PREDBC' => '10.00',
                'VBC' => '100.00',
                'PICMS' => '10.00',
                'VICMS' => '10.00',
            ],
        ];

        $icmsDto = new IcmsDto($data);

        $expectedArray = [
            "origin" => '1',
            "cst" => '1',
            "calculation_base_mode" => 100.00,
            "calculation_base_reduction_percent" => 10.00,
            "calculation_base_value" => 100.00,
            "icms_percent" => 10.00,
            "icms_value" => 10.00,
        ];

        $this->assertEquals($expectedArray, $icmsDto->toArray());
    }

    public function testOrigin(): void
    {
        $data = [
            [
                'ORIG' => '1',
            ],
        ];

        $icmsDto = new IcmsDto($data);

        $this->assertEquals('1', $icmsDto->origin());
    }

    public function testCst(): void
    {
        $data = [
            [
                'CST' => '1',
            ],
        ];

        $icmsDto = new IcmsDto($data);

        $this->assertEquals('1', $icmsDto->cst());
    }

    public function testCalculationBaseMode(): void
    {
        $data = [
            [
                'MODBC' => '100.00',
            ],
        ];

        $icmsDto = new IcmsDto($data);

        $this->assertEquals(100.00, $icmsDto->calculationBaseMode());
    }

    public function testCalculationBaseReductionPercent(): void
    {
        $data = [
            [
                'PREDBC' => '10.00',
            ],
        ];

        $icmsDto = new IcmsDto($data);

        $this->assertEquals(10.00, $icmsDto->calculationBaseReductionPercent());
    }

    public function testCalculationBaseValue(): void
    {
        $data = [
            [
                'VBC' => '100.00',
            ],
        ];

        $icmsDto = new IcmsDto($data);

        $this->assertEquals(100.00, $icmsDto->calculationBaseValue());
    }

    public function testIcmsPercent(): void
    {
        $data = [
            [
                'PICMS' => '10.00',
            ],
        ];

        $icmsDto = new IcmsDto($data);

        $this->assertEquals(10.00, $icmsDto->icmsPercent());
    }

    public function testIcmsValue(): void
    {
        $data = [
            [
                'VICMS' => '10.00',
            ],
        ];

        $icmsDto = new IcmsDto($data);

        $this->assertEquals(10.00, $icmsDto->icmsValue());
    }
}