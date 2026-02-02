<?php

namespace App\Domains\User\Actions;

use App\Domains\User\Mails\EmailChanged;
use App\Models\EmailChange;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class ConfirmUserEmailChangeAction
{
    public function handle(User $user, int $code): bool
    {
        /** @var ?EmailChange $emailChange */
        $emailChange = $user->emailChanges()->where('code', $code)->first();

        if (empty($emailChange)) {
            return false;
        }

        $emailChange->confirmed_at = now();
        $emailChange->save();

        $user->update(['email' => $emailChange->new_email]);

        Mail::to($emailChange->new_email)
            ->send(new EmailChanged(emailChange: $emailChange));

        return true;
    }
}
