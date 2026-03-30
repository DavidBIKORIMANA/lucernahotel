<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactConfirm extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public $contact)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'We Received Your Message — Lucerna Kabgayi Hotel',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.contact_confirm',
            with: ['contact' => $this->contact],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
