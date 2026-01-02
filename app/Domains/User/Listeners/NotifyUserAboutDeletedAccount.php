<?php

namespace App\Domains\User\Listeners;

use App\Domains\User\Events\UserDeleted;
use App\Domains\User\Mails\UserAccountDeletedMail;
use Illuminate\Support\Facades\Mail;

class NotifyUserAboutDeletedAccount
{
    public function __invoke(UserDeleted $event): void
    {
        $user = $event->user;
        Mail::to($user)->send(new UserAccountDeletedMail($user, $event->deletedByAdmin));
    }
}
