<?php

namespace Lucasnpinheiro\NotasFiscaisExtract\Dto;

class CofinsDto extends Dto
{
    private ?string $cst;
    private ?float $calculationBase;
    private ?float $percentage;
    private ?float $value;

    public function __construct(array $data)
    {
        $this->calculationBase = $this->replaceMoney($data["COFINSALIQ"]["VBC"]);
        $this->percentage = $this->replaceMoney($data["COFINSALIQ"]["PCOFINS"]);
        $this->value = $this->replaceMoney($data["COFINSALIQ"]["VCOFINS"]);
        $this->cst = $data["COFINSALIQ"]["CST"];
    }

    public function toArray(): array
    {
        return [
            "calculation_base" => $this->calculationBase(),
            "percentage" => $this->percentage(),
            "value" => $this->value(),
            "cst" => $this->cst(),
        ];
    }

    public function calculationBase(): ?float
    {
        return $this->calculationBase;
    }

    public function percentage(): ?float
    {
        return $this->percentage;
    }

    public function value(): ?float
    {
        return $this->value;
    }

    public function cst(): ?string
    {
        return $this->cst;
    }
}
