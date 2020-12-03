<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConversionFormRequest;
use App\Services\RomanNumeralConverter;
use App\Models\Conversion;
use App\Http\Resources\ConversionCollection;
use App\Http\Resources\ConvertedInteger;

class ConversionController extends Controller
{
    private RomanNumeralConverter $converter;

    public function __construct()
    {
        $this->converter = new RomanNumeralConverter();
    }

    public function store($integer, StoreConversionFormRequest $request)
    {
        $conversion = Conversion::updateOrCreate(
            ['integer' => $integer],
            ['conversion' => $this->converter->convertInteger($integer)]
        );

        $conversion->increment('hits', 1);

        return new ConvertedInteger();
    }

    public function getRecentlyConvertedIntegers(Conversion $conversion)
    {
        return new ConversionCollection($conversion->recentlyConvertedIntegers()->get());
    }

    public function getTopTenConvertedIntegers(Conversion $conversion)
    {
        return new ConversionCollection($conversion->topTenConvertedIntegers()->get());
    }
}
