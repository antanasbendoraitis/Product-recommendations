<?php

use App\Http\Controllers\RecommendationController;
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

Route::get(
    '/products/recommended/{city}',
    [RecommendationController::class, 'index'],
);

Route::any('{any}', function(){
    return response()->json([
        'message'   => 'Page Not Found',
    ], 404);
})->where('any', '.*');
