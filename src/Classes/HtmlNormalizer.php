<?php

namespace gyaani\guy\Classes;

use Stringy\Stringy;

/**
 * Class HtmlNormalizer
 * @package gyaani\guy\Classes
 * Normalizes HTML stubs, converts types
 * Manages all sorts of weird whitespace in html
 * sets values in an array
 */
class HtmlNormalizer
{
    public $extractedValues = [];

    public function setByValue($col, $rawInput)
    {
        $name = $col[0];
        $type = empty($col[1]) ? 'string' : $col[1];
        $value = $this->getNormalizedValue($rawInput, $type);
        $this->extractedValues[$name] = $value;
    }


    private function handleType($type, $rawInput)
    {
        $type = strtolower($type);
        if (strstr($type, 'int') !== false) {
            $extracted = $this->extractDigits($rawInput);

            $out = $extracted ? intval($extracted, 10) : '';
        } elseif (strstr($type, 'float') !== false) {
            $extracted = $this->extractDigits($rawInput);
            $out = $extracted ? (float)$extracted : '';
        } elseif (strstr($type, 'double') !== false || strstr($type, 'decimal') !== false) {
            $extracted = $this->extractDigits($rawInput);
            $out = $extracted ? (double)$extracted : '';
        } else {
            $out = $rawInput;
        }
        return $out;
    }


    /**
     * @param $rawInput
     * @return string|string[]|null
     */
    private function extractDigits($rawInput)
    {
        $extracted = preg_replace('#[^\d.\-]#', '', $rawInput);
        return $extracted;
    }

    /**
     * @param $rawInput
     * @param string $type
     * @return float|int|string
     */
    public function getNormalizedValue($rawInput, string $type ='text')
    {
        $saneInput = (string)Stringy::create($rawInput)->collapseWhitespace()->trim();
        $value = $this->handleType($type, $saneInput);
        return $value;
    }
}
/*
 * Get table
 * - set col -> type
 * Set functions for each col - (colname, value) OR (colname,selector/regex)
 *
 */
