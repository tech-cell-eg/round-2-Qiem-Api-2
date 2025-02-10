<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Authentication\IndividualClient\RegisterController;


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
