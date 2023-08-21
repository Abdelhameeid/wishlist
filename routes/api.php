<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(
    [
        'prefix' => 'wishlist',
    ], function(){ 
        Route::controller(WishlistController::class)->group(function(){
            Route::get('index', 'index');
            Route::get('show/{id}', 'show');
            Route::post('store', 'store');
            Route::post('update/{id}', 'update');
            Route::get('total-price-items', 'totalPriceItems');
            Route::get('average-price-items', 'averagePriceItems');
        });
});
