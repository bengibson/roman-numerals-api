<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConversionFormRequest;
use App\Http\Resources\ConvertedInteger;
use App\Models\Conversion;
use App\Repositories\ConversionRepository;
use App\Services\RomanNumeralConverter;
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

    public function getRecentlyConvertedIntegers(Conversion $query)
    {
        return new ConversionCollection($this->conversionRepository->recentlyConvertedIntegers($query)->get());
    }

    public function getTopTenConvertedIntegers(Conversion $query)
    {
        return new ConversionCollection($this->conversionRepository->topTenConvertedIntegers($query)->get());
    }
}
