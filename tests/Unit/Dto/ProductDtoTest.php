<?php

use Lucasnpinheiro\NotasFiscaisExtract\Dto\ProductDto;
use PHPUnit\Framework\TestCase;

class ProductDtoTest extends TestCase
{
    private array $data;

    public function testProductDtoConstructor()
    {
        $productDto = new ProductDto($this->data);

        $this->assertEquals("12345", $productDto->code());
        $this->assertEquals("7891234567890", $productDto->ean());
        $this->assertEquals("Produto Teste", $productDto->name());
        $this->assertEquals("12345678", $productDto->ncm());
        $this->assertEquals("5102", $productDto->cfop());
        $this->assertEquals("UN", $productDto->commercialUnit());
        $this->assertEquals(10.00, $productDto->commercialQuantity());
        $this->assertEquals(5.00, $productDto->unitPrice());
        $this->assertEquals(50.00, $productDto->productValue());
        $this->assertEquals("7891234567890", $productDto->taxedEan());
        $this->assertEquals("UN", $productDto->taxedUnit());
        $this->assertEquals(10.00, $productDto->taxedQuantity());
        $this->assertEquals(5.00, $productDto->taxedUnitPrice());
        $this->assertEquals("1", $productDto->composesTotalInvoice());
        $this->assertEquals("1", $productDto->sequence());
        $this->assertEquals("Informações adicionais", $productDto->information());
    }

    public function testToArrayMethod()
    {
        $productDto = new ProductDto($this->data);

        $expectedArray = [
            "code" => "12345",
            "ean" => "7891234567890",
            "name" => "Produto Teste",
            "ncm" => "12345678",
            "cfop" => "5102",
            "commercial_unit" => "UN",
            "commercial_quantity" => 10.00,
            "unit_price" => 5.00,
            "product_value" => 50.00,
            "taxed_ean" => "7891234567890",
            "taxed_unit" => "UN",
            "taxed_quantity" => 10.00,
            "taxed_unit_price" => 5.00,
            "composes_total_invoice" => "1",
            "sequence" => "1",
            "information" => "Informações adicionais",
        ];

        $this->assertEquals($expectedArray, $productDto->toArray());
        $this->assertEquals((object)$expectedArray, $productDto->toObject());
    }

    public function testArrayMonetaryValueWithComma()
    {
        $data = [
            "CPROD" => "12345",
            "CEAN" => "7891234567890",
            "XPROD" => "Produto Teste",
            "NCM" => "12345678",
            "CFOP" => "5102",
            "UCOM" => "UN",
            "QCOM" => "10,00",
            "VUNCOM" => "5,00",
            "VPROD" => "50,00",
            "CEANTRIB" => "7891234567890",
            "UTRIB" => "UN",
            "QTRIB" => "10,00",
            "VUNTRIB" => "5,00",
            "INDTOT" => "1",
            "NITEM" => "1",
            "INFADPROD" => "Informações adicionais"
        ];

        $productDto = new ProductDto($data);

        $this->assertEquals("12345", $productDto->code());
        $this->assertEquals("7891234567890", $productDto->ean());
        $this->assertEquals("Produto Teste", $productDto->name());
        $this->assertEquals("12345678", $productDto->ncm());
        $this->assertEquals("5102", $productDto->cfop());
        $this->assertEquals("UN", $productDto->commercialUnit());
        $this->assertEquals(10.00, $productDto->commercialQuantity());
        $this->assertEquals(5.00, $productDto->unitPrice());
        $this->assertEquals(50.00, $productDto->productValue());
        $this->assertEquals("7891234567890", $productDto->taxedEan());
        $this->assertEquals("UN", $productDto->taxedUnit());
        $this->assertEquals(10.00, $productDto->taxedQuantity());
        $this->assertEquals(5.00, $productDto->taxedUnitPrice());
        $this->assertEquals("1", $productDto->composesTotalInvoice());
        $this->assertEquals("1", $productDto->sequence());
        $this->assertEquals("Informações adicionais", $productDto->information());
    }

    protected function setUp(): void
    {
        $this->data = [
            "CPROD" => "12345",
            "CEAN" => "7891234567890",
            "XPROD" => "Produto Teste",
            "NCM" => "12345678",
            "CFOP" => "5102",
            "UCOM" => "UN",
            "QCOM" => "10.00",
            "VUNCOM" => "5.00",
            "VPROD" => "50.00",
            "CEANTRIB" => "7891234567890",
            "UTRIB" => "UN",
            "QTRIB" => "10.00",
            "VUNTRIB" => "5.00",
            "INDTOT" => "1",
            "NITEM" => "1",
            "INFADPROD" => "Informações adicionais"
        ];
    }
}
