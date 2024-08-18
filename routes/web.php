<?php

use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\SocialController;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [FileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [FileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [FileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::post('/send-message', [ChatController::class, 'sendMessage']);
Route::get('/chats/{recipient_id}', [ChatController::class, 'fetchChats']);
Route::post('/update-location', [LocationController::class, 'updateLocation']);

Route::get('auth/google', [SocialController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [SocialController::class, 'handleGoogleCallback']);
