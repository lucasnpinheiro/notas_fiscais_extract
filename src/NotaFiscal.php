<?php

declare(strict_types=1);

namespace Lucasnpinheiro\NotasFiscaisExtract;

use InvalidArgumentException;
use JsonException;
use SimpleXMLElement;

class NotaFiscal
{
    private string $xmlContent = '';
    private array $parsedData = [];

    public function __construct(string $xmlContent)
    {
        $this->loadXmlContent($xmlContent);
        $this->convertDataKeysToUppercase();
    }

    private function loadXmlContent(string $xmlContent): void
    {
        $cleanedContent = $this->cleanXmlContent($xmlContent);
        $cleanedContent = $this->removeTags($cleanedContent, 'infCpl');
        $this->xmlContent = $cleanedContent;

        try {
            $xmlElement = new SimpleXMLElement($cleanedContent);
            $this->parsedData = json_decode(json_encode($xmlElement), true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            throw new InvalidArgumentException('Failed to parse XML content', 0, $e);
        }
    }

    private function cleanXmlContent(string $xmlContent): string
    {
        $xmlContent = str_replace(['ï', '»', '¿'], '', $xmlContent);
        $xmlContent = str_replace("\n", '', $xmlContent);
        $xmlContent = mb_convert_encoding($xmlContent, 'UTF-8', 'ISO-8859-9');
        $xmlContent = str_replace(['ï', '»', '¿'], '', $xmlContent);
        $xmlContent = str_replace("\n", '', $xmlContent);
        return trim($xmlContent);
    }

    private function removeTags(string $content, string $tag): string
    {
        $pattern = '/<' . $tag . '.*?<\/' . $tag . '>/Usi';
        return preg_replace($pattern, '', $content);
    }

    private function convertDataKeysToUppercase(): void
    {
        $this->parsedData = $this->changeKeyCaseRecursive($this->parsedData);
    }

    private function changeKeyCaseRecursive(mixed $data): mixed
    {
        if (is_array($data) || is_object($data)) {
            foreach ($data as $key => $value) {
                if (is_array($value)) {
                    $data[$key] = $this->changeKeyCaseRecursive($value);
                }
            }
        }

        if (empty($data)) {
            return $data;
        }

        return array_change_key_case((array)$data, CASE_UPPER);
    }

    public static function loadFromFile(string $filePath): self
    {
        if (!file_exists($filePath)) {
            throw new InvalidArgumentException('File not found');
        }
        return self::loadXml(file_get_contents($filePath));
    }

    public static function loadXml(string $xmlContent): self
    {
        return new self($xmlContent);
    }

    public function xmlContent(): string
    {
        return $this->xmlContent;
    }

    public function parsedData(): array
    {
        return $this->parsedData;
    }

    public function products(): array
    {
        if (!isset($this->parsedData['INFNFE']['DET'])) {
            throw new InvalidArgumentException('Invalid parsed data');
        }

        $products = [];
        foreach ($this->parsedData['INFNFE']['DET'] as $item) {
            $products[] = Products::extract($item);
        }
        return $products;
    }
}