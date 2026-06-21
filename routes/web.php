<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\CalendarController;

Route::get('/', function () {
    return view('home');
});

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [ScheduleController::class, 'index'])
        ->name('dashboard');

    // Upload KRS
    Route::post('/upload-krs', [ScheduleController::class, 'upload'])
        ->name('upload.krs');

    // Pengaturan email reminder
    Route::get('/reminder/settings', [ReminderController::class, 'settings'])
        ->name('reminder.settings');

    Route::post('/reminder/settings', [ReminderController::class, 'saveSettings'])
        ->name('reminder.save');

    // Test kirim email reminder
    Route::post('/reminder/test/{schedule}', [ReminderController::class, 'sendTest'])
        ->name('reminder.test');
    // Hapus
    Route::delete('/schedule/{id}', [ScheduleController::class, 'destroy'])->name('schedule.destroy');
});

require __DIR__.'/auth.php';
