<?php

namespace App\Domains\Mail;

use Illuminate\Mail\Mailables\Address;

class Sender
{
    public static function noReply(): Address
    {
        return new Address(address: 'no-reply@rescanny.hu', name: 'Rescanny');
    }
}
