<?php

namespace App\Http\Controllers;

use App\Mail\ClassReminderMail;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ReminderController extends Controller
{
    /**
     * Halaman pengaturan email reminder
     */
    public function settings()
    {
        $user      = Auth::user();
        $schedules = Schedule::where('user_id', $user->id)
            ->orderByRaw("FIELD(day,'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu')")
            ->get();

        return view('reminder.settings', compact('user', 'schedules'));
    }

    /**
     * Simpan email untuk reminder
     */
    public function saveSettings(Request $request)
    {
        $request->validate([
            'reminder_email' => 'required|email|max:255',
        ]);

        // Simpan email reminder ke profil user
        $user = Auth::user();
        $user->update(['reminder_email' => $request->reminder_email]);

        return redirect()->route('reminder.settings')
            ->with('success', "Email pengingat disimpan: {$request->reminder_email}. Kamu akan menerima email 40 menit sebelum setiap kelas.");
    }

    /**
     * Kirim test email reminder untuk satu jadwal
     */
    public function sendTest(Schedule $schedule)
    {
        if ($schedule->user_id !== Auth::id()) abort(403);

        $user  = Auth::user();
        $email = $user->reminder_email ?? $user->email;

        try {
            Mail::to($email)->send(
                new ClassReminderMail($schedule, $user->name, '40')
            );
            return redirect()->route('reminder.settings')
                ->with('success', "✅ Email test berhasil dikirim ke {$email}!");
        } catch (\Exception $e) {
            return redirect()->route('reminder.settings')
                ->with('error', "❌ Gagal kirim email: " . $e->getMessage());
        }
    }
}
