<?php

if (!function_exists('deburr')) {
    /**
     * Remove accents from a string.
     */
    function deburr($string): string
    {
        return iconv('UTF-8', 'ASCII//TRANSLIT', $string);
    }
}

if (!function_exists('decimalAdd')) {
    /**
     * Add two decimal numbers with precision using a BCMath function.
     */
    function decimalAdd($number1, $number2, $precision = 2): string
    {
        return bcadd($number1, $number2, $precision);
    }
}

if (!function_exists('decimalDivide')) {
    /**
     * Divide two decimal numbers with precision using a BCMath function.
     */
    function decimalDivide($number1, $number2, $precision = 2): string
    {
        if ($number2 == 0) {
            throw new InvalidArgumentException('Division by zero.');
        }

        return bcdiv($number1, $number2, $precision);
    }
}
