<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConversionController;
use App\Http\Resources\ConversionCollection;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ConversionController::class, 'index']);

Route::post('/', [ConversionController::class, 'store']);

Route::get('/recently-converted-integers', function () {

    return (new ConversionCollection(App\Models\Conversion::recentlyConvertedIntegers()->orderBy('updated_at', 'desc')->get()))
        ->additional(['meta' => [
            'Recently Converted Integers' => 'All Integers converted in the last 7 days',
        ]]);
});

Route::get('/top-ten-converted-integers', function () {

    return (new ConversionCollection(App\Models\Conversion::topTenConvertedIntegers()->orderBy('hits', 'desc')->limit(10)->get()))
        ->additional(['meta' => [
            'Recently Converted Integers' => 'Top 10 converted integers of all time',
        ]]);

});
