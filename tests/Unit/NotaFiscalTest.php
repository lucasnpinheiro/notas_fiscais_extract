<?php

namespace Lucasnpinheiro\NotasFiscaisExtract\Tests\Unit;

use InvalidArgumentException;
use Lucasnpinheiro\NotasFiscaisExtract\NotaFiscal;
use PHPUnit\Framework\TestCase;

class NotaFiscalTest extends TestCase
{
    public function testConstruct(): void
    {
        $xmlContent = '<notaFiscal></notaFiscal>';
        $notaFiscal = NotaFiscal::loadXml($xmlContent);
        $this->assertInstanceOf(NotaFiscal::class, $notaFiscal);
    }

    public function testLoadFromFileNotExists(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $filePath = 'path/to/file.xml';
        NotaFiscal::loadFromFile($filePath);
    }

    public function testLoadXml(): void
    {
        $xmlContent = '<notaFiscal></notaFiscal>';
        $notaFiscal = NotaFiscal::loadXml($xmlContent);
        $this->assertInstanceOf(NotaFiscal::class, $notaFiscal);
    }

    public function testLoadXmlContent(): void
    {
        $xmlContent = '<notaFiscal></notaFiscal>';
        $notaFiscal = NotaFiscal::loadXml($xmlContent);
        $this->assertIsString($notaFiscal->xmlContent());
    }

    public function testCleanXmlContent(): void
    {
        $xmlContent = "ï»¿<notaFiscal>\n</notaFiscal>";
        $notaFiscal = NotaFiscal::loadXml($xmlContent);
        $this->assertStringNotContainsString('ï', $notaFiscal->xmlContent());
        $this->assertStringNotContainsString('»', $notaFiscal->xmlContent());
        $this->assertStringNotContainsString('¿', $notaFiscal->xmlContent());
    }

    public function testRemoveTags(): void
    {
        $content = '<notaFiscal><infCpl>info</infCpl></notaFiscal>';
        $notaFiscal = NotaFiscal::loadXml($content);
        $this->assertStringNotContainsString('<infCpl>', $notaFiscal->xmlContent());
    }

