<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ReminderController;

Route::get('/', function () {
    return view('home');
});

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [ScheduleController::class, 'index'])
        ->name('dashboard');

    // Upload KRS PDF
    Route::post('/upload-krs', [ScheduleController::class, 'upload'])
        ->name('upload.krs');

    // Pengaturan email reminder
    Route::get('/reminder/settings', [ReminderController::class, 'settings'])
        ->name('reminder.settings');

    Route::post('/reminder/settings', [ReminderController::class, 'saveSettings'])
        ->name('reminder.save');

    // Test kirim email reminder sekarang (untuk testing)
    Route::post('/reminder/test/{schedule}', [ReminderController::class, 'sendTest'])
        ->name('reminder.test');
});

require __DIR__.'/auth.php';
