<?php

namespace App\Http\Controllers;

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

    public function index()
    {
        return view('conversion.index');
    }

    public function store(Request $request)
    {
        $conversion = new Conversion;

        $input = $request->all();

        if ($conversion->validate($input)) {

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

            return redirect('/')->with('success', $convertedInteger);

        } else {

            return redirect('/')->with('errors', $conversion->errors());
        }
    }
}
