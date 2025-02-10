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
       Route::get('/all', 'showAllRealEstates');
       Route::delete('/delete/{id}/{client_id}', 'delete');
       Route::put('/update/{id}/{client_id}', 'update');
    });

    Route::controller(\App\Http\Controllers\API\PaymentController::class)->prefix('payment')->group(function () {
        Route::get('/paidRealEstate', 'paidRealEstate');
    });

    Route::controller(\App\Http\Controllers\API\OfferController::class)->prefix('offer')->group(function () {
        Route::get('/allOffers', 'showAllOffers');
        Route::get('/offer/{id}', 'showOffer');
        Route::put('updateOfferStatus/{id}','updateOfferStatus');
        Route::get('/acceptedOffers', 'showAcceptedOffers');
        Route::get('/refusedOffers', 'showRefusedOffers');
    });
});
