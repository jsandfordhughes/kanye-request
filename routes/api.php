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

Route::middleware([\App\Http\Middleware\AuthenticateApi::class])->group(function () {
    Route::get('quotes', [\App\Http\Controllers\QuotesController::class, 'quotes']);
    Route::get('quotes/refresh', [\App\Http\Controllers\QuotesController::class, 'refreshQuotes']);
});
