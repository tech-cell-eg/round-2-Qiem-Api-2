<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\Inspector\InspectorReporstsController;
use App\Http\Controllers\Inspector\InspectorReportsController;
use App\Http\Controllers\Inspector\PaidProjectsController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\TermsAndConditionsController;
use App\Http\Controllers\Inspector\RealEstateController as InspectorRealEstateController;
use App\Http\Controllers\Inspector\RequestController;
use App\Http\Controllers\InspectorController;
use App\Models\InspectorReport;

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

//paid project
Route::get('inspectors/{id}/paid-projects', [PaidProjectsController::class, 'index'])->name('inspectors.paid-projects');

//report
Route::post('inspectors/report', [InspectorReportsController::class, 'store'])->name('inspector.report.store');
Route::get('/inspectors/reports', [InspectorReportsController::class, 'index'])->name('inspectors.index');
Route::get('/inspectors/report/{id}',[InspectorReportsController::class,'show'])->name('inspector.report.show');

// Routes for Requests
Route::get('requests', [RequestController::class, 'index'])->name('requests.index');
Route::get('requests/{id}', [RequestController::class, 'show'])->name('requests.show');

// Routes for Real Estates (For Inspectors)
Route::get('real-estates', [InspectorRealEstateController::class, 'index'])->name('real-estates.index');
Route::get('real-estates/{id}', [InspectorRealEstateController::class, 'show'])->name('real-estates.show');

//accept or reject request
//accept
Route::post('/requests/{id}/accept', [RequestController::class, 'acceptRequest'])->name('requests.accept');
//reject
Route::post('/requests/{id}/cancel', [RequestController::class, 'cancelRequest'])->name('requests.cancel');