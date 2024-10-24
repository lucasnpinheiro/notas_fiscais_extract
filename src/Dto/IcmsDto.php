<?php

namespace Lucasnpinheiro\NotasFiscaisExtract\Dto;

class IcmsDto extends Dto
{
    private ?string $origin;
    private ?string $cst;
    private ?float $calculationBaseMode;
    private ?float $calculationBaseReductionPercent;
    private ?float $calculationBaseValue;
    private ?float $icmsPercent;
    private ?float $icmsValue;

    public function __construct(array $data)
    {
        foreach ($data as $icms) {
            $this->origin = $this->getValue($icms, 'ORIG');
            $this->cst = $this->getValue($icms, "CST");
            $this->calculationBaseMode = $this->replaceMoney($this->getValue($icms, "MODBC"));
            $this->calculationBaseReductionPercent = $this->replaceMoney($this->getValue($icms, "PREDBC"));
            $this->calculationBaseValue = $this->replaceMoney($this->getValue($icms, "VBC"));
            $this->icmsPercent = $this->replaceMoney($this->getValue($icms, "PICMS"));
            $this->icmsValue = $this->replaceMoney($this->getValue($icms, "VICMS"));
        }
    }

    public function toArray(): array
    {
        return [
            "origin" => $this->origin(),
            "cst" => $this->cst(),
            "calculation_base_mode" => $this->calculationBaseMode(),
            "calculation_base_reduction_percent" => $this->calculationBaseReductionPercent(),
            "calculation_base_value" => $this->calculationBaseValue(),
            "icms_percent" => $this->icmsPercent(),
            "icms_value" => $this->icmsValue(),
        ];
    }

    public function origin(): ?string
    {
        return $this->origin;
    }

    public function cst(): ?string
    {
        return $this->cst;
    }

    public function calculationBaseMode(): ?float
    {
        return $this->calculationBaseMode;
    }

    public function calculationBaseReductionPercent(): ?float
    {
        return $this->calculationBaseReductionPercent;
    }

    public function calculationBaseValue(): ?float
    {
        return $this->calculationBaseValue;
    }

    public function icmsPercent(): ?float
    {
        return $this->icmsPercent;
    }

    public function icmsValue(): ?float
    {
        return $this->icmsValue;
    }
}