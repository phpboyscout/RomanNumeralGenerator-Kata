<?php
/**
 * GeneratorTest.php - RomanNumeralTest\GeneratorTest
 */
namespace RomanNumeralTest;

/**
 * @package RomanNumeralTest
 * @subpackage Generator
 * @category Test
 */
class GeneratorTest extends \Codeception\TestCase\Test
{
    /**
     * @var \RomanNumeral\Generator
     */
    protected $generator;

    /**
     * Set Up
     */
    protected function _before()
    {
        $this->generator = new \RomanNumeral\Generator();
    }

    /**
     * Tear down
     */
    protected function _after()
    {
    }

    /**
     * Check if a \RomanNumeral\Generator object can be instantiated.
     */
    public function testCanInstantiateGenerator()
    {
        $generator = new \RomanNumeral\Generator();
    }

    /**
     * Check that generate method can accept a Numeric Arabic Numeral
     */
    public function testValidateAcceptsNumericArabicNumeral()
    {
        $result = $this->generator->validate(1);
    }

    /**
     * Check that generate method can accept a String Arabic Numeral
     */
    public function testValidateAcceptsStringArabicNumeral()
    {
        $result = $this->generator->validate('1');
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage "Argument supplied must be a Numeric string"
     */
    public function testValidateNotAcceptStringNonArabicNumeral()
    {
        $result = $this->generator->validate('X');
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage "Argument supplied must be a Numeric integer"
     */
    public function testValidateNotAcceptArray()
    {
        $result = $this->generator->validate(array());
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage "Argument supplied must be a Numeric integer"
     */
    public function testValidateNotAcceptObject()
    {
        $result = $this->generator->validate(new \StdClass());
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage "Argument supplied must be greater than Zero"
     */
    public function testValidateNotAcceptZero()
    {
        $result = $this->generator->validate(0);
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage "Argument supplied must be greater than Zero"
     */
    public function testValidateNotAcceptNegativeOne()
    {
        $result = $this->generator->validate(0);
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage "Argument supplied must be less than Four Thousand"
     */
    public function testValidateNotAcceptMoreThanThreeNineNineNine()
    {
        $result = $this->generator->validate(4000);
    }

    /**
     * Check that internal number property is set to null on invalid input
     */
    public function testInValidArgumentSetsInternalNumberToNull()
    {
        try {
            $result = $this->generator->setNumber('X');
        } catch (\InvalidArgumentException $e) {
            $this->assertNull($this->generator->getNumber());
        }
    }


    /**
     * Check to confirm that validate returns numeric result
     */
    public function testValidateReturnsInteger()
    {
        $result = $this->generator->validate(1);
        $this->assertInternalType('integer', $result);
    }

    /**
     * test generate returns string
     */
    public function testGenerateReturnsString()
    {
        $result = $this->generator->generate(1);
        $this->assertInternalType('string', $result);
    }

    /**
     * test generate returns string
     */
    public function testGetNumberReturnsOriginalInputValue()
    {
        $result = $this->generator->generate(1);
        $this->assertEquals(1, $this->generator->getNumber());
    }

    /**
     * @dataProvider sampleData
     */
    public function testGenerateReturnsCorrectRomanNumeralsForSampleData($arabic, $roman)
    {
        $this->assertEquals($roman, $this->generator->generate($arabic));
    }

    /**
     * Sample Test Data
     * @return array
     */
    public function sampleData()
    {
        return array(
            array(1,    'I'),
            array(2,    'II'),
            array(3,    'III'),
            array(4,    'IV'),
            array(5,    'V'),
            array(9,    'IX'),
            array(10,   'X'),
            array(40,   'XL'),
            array(47,   'XLVII'),
            array(50,   'L'),
            array(90,   'XC'),
            array(100,  'C'),
            array(400,  'CD'),
            array(500,  'D'),
            array(900,  'CM'),
            array(1000, 'M'),
            array(2654, 'MMDCLIV'),
            array(3999, 'MMMCMXCIX'),
        );
    }
}