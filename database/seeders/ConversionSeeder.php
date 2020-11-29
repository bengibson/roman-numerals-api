<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Services\RomanNumeralConverter;

class ConversionSeeder extends Seeder
{
    private RomanNumeralConverter $converter;

    public function __construct()
    {
        $this->converter = new RomanNumeralConverter();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $conversions = array();

        for($i = 0; $i < 3999; $i++)
        {

            $conversions[] = [
                'integer' => $i,
                'conversion' => $this->converter->convertInteger($i),
                'hits' => rand(),
                'created_at' => \Carbon\Carbon::today()->subDays($i),
                'updated_at' => \Carbon\Carbon::today()->subDays($i++),
            ];
        }

        \DB::table('conversions')->insert($conversions);
    }
}
