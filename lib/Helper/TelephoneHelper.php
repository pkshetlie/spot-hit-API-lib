<?php

namespace SpotHit\Client\Helper;

class TelephoneHelper
{
    static function validateMobileNumber($number) {
        $countries = array(
            'AD' => '/^(?:(?:\+|00)376)?\d{6}$/',
            'BE' => '/^(?:(?:\+|00)32)?\d{8}$/',
            'CA' => '/^(?:(?:\+|00)1)?[2-9]\d{2}[2-9](?!11)\d{6}$/',
            'CH' => '/^(?:(?:\+|00)41)?(0|\d{2})\d{9}$/',
            'DE' => '/^(?:(?:\+|00)49)?(0|\d{2})\d{8}$/',
            'ES' => '/^(?:(?:\+|00)34)?[6-7]\d{8}$/',
            'FR' => '/^(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}$/',
            'GB' => '/^(?:(?:\+|00)44|0)7\d{9}$/',
            'IT' => '/^(?:(?:\+|00)39)?\s*(3\d{2})\s*(\d{6,7})$/',
            'US' => '/^(?:(?:\+|00)1)?[2-9]\d{2}[2-9](?!11)\d{6}$/'
        );
        foreach ($countries as $regex) {
            if (preg_match($regex, $number)) {
                return  true;
            }
        }
        return false;
    }
}