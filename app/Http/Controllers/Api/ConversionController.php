<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConversionFormRequest;
use App\Http\Resources\ConvertedInteger;
use App\Repositories\ConversionRepository;
use App\Services\RomanNumeralConverter;
use App\Models\Conversion;
use App\Http\Resources\ConversionCollection;

class ConversionController extends Controller
{
    private RomanNumeralConverter $converter;
    private $conversionRepository;

    public function __construct(ConversionRepository $conversionRepository)
    {
        $this->converter = new RomanNumeralConverter();
        $this->conversionRepository = $conversionRepository;
    }

    public function store($integer, StoreConversionFormRequest $request)
    {
        $this->conversionRepository->updateOrCreate($integer);

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
