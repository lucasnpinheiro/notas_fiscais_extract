<?php

use Lucasnpinheiro\NotasFiscaisExtract\NotaFiscal;

require_once '../vendor/autoload.php';

$file = '../files/nfe.xml';

$notaFiscal = NotaFiscal::loadFromFile($file);

$notaFiscal->products();