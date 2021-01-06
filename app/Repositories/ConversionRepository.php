<?php

namespace App\Repositories;
use App\Services\RomanNumeralConverter;
use App\Models\Conversion;

class ConversionRepository implements ConversionInterface
{
    private RomanNumeralConverter $converter;

    public function __construct()
    {
        $this->converter = new RomanNumeralConverter();
    }

    public function updateOrCreate($integer)
    {
        $conversion = Conversion::updateOrCreate(
            ['integer' => $integer],
            ['conversion' => $this->converter->convertInteger($integer)]
        );

        $conversion->increment('hits', 1);
    }
}
