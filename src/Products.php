<?php

namespace Lucasnpinheiro\NotasFiscaisExtract;

use Lucasnpinheiro\NotasFiscaisExtract\Dto\CofinsDto;
use Lucasnpinheiro\NotasFiscaisExtract\Dto\IcmsDto;
use Lucasnpinheiro\NotasFiscaisExtract\Dto\IpiDto;
use Lucasnpinheiro\NotasFiscaisExtract\Dto\PisDto;
use Lucasnpinheiro\NotasFiscaisExtract\Dto\ProductDto;

class Products
{
    private ProductDto $product;
    private IcmsDto $icms;
    private PisDto $pis;
    private IpiDto $ipi;
    private CofinsDto $cofins;

    private function __construct(array $item = [])
    {
        $this->product = ProductDto::extract(
            array_merge(
                $item['PROD'],
                $item['@ATTRIBUTES'],
                [
                    'INFADPROD' => $item['INFADPROD']
                ]
            )
        );

        $this->icms = IcmsDto::extract($item['IMPOSTO']['ICMS']);
        $this->ipi = IpiDto::extract($item['IMPOSTO']['IPI']);
        $this->pis = PisDto::extract($item['IMPOSTO']['PIS']);
        $this->cofins = CofinsDto::extract($item['IMPOSTO']['COFINS']);
    }

    public static function extract(array $data = []): self
    {
        return new self($data);
    }

    public function toArray(): array
    {
        return [
            'product' => $this->product()->toArray(),
            'icms' => $this->icms()->toArray(),
            'ipi' => $this->ipi()->toArray(),
            'pis' => $this->pis()->toArray(),
            'cofins' => $this->cofins()->toArray(),
        ];
    }

    public function product(): ProductDto
    {
        return $this->product;
    }

    public function icms(): IcmsDto
    {
        return $this->icms;
    }

    public function ipi(): IpiDto
    {
        return $this->ipi;
    }

    public function pis(): PisDto
    {
        return $this->pis;
    }

    public function cofins(): CofinsDto
    {
        return $this->cofins;
    }

}