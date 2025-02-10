<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Authentication\IndividualClient\RegisterController;
use App\Http\Controllers\Api\Authentication\Inspector\InspectorRegisterController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(\App\Http\Controllers\API\AuthController::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/register', 'register');
});


//register individual client
Route::post('/auth/individual-client/register', [RegisterController::class, 'register']);
//rerister evaluation company
Route::post('/auth/register/evaluation-company', [RegisterController::class, 'register']);
//Register inspector
Route::post('/auth/register-inspector', [InspectorRegisterController::class, 'register']);
Route::middleware(['auth:sanctum','role:client'])->group( function () {
    Route::controller(\App\Http\Controllers\API\RealEstateController::class)->prefix('real_estate')->group(function () {
       Route::post('/create', 'store');
       Route::delete('/delete/{id}/{client_id}', 'delete');
       Route::put('/update/{id}/{client_id}', 'update');
    });
});
