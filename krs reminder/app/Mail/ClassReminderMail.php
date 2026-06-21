<?php

namespace App\Mail;

use App\Models\Schedule;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ClassReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Schedule $schedule,
        public string   $studentName,
        public string   $minutesBefore = '40'
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "⏰ Pengingat Kuliah: {$this->schedule->course} — {$this->minutesBefore} menit lagi",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.class-reminder',
        );
    }
}
