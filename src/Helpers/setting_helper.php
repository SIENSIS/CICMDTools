<?php
if (!function_exists('crypt_setting')) {

    function crypt_setting($setting_name,$value=null)
    {
        $encrypter = service('encrypter');

        if($value){   // if value is provided, crypt the value and save it to the setting
            $cryptValue = $encrypter->encrypt($value);
            service('settings')->set($setting_name, base64_encode($cryptValue));
        } else{
            $cryptValue = service('settings')->get($setting_name);

            $value = $encrypter->decrypt(base64_decode($cryptValue));
            return $value;
        }
    }
}