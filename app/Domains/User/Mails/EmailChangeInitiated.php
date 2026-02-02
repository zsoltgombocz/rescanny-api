<?php

namespace App\Domains\User\Mails;

use App\Domains\Mail\Sender;
use App\Models\EmailChange;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmailChangeInitiated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        private readonly EmailChange $emailChange,
    ) {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: Sender::noReply(),
            subject: __('mail.user.email_change.subject'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        /** @var User $user */
        $user = $this->emailChange->user;

        return new Content(
            markdown: 'mail.email_change_request',
            with: [
                'name' => $user->display_first_name,
                'newEmail' => $this->emailChange->new_email,
                'code' => $this->emailChange->code,
            ]
        );
    }
}
