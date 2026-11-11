<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMessageReceived extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @param  array{name: string, email: string, topic: ?string, message: string}  $contact
     */
    public function __construct(public array $contact) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New message from the uacjp.uz contact form',
            // So that replying in a mail client answers the sender, not the site.
            replyTo: [$this->contact['email']],
        );
    }

    public function content(): Content
    {
        return new Content(markdown: 'emails.contact_message_received');
    }

    public function attachments(): array
    {
        return [];
    }
}
