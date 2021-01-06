<?php

namespace App\Repositories;
use App\Http\Resources\ConvertedInteger;
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

        return new ConvertedInteger();
    }

    public function recentlyConvertedIntegers($query)
    {
        $date = \Carbon\Carbon::today()->subDays(7);
        return $query->where('updated_at', '>=', $date)->orderBy('updated_at', 'desc');
    }

    public function topTenConvertedIntegers($query)
    {
        return $query->orderBy('hits','DESC')->orderBy('hits', 'desc')->limit(10);
    }
}
