<?php

namespace App\Services;

class RomanNumeralConverter implements IntegerConverterInterface
{

    public function convertInteger(int $integer): string
    {
        $romanNumerals = array(
            'M' => 1000,
            'CM' => 900,
            'D' => 500,
            'CD' => 400,
            'C' => 100,
            'XC' => 90,
            'L' => 50,
            'XL' => 40,
            'X' => 10,
            'IX' => 9,
            'V' => 5,
            'IV' => 4,
            'I' => 1
        );

        $result = "";

        foreach ($romanNumerals as $key => $value) {

            // Determine matches and add same number of characters to the string
            $result .= str_repeat($key, $integer / $value);

            // Set the integer to be the remainder of the value
            $integer %= $value;
        }

        // Return conversion
        return $result;
    }

}
