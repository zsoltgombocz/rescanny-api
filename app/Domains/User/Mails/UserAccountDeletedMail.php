<?php

namespace App\Domains\User\Mails;

use App\Domains\Mail\Sender;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserAccountDeletedMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(private User $user, private bool $deletedByAdmin = false)
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
            subject: __('mail.user.deleted.subject'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.user_deleted',
            with: [
                'name' => $this->user->first_name ?? __('mail.guest'),
                'deletedByAdmin' => $this->deletedByAdmin,
            ]
        );
    }
}
