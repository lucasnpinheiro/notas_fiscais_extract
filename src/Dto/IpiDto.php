<?php

namespace Lucasnpinheiro\NotasFiscaisExtract\Dto;

class IpiDto extends Dto
{
    private ?float $calculationBase;
    private ?float $percentage;
    private ?float $value;
    private ?string $cst;

    public function __construct(array $data = [])
    {
        if (isset($data['IPITRIB'])) {
            $this->calculationBase = $this->replaceMoney($data['IPITRIB']['VBC']);
            $this->percentage = $this->replaceMoney($data['IPITRIB']['VIPI']);
            $this->value = $this->replaceMoney($data['IPITRIB']['PIPI']);
        }

        if (isset($data['CST'])) {
            $this->cst = $data['CST'];
        }
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