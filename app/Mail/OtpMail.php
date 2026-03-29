<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $otp,
        public string $purpose = 'verify', // 'verify' or 'reset'
        public string $userName = 'Guest'
    ) {}

    public function envelope(): Envelope
    {
        $subject = $this->purpose === 'reset'
            ? 'Reset Your Password — ' . config('app.name')
            : 'Verify Your Email — ' . config('app.name');

        return new Envelope(subject: $subject);
    }

    public function content(): Content
    {
        return new Content(view: 'mail.otp');
    }
}
