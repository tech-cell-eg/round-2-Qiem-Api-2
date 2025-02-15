<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\API\Client\AuthController;
use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\Inspector\RequestController;
use App\Http\Controllers\TermsAndConditionsController;
use App\Http\Controllers\Inspector\InspectorController;
use App\Http\Controllers\TeamMember\TeamMemberController;
use App\Http\Controllers\Inspector\PaidProjectsController;
use App\Http\Controllers\Inspector\InspectorReportsController;
use App\Http\Controllers\Api\Authentication\EditProfile\EditProfileController;
use App\Http\Controllers\Api\Authentication\IndividualClient\RegisterController;
use App\Http\Controllers\Api\Authentication\Inspector\InspectorRegisterController;
use App\Http\Controllers\Inspector\RealEstateController as InspectorRealEstateController;
use App\Http\Controllers\Api\Authentication\EvaluationCompany\EvaluationCompanyRegisterController;


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
Route::post('/register/evaluation-company', [EvaluationCompanyRegisterController::class, 'register']);
//Register inspector
Route::post('/auth/register-inspector', [InspectorRegisterController::class, 'register']);
//Eitd Profile & Edit Password
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/update-profile', [EditProfileController::class, 'updateProfile']);
    Route::post('/update-password', [EditProfileController::class, 'updatePassword']);
});

//Login & Logout
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware(['auth:sanctum','role:client'])->group( function () {
    Route::controller(\App\Http\Controllers\API\Client\RealEstateController::class)->prefix('real_estate')->group(function () {
       Route::post('/create', 'store');
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

//Route::group(function (){
    Route::controller(\App\Http\Controllers\API\Company\ProjectController::class)->prefix('company')->group(function () {
        Route::get('/allProjects', 'index');
        Route::get('/project/{id}', 'show');
        Route::get('/paidProjects', 'paidProjects');
        Route::get('/{project_id}/comments', 'comments');
    });
    Route::controller(\App\Http\Controllers\API\Company\Real_estateController::class)->prefix('company')->group(function () {
        Route::get('/allRealEstate', 'index');
    });
//});

Route::get('/terms-and-conditions', [TermsAndConditionsController::class, 'show'])->name('terms-and-conditions.show');
//notifications
Route::post('/send-notification',[NotificationController::class,'send'])->name('send.notification');
Route::get('/get-notifications', [NotificationController::class, 'index'])->name('get.notifications');
Route::post('/mark-as-read', [NotificationController::class, 'markAsRead'])->name('mark.as.read');

Route::get('inspectors/{id}/balance', [InspectorController::class, 'show'])->name('inspectors.balance');

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

//company
//finish project
Route::get('/project/{id}/finish',[CompanyController::class,'finish'])->name('project.finish');
//Company wallet
Route::get('/company/{id}/wallet',[CompanyController::class, 'show'])->name('company.wallet.show');



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
