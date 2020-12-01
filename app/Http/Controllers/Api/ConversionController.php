<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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

    public function postNewInteger(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'integer' => 'required|numeric|min:1|max:3999'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $conversion = new Conversion();

        $convertedInteger = $this->converter->convertInteger($request->integer);

        $updateConversion = $conversion->where('integer', $request->integer)->first();

        if ($updateConversion !== null) {

            $updateConversion->update(['hits' => $updateConversion->increment('hits', 1)]);

        } else {

            $conversion->integer = $request->integer;
            $conversion->conversion = $convertedInteger;
            $conversion->hits = 1;
            $conversion->save();

        }

        return new ConvertedInteger();
    }

    public function getRecentlyConvertedIntegers()
    {
        $conversion = new Conversion();

        return new ConversionCollection($conversion->recentlyConvertedIntegers()->get());
    }

    public function getTopTenConvertedIntegers()
    {
        $conversion = new Conversion();

        return new ConversionCollection($conversion->topTenConvertedIntegers()->get());
    }
}
