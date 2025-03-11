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

if (!function_exists('generateStringID')) {
    function generateStringID($prefix = '', $suffix = '',$split = 0,$entropy=false) {

        if (!empty($prefix)) {
            $id = uniqid($prefix, $entropy);
        } else {
            $id = uniqid('', $entropy);
        }
        $id = $id.$suffix;

        if ($split > 0) {
            $id = implode('-', str_split($id, $split));
        } 
        $id = strtoupper($id);
        
        return $id;
    }
}

if (!function_exists('cryptb64')) {
    function cryptb64($string) {
        $encrypter = service('encrypter');
        $cryptValue = $encrypter->encrypt($string);
        return base64_encode($cryptValue);
    }
}

if (!function_exists('decryptb64')) {
    function decryptb64($string) {
        $encrypter = service('encrypter');
        $decryptValue = base64_decode($string);
        return $encrypter->decrypt($decryptValue);
    }
}

if (!function_exists('hmacb64')) {
    function hmacb64($string) {
        $encryption = config('encryption');
        $hmacValue =hash_hmac('sha512', $string, $encryption->key);
        return base64_encode($hmacValue);
    }
}
