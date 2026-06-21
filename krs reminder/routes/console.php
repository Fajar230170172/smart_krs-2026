<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Jalankan pengecekan pengingat setiap menit
// Laravel Scheduler akan memanggil command ini tiap menit
// dan command akan kirim email jika ada kelas yang mulai 40 menit lagi
Schedule::command('reminders:send')
    ->everyMinute()
    ->timezone('Asia/Jakarta')
    ->withoutOverlapping()
    ->runInBackground();
