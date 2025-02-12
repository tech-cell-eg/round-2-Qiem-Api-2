<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\TermsAndConditionsController;
use App\Http\Controllers\Inspector\RealEstateController as InspectorRealEstateController;
use App\Http\Controllers\Inspector\RequestController;
use App\Http\Controllers\InspectorController;

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
       Route::delete('/delete/{id}/{client_id}', 'delete');
       Route::put('/update/{id}/{client_id}', 'update');
    });
});

Route::get('/terms-and-conditions', [TermsAndConditionsController::class, 'show'])->name('terms-and-conditions.show');
//notifications
Route::post('/send-notification',[NotificationController::class,'send'])->name('send.notification');
Route::get('/get-notifications', [NotificationController::class, 'index'])->name('get.notifications');
Route::post('/mark-as-read', [NotificationController::class, 'markAsRead'])->name('mark.as.read');

Route::get('inspectors/{id}/balance', [InspectorController::class, 'getBalance'])->name('inspectors.balance');
Route::get('inspectors/{id}/paid-projects', [InspectorController::class, 'getPaidProjects'])->name('inspectors.paid-projects');
Route::post('inspectors/reports', [InspectorController::class, 'storeReport'])->name('inspector.report.store');
// Routes for Requests
Route::get('requests', [RequestController::class, 'index'])->name('requests.index');
Route::get('requests/{id}', [RequestController::class, 'show'])->name('requests.show');
// Routes for Real Estates (For Inspectors)
Route::get('real-estates', [InspectorRealEstateController::class, 'index'])->name('real-estates.index');
Route::get('real-estates/{id}', [InspectorRealEstateController::class, 'show'])->name('real-estates.show');