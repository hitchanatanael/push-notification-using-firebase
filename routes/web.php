<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\NotificationController;

Route::get('/', [NotificationController::class, 'index']);
Route::post('/notifications/send', [NotificationController::class, 'sendNotification'])->name('notifications.send');
