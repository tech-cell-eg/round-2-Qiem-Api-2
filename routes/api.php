<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(\App\Http\Controllers\API\AuthController::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/register', 'register');
});

Route::middleware(['auth:sanctum','role:client'])->group( function () {
    Route::controller(\App\Http\Controllers\API\RealEstateController::class)->prefix('real_estate')->group(function () {
       Route::post('/create', 'store');
       Route::get('/all', 'index');
       Route::delete('/delete/{id}/{client_id}', 'delete');
       Route::put('/update/{id}/{client_id}', 'update');
    });

    Route::controller(\App\Http\Controllers\API\PaymentController::class)->prefix('payment')->group(function () {
        Route::get('/paidRealEstate', 'index');
    });

    Route::controller(\App\Http\Controllers\API\OfferController::class)->prefix('offer')->group(function () {
        Route::get('/allOffers', 'index');
        Route::get('/offer/{id}', 'show');
        Route::put('updateOfferStatus/{id}','updateOfferStatus');
    });
});
