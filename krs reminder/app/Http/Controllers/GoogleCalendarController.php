<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;

class GoogleCalendarController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')
            ->scopes([
                'https://www.googleapis.com/auth/calendar'
            ])
            ->redirect();
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')->user();

        /*
            SIMPAN TOKEN
        */

        return redirect('/dashboard')
            ->with('success', 'Google Calendar connected');
    }
}