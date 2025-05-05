<?php

use App\Http\Controllers\RealEstateController;
use App\Http\Middleware\ApiAuthentication;
use Illuminate\Support\Facades\Route;

Route::middleware(['cors', 'api.auth'])->group(function () {
    Route::apiResource('real-estates', RealEstateController::class);
});
