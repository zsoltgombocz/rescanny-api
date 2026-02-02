<?php

namespace App\Domains\User\Actions;

use App\Domains\User\Mails\EmailChangeInitiated;
use App\Models\EmailChange;
use App\Models\User;
use Mail;

class InitiateUserEmailChangeAction
{
    public function handle(User $user, string $newEmail): void
    {
        $code = random_int(100000, 999999);

        /** @var EmailChange $emailChange */
        $emailChange = $user->emailChanges()->create([
            'new_email' => $newEmail,
            'code' => $code,
        ]);

        Mail::to($newEmail)
            ->send(new EmailChangeInitiated(emailChange: $emailChange));
    }
}
