<?php
// ============================================================
// TAMBAHKAN KE config/services.php (di dalam array return)
// ============================================================
// Temukan file config/services.php di project Laravel kamu,
// lalu tambahkan dua blok berikut ke dalam array-nya:

return [

    // ... (konfigurasi yang sudah ada, jangan dihapus) ...

    // Google OAuth / Calendar API
    'google' => [
        'client_id'     => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect'      => env('GOOGLE_REDIRECT_URI'),
    ],

    // Gemini AI API
    'gemini' => [
        'api_key' => env('GEMINI_API_KEY'),
    ],

];