<?php

namespace ThaiGov;

class ThaiGov 
{
    
    public static function genIdCard(): ?string
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

    public static function checkIdCard(string $value = null): ?bool
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

}