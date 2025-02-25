<?php
if (!function_exists('startsWith')) {
    function startsWith($haystack, $needle)
    {
        return substr($haystack, 0, strlen($needle)) === $needle;
    }
}
if (!function_exists('endsWith')) {
    function endsWith($haystack, $needle)
    {
        return substr($haystack, -strlen($needle)) === $needle;
    }
}

if (!function_exists('obscureMiddle')) {
    function obscureMiddle($string) {
        $length = strlen($string);
        if ($length <= 5) {
            return ''; // No hay suficientes caracteres para mostrar
        }

        $visiblePart = substr($string, $length-5, 4);
        $obscuredPart = str_repeat('*', $length - 5);

        return $obscuredPart . $visiblePart . "*";
    }
}