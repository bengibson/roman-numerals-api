<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\RomanNumeralConverter;
use App\Models\Conversion;

class ConversionController extends Controller
{
    private RomanNumeralConverter $converter;

    public function __construct()
    {
        $this->converter = new RomanNumeralConverter();
    }

    public function postNewInteger(Request $request)
    {

        $validatedData = $request->validate([
            'integer' => 'required|numeric|min:1|max:3999'
        ]);

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

        return response()->json($convertedInteger, 201);
    }

    public function getRecentlyConvertedIntegers()
    {
        $conversion = new Conversion();

        $recentlyConvertedIntegers = $conversion->recentlyConvertedIntegers()->get();

        return response()->json($recentlyConvertedIntegers, 201);

    }

    public function getTopTenConvertedIntegers()
    {
        $conversion = new Conversion();

        $topTenConvertedIntegers = $conversion->topTenConvertedIntegers()->get();

        return response()->json($topTenConvertedIntegers, 201);
    }

}
