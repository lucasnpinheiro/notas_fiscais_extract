<?php

use Lucasnpinheiro\NotasFiscaisExtract\Dto\CofinsDto;
use Lucasnpinheiro\NotasFiscaisExtract\Dto\IcmsDto;
use Lucasnpinheiro\NotasFiscaisExtract\Dto\IpiDto;
use Lucasnpinheiro\NotasFiscaisExtract\Dto\PisDto;
use Lucasnpinheiro\NotasFiscaisExtract\Dto\ProductDto;
use Lucasnpinheiro\NotasFiscaisExtract\Products;
use PHPUnit\Framework\TestCase;

class ProductsTest extends TestCase
{
    private array $data;

    public function testExtractMethod()
    {
        $products = Products::extract($this->data);

        $this->assertInstanceOf(Products::class, $products);
        $this->assertInstanceOf(ProductDto::class, $products->product());
        $this->assertInstanceOf(IcmsDto::class, $products->icms());
        $this->assertInstanceOf(IpiDto::class, $products->ipi());
        $this->assertInstanceOf(PisDto::class, $products->pis());
        $this->assertInstanceOf(CofinsDto::class, $products->cofins());
    }

    public function testToArrayMethod()
    {
        $products = Products::extract($this->data);

        $expectedArray = [
            'product' => [
                'code' => '12345',
                'ean' => '7891234567890',
                'name' => 'Produto Teste',
                'ncm' => '12345678',
                'cfop' => '5102',
                'commercial_unit' => 'UN',
                'commercial_quantity' => 10.00,
                'unit_price' => 5.00,
                'product_value' => 50.00,
                'taxed_ean' => '7891234567890',
                'taxed_unit' => 'UN',
                'taxed_quantity' => 10.00,
                'taxed_unit_price' => 5.00,
                'composes_total_invoice' => null,
                'sequence' => '1',
                'information' => 'Informações adicionais',
            ],
            'icms' => [
                'origin' => '0',
                'cst' => '00',
                'calculation_base_mode' => '3.0',
                'calculation_base_reduction_percent' => '0.0',
                'calculation_base_value' => '50.00',
                'icms_percent' => '18.00',
                'icms_value' => '9.00',
            ],
            'ipi' => [
                'cst' => '01',
                'calculation_base' => '50.00',
                'value' => '5.00',
                'percentage' => '2.50',
            ],
            'pis' => [
                'cst' => '01',
                'calculation_base' => '50.00',
                'percentage' => '1.65',
                'value' => '0.83',
            ],
            'cofins' => [
                'cst' => '01',
                'calculation_base' => '50.00',
                'percentage' => '7.60',
                'value' => '3.80',
            ],
        ];

        $this->assertEquals($expectedArray, $products->toArray());
    }

    protected function setUp(): void
    {
        $this->data = [
            'PROD' => [
                'CPROD' => '12345',
                'CEAN' => '7891234567890',
                'XPROD' => 'Produto Teste',
                'NCM' => '12345678',
                'CFOP' => '5102',
                'UCOM' => 'UN',
                'QCOM' => '10.00',
                'VUNCOM' => '5.00',
                'VPROD' => '50.00',
                'CEANTRIB' => '7891234567890',
                'UTRIB' => 'UN',
                'QTRIB' => '10.00',
                'VUNTRIB' => '5.00',
            ],
            '@ATTRIBUTES' => [
                'NITEM' => '1',
            ],
            'INFADPROD' => 'Informações adicionais',
            'IMPOSTO' => [
                'ICMS' => [
                    [
                        'ORIG' => '0',
                        'CST' => '00',
                        'MODBC' => '3',
                        'VBC' => '50.00',
                        'PICMS' => '18.00',
                        'VICMS' => '9.00',
                    ]
                ],
                'IPI' => [
                    'IPITRIB' => [
                        'VBC' => '50.00',
                        'PIPI' => '5.00',
                        'VIPI' => '2.50',
                    ],
                    'CST' => '01',
                ],
                'PIS' => [
                    'PISALIQ' => [
                        'CST' => '01',
                        'VBC' => '50.00',
                        'PPIS' => '1.65',
                        'VPIS' => '0.83',
                    ],
                ],
                'COFINS' => [
                    'COFINSALIQ' => [
                        'CST' => '01',
                        'VBC' => '50.00',
                        'PCOFINS' => '7.60',
                        'VCOFINS' => '3.80',
                    ],
                ],
            ],
        ];
    }
}
