<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

/**
 * Notice how this helper test does not extend any Laravel test class, nor does it require the framework to be running.
 * The only imports happening here are the ones from PHPUnit and the helper file itself.
 */
class HelperTest extends TestCase
{
    /**
     * @covers ::deburr
     *
     * @dataProvider deburrDataProvider
     */
    public function testDeburr($string, $expected): void
    {
        $this->assertEquals($expected, deburr($string));
    }

    public static function deburrDataProvider(): array
    {
        return [
            ['déjà', 'deja'],
            ['papier-mâché', 'papier-mache'],
            ['résumé', 'resume'],
        ];
    }

    /**
     * @covers ::decimalAdd
     *
     * @dataProvider decimalAddDataProvider
     */
    public function testDecimalAdd($number1, $number2, $precision, $expected): void
    {
        $this->assertEquals($expected, decimalAdd($number1, $number2, $precision));
    }

    public static function decimalAddDataProvider(): array
    {
        return [
            ['1.2345', '2.3456', 2, '3.58'],
            ['0.1', '0.2', 2, '0.30'],
            ['123.456', '789.123', 3, '912.579'],
            ['0.123456', '0.789123', 6, '0.912579'],
            ['0.123456789', '0.987654321', 9, '1.111111110'],
            ['0.0000000001', '0.0000000009', 10, '0.0000000010'],
            ['0.00000000001', '0.00000000009', 11, '0.00000000010'],
            ['0.000000000001', '0.000000000009', 12, '0.000000000010'],
            ['0.0000000000001', '0.0000000000009', 13, '0.0000000000010'],
            ['0.00000000000001', '0.00000000000009', 14, '0.00000000000010'],
        ];
    }

    /**
     * @covers ::decimalDivide
     *
     * @dataProvider decimalDivideDataProvider
     */
    public function testDecimalDivide($number1, $number2, $precision, $expected): void
    {
        $this->assertEquals($expected, decimalDivide($number1, $number2, $precision));
    }

    public function decimalDivideDataProvider(): array
    {
        return [
            ['1.2345', '2.3456', 2, '0.52'],
            ['0.1', '0.2', 2, '0.50'],
            ['123.456', '789.123', 3, '0.156'],
            ['0.123456', '0.789123', 6, '0.156447'],
            ['0.123456789', '0.987654321', 9, '0.124999998'],
        ];
    }

    /**
     * @covers ::decimalDivide
     *
     * @dataProvider invalidDecimalDivideDataProvider
     */
    public function testInvalidDecimalDivide($number1, $number2, $precision): void
    {
        $this->expectException(\InvalidArgumentException::class);

        decimalDivide($number1, $number2, $precision);
    }

    public function invalidDecimalDivideDataProvider(): array
    {
        return [
            ['1.2345', '0', 2],
            ['0.1', '0', 2],
            ['123.456', '0', 3],
        ];
    }
}
