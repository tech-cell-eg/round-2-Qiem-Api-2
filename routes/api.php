<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InspectorController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\TermsAndConditionsController;

Route::get('/terms-and-conditions', [TermsAndConditionsController::class, 'show']);

//notifications
Route::post('/send-notification',[NotificationController::class,'sendNotification'])->name('send.notification');
Route::get('/get-notifications', [NotificationController::class, 'getNotifications'])->name('get.notifications');
Route::post('/mark-as-read', [NotificationController::class, 'markAsRead'])->name('mark.as.read');

//Inspector
Route::get('/inspectors/{id}/balance', [InspectorController::class, 'showBalance'])->name('inspectors.balance');
