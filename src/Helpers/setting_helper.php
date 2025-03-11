<?php
if (!function_exists('crypt_setting')) {

    function crypt_setting($setting_name,$value=null)
    {
        helper("text");

        if($value){   // if value is provided, crypt the value and save it to the setting
            service('settings')->set($setting_name, cryptb64($value));
        } else{
            $cryptValue = service('settings')->get($setting_name);
            $value = decryptb64($cryptValue);
            return $value;
        }
    }
}

if (!function_exists('hash_setting')) {

    function hash_setting($setting_name,$value=null)
    {
        helper("text");
        if($value){   // if value is provided, crypt the value and save it to the setting
            // $encryption = config('encryption');
            // $hashValue =hash_hmac('sha512', $value, $encryption->key);
            $hashValue=hmacb64($value); // function provided by text helper
            service('settings')->set($setting_name, $hashValue);
        } else{
            return service('settings')->get($setting_name);
        }
    }
}