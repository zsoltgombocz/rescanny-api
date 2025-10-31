<?php

namespace App\Domains\Auth\MagicLink;

use App\Domains\Mail\Sender;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MagicLinkMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(private User $user)
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: Sender::noReply(),
            subject: 'Bejelentkezés Rescanny-be',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.magic_link',
            with: [
                'name' => $this->user->first_name ?? __('mail.guest'),
                'link' => $this->user->magicLink(),
                'emailType' => 'Bejelentkezés',
            ]
        );
    }
}
