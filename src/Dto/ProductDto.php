<?php

namespace Lucasnpinheiro\NotasFiscaisExtract\Dto;

class ProductDto extends Dto
{
    private ?string $code;
    private ?string $ean;
    private ?string $name;
    private ?string $ncm;
    private ?string $cfop;
    private ?string $commercialUnit;
    private ?float $commercialQuantity;
    private ?float $unitPrice;
    private ?float $productValue;
    private ?string $taxedEan;
    private ?string $taxedUnit;
    private ?float $taxedQuantity;
    private ?float $taxedUnitPrice;
    private ?string $composesTotalInvoice;
    private ?string $sequence;
    private ?string $information;

    public function __construct(array $data)
    {
        $this->code = $data["CPROD"];
        $this->ean = $data["CEAN"];
        $this->name = $data["XPROD"];
        $this->ncm = $data["NCM"];
        $this->cfop = $data["CFOP"];
        $this->commercialUnit = $data["UCOM"];
        $this->commercialQuantity = $this->replaceMoney($data["QCOM"]);
        $this->unitPrice = $this->replaceMoney($data["VUNCOM"]);
        $this->productValue = $this->replaceMoney($data["VPROD"]);
        $this->taxedEan = $data["CEANTRIB"];
        $this->taxedUnit = $data["UTRIB"];
        $this->taxedQuantity = $this->replaceMoney($data["QTRIB"]);
        $this->taxedUnitPrice = $this->replaceMoney($data["VUNTRIB"]);
        $this->composesTotalInvoice = $data["INDTOT"];
        $this->sequence = $data["NITEM"];
        $this->information = $data["INFADPROD"];
    }

    public function toArray(): array
    {
        return [
            "code" => $this->code(),
            "ean" => $this->ean(),
            "name" => $this->name(),
            "ncm" => $this->ncm(),
            "cfop" => $this->cfop(),
            "commercial_unit" => $this->commercialUnit(),
            "commercial_quantity" => $this->commercialQuantity(),
            "unit_price" => $this->unitPrice(),
            "product_value" => $this->productValue(),
            "taxed_ean" => $this->taxedEan(),
            "taxed_unit" => $this->taxedUnit(),
            "taxed_quantity" => $this->taxedQuantity(),
            "taxed_unit_price" => $this->taxedUnitPrice(),
            "composes_total_invoice" => $this->composesTotalInvoice(),
            "sequence" => $this->sequence(),
            "information" => $this->information(),
        ];
    }

    public function code(): ?string
    {
        return $this->code;
    }

    public function ean(): ?string
    {
        return $this->ean;
    }

    public function name(): ?string
    {
        return $this->name;
    }

    public function ncm(): ?string
    {
        return $this->ncm;
    }

    public function cfop(): ?string
    {
        return $this->cfop;
    }

    public function commercialUnit(): ?string
    {
        return $this->commercialUnit;
    }

    public function commercialQuantity(): ?float
    {
        return $this->commercialQuantity;
    }

    public function unitPrice(): ?float
    {
        return $this->unitPrice;
    }

    public function productValue(): ?float
    {
        return $this->productValue;
    }

    public function taxedEan(): ?string
    {
        return $this->taxedEan;
    }

    public function taxedUnit(): ?string
    {
        return $this->taxedUnit;
    }

    public function taxedQuantity(): ?float
    {
        return $this->taxedQuantity;
    }

    public function taxedUnitPrice(): ?float
    {
        return $this->taxedUnitPrice;
    }

    public function composesTotalInvoice(): ?string
    {
        return $this->composesTotalInvoice;
    }

    public function sequence(): ?string
    {
        return $this->sequence;
    }

    public function information(): ?string
    {
        return $this->information;
    }

}
