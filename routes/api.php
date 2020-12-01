<?php

use App\Http\Controllers\Api\ConversionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/integer', [ConversionController::class, 'postNewInteger']);

Route::get('/recently-converted-integers', [ConversionController::class, 'getRecentlyConvertedIntegers']);

Route::get('/top-ten-converted-integers', [ConversionController::class, 'getTopTenConvertedIntegers']);
