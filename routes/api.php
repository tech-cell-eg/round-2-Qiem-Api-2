<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\Authentication\IndividualClient\RegisterController;
use App\Http\Controllers\API\Authentication\EvaluationCompany\EvaluationCompanyRegisterController;
use App\Http\Controllers\API\Authentication\Inspector\InspectorRegisterController;
use App\Http\Controllers\API\Authentication\EditProfile\EditProfileController;
use App\Http\Controllers\API\Inspector\InspectorController;
use App\Http\Controllers\API\Inspector\NotificationController;
use App\Http\Controllers\TermsAndConditionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamMember\TeamMemberController;
use App\Http\Controllers\API\Reviewer\RealEstateController;
use App\Http\Controllers\API\Reviewer\ReviewerReportController;
use App\Http\Controllers\API\Reviewer\RealEstateReviewController;

Route::get('/terms-and-conditions', [TermsAndConditionsController::class, 'show'])->name('terms-and-conditions.show');

// Notifications
Route::post('/send-notification', [NotificationController::class, 'send'])->name('send.notification');
Route::get('/get-notifications', [NotificationController::class, 'index'])->name('get.notifications');
Route::post('/mark-as-read', [NotificationController::class, 'markAsRead'])->name('mark.as.read');

// Inspector
Route::get('/inspectors/{id}/balance', [InspectorController::class, 'show'])->name('inspectors.balance');

// Get authenticated user
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Authentication routes
Route::controller(\App\Http\Controllers\API\Client\AuthController::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/register', 'register');
});

// Register individual client
Route::post('/auth/individual-client/register', [RegisterController::class, 'register']);

// Register evaluation company
Route::post('/register/evaluation-company', [EvaluationCompanyRegisterController::class, 'register']);

// Register inspector
Route::post('/auth/register-inspector', [InspectorRegisterController::class, 'register']);

// Edit Profile & Password
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/update-profile', [EditProfileController::class, 'updateProfile']);
    Route::post('/update-password', [EditProfileController::class, 'updatePassword']);
});

// Client routes
Route::middleware(['auth:sanctum', 'role:client'])->group(function () {
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
        Route::put('updateOfferStatus/{id}', 'updateOfferStatus');
    });

    Route::controller(\App\Http\Controllers\API\Client\ProjectController::class)->prefix('project')->group(function () {
        Route::get('/allProjects', 'index');
        Route::get('/project/{id}', 'show');
    });
});

//////Show team members
Route::post('/team-members', [TeamMemberController::class, 'store']);
Route::get('/team-members', [TeamMemberController::class, 'index']);


////// Reviewer
/////Show all properties///
Route::get('/properties', [RealEstateController::class, 'index']);

/// Retrieve details of a real estate property by its Id
Route::get('/properties/{id}', [RealEstateController::class, 'show']);

//Show reports
Route::get('/reviewer/reports', [ReviewerReportController::class, 'index']);
// Show single report
 Route::get('/reviewer/reports/{id}', [ReviewerReportController::class, 'show']);
// Accept/Reject a report
    Route::put('/reviewer/reports/{id}/review', [ReviewerReportController::class, 'review']);
//Send Notes
Route::post('/real-estates/{id}/review', [RealEstateReviewController::class, 'store']);
