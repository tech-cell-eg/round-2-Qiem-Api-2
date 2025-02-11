<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Authentication\IndividualClient\RegisterController;
use App\Http\Controllers\Api\Authentication\EvaluationCompany\EvaluationCompanyRegisterController;
use App\Http\Controllers\Api\Authentication\Inspector\InspectorRegisterController;


use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\InspectorController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\API\RealEstateController;
use App\Http\Controllers\TermsAndConditionsController;


Route::get('/terms-and-conditions', [TermsAndConditionsController::class, 'show']);

//notifications
Route::post('/send-notification',[NotificationController::class,'send'])->name('send.notification');
Route::get('/get-notifications', [NotificationController::class, 'index'])->name('get.notifications');
Route::post('/mark-as-read', [NotificationController::class, 'markAsRead'])->name('mark.as.read');

//Inspector
Route::get('/inspectors/{id}/balance', [InspectorController::class, 'show'])->name('inspectors.balance');

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
Route::post('/register/evaluation-company', [EvaluationCompanyRegisterController::class, 'register']);
//Register inspector
Route::post('/auth/register-inspector', [InspectorRegisterController::class, 'register']);

Route::middleware(['auth:sanctum','role:client'])->group( function () {
    Route::controller(\App\Http\Controllers\API\RealEstateController::class)->prefix('real_estate')->group(function () {
       Route::post('/create', 'store');
       Route::delete('/delete/{id}/{client_id}', 'delete');
       Route::put('/update/{id}/{client_id}', 'update');
    });
});

Route::get('/terms-and-conditions', [TermsAndConditionsController::class, 'show'])->name('terms-and-conditions.show');
//notifications
Route::post('/send-notification',[NotificationController::class,'send'])->name('send.notification');
Route::get('/get-notifications', [NotificationController::class, 'index'])->name('get.notifications');
Route::post('/mark-as-read', [NotificationController::class, 'markAsRead'])->name('mark.as.read');

//Inspector
Route::get('/inspectors/{id}/balance', [InspectorController::class, 'show'])->name('inspectors.balance');

