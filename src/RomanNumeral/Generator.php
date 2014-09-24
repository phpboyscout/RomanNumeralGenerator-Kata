<?php
/**
 * Generator.php - RomanNumeral\Generator
 */
namespace RomanNumeral;

/**
 * Class Generator
 *
 * Simple Generator Class to allow for the conversion of Arabic Numerals from 1 - 3999 into Roman Numerals
 *
 * @package RomanNumeral
 * @subpackage Generator
 */
class Generator implements GeneratorInterface
{

    /**
     * map of Roman Numerals to Arabic Numerals
     * @var array
     */
    protected $numerals = array(
        'M'  => 1000,
        'CM' => 900,
        'D'  => 500,
        'CD' => 400,
        'C'  => 100,
        'XC' => 90,
        'L'  => 50,
        'XL' => 40,
        'X'  => 10,
        'IX' => 9,
        'V'  => 5,
        'IV' => 4,
        'I'  => 1
    );

    /**
     * @var int
     */
    protected $number;

    /**
     * set the number that has been input while validating input
     * @param int $number
     * @return $this
     */
    public function setNumber($number)
    {
        $this->number = $this->validate($number);;
        return $this;
    }

    /**
     * get originally input and validated number
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * validate supplied number meets validation criteria
     * @param int $number
     * @return null
     */
    public function validate($number)
    {
        try {
            if (is_string($number)) {
                if (preg_match_all('/[^0-9]/', $number)) {
                    throw new \InvalidArgumentException("Argument supplied must be a Numeric string");
                }

                $number = (int)$number;
            }

            if (!is_numeric($number)) {
                throw new \InvalidArgumentException("Argument supplied must be a Numeric integer");
            }

            if ($number < 1) {
                throw new \InvalidArgumentException("Argument supplied must be greater than Zero" . $number);
            }

            if ($number > 3999) {
                throw new \InvalidArgumentException("Argument supplied must be less than Four Thousand");
            }
        } catch (\InvalidArgumentException $e) {
            $this->number = null;
            throw $e;
        }

        return $number;
    }

    /**
     * generate roman numeral from arabic numeral
     * @param int $number
     * @return string
     */
    public function generate($number)
    {
        $this->setNumber($number);

        $result = '';

        foreach ($this->numerals as $roman => $arabic) {
            while ($number >= $arabic) {
                $result .= $roman;
                $number -= $arabic;
            }
        }

        return $result;
    }


}