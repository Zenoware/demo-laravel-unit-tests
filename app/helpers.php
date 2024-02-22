<?php

if (!function_exists('deburr')) {
    // Remove accents and other diacritics from a string.
    function deburr($string)
    {
        return iconv('UTF-8', 'ASCII//TRANSLIT', $string);
    }
}
