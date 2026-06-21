<?php

namespace App\Console\Commands;

use App\Mail\ClassReminderMail;
use App\Models\Schedule;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendClassReminders extends Command
{
    protected $signature   = 'reminders:send';
    protected $description = 'Kirim email pengingat kuliah 40 menit sebelum kelas dimulai';

    // Map nama hari Indonesia → nomor hari Carbon (0=Minggu, 1=Senin, ..., 6=Sabtu)
    private array $dayMap = [
        'Minggu' => Carbon::SUNDAY,
        'Senin'  => Carbon::MONDAY,
        'Selasa' => Carbon::TUESDAY,
        'Rabu'   => Carbon::WEDNESDAY,
        'Kamis'  => Carbon::THURSDAY,
        'Jumat'  => Carbon::FRIDAY,
        'Sabtu'  => Carbon::SATURDAY,
    ];

    public function handle(): void
    {
        $now       = Carbon::now('Asia/Jakarta');
        $dayName   = $this->getDayName($now->dayOfWeek);
        $target    = $now->copy()->addMinutes(40);

        $this->info("Cek pengingat: {$now->format('Y-m-d H:i')} WIB | Hari: {$dayName} | Target jam: {$target->format('H:i')}");

        // Ambil semua jadwal hari ini yang jamnya = sekarang + 40 menit (toleransi ±1 menit)
        $schedules = Schedule::where('day', $dayName)
            ->whereTime('start_time', '>=', $target->copy()->subMinute()->format('H:i:s'))
            ->whereTime('start_time', '<=', $target->copy()->addMinute()->format('H:i:s'))
            ->with('user')
            ->get();

        if ($schedules->isEmpty()) {
            $this->line("Tidak ada kelas yang dimulai sekitar {$target->format('H:i')}.");
            return;
        }

        $sent = 0;
        foreach ($schedules as $schedule) {
            $user = $schedule->user;
            if (!$user) {
                Log::warning("Schedule #{$schedule->id}: user tidak ditemukan.");
                continue;
            }

            // Gunakan reminder_email jika ada, fallback ke email akun
            $emailTarget = $user->reminder_email ?? $user->email;
            if (!$emailTarget) {
                Log::warning("Schedule #{$schedule->id}: tidak ada email target.");
                continue;
            }

            try {
                Mail::to($emailTarget)
                    ->send(new ClassReminderMail($schedule, $user->name, '40'));

                $this->info("✅ Email terkirim ke {$emailTarget} untuk [{$schedule->course}]");
                Log::info("Reminder terkirim", [
                    'user'   => $emailTarget,
                    'course' => $schedule->course,
                    'day'    => $schedule->day,
                    'start'  => $schedule->start_time,
                ]);
                $sent++;
            } catch (\Exception $e) {
                $this->error("❌ Gagal kirim ke {$emailTarget}: " . $e->getMessage());
                Log::error("Gagal kirim reminder", [
                    'user'  => $emailTarget,
                    'error' => $e->getMessage(),
                ]);
            }
        }

        $this->info("Selesai. {$sent} email terkirim.");
    }

    private function getDayName(int $carbonDayOfWeek): string
    {
        $map = [
            Carbon::SUNDAY    => 'Minggu',
            Carbon::MONDAY    => 'Senin',
            Carbon::TUESDAY   => 'Selasa',
            Carbon::WEDNESDAY => 'Rabu',
            Carbon::THURSDAY  => 'Kamis',
            Carbon::FRIDAY    => 'Jumat',
            Carbon::SATURDAY  => 'Sabtu',
        ];
        return $map[$carbonDayOfWeek] ?? 'Senin';
    }
}
