<?php

namespace ThaiGov;

class ThaiGov 
{
    
    public static function genIdCard(): ?string
    {
        $head = null;
        $sum = 0;
        for ($i = 0; $i < 12; $i++ ) {
            $pos = abs($i + (-13));
            $digits = rand(0, 9);
            $head .= $digits;
            $sum += ($pos * $digits);
        }
        return $head.strval((11 - $sum % 11) % 10);
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