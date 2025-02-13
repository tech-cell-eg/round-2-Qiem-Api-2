<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\Api\Authentication\IndividualClient\RegisterController;
use App\Http\Controllers\Api\Authentication\Inspector\InspectorRegisterController;
use App\Http\Controllers\API\Inspector\InspectorController;
use App\Http\Controllers\API\Inspector\NotificationController;
use App\Http\Controllers\API\RealEstateController;
use App\Http\Controllers\TermsAndConditionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/terms-and-conditions', [TermsAndConditionsController::class, 'show']);

//notifications
Route::post('/send-notification',[NotificationController::class,'send'])->name('send.notification');
Route::get('/get-notifications', [NotificationController::class, 'index'])->name('get.notifications');
Route::post('/mark-as-read', [NotificationController::class, 'markAsRead'])->name('mark.as.read');

//Inspector
//Route::get('/inspectors/{id}/balance', [InspectorController::class, 'show'])->name('inspectors.balance');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(\App\Http\Controllers\API\Client\AuthController::class)->group(function () {
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
    Route::controller(\App\Http\Controllers\API\Client\RealEstateController::class)->prefix('real_estate')->group(function () {
       Route::post('/create', 'store');
       Route::get('/all', 'index');
       Route::delete('/delete/{id}/{client_id}', 'delete');
       Route::put('/update/{id}/{client_id}', 'update');
    });

    Route::controller(\App\Http\Controllers\API\Client\PaymentController::class)->prefix('payment')->group(function () {
        Route::get('/paidRealEstate', 'index');
    });

    Route::controller(\App\Http\Controllers\API\Client\OfferController::class)->prefix('offer')->group(function () {
        Route::get('/allOffers', 'index');
        Route::get('/offer/{id}', 'show');
        Route::put('updateOfferStatus/{id}','updateOfferStatus');
    });
    Route::controller(\App\Http\Controllers\API\Client\ProjectController::class)->prefix('project')->group(function () {
       Route::get('/allProjects', 'index');
       Route::get('/project/{id}', 'show');
    });

    Route::controller(\App\Http\Controllers\API\Client\InspectorController::class)->prefix('inspector')->group(function () {
        Route::get('/inspector/{project_id}', 'getInspectorByProject');
    });
});

Route::get('/terms-and-conditions', [TermsAndConditionsController::class, 'show'])->name('terms-and-conditions.show');
//notifications
Route::post('/send-notification',[NotificationController::class,'send'])->name('send.notification');
Route::get('/get-notifications', [NotificationController::class, 'index'])->name('get.notifications');
Route::post('/mark-as-read', [NotificationController::class, 'markAsRead'])->name('mark.as.read');

//Inspector
Route::get('/inspectors/{id}/balance', [InspectorController::class, 'show'])->name('inspectors.balance');

