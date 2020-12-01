<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Services\RomanNumeralConverter;

class ConvertedInteger extends JsonResource
{
    private RomanNumeralConverter $converter;

    public function __construct()
    {
        $this->converter = new RomanNumeralConverter();
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'conversion' => $this->converter->convertInteger($request->integer)
        ];
    }
}
