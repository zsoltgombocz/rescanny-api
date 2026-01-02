<?php

namespace App\Domains\User\Actions;

use App\Domains\User\Events\UserDeleted;
use App\Models\User;

class DeleteUserAction
{
    public function handle(User $user, bool $deletedByAdmin = false): void
    {
        event(new UserDeleted(user: $user, deletedByAdmin: $deletedByAdmin));

        if ($user->hasStripeId()) {
            try {
                $user->asStripeCustomer()->delete();
            } catch (\Exception $exception) {
            }
        }

        $user->delete();
    }
}
