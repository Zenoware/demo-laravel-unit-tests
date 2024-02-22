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
