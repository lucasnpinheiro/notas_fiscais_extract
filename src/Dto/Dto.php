<?php

namespace Lucasnpinheiro\NotasFiscaisExtract\Dto;

use stdClass;

abstract class Dto
{
    /**
     * Creates a new instance of the current class from the given data.
     *
     * @param array $data The data to initialize the instance with.
     *
     * @return self
     */
    public static function extract(array $data = []): self
    {
        return new static($data);
    }

    /**
     * Converts the current instance to a stdClass object.
     *
     * @return stdClass
     */
    public function toObject(): stdClass
    {
        return (object)$this->toArray();
    }

    /**
     * Converts the current instance to an array.
     *
     * @return array
     */
    abstract public function toArray(): array;

    /**
     * Checks if a value exists in the given data array and returns it, or a default value if it does not exist.
     *
     * @param array $data The data array to check.
     * @param string $key The key to check for.
     * @param mixed $default The default value to return if the key does not exist.
     *
     * @return mixed
     */
    protected function getValue(array $data, string $key, $default = null): mixed
    {
        if (array_key_exists($key, $data)) {
            return $data[$key];
        }
        return $default;
    }

    /**
     * Replaces a monetary string with a float value.
     *
     * @param string $value The monetary string to replace.
     *
     * @return float
     */
    protected function replaceMoney(?string $value = null): float
    {
        if (is_null($value)) {
            return 0;
        }
        $value = preg_replace('/[^\d.,]/', '', $value);
        if (stripos($value, ',') !== false) {
            $value = str_replace('.', '', $value);
            $value = str_replace(',', '.', $value);
        }
        return (float)$value;
    }
}