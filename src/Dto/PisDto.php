<?php

namespace Lucasnpinheiro\NotasFiscaisExtract\Dto;

class PisDto extends Dto
{
    private ?string $cst;
    private ?float $calculationBase;
    private ?float $percentage;
    private ?float $value;

    public function __construct(array $data)
    {
        $this->calculationBase = $this->replaceMoney($data["PISALIQ"]["VBC"]);
        $this->percentage = $this->replaceMoney($data["PISALIQ"]["PPIS"]);
        $this->value = $this->replaceMoney($data["PISALIQ"]["VPIS"]);
        $this->cst = $data["PISALIQ"]["CST"];
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
