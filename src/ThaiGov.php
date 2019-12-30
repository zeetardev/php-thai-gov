<?php

namespace ThaiGov;

class ThaiGov 
{

    // Phone number code
    const POTS = ['2', '3', '4', '5', '7'];
    const MOBILE = ['6', '8', '9'];

    // Checking an ID card
    public static function checkIdCard(string $value = null): bool
    {
        if (strlen($value) != 13 || is_null($value)) {
            return false;
        }
        $digits = str_split($value);
        $tail = array_pop($digits);
        $sum = array_sum(array_map(function ($x, $y) { 
            return ($y + 2) * $x; 
        }, array_reverse($digits), array_keys($digits)));
        return $tail === strval((11 - $sum % 11) % 10);
    }

    // Random a phone number
    public static function genPhoneNumber(string $type = 'M'): string 
    {
        $number = '0';
        if ($type == 'M') {
            $number.= self::MOBILE[rand(0, (sizeof(self::MOBILE) - 1))];
            $digits = 8;
        } else {
            $number.= self::POTS[rand(0, (sizeof(self::POTS) - 1))];
            $digits = 7;
        }
        for ($i = 0; $i < $digits; $i++) {
            $number.= rand(0, 9);
        }
        return $number;
    }

    // Random an ID card
    public static function genIdCard(): string
    {
        $digits = '';
        $sum = 0;
        for ($i = 0; $i < 12; $i++ ) {
            $num = rand(0, 9);
            $digits .= $num;
            $sum += (abs($i + (-13)) * $num);
        }
        return $digits.strval((11 - $sum % 11) % 10);
    }

}