    public function testRemoveTagsSubLevel(): void
    {
        $content = '<?xml version="1.0" encoding="UTF-8"?>
<NFe xmlns="http://www.portalfiscal.inf.br/nfe">
    <infNFe Id="NFe35241004216200000137550010000081611184126414" versao="4.00">
        <ide>
            <cUF>35</cUF>
            <cNF>18412641</cNF>
            <natOp>DEVOLUCAO</natOp>
            <mod>55</mod>
            <serie>1</serie>
            <nNF>8161</nNF>
            <dhEmi>2024-10-07T00:00:00-03:00</dhEmi>
            <dhSaiEnt>2024-10-07T00:00:00-03:00</dhSaiEnt>
            <tpNF>1</tpNF>
            <idDest>2</idDest>
            <cMunFG>3543402</cMunFG>
            <tpImp>1</tpImp>
            <tpEmis>1</tpEmis>
            <cDV>4</cDV>
            <tpAmb>1</tpAmb>
            <finNFe>4</finNFe>
            <indFinal>1</indFinal>
            <indPres>9</indPres>
            <indIntermed>0</indIntermed>
            <procEmi>0</procEmi>
            <verProc>Agência Voxel</verProc>
            <NFref>
                <refNFe>43240991501569000196550010001404901068691915</refNFe>
            </NFref>
        </ide>
        <emit>
            <CNPJ>00000000000000</CNPJ>
            <xNome>EMPRESA IND. E COM. LTDA</xNome>
            <xFant>EMPRESA COMERCIAL</xFant>
            <enderEmit>
                <xLgr>AV. EDUARDO ANDREA MATARAZZO</xLgr>
                <nro>12</nro>
                <xBairro>CHACARA PEDRO C.CARVALHO</xBairro>
                <cMun>3543402</cMun>
                <xMun>RIBEIRAO</xMun>
                <UF>SP</UF>
                <CEP>14075820</CEP>
                <cPais>1058</cPais>
                <xPais>BRASIL</xPais>
                <fone>0000000000</fone>
            </enderEmit>
            <IE>582594641118</IE>
            <CRT>3</CRT>
        </emit>
        <dest>
            <CNPJ>00000000000000</CNPJ>
            <xNome>EMPRESA IND. E COM. LTDA</xNome>
            <enderDest>
                <xLgr>RUA EXEMPLO</xLgr>
                <nro>12</nro>
                <xBairro>SÃO</xBairro>
                <cMun>4305108</cMun>
                <xMun>CAXIAS DO SUL</xMun>
                <UF>RS</UF>
                <CEP>95043670</CEP>
                <cPais>1058</cPais>
                <xPais>BRASIL</xPais>
            </enderDest>
            <indIEDest>1</indIEDest>
            <IE>000000000000</IE>
        </dest>
        <det nItem="1">
            <prod>
                <cProd>81070015</cProd>
                <cEAN>SEM GTIN</cEAN>
                <xProd>81070015 - S.C.W.350X72Z D3,0 C4,5 AT.15 E/D F30</xProd>
                <NCM>82023100</NCM>
                <CEST>2899900</CEST>
                <indEscala>S</indEscala>
                <CFOP>6556</CFOP>
                <uCom>PC</uCom>
                <qCom>2.0000</qCom>
                <vUnCom>748.0000000000</vUnCom>
                <vProd>1496.00</vProd>
                <cEANTrib>SEM GTIN</cEANTrib>
                <uTrib>PC</uTrib>
                <qTrib>2.0000</qTrib>
                <vUnTrib>748.0000000000</vUnTrib>
                <indTot>1</indTot>
            </prod>
            <imposto>
                <vTotTrib>0.00</vTotTrib>
                <ICMS>
                    <ICMS60>
                        <orig>0</orig>
                        <CST>60</CST>
                    </ICMS60>
                </ICMS>
                <IPI>
                    <cEnq>999</cEnq>
                    <IPITrib>
                        <CST>99</CST>
                        <vBC>1496.00</vBC>
                        <pIPI>5.2000</pIPI>
                        <vIPI>77.79</vIPI>
                    </IPITrib>
                </IPI>
                <PIS>
                    <PISNT>
                        <CST>08</CST>
                    </PISNT>
                </PIS>
                <COFINS>
                    <COFINSNT>
                        <CST>08</CST>
                    </COFINSNT>
                </COFINS>
            </imposto>
        </det>
        <total>
            <ICMSTot>
                <vBC>1496.00</vBC>
                <vICMS>179.52</vICMS>
                <vICMSDeson>0.00</vICMSDeson>
                <vFCP>0.00</vFCP>
                <vBCST>0.00</vBCST>
                <vST>0.00</vST>
                <vFCPST>0.00</vFCPST>
                <vFCPSTRet>0.00</vFCPSTRet>
                <vProd>1496.00</vProd>
                <vFrete>0.00</vFrete>
                <vSeg>0.00</vSeg>
                <vDesc>0.00</vDesc>
                <vII>0.00</vII>
                <vIPI>77.79</vIPI>
                <vIPIDevol>0.00</vIPIDevol>
                <vPIS>0.00</vPIS>
                <vCOFINS>0.00</vCOFINS>
                <vOutro>0.00</vOutro>
                <vNF>1573.79</vNF>
            </ICMSTot>
        </total>
        <transp>
            <modFrete>1</modFrete>
            <transporta>
                <CNPJ>00000000000000</CNPJ>
                <xNome>RODONAVES TRANSPORTES</xNome>
                <xEnder>RUA EXEMPLO</xEnder>
                <xMun>PORTO ALEGRE</xMun>
                <UF>RS</UF>
            </transporta>
            <vol>
                <qVol>2</qVol>
                <esp>VOLUME(S)</esp>
                <nVol>2</nVol>
                <pesoL>3.360</pesoL>
                <pesoB>3.360</pesoB>
            </vol>
        </transp>
        <pag>
            <detPag>
                <tPag>90</tPag>
                <vPag>0.00</vPag>
            </detPag>
        </pag>
        <infAdic>
            <infCpl>DEVOLUÇÃO REFERENTE A NF 140490</infCpl>
        </infAdic>
        <infRespTec>
            <CNPJ>00000000000000</CNPJ>
            <xContato>TESTE CONTATO</xContato>
            <email>teste@exemplo.com</email>
            <fone>0000000000</fone>
        </infRespTec>
    </infNFe>
</NFe>';
        $notaFiscal = NotaFiscal::loadXml($content);
        $this->assertStringNotContainsString('<infCpl>', $notaFiscal->xmlContent());
    }

    public function testConvertDataKeysToUppercase(): void
    {
        $xmlContent = '<notaFiscal><key>value</key></notaFiscal>';
        $notaFiscal = NotaFiscal::loadXml($xmlContent);
        $this->assertArrayHasKey('KEY', $notaFiscal->parsedData());
    }

    public function testProducts(): void
    {
        $xmlContent = '<notaFiscal><INFNFE><DET>content</DET></INFNFE></notaFiscal>';
        $notaFiscal = new NotaFiscal($xmlContent);
        $products = $notaFiscal->products();
        $this->assertIsArray($products);
    }

    public function testProductsInXml(): void
    {
        $filePath = __DIR__ . '/../../files/nfe.xml';
        $notaFiscal = NotaFiscal::loadFromFile($filePath);
        $products = $notaFiscal->products();
        $this->assertIsArray($products);
    }

    public function testProductsInvalidParsedData(): void
    {
        $xmlContent = '<notaFiscal></notaFiscal>';
        $notaFiscal = new NotaFiscal($xmlContent);
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid parsed data');
        $notaFiscal->products();
    }
}
