<?php

function str_contains($haystack, $needle) {
    return (str_indexof($haystack, $needle) !== false);
}

function str_prefix($text, $prefix) {
    $prefixLength = str_length($prefix);
    $substring = str_substring($text, 0, $prefixLength);

    return $substring == $prefix;
}

function str_suffix($text, $suffix) {
    $suffixLength = str_length($suffix);
    $stringLength = str_length($text);
    $substring = str_substring($text, $stringLength - $suffixLength - 1, $suffixLength);

    return $suffix == $substring;
}

function str_length($string) {
    return strlen($string);
}

function str_substring($string, $start, $length) {
    return substr($string, $start, $length);
}

function str_indexof($haystack, $needle) {
    return strpos($haystack, $needle);
}

function str_explode($string, $delimeter) {
    return explode($delimeter, $string);
}

function str_implode($array, $glue) {
    return implode($glue, $array);
}

function str_salted_hash($string) {
    return hash("sha256", $string . "ion#def57/9s*efa");
}