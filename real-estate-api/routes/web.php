<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RealEstateController;

Route::get('/', function () {
    return view('welcome');
});

// API routes
Route::prefix('api')->group(function () {
    Route::apiResource('real-estates', RealEstateController::class);
});
