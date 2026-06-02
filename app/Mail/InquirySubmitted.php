<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InquirySubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function envelope(): \Illuminate\Mail\Mailables\Envelope
    {
        $villa = $this->data['villa'] ?? null;
        $subject = $villa
            ? "New Villa Inquiry: {$villa->title} - Luxteria"
            : 'New Inquiry Submission - Luxteria';

        return new \Illuminate\Mail\Mailables\Envelope(
            subject: $subject,
        );
    }

    public function content(): \Illuminate\Mail\Mailables\Content
    {
        return new \Illuminate\Mail\Mailables\Content(
            view: 'emails.inquiry-submitted',
        );
    }
}
