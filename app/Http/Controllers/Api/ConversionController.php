<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConversionFormRequest;
use App\Models\Conversion;
use App\Repositories\ConversionRepository;
use App\Services\RomanNumeralConverter;
use App\Http\Resources\ConversionCollection;

class ConversionController extends Controller
{
    private RomanNumeralConverter $converter;
    private ConversionRepository $conversionRepository;

    public function __construct()
    {
        $this->converter = new RomanNumeralConverter();
        $this->conversionRepository = new ConversionRepository();
    }

    public function store($integer, StoreConversionFormRequest $request)
    {
        return $this->conversionRepository->updateOrCreate($integer);
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
