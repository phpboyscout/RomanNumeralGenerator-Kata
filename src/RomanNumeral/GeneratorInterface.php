<?php
/**
 * GeneratorInterface.php - RomanNumeral\GeneratorInterface
 */
namespace RomanNumeral;

/**
 * Interface GeneratorInterface
 * @package RomanNumeral
 * @subpackage Generator
 */
interface GeneratorInterface
{
    /**
     * generate roman numeral from arabic numeral
     * @param int $number
     * @return string
     */
    public function generate($number);
} 