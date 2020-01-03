<?php

namespace ThaiGov;

class ThaiGov 
{

    // Phone number code
    const POTS = ['2', '3', '4', '5', '7'];
    const MOBILE = ['6', '8', '9'];

    // Thai numbers
    const NUMBER = [
        '0' => '๐',
        '1' => '๑',
        '2' => '๒',
        '3' => '๓',
        '4' => '๔',
        '5' => '๕',
        '6' => '๖',
        '7' => '๗',
        '8' => '๘',
        '9' => '๙',
    ];

    // Thai days 
    const DAY = [
        'monday' => 'จันทร์',
        'tuesday' => 'อังคาร',
        'wednesday' => 'พุธ',
        'thursday' => 'พฤหัสบดี',
        'friday' => 'ศุกร์',
        'saturday' => 'เสาร์',
        'sunday' => 'อาทิตย์',
    ];

    // Thai months
    const MONTH = [
        '01' => 'มกราคม',
        '02' => 'กุมภาพันธ์',
        '03' => 'มีนาคม',
        '04' => 'เมษายน',
        '05' => 'พฤษภาคม',
        '06' => 'มิถุนายน',
        '07' => 'กรกฎาคม',
        '08' => 'สิงหาคม',
        '09' => 'กันยายน',
        '10' => 'ตุลาคม',
        '11' => 'พฤศจิกายน',
        '12' => 'ธันวาคม',
    ];

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

    // Convert to Thai number as a string
    public static function thaiNum(string $number): string
    {
        $str = null;
        for ($i = 0; $i < strlen($number); $i++) { 
            $str.= self::NUMBER[$number[$i]];
        }
        return $str;
    }

    // Convert to Thai day
    public static function thaiDay(string $day): string 
    {
        return self::DAY[strtolower($day)];
    }

    // Convert to Thai month
    public static function thaiMonth(string $month): string 
    {
        return self::MONTH[strtolower($month)];
    }

    // Convert to Buddhist year
    public static function beYear(int $year): int 
    {
        return $year + 543;
    }

}