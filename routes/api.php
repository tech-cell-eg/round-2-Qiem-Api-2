<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewerController;
use App\Http\Controllers\Api\AccessTokenController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

//Route::post('/addreviewer', [ReviewerController::class,'addreviewer']); ////add reviewer

Route::post('auth/access_token', [AccessTokenController::class, 'store'])->middleware('guest:sanctum');
Route::get('/test', function () {
    return response()->json(['message' => 'Hello World!']);
});
